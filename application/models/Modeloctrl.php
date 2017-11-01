<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modeloctrl extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function validarAcceso($acceso){

		$this->db->select('u.tipo, u.usuario, e.nombre, e.apellidop, e.apellidom, e.id ');
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
		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Actualizar',
		'tabla' => 'empleados');
		$bitacora['registro'] = $id;
		$this->insertBitacora($bitacora);
	}

	function actualizarUsu($usuario,$id){
		$this->db->where('id',$id);
		$this->db->update('usuarios',$usuario);
		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Actualizar',
		'tabla' => 'usuarios');
		$bitacora['registro'] = $id;
		$this->insertBitacora($bitacora);
	}

	function eliminarBio($id){
		$this->db->set('activo',0);
		$this->db->where('id',$id);
		$this->db->update('usuarios');
		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Eliminar',
		'tabla' => 'usuarios');
		$bitacora['registro'] = $id;
		$this->insertBitacora($bitacora);
	}

	function consultaArea($id){
		$this->db->where('id_departamento', $id);
		$res = $this->db->get('areas');
		return json_decode(json_encode($res->result()), True);
	}

	function insertArticulo($articulo){
		$this->db->set($articulo);
		$this->db->insert('articulos');
		$id = $this->db->query('SELECT @@identity AS id');
		if ($id->num_rows() == 1 ){
			$id = $id->result();
			$bitacora = array('usuario' => $this->session->userdata('user'),
			'accion' => 'Alta',
			'tabla' => 'articulos');
			$bitacora['registro'] = $id[0]->id;
			$this->insertBitacora($bitacora);
		}

	}

	function insertArtUnico($articulo, $articuloU){
		$this->db->set($articulo);
		$this->db->insert('articulos');
		$id = $this->db->query('SELECT @@identity AS id');
		if ($id->num_rows() == 1 ){
			$id = $id->result();
			$articuloU['id_articulo'] = $id[0]->id;
			$this->db->set($articuloU);
			$this->db->insert('articulo_unico');
			$bitacora = array('usuario' => $this->session->userdata('user'),
			'accion' => 'Alta',
			'tabla' => 'articulo_unico');
			$bitacora['registro'] = $id[0]->id;
			$this->insertBitacora($bitacora);
		}
	}

	function insertBitacora($bitacora){
		 $bitacora['dispositivo'] = ($this->agent->is_mobile())? "Movil" : "Escritorio";
		 $this->db->set($bitacora);
		 $this->db->insert('bitacora');
	}

	function selectArt(){
		//$this->db->select('art.*, au.');
		$this->db->from('articulos art');
		$this->db->join('articulo_unico au', 'art.id = au.id_articulo','left');
		$res = $this->db->get();

		return json_decode(json_encode($res->result()), True);
	}

	function selectStock(){
		$this->db->select('a.codigo, a.nombre as articulo, al.nombre as almacen, s.cantidad');
		$this->db->from('stock s');
		$this->db->join('articulos a','s.id_articulo = a.id' ,'inner');
		$this->db->join('almacenes al', 's.id_almacen = al.id', 'inner');
		//$this->db->join('articulo_unico au', 's.id_articulo = au.id_articulo', 'left');

		$res = $this->db->get();

		return json_decode(json_encode($res->result()), True);
	}

	function insertAlm($almacen){
		$this->db->set($almacen);
		$this->db->insert('almacenes');
		$id = $this->db->query('SELECT @@identity AS id');

		if ($id->num_rows() == 1 ){
			$id = $id->result();
			$bitacora = array('usuario' => $this->session->userdata('user'),
			'accion' => 'Alta',
			'tabla' => 'almacenes',
			'registro' => $id[0]->id);

			$this->insertBitacora($bitacora);
		}
	}

	function insertDpto($dpto, $areas){
		$this->db->set($dpto);
		$this->db->insert('departamentos');
		$id = $this->db->query('SELECT @@identity AS id');

		if ($id->num_rows() == 1 ){
			$id = $id->result();
			$bitacora = array('usuario' => $this->session->userdata('user'),
			'accion' => 'Alta',
			'tabla' => 'departamentos',
			'registro' => $id[0]->id);
			$this->insertBitacora($bitacora);

			if (!empty($areas)){
				foreach ($areas as $area) {
					if (!empty($area)){
						$insert = array('nombre' => $area,'id_departamento' => $id[0]->id );
						$this->db->set($insert);
						$this->db->insert('areas');
						$id_area = $this->db->query('SELECT @@identity AS id');

						if ($id_area->num_rows() == 1 ){
							$id_area = $id_area->result();
							$bitacora = array('usuario' => $this->session->userdata('user'),
							'accion' => 'Alta',
							'tabla' => 'areas',
							'registro' => $id_area[0]->id);
							$this->insertBitacora($bitacora);
						}
					}
				}
			}
		}

	}
	function selectDpto(){
		$res = $this->db->get('departamentos');
		return json_decode(json_encode($res->result()), True);
	}

	function selectAreas(){
		$this->db->order_by('id_departamento');
		$res = $this->db->get('areas');
		return json_decode(json_encode($res->result()), True);
	}
/*

	function selectDpto(){
	$this->db->select('d.nombre as departamento, a.* ');
	$this->db->join('areas a', 'd.id = a.id_departamento', 'left');
	$res = $this->db->get('departamentos d');
	return json_decode(json_encode($res->result()), True);
}
*/
	function selectAlm(){
		$res = $this->db->get('areas');
		return json_decode(json_encode($res->result()), True);
	}



}
