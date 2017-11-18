<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistemactrl extends CI_Controller {

  function __construct(){
    parent::__construct();

    $this->arr_MenAdmin = array('Nuevo articulo' =>  array(
                                      'popUp' => site_url('Sistemactrl/nuevoArticulo/1')),
                                'Inventario' => array(
                                      'Nuevo articulo' =>  array( 'popUp' => site_url('Sistemactrl/nuevoArticulo/1')),
                                      'Buscar articulo' => site_url('Sistemactrl/SinFuncion'),
                                      'Ver Articulos' => site_url('Sistemactrl/verArticulos'),
                                      'Ver inventario' => site_url('Sistemactrl/verInentario'),
                                      'divider',
                                      'Abrir lista de pedidos' => site_url('Sistemactrl/verPedidos'),
                                      'divider',
                                      'Vender stock' => array( 'popUp' => site_url('Sistemactrl/venderStock/1')),
                                      'Recibir stock' => array( 'popUp' => site_url('Sistemactrl/recibirStock/1')),
                                      'Pedir stock' => array( 'popUp' => site_url('Sistemactrl/nuevoPedido/1')),
                                      'Transferir stock' => site_url('Sistemactrl/transferirStock')),
                                'Departamentos' => array(
                                      'Nuevo Departamento' => array( 'popUp' => site_url('Sistemactrl/nuevoDpto/1')),
                                      'Ver lista de departamentos' => site_url('Sistemactrl/verDpto')),
                                'Almacenes' => array(
                                      'Nuevo almacen' => array( 'popUp' => site_url('Sistemactrl/nuevoAlm/1')),
                                      'Ver Almacenes' => site_url('Sistemactrl/verAlm')),
                                'Proveedores' => array(
                                      'Nuevo proveedor' => array( 'popUp' => site_url('Sistemactrl/nuevoProv/1')),
                                      'Ver proveedores' => site_url('Sistemactrl/verProveedores')),
                                'Clientes' => array(
                                      'Nuevo cliente' => array( 'popUp' => site_url('Sistemactrl/nuevoCliente/1')),
                                      'Ver clientes' => site_url('Sistemactrl/verClientes')),
                                'Administrar Biomédicos' => array(
                                      'Nuevo Biomedico' => array( 'popUp' => site_url('Sistemactrl/nuevoBio/1')),
                                      'Ver Biomedicos' => site_url('Sistemactrl/verBio')),
                                'Informes' => array(
                                      'PENDIENTE' => array( 'popUp' => site_url('Sistemactrl/SinFuncion')),
                                      'PENDIENTE-' => site_url('Sistemactrl/SinFuncion')),
								                'Cerrar sesion' => site_url('Sistemactrl/cerrarSesion'));



    $this->arr_MenAcademico = array('Nueva solicitud de viáticos' => site_url('Sistemactrl/nuevo_viaje/1'),
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
      $usuario['usuario'] = $this->session->userdata('user');
      $usuario['nombre'] = $this->session->userdata('usuario');
      $this->load->view('encabezado');
      $this->load->view('menuAdmin',$usuario);
      /*
      echo "Inicio Administrador<br>";
      echo $this->agent->platform()."<br>";
      echo ($this->agent->is_mobile())? "Movil" : "Escritorio";*/
      $this->load->view('pie');
    }else{
      redirect('Sistemactrl/acceso','refresh');
    }
  }

  public function nuevoBio(){
    if ($this->session->userdata('tipo') == 1){
      $data['sed'] = array('sed' => $this->uri->segment(3));
      $this->load->view('encabezado');
      $this->load->view('GestionBio/nuevoBio',$data);
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

      if ($this->input->post('sed')){
        echo '<script language="javascript">
        window.close();
        </script>';
      }else {
        echo '<script language="javascript">
        window.opener.document.location="verBio/INSERT_OK"
        window.close();
        </script>';
      }
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
    $data['sed'] = array('sed' => $this->uri->segment(3));

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

    $proveedores = $this->modeloctrl->selectProv();
    if ($proveedores == null) {
      $data['selectProv'] = '<option value="" disabled selected>Sin Proveedores registrados</option>';
    }else{
      $data['selectProv'] = '<option value="" disabled selected>Elige un proveedor</option>';
      foreach ($proveedores as $proveedor) {
        $data['selectProv'] .= '<option value="'.$proveedor['id'].'">'.$proveedor['nombre_proveedor'].'</option>';
      }
      $data['selectProv'] .= '<option value="-1">EQUIPO PROPIO</option>';
    }

    $almacenes = $this->modeloctrl->selectAlm();
    if ($almacenes == null) {
      $data['selectAlm'] = '<option value="" disabled selected style="margin-bottom: 1px;">Sin Almacenes registrados</option>';
    }else{
      $data['selectAlm'] = '<option value="" disabled selected>Selecciona un almacen</option>';
      foreach ($almacenes as $almacen) {
        $data['selectAlm'] .= '<option value="'.$almacen['id'].'">'.$almacen['nombre'].'</option>';
      }
    }

    $this->load->view('encabezado');
    $this->load->view('Articulos/nuevoArticulo',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function insertArticulo(){
  //echo "<pre>";print_r($this->input->post());

  $articulo = $this->input->post();

  $articulo['descripcion'] = nl2br($articulo['descripcion']);
  $articulo['nota'] = nl2br($articulo['nota']);
  unset ($articulo['submitGua']);
  unset ($articulo['sed']);
  if ($this->input->post('id_almacen')){
    $stock = array('ids' => $this->input->post('id_almacen'), 'cantidad' => $this->input->post('cantidad'));
    unset ($articulo['id_almacen']);
  }
  unset ($articulo['cantidad']);


  if($this->input->post('equipo-unico')){
    $art_unico = array('marca' =>$articulo['marca'] ,'modelo' => $articulo['modelo'], 'serie' =>$articulo['serie'], 'fecha_instalacion' => $articulo['fecha_instalacion_submit']);
    if ($this->input->post('status')){
      $art_unico['status'] = $articulo['status'];
      unset ($articulo['status']);
    }
    if ($this->input->post('id_proveedor')){
      $art_unico['id_proveedor'] = $articulo['id_proveedor'];
      unset ($articulo['id_proveedor']);
    }
    unset ($articulo['equipo-unico']);
    unset ($articulo['marca']);
    unset ($articulo['modelo']);
    unset ($articulo['serie']);
    unset ($articulo['fecha_instalacion_submit']);
    unset ($articulo['fecha_instalacion']);

    $id = $this->modeloctrl->insertArtUnico($articulo,$art_unico);
  }else{
    unset ($articulo['fecha_instalacion_submit']);
    $id = $this->modeloctrl->insertArticulo($articulo);
  }


  if (isset($stock))
    $this->modeloctrl->insertStock($id,$stock);

  if ($this->input->post('sed')){
    echo '<script language="javascript">
    window.close();
    </script>';
  }else {
    echo '<script language="javascript">
    window.opener.document.location="verArticulos/INSERT_OK"
    window.close();
    </script>';
  }
}

public function editArticulo(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['sed'] = array('sed' => $this->uri->segment(3));

    $data['articulo'] = $this->modeloctrl->consultArt($this->uri->segment(3));

    $departamentos = $this->modeloctrl->selectDpto();
    if ($departamentos == null) {
      $data['selectDpto'] = '<option value="" disabled selected>Sin departamento registrado</option>';
    }else{
      $data['selectDpto'] = '<option value="" disabled>Elige un departamento</option>';
      foreach ($departamentos as $departamento) {
        if ($data['articulo'][0]['id_departamento'] == $departamento['id'])
          $data['selectDpto'] .= '<option value="'.$departamento['id'].'" selected>'.$departamento['nombre'].'</option>';
        else
          $data['selectDpto'] .= '<option value="'.$departamento['id'].'">'.$departamento['nombre'].'</option>';
      }
      $data['selectDpto'] .= '<option value="-1">SIN DEPTO</option>';
    }

    if ($data['articulo'][0]['id_area'] != null){
      $areas = $this->modeloctrl->consultaArea($data['articulo'][0]['id_departamento']);
      if ($areas == null) {
        $dropselect = '<select name="id_area" disabled>';
        $dropselect .= '<option value="" disabled selected>Sin areas registradas</option>';
      }else{
        $dropselect = '<select name="id_area">';
        $dropselect .= '<option value="" disabled selected>Selecciona un area</option>';
        foreach ($areas as $area) {
          if ($data['articulo'][0]['id_area'] == $area['id'])
            $dropselect .= '<option value="'.$area['id'].'" selected>'.$area['nombre'].'</option>';
          else
            $dropselect .= '<option value="'.$area['id'].'">'.$area['nombre'].'</option>';
        }
        $dropselect .= '<option value="-1">SIN AREA</option>';
      }
      $data['selectArea'] = $dropselect;

    }else{
      $data['selectArea'] = '<select disabled>
        <option value="" disabled selected>Selecciona un área</option>
      </select>';

    }

    $proveedores = $this->modeloctrl->selectProv();
    if ($proveedores == null) {
      $data['selectProv'] = '<option value="" disabled selected>Sin Proveedores registrados</option>';
    }else{
      $data['selectProv'] = '<option value="" disabled selected>Elige un proveedor</option>';
      foreach ($proveedores as $proveedor) {
        if ($data['articulo'][0]['id_proveedor'] == $proveedor['id'])
          $data['selectProv'] .= '<option value="'.$proveedor['id'].'" selected>'.$proveedor['nombre_proveedor'].'</option>';
        else
          $data['selectProv'] .= '<option value="'.$proveedor['id'].'">'.$proveedor['nombre_proveedor'].'</option>';
      }
      if ($data['articulo'][0]['id_proveedor'] == -1)
        $data['selectProv'] .= '<option value="-1" selected>EQUIPO PROPIO</option>';
      else
        $data['selectProv'] .= '<option value="-1">EQUIPO PROPIO</option>';
    }

    //echo "<pre>";    print_r($data['articulo']);    exit;

    $this->load->view('encabezado');
    $this->load->view('Articulos/editArticulo',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function actualizaArt(){
  $articulo = $this->input->post();

  $articulo['descripcion'] = nl2br($articulo['descripcion']);
  $articulo['nota'] = nl2br($articulo['nota']);
  unset ($articulo['submitGua']);

  if($this->input->post('marca')){
    $art_unico = array('marca' =>$articulo['marca'] ,'modelo' => $articulo['modelo'], 'serie' =>$articulo['serie'], 'fecha_instalacion' => $articulo['fecha_instalacion_submit']);
    if ($articulo['status']){
      $art_unico['status'] = $articulo['status'];
    }

    if ($this->input->post('id_proveedor')){
      $art_unico['id_proveedor'] = $articulo['id_proveedor'];
    }
    unset ($articulo['marca']);
    unset ($articulo['modelo']);
    unset ($articulo['serie']);
    unset ($articulo['fecha_instalacion_submit']);
    unset ($articulo['fecha_instalacion']);
    unset ($articulo['status']);
    unset ($articulo['id_proveedor']);

    $id = $this->modeloctrl->actualizaArtUnico($articulo,$art_unico);
  }else{
    unset ($articulo['fecha_instalacion_submit']);

    $id = $this->modeloctrl->actualizaArt($articulo);
  }

  echo '<script language="javascript">
  window.opener.document.location="verArticulos/UPDATE_OK"
  window.close();
  </script>';

}

public function eliminarArt(){

  $this->modeloctrl->eliminarArt($this->input->post('id_activo'));
  redirect('Sistemactrl/verArticulos/DELETE_OK','refresh');

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
    $dropselect .= '<option value="-1">SIN AREA</option>';
  }
  $dropselect .= '</select><label >Area:</label>';
  echo $dropselect;

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
    $data['sed'] = array('sed' => $this->uri->segment(3));
    $this->load->view('encabezado');
    $this->load->view('Almacenes/nuevoAlm',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function insertarAlm(){
  $almacen = $this->input->post();
  $almacen['ubicacion'] = nl2br($almacen['ubicacion']);
  unset ($almacen['submitGua']);
  unset ($almacen['sed']);

  $this->modeloctrl->insertAlm($almacen);

  if ($this->input->post('sed')){
    echo '<script language="javascript">
    window.close();
    </script>';
  }else {
    echo '<script language="javascript">
    window.opener.document.location="verAlm/INSERT_OK"
    window.close();
    </script>';
  }
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

public function editarAlm(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['atts'] = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank',
                  'id' => 'jump', 'class' => 'waves-effect waves-light btn blue-grey darken-3');


    $data['almacen'] = $this->modeloctrl->consultAlm($this->uri->segment(3));

    $this->load->view('encabezado');
    $this->load->view('Almacenes/editarAlm',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function actualizarAlm(){
  $almacen = $this->input->post();
  unset ($almacen['submitGua']);
  $almacen['ubicacion'] = nl2br($almacen['ubicacion']);

  $this->modeloctrl->actualizarAlm($almacen);

  echo '<script language="javascript">
  window.opener.document.location="verAlm/UPDATE_OK"
  window.close();
  </script>';
}

public function eliminarAlm(){
  //print_r($this->input->post('id_activo'));
  $this->modeloctrl->eliminarAlm($this->input->post('id_activo'));
  redirect('Sistemactrl/verAlm/DELETE_OK','refresh');
}

public function nuevoDpto(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['sed'] = array('sed' => $this->uri->segment(3));
    $this->load->view('encabezado');
    $this->load->view('Departamentos/nuevoDpto',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function insertarDpto(){
  $dpto  = array('nombre' => $this->input->post('nombre') );
  $areas = $this->input->post('areas');

  $this->modeloctrl->insertDpto($dpto, $areas);
  if ($this->input->post('sed')){
    echo '<script language="javascript">
    window.close();
    </script>';
  }else {
    echo '<script language="javascript">
    window.opener.document.location="verDpto/INSERT_OK"
    window.close();
    </script>';
  }
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

public function editarDpto(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['atts'] = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank',
                  'id' => 'jump', 'class' => 'waves-effect waves-light btn blue-grey darken-3');


    $data['departamentos'] = $this->modeloctrl->consultaDpto($this->uri->segment(3));

    $this->load->view('encabezado');
    $this->load->view('Departamentos/editarDpto',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function actualizarDpto(){

  $departamento = array('id' => $this->input->post('id_departamento'), 'nombre' => $this->input->post('nombre'));
  $areas_editadas = array('ids' => $this->input->post('id_area_edit'), 'nombre' => $this->input->post('area_editada'));
  $areas_eliminadas = array('ids' => $this->input->post('id_area_delete'));
  $areas_nuevas = array('id' => $this->input->post('id_departamento'), 'nombres' => $this->input->post('areas'));

  $this->modeloctrl->actualizarDpto($departamento);
  $this->modeloctrl->actualizarAreas($areas_editadas);
  $this->modeloctrl->eliminarAreas($areas_eliminadas);
  $this->modeloctrl->insertarAreas($areas_nuevas);

  echo '<script language="javascript">
  window.opener.document.location="verDpto/UPDATE_OK"
  window.close();
  </script>';
}

public function eliminarDpto(){
  $this->modeloctrl->eliminarDpto($this->input->post('id_activo'));
  redirect('Sistemactrl/verDpto/DELETE_OK','refresh');
}

//proveedores

public function nuevoProv(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['sed'] = array('sed' => $this->uri->segment(3));
    $this->load->view('encabezado');
    $this->load->view('Proveedores/nuevoProv',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function insertarProv(){

  $proveedor = $this->input->post();
  unset ($proveedor['submitGua']);
  unset ($proveedor['sed']);

  $this->modeloctrl->insertProv($proveedor);

  if ($this->input->post('sed')){
    echo '<script language="javascript">
    window.close();
    </script>';
  }else {
    echo '<script language="javascript">
    window.opener.document.location="verProveedores/INSERT_OK"
    window.close();
    </script>';
  }
}

public function verProveedores(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){

    $data['proveedores'] = $this->modeloctrl->selectProv();

    $data['atts'] = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank',
                  'id' => 'jump', 'class' => 'waves-effect waves-light btn blue-grey darken-3');

    $this->load->view('encabezado');
    echo Crear_menuMaterial('Usuario',$this->arr_MenAdmin);
    $this->load->view('Proveedores/verProv',$data);
    $this->load->view('pie');

  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function editarProv(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){

    $data['proveedor'] = $this->modeloctrl->consultProv($this->uri->segment(3));

    $data['atts'] = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank',
                  'id' => 'jump', 'class' => 'waves-effect waves-light btn blue-grey darken-3');

    $this->load->view('encabezado');
    $this->load->view('Proveedores/editProv',$data);
    $this->load->view('pie');

  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function actualizaProv(){
  $proveedor = $this->input->post();
  unset ($proveedor['submitGua']);

  $this->modeloctrl->actualizaProv($proveedor);

  echo '<script language="javascript">
  window.opener.document.location="verProveedores/UPDATE_OK"
  window.close();
  </script>';
}

public function eliminarProv(){
  $this->modeloctrl->eliminarProv($this->input->post('id_activo'));
  redirect('Sistemactrl/verProveedores/DELETE_OK','refresh');
}

//Clientes

public function nuevoCliente(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['sed'] = array('sed' => $this->uri->segment(3));
    $this->load->view('encabezado');
    $this->load->view('Clientes/nuevoCliente',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function insertarCliente(){
  $proveedor = $this->input->post();
  unset ($proveedor['submitGua']);
  unset ($proveedor['sed']);

  $this->modeloctrl->insertCliente($proveedor);

  if ($this->input->post('sed')){
    echo '<script language="javascript">
    window.close();
    </script>';
  }else {
    echo '<script language="javascript">
    window.opener.document.location="verClientes/INSERT_OK"
    window.close();
    </script>';
  }
}

public function verClientes(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){

    $data['cleintes'] = $this->modeloctrl->selectClientes();

    $data['atts'] = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank',
                  'id' => 'jump', 'class' => 'waves-effect waves-light btn blue-grey darken-3');

    $this->load->view('encabezado');
    echo Crear_menuMaterial('Usuario',$this->arr_MenAdmin);
    $this->load->view('clientes/verClientes',$data);
    $this->load->view('pie');

  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function editarCliente(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){

    $data['cliente'] = $this->modeloctrl->consultCliente($this->uri->segment(3));

    $data['atts'] = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank',
                  'id' => 'jump', 'class' => 'waves-effect waves-light btn blue-grey darken-3');

    $this->load->view('encabezado');
    $this->load->view('Clientes/editCliente',$data);
    $this->load->view('pie');

  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function actualizarCliente(){
  $cliente = $this->input->post();
  unset ($cliente['submitGua']);

  $this->modeloctrl->actualizaCliente($cliente);

  echo '<script language="javascript">
  window.opener.document.location="verClientes/UPDATE_OK"
  window.close();
  </script>';
}

public function eliminarCliente(){
  $this->modeloctrl->eliminarCliente($this->input->post('id_activo'));
  redirect('Sistemactrl/verClientes/DELETE_OK','refresh');
}

public function verPedidos(){

  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['atts'] = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank',
                  'id' => 'jump', 'class' => 'waves-effect waves-light btn blue-grey darken-3');

    $data['pedidos'] = $this->modeloctrl->selectPedidos();
    //echo "<pre>";    print_r($data['pedidos']);    exit;

    $this->load->view('encabezado');
    echo Crear_menuMaterial('Usuario',$this->arr_MenAdmin);
    $this->load->view('Pedidos/verPedidos',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }

}

public function venderStock(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['sed'] = array('sed' => $this->uri->segment(3));

    $articulos = $this->modeloctrl->selectArt();

    if ($articulos == null) {
      $data['selectArt'] = '<option value="" disabled selected>Sin articulos registrados</option>';
    }else{
      $data['selectArt'] = '<option value="" disabled selected>Elige un articulo</option>';
      foreach ($articulos as $articulo) {
        $data['selectArt'] .= '<option value="'.$articulo['id'].'">'.$articulo['codigo'].'</option>';
      }
    }

    $clientes = $this->modeloctrl->selectClientes();

    if ($clientes == null) {
      $data['selectCli'] = '<option value="" disabled selected>Sin clientes registrados</option>';
    }else{
      $data['selectCli'] = '<option value="" disabled selected>Elige un cliente</option>';
      foreach ($clientes as $cliente) {
        $data['selectCli'] .= '<option value="'.$cliente['id'].'">'.$cliente['nombre_cliente'].'</option>';
      }
    }

    $this->load->view('encabezado');
    $this->load->view('Stock/venderStock',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }

}

public function cargarUb(){

  $ubicacion = $this->modeloctrl->consultaUb($this->input->post('id_art'));

  if ($ubicacion == null) {
    $dropselect = '<select name="id_almacen[]" class = "selectAlm" disabled>';
    $dropselect .= '<option value="" disabled selected>Sin existencias</option>';
  }else{
    $dropselect = '<select name="id_almacen[]" class = "selectAlm" required>';
    $dropselect .= '<option value="" disabled selected>Selecciona un almacen</option>';
    foreach ($ubicacion as $area) {
      $dropselect .= '<option value="'.$area['id_almacen'].'">'.$area['nombre'].'</option>';
    }

  }
  $dropselect .= '</select><label >Almacen:</label>';
  echo $dropselect;

}

public function cargarPrecio(){

  $precio = $this->modeloctrl->consultaPrecio($this->input->post('id_art'));
  echo '$'.$precio;

}

public function cargarExistencias(){

  $existencias = $this->modeloctrl->consultaExistencias($this->input->post('id_alm'), $this->input->post('id_art'));
  echo $existencias;

}

public function previsualizarVenta(){
//echo "<pre>";  print_r($this->input->post());  exit;

  $venta = array('nombre_venta'=> $this->input->post('nombre_venta'),
                 'id_cliente' => $this->input->post('id_cliente'),
                 'nota' => nl2br($this->input->post('nota')),
                 'fecha_venta' => $this->input->post('fecha_venta_submit'));

  $articulos = $this->input->post('id_articulo');
  $almacenes = $this->input->post('id_almacen');
  $cantidades = $this->input->post('cantidad');
  $articulos_vendidos = array();

  for ($i=0; $i < count($articulos) ; $i++) {
    if (isset($almacenes[$i])){
      if (isset($articulos_vendidos[$articulos[$i].'-'.$almacenes[$i]])){
        $articulos_vendidos[$articulos[$i].'-'.$almacenes[$i]]['cantidad'] += $cantidades[$i];
      }else{
        $articulos_vendidos[$articulos[$i].'-'.$almacenes[$i]]['id_articulo'] =  $articulos[$i];
        $articulos_vendidos[$articulos[$i].'-'.$almacenes[$i]]['id_almacen'] = $almacenes[$i] ;
        $articulos_vendidos[$articulos[$i].'-'.$almacenes[$i]]['cantidad'] = $cantidades[$i];
      }
    }
  }

  $venta_articulos = array();

  foreach ($articulos_vendidos as $articulo) {
      $show = $this->modeloctrl->existenciaStock($articulo['id_articulo'], $articulo['id_almacen']);
      $show['id_articulo'] = $articulo['id_articulo'];
      $show['id_almacen'] = $articulo['id_almacen'];
      ($articulo['cantidad'] > $show['cantidad'])? $show['venta'] = $show['cantidad'] : $show['venta'] = $articulo['cantidad'];
      $show['venta'] = $articulo['cantidad'];
      array_push($venta_articulos, $show);
  }

  $cliente = $this->modeloctrl->consultCliente($venta['id_cliente']);

  if ($cliente != null)
    $venta['nombre_cliente'] = $cliente[0]['nombre_cliente'] ;
  else
    $venta['nombre_cliente'] = '';

  $data['venta'] = $venta;
  $data['articulos'] = $venta_articulos;

  $this->load->view('encabezado');
  $this->load->view('Stock/visualizarVenta',$data);
  $this->load->view('pie');

}

public function insertarVenta(){

  if ($this->input->post('submitEdit')){
    $editVenta = $this->input->post();

    $editVenta['selectArt'] = array();
    $editVenta['selectAlm'] = array();

    foreach ($editVenta['id_articulo'] as $id) {

      $articulos = $this->modeloctrl->selectArtMultiples();
      if ($articulos == null) {
        $selectArt = '<option value="" disabled selected>Sin articulos registrados</option>';
      }else{
        $selectArt = '<option value="" disabled selected>Elige un articulo</option>';
        foreach ($articulos as $articulo) {
          if ($id == $articulo['id'])
            $selectArt .= '<option value="'.$articulo['id'].'" selected>'.$articulo['codigo'].'</option>';
          else
            $selectArt .= '<option value="'.$articulo['id'].'">'.$articulo['codigo'].'</option>';
        }
      }
      array_push($editVenta['selectArt'], $selectArt);
    }

    foreach ($editVenta['id_almacen'] as $id) {
      $ubicacion = $this->modeloctrl->selectAlm();
      if ($ubicacion == null) {
        $dropselect = '<option value="" disabled selected>Sin existencias</option>';
      }else{
        $dropselect = '<option value="" disabled selected>Selecciona un almacen</option>';
        foreach ($ubicacion as $area) {
          if ($id == $area['id'])
            $dropselect .= '<option value="'.$area['id'].'" selected>'.$area['nombre'].'</option>';
          else
            $dropselect .= '<option value="'.$area['id'].'">'.$area['nombre'].'</option>';
        }
      }
      array_push($editVenta['selectAlm'], $dropselect);
    }

    $clientes = $this->modeloctrl->selectClientes();

    if ($clientes == null) {
      $data['selectCli'] = '<option value="" disabled selected>Sin clientes registrados</option>';
    }else{
      $data['selectCli'] = '<option value="" disabled selected>Elige un cliente</option>';
      foreach ($clientes as $cliente) {
        if ($editVenta['id_cliente'] == $cliente['id'])
          $data['selectCli'] .= '<option value="'.$cliente['id'].'" selected>'.$cliente['nombre_cliente'].'</option>';
        else
          $data['selectCli'] .= '<option value="'.$cliente['id'].'">'.$cliente['nombre_cliente'].'</option>';
      }
    }

    $articulos = $this->modeloctrl->selectArt();

    if ($articulos == null) {
      $data['selectArt'] = '<option value="" disabled selected>Sin articulos registrados</option>';
    }else{
      $data['selectArt'] = '<option value="" disabled selected>Elige un articulo</option>';
      foreach ($articulos as $articulo) {
        $data['selectArt'] .= '<option value="'.$articulo['id'].'">'.$articulo['codigo'].'</option>';
      }
    }

    $data['editVenta'] = $editVenta;

    $this->load->view('encabezado');
    $this->load->view('Stock/editarVenta',$data);
    $this->load->view('pie');

  } else{
    //echo "<pre>";    print_r($this->input->post());
    $venta = array('nombre_venta'=> $this->input->post('nombre_venta'),
                   'id_cliente' => $this->input->post('id_cliente'),
                   'nota' => $this->input->post('nota'),
                   'fecha_venta' =>$this->input->post('fecha_venta_submit'));


    $artculos = array();

    $id = $this->modeloctrl->insertVenta($venta);

    $id_articulo = $this->input->post('id_articulo');
    $costo_venta = $this->input->post('costo_venta');

    for ($i=0; $i < count($id_articulo) ; $i++) {
      array_push($artculos,array('id_articulo' => $id_articulo[$i],
                                 'precio_venta' => $costo_venta[$i],
                                 'id_venta' => $id));
    }

    $this->modeloctrl->registrarArticulos($artculos);

    $updateStock = array();

    $id_stock = $this->input->post('id_stock');
    $cantidad_venta = $this->input->post('cantidad_venta');

    for ($i=0; $i < count($id_stock) ; $i++) {
      array_push($updateStock,array('id_stock' => $id_stock[$i],
                                 'cantidad' => $cantidad_venta[$i]));
    }


    $this->modeloctrl->updateStock($updateStock);

    echo '<script language="javascript">
    window.close();
    </script>';

  }

}

public function transferirStock(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['sed'] = array('sed' => $this->uri->segment(3));

    $almacenes = $this->modeloctrl->selectAlm();

    if ($almacenes == null) {
      $data['selectAlm'] = '<option value="" disabled selected>Sin Almacenes registrados</option>';
    }else{
      $data['selectAlm'] = '<option value="" disabled selected>Elige un almacen</option>';
      foreach ($almacenes as $almacen) {
        $data['selectAlm'] .= '<option value="'.$almacen['id'].'">'.$almacen['nombre'].'</option>';
      }
    }

    $this->load->view('encabezado');
    echo Crear_menuMaterial('Usuario',$this->arr_MenAdmin);
    $this->load->view('Stock/tranStock',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function cargarStock(){
  $id = $this->input->post('id_alm');
  $data['stock'] = $this->modeloctrl->consultStock($id);

  $this->load->view('Stock/stockUb',$data);
}

public function updateStock(){
  $this->modeloctrl->transferirStock($this->input->post());
}

public function nuevoPedido(){

  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['sed'] = array('sed' => $this->uri->segment(3));

    $articulos = $this->modeloctrl->selectArtMultiples();

    if ($articulos == null) {
      $data['selectArt'] = '<option value="" disabled selected>Sin articulos registrados</option>';
    }else{
      $data['selectArt'] = '<option value="" disabled selected>Elige un articulo</option>';
      foreach ($articulos as $articulo) {
        $data['selectArt'] .= '<option value="'.$articulo['id'].'">'.$articulo['codigo'].'</option>';
      }
    }

    $proveedores = $this->modeloctrl->selectProv();

    if ($proveedores == null) {
      $data['selectProv'] = '<option value="" disabled selected>Sin proveedores registrados</option>';
    }else{
      $data['selectProv'] = '<option value="" disabled selected>Elige un proveedor</option>';
      foreach ($proveedores as $proveedor) {
        $data['selectProv'] .= '<option value="'.$proveedor['id'].'">'.$proveedor['nombre_proveedor'].'</option>';
      }
    }

    $this->load->view('encabezado');
    $this->load->view('Pedidos/nuevoPedido',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }

}

public function cargaPrecio(){

  $precio = $this->modeloctrl->consultaPrecio($this->input->post('id_art'));
  echo '$'.$precio;

}

public function previsualizarPedido(){

  $data['sed'] = array('sed' => $this->input->post('sed'));

  $pedido = array('nombre_pedido' => $this->input->post('nombre_pedido'),
                  'id_proveedor' => $this->input->post('id_proveedor'),
                  'fecha_llegada' => $this->input->post('fecha_llegada_submit') );

  $articulos = $this->input->post('id_articulo');
  $cantidad = $this->input->post('cantidad');



  $articulos_pedidos = array();

  for ($i=0; $i < count($articulos) ; $i++) {
    $precio = $this->modeloctrl->consultaPrecio($articulos[$i]);
    $articulo = $this->modeloctrl->consultArt($articulos[$i]);
    $arreglo = array('id_articulo' => $articulos[$i],
                     'nombre' => $articulo[0]['nombre'],
                     'codigo' => $articulo[0]['codigo'],
                     'cantidad' => $cantidad[$i],
                     'precio_unitario' => $precio);
    array_push($articulos_pedidos, $arreglo);
  }


  $proveedor = $this->modeloctrl->consultProv($pedido['id_proveedor']);
  $data['proveedor'] = $proveedor[0]['nombre_proveedor'];

  $data['pedido'] = $pedido;
  $data['articulos_pedidos'] = $articulos_pedidos;

  $this->load->view('encabezado');
  $this->load->view('Pedidos/visualizarPedido',$data);
  $this->load->view('pie');

}

public function insertarPedido(){

  if ($this->input->post('submitEdit')){

    $articulos = $this->modeloctrl->selectArtMultiples();

    if ($articulos == null) {
      $data['selectArt'] = '<option value="" disabled selected>Sin articulos registrados</option>';
    }else{
      $data['selectArt'] = '<option value="" disabled selected>Elige un articulo</option>';
      foreach ($articulos as $articulo) {
        $data['selectArt'] .= '<option value="'.$articulo['id'].'">'.$articulo['codigo'].'</option>';
      }
    }


    $editPedido = $this->input->post();


    $editPedido['selectArt'] = array();

    foreach ($editPedido['id_articulo'] as $id) {

      $articulos = $this->modeloctrl->selectArt();
      if ($articulos == null) {
        $selectArt = '<option value="" disabled selected>Sin articulos registrados</option>';
      }else{
        $selectArt = '<option value="" disabled selected>Elige un articulo</option>';
        foreach ($articulos as $articulo) {
          if ($id == $articulo['id'])
            $selectArt .= '<option value="'.$articulo['id'].'" selected>'.$articulo['codigo'].'</option>';
          else
            $selectArt .= '<option value="'.$articulo['id'].'">'.$articulo['codigo'].'</option>';
        }
      }
      array_push($editPedido['selectArt'], $selectArt);
    }


    $proveedores = $this->modeloctrl->selectProv();

    if ($proveedores == null) {
      $data['selectProv'] = '<option value="" disabled selected>Sin proveedores registrados</option>';
    }else{
      $data['selectProv'] = '<option value="" disabled selected>Elige un proveedor</option>';
      foreach ($proveedores as $proveedor) {
        if ($editPedido['id_proveedor'] == $proveedor['id'])
          $data['selectProv'] .= '<option value="'.$proveedor['id'].'" selected>'.$proveedor['nombre_proveedor'].'</option>';
        else
          $data['selectProv'] .= '<option value="'.$proveedor['id'].'">'.$proveedor['nombre_proveedor'].'</option>';
      }
    }

    $data['editPedido'] = $editPedido;

    $this->load->view('encabezado');
    $this->load->view('Pedidos/editPedido',$data);
    $this->load->view('pie');

  } else{

    $pedido = array('nombre_pedido' => $this->input->post('nombre_pedido'),
                    'id_proveedor' => $this->input->post('id_proveedor'),
                    'fecha_emision' => date("Y-m-d"),
                    'fecha_llegada' => $this->input->post('fecha_llegada_submit'),
                    'status' => 0);

    $articulos_pedidos = array();

    $id = $this->modeloctrl->insertPedido($pedido);

    $articulos = $this->input->post('id_articulo');
    $cantidad = $this->input->post('cantidad');
    $costos = $this->input->post('costo_venta');

    for ($i=0; $i < count($articulos) ; $i++) {
      $arreglo = array('id_articulo' => $articulos[$i],
      'cantidad' => $cantidad[$i],
      'precio_compra' => $costos[$i],
      'id_pedido' => $id);
      array_push($articulos_pedidos, $arreglo);
    }

    $this->modeloctrl->registrarArtPedido($articulos_pedidos);

    if ($this->input->post('sed')){
      echo '<script language="javascript">
      window.close();
      </script>';
    }else {
      echo '<script language="javascript">
      window.opener.document.location="verPedidos/INSERT_OK"
      window.close();
      </script>';
    }

  }

}

public function eliminarPedido(){
  $this->modeloctrl->eliminarPedido($this->input->post('id_activo'));
  redirect('sistemactrl/verPedidos/DELETE_OK','refresh');

}

public function recibirPedido(){

  $articulos = $this->modeloctrl->consultArtPedidos($this->input->post('id_pedido'));

  $push = array();
  foreach ($articulos as $artculo) {
    array_push($push,array('id_articulo' => $artculo['id_articulo'],
                            'cantidad' => $artculo['cantidad']));
  }

  $this->modeloctrl->guardaStock($push);
  $this->modeloctrl->checkPedido($this->input->post('id_pedido'));

}

public function recibirStock(){
  if ($this->session->userdata('tipo') == 1 || $this->session->userdata('tipo') == 2){
    $data['sed'] = array('sed' => $this->uri->segment(3));

    $articulos = $this->modeloctrl->selectArtMultiples();

    if ($articulos == null) {
      $data['selectArt'] = '<option value="" disabled selected>Sin articulos registrados</option>';
    }else{
      $data['selectArt'] = '<option value="" disabled selected>Elige un articulo</option>';
      foreach ($articulos as $articulo) {
        $data['selectArt'] .= '<option value="'.$articulo['id'].'">'.$articulo['codigo'].'</option>';
      }
    }

    $proveedores = $this->modeloctrl->selectProv();

    if ($proveedores == null) {
      $data['selectProv'] = '<option value="" disabled selected>Sin proveedores registrados</option>';
    }else{
      $data['selectProv'] = '<option value="" disabled selected>Elige un proveedor</option>';
      foreach ($proveedores as $proveedor) {
        $data['selectProv'] .= '<option value="'.$proveedor['id'].'">'.$proveedor['nombre_proveedor'].'</option>';
      }
    }

    $almacenes = $this->modeloctrl->selectAlm();
    if ($almacenes == null) {
      $data['selectAlm'] = '<option value="" disabled selected style="margin-bottom: 1px;">Sin Almacenes registrados</option>';
    }else{
      $data['selectAlm'] = '<option value="" disabled selected>Selecciona un almacen</option>';
      foreach ($almacenes as $almacen) {
        $data['selectAlm'] .= '<option value="'.$almacen['id'].'">'.$almacen['nombre'].'</option>';
      }
    }

    $this->load->view('encabezado');
    $this->load->view('Pedidos/recibirPedido',$data);
    $this->load->view('pie');
  }else{
    redirect('Sistemactrl/acceso','refresh');
  }
}

public function prevPedido(){
  $data['sed'] = array('sed' => $this->input->post('sed'));

  $pedido = array('nombre_pedido' => $this->input->post('nombre_pedido'),
                  'id_proveedor' => $this->input->post('id_proveedor'),
                  'fecha_llegada' => $this->input->post('fecha_llegada_submit') );

  $articulos = $this->input->post('id_articulo');
  $cantidad = $this->input->post('cantidad');
  $almacenes = $this->input->post('id_almacen');

  $articulos_pedidos = array();

  for ($i=0; $i < count($articulos) ; $i++) {
    $precio = $this->modeloctrl->consultaPrecio($articulos[$i]);
    $articulo = $this->modeloctrl->consultArt($articulos[$i]);
    $almacen = $this->modeloctrl->consultAlm($almacenes[$i]);
    $stock = $this->modeloctrl->consultaExistencias($almacenes[$i], $articulos[$i]);
    $arreglo = array('id_articulo' => $articulos[$i],
                     'nombre' => $articulo[0]['nombre'],
                     'codigo' => $articulo[0]['codigo'],
                     'cantidad' => $cantidad[$i],
                     'stock' => $stock,
                     'almacen' => $almacen[0]['nombre'],
                     'id_almacen' => $almacenes[$i],
                     'precio_unitario' => $precio);
    array_push($articulos_pedidos, $arreglo);
  }

  $proveedor = $this->modeloctrl->consultProv($pedido['id_proveedor']);
  //$data['proveedor'] = $proveedor[0]['nombre_proveedor'];

  $data['pedido'] = $pedido;
  $data['articulos_pedidos'] = $articulos_pedidos;

  $this->load->view('encabezado');
  $this->load->view('Pedidos/visualizarPed',$data);
  $this->load->view('pie');
}

public function insertPedStock(){

  if ($this->input->post('submitEdit')){

    $articulos = $this->modeloctrl->selectArtMultiples();
    if ($articulos == null) {
      $data['selectArt'] = '<option value="" disabled selected>Sin articulos registrados</option>';
    }else{
      $data['selectArt'] = '<option value="" disabled selected>Elige un articulo</option>';
      foreach ($articulos as $articulo) {
        $data['selectArt'] .= '<option value="'.$articulo['id'].'">'.$articulo['codigo'].'</option>';
      }
    }

    $almacenes = $this->modeloctrl->selectAlm();
    if ($almacenes == null) {
      $data['selectAlm'] = '<option value="" disabled selected style="margin-bottom: 1px;">Sin Almacenes registrados</option>';
    }else{
      $data['selectAlm'] = '<option value="" disabled selected>Selecciona un almacen</option>';
      foreach ($almacenes as $almacen) {
        $data['selectAlm'] .= '<option value="'.$almacen['id'].'">'.$almacen['nombre'].'</option>';
      }
    }

    $editPedido = $this->input->post();


    $editPedido['selectArt'] = array();

    foreach ($editPedido['id_articulo'] as $id) {

      $articulos = $this->modeloctrl->selectArtMultiples();
      if ($articulos == null) {
        $selectArt = '<option value="" disabled selected>Sin articulos registrados</option>';
      }else{
        $selectArt = '<option value="" disabled selected>Elige un articulo</option>';
        foreach ($articulos as $articulo) {
          if ($id == $articulo['id'])
            $selectArt .= '<option value="'.$articulo['id'].'" selected>'.$articulo['codigo'].'</option>';
          else
            $selectArt .= '<option value="'.$articulo['id'].'">'.$articulo['codigo'].'</option>';
        }
      }
      array_push($editPedido['selectArt'], $selectArt);
    }

    $editPedido['selectAlm'] = array();

    foreach ($editPedido['id_almacen'] as $id) {
      $ubicacion = $this->modeloctrl->selectAlm();
      if ($ubicacion == null) {
        $dropselect = '<option value="" disabled selected>Sin existencias</option>';
      }else{
        $dropselect = '<option value="" disabled selected>Selecciona un almacen</option>';
        foreach ($ubicacion as $area) {
          if ($id == $area['id'])
            $dropselect .= '<option value="'.$area['id'].'" selected>'.$area['nombre'].'</option>';
          else
            $dropselect .= '<option value="'.$area['id'].'">'.$area['nombre'].'</option>';
        }
      }
      array_push($editPedido['selectAlm'], $dropselect);
    }
/*
    $proveedores = $this->modeloctrl->selectProv();

    if ($proveedores == null) {
      $data['selectProv'] = '<option value="" disabled selected>Sin proveedores registrados</option>';
    }else{
      $data['selectProv'] = '<option value="" disabled selected>Elige un proveedor</option>';
      foreach ($proveedores as $proveedor) {
        if ($editPedido['id_proveedor'] == $proveedor['id'])
          $data['selectProv'] .= '<option value="'.$proveedor['id'].'" selected>'.$proveedor['nombre_proveedor'].'</option>';
        else
          $data['selectProv'] .= '<option value="'.$proveedor['id'].'">'.$proveedor['nombre_proveedor'].'</option>';
      }
    }
*/
    $data['editPedido'] = $editPedido;

    //echo "<pre>";    print_r($data['editPedido']);

    $this->load->view('encabezado');
    $this->load->view('Pedidos/recibirPedidoEdit',$data);
    $this->load->view('pie');

  } else{

    //echo "guardar<pre>";    print_r($this->input->post());    exit;

    $articulos = $this->input->post('id_articulo');
    $cantidad = $this->input->post('cantidad');
    $almacenes = $this->input->post('id_almacen');

    $articulos_recibidos = array();

    for ($i=0; $i < count($articulos) ; $i++) {
      $arreglo = array('id_articulo' => $articulos[$i],
      'id_almacen' => $almacenes[$i],
      'cantidad' => $cantidad[$i]);
      array_push($articulos_recibidos, $arreglo);
    }

    //echo "<pre>";    print_r($articulos_recibidos);    exit;

    $this->modeloctrl->updateStockPush($articulos_recibidos);

    echo '<script language="javascript">
    window.close();
    </script>';

/*
    $pedido = array('nombre_pedido' => $this->input->post('nombre_pedido'),
                    'id_proveedor' => $this->input->post('id_proveedor'),
                    'fecha_emision' => date("Y-m-d"),
                    'fecha_llegada' => $this->input->post('fecha_llegada_submit'),
                    'status' => 0);

    $articulos_pedidos = array();

    $id = $this->modeloctrl->insertPedido($pedido);

    $articulos = $this->input->post('id_articulo');
    $cantidad = $this->input->post('cantidad');
    $costos = $this->input->post('costo_venta');

    for ($i=0; $i < count($articulos) ; $i++) {
      $arreglo = array('id_articulo' => $articulos[$i],
      'cantidad' => $cantidad[$i],
      'precio_compra' => $costos[$i],
      'id_pedido' => $id);
      array_push($articulos_pedidos, $arreglo);
    }

    $this->modeloctrl->registrarArtPedido($articulos_pedidos);

    if ($this->input->post('sed')){
    echo '<script language="javascript">
    window.close();
    </script>';
  }else {
  echo '<script language="javascript">
  window.opener.document.location="verPedidos/INSERT_OK"
  window.close();
  </script>';
}
*/

  }


}




  public function inicioBio(){
    echo "inicio Biomedico";
  }

  public function test(){
    $data['biomedicos'] = $this->modeloctrl->selectBio();
    $data['atts'] = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank',
                  'id' => 'jump');
    //$data['inventario'] = $this->modeloctrl->selectStock();
    $data['pedidos'] = $this->modeloctrl->selectPedidos();
    $this->load->view('encabezado');
    $this->load->view('test',$data);
    $data['atts'] = array( 'width' => 800, 'height' => 700,
                 'scrollbars' => 'yes', 'status' => 'yes',
                 'resizable' => 'yes', 'screenx' => 100,
                 'screeny' => 100, 'window_name' => '_blank',
                  'id' => 'jump', 'class' => 'waves-effect waves-light btn blue-grey darken-3');

    $this->load->view('GestionBio/verBiomedicos',$data);
    //$this->load->view('Inventario/verInventario',$data);
    //$this->load->view('Pedidos/verPedidos',$data);

    $this->load->view('pie');
  }













  public function cerrarSesion(){
    $this->session->sess_destroy();
		redirect('','refresh');
  }
}
