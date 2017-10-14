<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sistemactrl extends CI_Controller {

  function __construct(){
    parent::__construct();

    //Configurar zona horaria a México
    date_default_timezone_set('UTC');
    date_default_timezone_set("America/Mexico_City");
    setlocale(LC_TIME, 'spanish');
    //Librerias
    //$this->load->library('my_phpmailer');

    // Helpers
    $this->load->helper('date');

    // Modelo
    $this->load->model('modeloctrl');
  }

	public function index()
	{
		$this->load->view('index.php');
	}
}
