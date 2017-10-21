<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modeloctrl extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function validarAcceso($acceso){

		$this->db->select('u.tipo, e.nombre, e.apellidop, e.apellidom, e.id ');
		$this->db->join('empleados e', 'u.id_empleado = e.id' ,'inner');
		$this->db->where('usuario',$acceso['usuario']);
		$this->db->where('password',md5($acceso['password']));
		$this->db->where('activo',1);
		$res = $this->db->get('usuarios u');

		return json_decode(json_encode($res->result()), True);

	}

}
