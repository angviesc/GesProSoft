<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistemactrl extends CI_Controller {

  function __construct(){
    parent::__construct();


    $this->arr_MenAdmin = array('Nuevo articulo' =>  array( 'popUp' => site_url('Sistemactrl/nuevoArticulo')),
                                'Inventario' => array(
                                      'Nuevo articulo' =>  array( 'popUp' => site_url('Sistemactrl/nuevoArticulo')),
                                      'Buscar articulo' => site_url('Sistemactrl/buscararticulo'),
                                      'Ver inventario' => site_url('Sistemactrl/verInventario'),
                                      'Abrir lista de pedidos' => site_url('Sistemactrl/verPedidos')),
                                'Stock' => array(
                                      'Vender stock' => site_url('Sistemactrl/venderStock'),
                                      'Recibir stock' => site_url('Sistemactrl/verBio'),
                                      'Pedir stock' => site_url('Sistemactrl/verBio'),
                                      'Transferir stock' => site_url('Sistemactrl/verBio')),
                                'Departamentos' => array(
                                      'Departamento nuevo' => array( 'popUp' => site_url('Sistemactrl/nuevoAlm')),
                                      'Ver lista de departamentos' => site_url('Sistemactrl/verBio')),
                                'Almacenes' => array(
                                      'Nuevo almacen' => array( 'popUp' => site_url('Sistemactrl/nuevoAlm')),
                                      'Ver Almacenes' => site_url('Sistemactrl/verBio')),
                                'Administrar Biomédicos' => array(
                                      'Nuevo Biomedico' => array( 'popUp' => site_url('Sistemactrl/nuevoBio')),
                                      'Ver Biomedicos' => site_url('Sistemactrl/verBio')),
                                'Documentos' => site_url('Sistemactrl/documentos_admin'),
								                'Cerrar sesion' => site_url('Sistemactrl/cerrar_sesion'));

    $this->arr_MenAcademico = array('Nueva solicitud de viáticos' => site_url('Sistemactrl/nuevo_viaje'),
    															'Mis solicitudes de viáticos' => site_url('Sistemactrl/mis_viajes'),
                              'Sistema' => array('EVENTOS ACADÉMICOS' => site_url('Sistemactrl/inicio_usuario'), 'Cerrar sesion' => site_url('Sistemactrl/cerrar_sesion') ));

    //Configurar zona horaria a México
    date_default_timezone_set('UTC');
    date_default_timezone_set("America/Mexico_City");
    setlocale(LC_TIME, 'spanish');
    //Librerias
    $this->load->library('user_agent');


    // Helpers
    $this->load->helper('date');

    //Mis helpers
    $this->load->helper('navbar');

    // Modelo
    $this->load->model('modeloctrl');
  }

	public function index()
	{
    $this->load->view('encabezado');
		$this->load->view('welcome');
		$this->load->view('login/acceso');
		$this->load->view('pie');
	}

  public function validarAcceso(){

    $acceso = $this->input->post();
    $datos = $this->modeloctrl->validarAcceso($acceso);
    if ($datos != null){
      if ($datos[0]['tipo'] == 1){
        redirect('Sistemactrl/inicioAdm','refresh');
      }else{
        redirect('Sistemactrl/inicioBio','refresh');
      }
    }else{
      redirect('Sistemactrl/index/ACC_NEGADO','refresh');
    }
  }

#Funciones Administrador

  public function inicioAdm(){
    $this->load->view('encabezado');
    //echo Crear_menu($this->arr_MenAdmin);
    echo Crear_menuMaterial('Usuario',$this->arr_MenAdmin);
    echo "Inicio Administrador<br>";
    echo $this->agent->platform()."<br>";
    echo ($this->agent->is_mobile())? "Movil" : "Escritorio";
    $this->load->view('pie');
  }

  public function nuevoBio(){
    $this->load->view('encabezado');
    $this->load->view('GestionBio/nuevoBio');
    $this->load->view('pie');
  }

  public function insertarBio(){
    if ($this->input->post('submitGua')){
      $empleado = $this->input->post();
      $usuario = array('usuario' => $empleado['usuario'],
      'password' => md5($empleado['password']),
      'tipo' => 2);
      unset ($empleado['usuario']);
      unset ($empleado['password']);
      unset ($empleado['password2']);
      unset ($empleado['submitGua']);
      $this->modeloctrl->insertarBio($empleado,$usuario);
      echo '<script language="javascript">
			window.opener.document.location="verBio/"
			window.close();
			</script>';
    }
  }

  public function verBio(){
    $data['biomedicos'] = $this->modeloctrl->selectBio();
    $data['atts'] = array( 'width' => 800, 'height' => 700,
                   'scrollbars' => 'yes', 'status' => 'yes',
                   'resizable' => 'yes', 'screenx' => 100,
                   'screeny' => 100, 'window_name' => '_blank',
                    'id' => 'jump');

    $this->load->view('encabezado');
    echo Crear_menuMaterial('Usuario',$this->arr_MenAdmin);
    $this->load->view('GestionBio/verBiomedicos',$data);
    $this->load->view('pie');
  }

  public function editarBio(){
    $id = $this->uri->segment(3);
    $bio = $this->modeloctrl->consultaBio($id);
    $data['biomedico'] = $bio[0];
    $this->load->view('encabezado');
    $this->load->view('GestionBio/editarBio',$data);
    $this->load->view('pie');
  }

  public function actualizarBio(){
    if ($this->input->post('submitGua')){
      $empleado = $this->input->post();
      $id_empleado = $empleado['id_empleado'];
      /*
      $usuario = array('usuario' => $empleado['usuario'],
      'password' => md5($empleado['password']),
      'tipo' => 2);*/
      unset ($empleado['id_empleado']);
      //unset ($empleado['id_us']);
      //unset ($empleado['password2']);
      unset ($empleado['submitGua']);
      $this->modeloctrl->actualizarBio($empleado,$id_empleado);
      echo '<script language="javascript">
      window.opener.document.location="verBio/"
      window.close();
      </script>';
    }
  }

#Funciones Biomedico

  public function inicioBio(){
    echo "inicio Biomedico";
  }
}
