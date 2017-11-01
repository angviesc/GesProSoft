<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistemactrl extends CI_Controller {

  function __construct(){
    parent::__construct();

    $this->arr_MenAdmin = array('Nuevo articulo' =>  array( 'popUp' => site_url('Sistemactrl/nuevoArticulo')),
                                'Inventario' => array(
                                      'Nuevo articulo' =>  array( 'popUp' => site_url('Sistemactrl/nuevoArticulo')),
                                      'Buscar articulo' => site_url('Sistemactrl/SinFuncion'),
                                      'Ver Articulos' => site_url('Sistemactrl/verArticulos'),
                                      'Ver inventario' => site_url('Sistemactrl/verInentario'),
                                      'divider',
                                      'Abrir lista de pedidos' => site_url('Sistemactrl/SinFuncion'),
                                      'divider',
                                      'Vender stock' => site_url('Sistemactrl/SinFuncion'),
                                      'Recibir stock' => site_url('Sistemactrl/SinFuncion'),
                                      'Pedir stock' => site_url('Sistemactrl/SinFuncion'),
                                      'Transferir stock' => site_url('Sistemactrl/SinFuncion')),
                                'Departamentos' => array(
                                      'Nuevo Departamento' => array( 'popUp' => site_url('Sistemactrl/nuevoDpto')),
                                      'Ver lista de departamentos' => site_url('Sistemactrl/verDpto')),
                                'Almacenes' => array(
                                      'Nuevo almacen' => array( 'popUp' => site_url('Sistemactrl/nuevoAlm')),
                                      'Ver Almacenes' => site_url('Sistemactrl/verAlm')),
                                'Proveedores' => array(
                                      'Nuevo proveedor' => array( 'popUp' => site_url('Sistemactrl/SinFuncion')),
                                      'Ver proveedores' => site_url('Sistemactrl/SinFuncion')),
                                'Clientes' => array(
                                      'Nuevo cliente' => array( 'popUp' => site_url('Sistemactrl/SinFuncion')),
                                      'Ver clientes' => site_url('Sistemactrl/SinFuncion')),
                                'Administrar Biomédicos' => array(
                                      'Nuevo Biomedico' => array( 'popUp' => site_url('Sistemactrl/nuevoBio')),
                                      'Ver Biomedicos' => site_url('Sistemactrl/verBio')),
                                'Informes' => array(
                                      'PENDIENTE' => array( 'popUp' => site_url('Sistemactrl/SinFuncion')),
                                      'PENDIENTE-' => site_url('Sistemactrl/SinFuncion')),
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
        $this->session->set_userdata('user' , $datos[0]['usuario']);
        $this->session->set_userdata('id' , $datos[0]['id']);
        redirect('Sistemactrl/inicioAdm','refresh');
      }else if ($datos[0]['tipo'] == 2){
        $this->session->set_userdata('tipo',2);
        $this->session->set_userdata('usuario' , $datos[0]['nombre'].' '.$datos[0]['apellidop'].' '.$datos[0]['apellidom']);
        $this->session->set_userdata('user' , $datos[0]['usuario']);
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

    $departamentos = $this->modeloctrl->selectDpto();
    if ($departamentos == null) {
      $data['selectDpto'] = '<option value="" disabled selected>Sin departamento registrado</option>';
    }else{
      $data['selectDpto'] = '<option value="" disabled selected>Elige un departamento</option>';
      foreach ($departamentos as $departamento) {
        $data['selectDpto'] .= '<option value="'.$departamento['id'].'">'.$departamento['nombre'].'</option>';
      }
      $data['selectDpto'] .= '<option value="-1">SIN DEPTO</option>';
    }

    $this->load->view('encabezado');
    $this->load->view('Articulos/nuevoArticulo',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function consultaArea(){

  $areas = $this->modeloctrl->consultaArea($this->input->post('idpto'));
  if ($areas == null) {
    $dropselect = '<select name="id_area" disabled>';
    $dropselect .= '<option value="" disabled selected>Sin areas registradas</option>';
  }else{
    $dropselect = '<select name="id_area">';
    $dropselect .= '<option value="" disabled selected>Selecciona un area</option>';
    foreach ($areas as $area) {
      $dropselect .= '<option value="'.$area['id'].'">'.$area['nombre'].'</option>';
    }
  }

  $dropselect .= '</select><label >Area:</label>';
  echo $dropselect;

}

public function insertArticulo(){

  $articulo = $this->input->post();

  $articulo['descripcion'] = nl2br($articulo['descripcion']);
  $articulo['nota'] = nl2br($articulo['nota']);
  unset ($articulo['submitGua']);

  if($this->input->post('equipo-unico')){
    $art_unico = array('marca' =>$articulo['marca'] ,'modelo' => $articulo['modelo'], 'serie' =>$articulo['serie']);
    unset ($articulo['equipo-unico']);
    unset ($articulo['marca']);
    unset ($articulo['modelo']);
    unset ($articulo['serie']);
    $this->modeloctrl->insertArtUnico($articulo,$art_unico);
  }else{
    $this->modeloctrl->insertArticulo($articulo);
  }

  echo '<script language="javascript">
  window.opener.document.location="verArticulos/INSERT_OK"
  window.close();
  </script>';

}

public function verArticulos(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){

    $data['articulos'] = $this->modeloctrl->selectArt();
    $data['atts'] = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank',
                  'id' => 'jump', 'class' => 'waves-effect waves-light btn blue-grey darken-3');

    $this->load->view('encabezado');
    echo Crear_menuMaterial('Usuario',$this->arr_MenAdmin);
    $this->load->view('Articulos/verArticulos',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function verInentario(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['atts'] = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank',
                  'id' => 'jump', 'class' => 'waves-effect waves-light btn blue-grey darken-3');
    $data['inventario'] = $this->modeloctrl->selectStock();

    $this->load->view('encabezado');
    echo Crear_menuMaterial('Usuario',$this->arr_MenAdmin);
    //echo "<pre>";    print_r($data['inventario']);
    $this->load->view('Inventario/verInventario',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function nuevoAlm(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $this->load->view('encabezado');
    $this->load->view('Almacenes/nuevoAlm');
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function insertarAlm(){
  $almacen = $this->input->post();
  $almacen['ubicacion'] = nl2br($almacen['ubicacion']);
  unset ($almacen['submitGua']);

  $this->modeloctrl->insertAlm($almacen);
  echo '<script language="javascript">
  window.opener.document.location="verAlm/INSERT_OK"
  window.close();
  </script>';
}

public function verAlm(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['atts'] = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank',
                  'id' => 'jump', 'class' => 'waves-effect waves-light btn blue-grey darken-3');
    $data['almacenes'] = $this->modeloctrl->selectAlm();
    $this->load->view('encabezado');
    echo Crear_menuMaterial('Usuario',$this->arr_MenAdmin);
    $this->load->view('Almacenes/verAlmacenes',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function nuevoDpto(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){

    $this->load->view('encabezado');
    $this->load->view('Departamentos/nuevoDpto');
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function insertarDpto(){

  $dpto  = array('nombre' => $this->input->post('nombre') );
  $areas = $this->input->post('areas');

  $this->modeloctrl->insertDpto($dpto, $areas);
  echo '<script language="javascript">
  window.opener.document.location="verDpto/INSERT_OK"
  window.close();
  </script>';
}

public function verDpto(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['atts'] = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank',
                  'id' => 'jump', 'class' => 'waves-effect waves-light btn blue-grey darken-3');

    $data['departamentos'] = $this->modeloctrl->selectDpto();
    $areas = $this->modeloctrl->selectAreas();
    $dptoxarea = array();

    foreach ($areas as $area) {
      if (isset($dptoxarea[$area['id_departamento']]))
      $dptoxarea[$area['id_departamento']] .= ', '.$area['nombre'];
      else
      $dptoxarea[$area['id_departamento']] = $area['nombre'];
    }

    $data['areas'] = $dptoxarea;

    $this->load->view('encabezado');
    echo Crear_menuMaterial('Usuario',$this->arr_MenAdmin);
    $this->load->view('Departamentos/verDptos',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

function test(){
  echo "<pre>";
  print_r($this->input->post());
}


  public function inicioBio(){
    echo "inicio Biomedico";
  }
}
