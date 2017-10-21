<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistemactrl extends CI_Controller {

  function __construct(){
    parent::__construct();

    $this->arr_MenAdmin = array('Evaluar' => site_url('Sistemactrl/evaluar_propuestas'),
                                'Documentos' => site_url('Sistemactrl/documentos_admin'),
                                'Administrar Biomédico' => array(
                                      'Nuevo Biomedico' => array( 'popUp' => site_url('Sistemactrl/nuevoBio') ),
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
    //$this->load->library('my_phpmailer');

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
    echo Crear_menu($this->arr_MenAdmin);
    echo "Inicio Administrador";
    $this->load->view('pie');
  }

  public function nuevoBio($value=''){
    $this->load->view('encabezado');
    $this->load->view('GestionBio/nuevoBio');
    $this->load->view('pie');
  }

  public function verBio($value=''){

  }

#Funciones Biomedico

  public function inicioBio(){
    echo "inicio Biomedico";
  }
}
