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
                                      'divider',
                                      'Abrir lista de pedidos' => site_url('Sistemactrl/verPedidos'),
                                      'divider',
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
                                'Proveedores' => array(
                                      'Nuevo proveedor' => array( 'popUp' => site_url('Sistemactrl/nuevoBio')),
                                      'Ver proveedores' => site_url('Sistemactrl/verBio')),
                                'Clientes' => array(
                                      'Nuevo cliente' => array( 'popUp' => site_url('Sistemactrl/nuevoBio')),
                                      'Ver clientes' => site_url('Sistemactrl/verBio')),
                                'Administrar Biomédicos' => array(
                                      'Nuevo Biomedico' => array( 'popUp' => site_url('Sistemactrl/nuevoBio')),
                                      'Ver Biomedicos' => site_url('Sistemactrl/verBio')),
                                'Informes' => array(
                                      'Nuevo Biomedico' => array( 'popUp' => site_url('Sistemactrl/nuevoBio')),
                                      'Ver Biomedicos' => site_url('Sistemactrl/verBio')),
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

	public function index(){
    $this->load->view('encabezado');
		$this->load->view('welcome');
		$this->load->view('login/acceso');
		$this->load->view('pie');
	}

  public function acceso(){
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
        $this->session->set_userdata('tipo',1);
        $this->session->set_userdata('usuario' , $datos[0]['nombre'].' '.$datos[0]['apellidop'].' '.$datos[0]['apellidom']);
        $this->session->set_userdata( 'id' , $datos[0]['id']);
        redirect('Sistemactrl/inicioAdm','refresh');
      }else if ($datos[0]['tipo'] == 2){
        $this->session->set_userdata('tipo',2);
        $this->session->set_userdata('usuario' , $datos[0]['nombre'].' '.$datos[0]['apellidop'].' '.$datos[0]['apellidom']);
        $this->session->set_userdata( 'id' , $datos[0]['id']);
        redirect('Sistemactrl/inicioBio','refresh');
      }
    }else{
      redirect('Sistemactrl/index/ACC_NEGADO','refresh');
    }
  }

#Funciones Administrador

  public function inicioAdm(){
    if ($this->session->userdata('tipo') == 1){
      $this->load->view('encabezado');
      //echo Crear_menu($this->arr_MenAdmin);
      echo Crear_menuMaterial('Usuario',$this->arr_MenAdmin);
      echo "Inicio Administrador<br>";
      echo $this->agent->platform()."<br>";
      echo ($this->agent->is_mobile())? "Movil" : "Escritorio";
      $this->load->view('pie');
    }else{
      redirect('Sistemactrl/acceso','refresh');
    }
  }

  public function nuevoBio(){
    if ($this->session->userdata('tipo') == 1){
      $this->load->view('encabezado');
      $this->load->view('GestionBio/nuevoBio');
      $this->load->view('pie');
    }else{
      redirect('Sistemactrl/acceso','refresh');
    }
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
			window.opener.document.location="verBio/INSERT_OK"
			window.close();
			</script>';
    }
  }

  public function verBio(){
    if ($this->session->userdata('tipo') == 1){

      $data['biomedicos'] = $this->modeloctrl->selectBio();
      $data['atts'] = array( 'width' => 800, 'height' => 700,
                   'scrollbars' => 'yes', 'status' => 'yes',
                   'resizable' => 'yes', 'screenx' => 100,
                   'screeny' => 100, 'window_name' => '_blank',
                    'id' => 'jump', 'class' => 'waves-effect waves-light btn blue-grey darken-3');

      $this->load->view('encabezado');
      echo Crear_menuMaterial('Usuario',$this->arr_MenAdmin);
      $this->load->view('GestionBio/verBiomedicos',$data);
      $this->load->view('pie');
    }else{
      redirect('Sistemactrl/acceso','refresh');
    }
  }

  public function editarBio(){
    if ($this->session->userdata('tipo') == 1){
      $id = $this->uri->segment(3);
      $bio = $this->modeloctrl->consultaBio($id);
      $data['biomedico'] = $bio[0];
      $this->load->view('encabezado');
      $this->load->view('GestionBio/editarBio',$data);
      $this->load->view('pie');
    }else{
      redirect('Sistemactrl/acceso','refresh');
    }
  }

  public function actualizarBio(){
    if ($this->input->post('submitGua')){
      $empleado = $this->input->post();
      $id_empleado = $empleado['id_empleado'];
      if ($empleado['update_usuario']){
        $id_usuario = $empleado['id_usuario'];
        $usuario = array('password' => md5($empleado['password']));
        unset ($empleado['password']);
        unset ($empleado['password2']);
        $this->modeloctrl->actualizarUsu($usuario,$id_usuario);
      }
      unset ($empleado['id_empleado']);
      unset ($empleado['id_usuario']);
      unset ($empleado['submitGua']);
      unset ($empleado['update_usuario']);

      $this->modeloctrl->actualizarBio($empleado,$id_empleado);
      echo '<script language="javascript">
      window.opener.document.location="verBio/UPDATE_OK"
      window.close();
      </script>';
    }
  }

  public function eliminarBio(){
    //print_r($this->input->post());    exit;
    $this->modeloctrl->eliminarBio($this->input->post('id_activo'));
    redirect('Sistemactrl/verBio/DELETE_OK','refresh');
  }

#Funciones Biomedico

public function nuevoArticulo(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $this->load->view('encabezado');
    $this->load->view('Articulos/nuevoArticulo');
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function insertArticulo(){
  echo "<pre>";
  print_r($this->input->post());
}

  public function inicioBio(){
    echo "inicio Biomedico";
  }
}
