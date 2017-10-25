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

	function insertarBio($empleado,$usuario){
		$this->db->set($empleado);
		$this->db->insert('empleados');
		$id = $this->db->query('SELECT @@identity AS id');
		if ($id->num_rows() == 1 ){
			$id = $id->result();
			$usuario['id_empleado'] = $id[0]->id;
			$this->db->set($usuario);
			$this->db->insert('usuarios');
		}else
			return -1;
	}

	function selectBio(){
		$this->db->select('u.id, e.nombre, e.apellidop, apellidom, u.usuario, u.tipo');
		$this->db->where('u.activo', 1);
		$this->db->join('empleados e', 'u.id_empleado = e.id','inner');
		$res = $this->db->get('usuarios u');

		return json_decode(json_encode($res->result()), True);
	}

	function consultaBio($id){
		$this->db->select('u.id AS id_usuario, u.usuario ,e.*');
		$this->db->where('u.id', $id);
		$this->db->where('u.activo', 1);
		$this->db->join('empleados e', 'u.id_empleado = e.id','inner');
		$res = $this->db->get('usuarios u');

		return json_decode(json_encode($res->result()), True);
	}

	function actualizarBio($empleado,$id){
		$this->db->where('id',$id);
		$this->db->update('empleados',$empleado);
	}

	function actualizarUsu($usuario,$id){
		$this->db->where('id',$id);
		$this->db->update('usuarios',$usuario);
	}

	function eliminarBio($id){
		$this->db->set('activo',0);
		$this->db->where('id',$id);
		$this->db->update('usuarios');

	}

}
