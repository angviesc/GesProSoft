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

//Biomedicos y usuarios
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

//Articulos

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

		return $id[0]->id;
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
		return $id[0]->id;
	}

	function selectArt(){
		//$this->db->select('art.*, au.');
		$this->db->from('articulos art');
		$this->db->join('articulo_unico au', 'art.id = au.id_articulo','left');
		$res = $this->db->get();

		return json_decode(json_encode($res->result()), True);
	}

	function consultArt($id){
		$this->db->where('id', $id);
		$this->db->join('articulo_unico au', 'a.id = au.id_articulo', 'LEFT');
		$res = $this->db->get('articulos a');

		return json_decode(json_encode($res->result()), True);
	}

	function actualizaArt($articulo){
		$this->db->set($articulo);
		$this->db->where('id',$articulo['id']);
		$this->db->update('articulos');

		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Actualizar',
		'tabla' => 'articulos');
		$bitacora['registro'] = $articulo['id'];
		$this->insertBitacora($bitacora);
	}

	function actualizaArtUnico($articulo, $articuloU){
		$this->db->set($articulo);
		$this->db->where('id',$articulo['id']);
		$this->db->update('articulos');

		$this->db->set($articuloU);
		$this->db->where('id_articulo',$articulo['id']);
		$this->db->update('articulo_unico');

		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Actualizar',
		'tabla' => 'articulo_unico');
		$bitacora['registro'] = $articulo['id'];
		$this->insertBitacora($bitacora);
	}

	function eliminarArt($id){
		$this->db->where('id_articulo',$id);
		$this->db->delete('articulo_unico');

		$this->db->where('id',$id);
		$this->db->delete('articulos');

		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Eliminar',
		'tabla' => 'articulos');
		$this->insertBitacora($bitacora);
	}

// Stock

	function selectStock(){
		$this->db->select('a.codigo, a.nombre as articulo, al.nombre as almacen, d.nombre as departamento, s.cantidad');
		$this->db->from('stock s');
		$this->db->join('articulos a','s.id_articulo = a.id' ,'left');
		$this->db->join('almacenes al', 's.id_almacen = al.id', 'left');
		$this->db->join('departamentos d', 'a.id_departamento = d.id', 'left');
		$this->db->where('s.cantidad >',0);
		//$this->db->join('articulo_unico au', 's.id_articulo = au.id_articulo', 'left');

		$res = $this->db->get();

		return json_decode(json_encode($res->result()), True);
	}

	function insertStock($id_articulo,$stock){

		for ($i=0; $i < count($stock['ids']); $i++) {
			$this->db->select('id, cantidad');
			$this->db->where('id_articulo',$id_articulo);
			$this->db->where('id_almacen',$stock['ids'][$i]);
			$res = $this->db->get('stock');

			if ($res->num_rows() == 1 ){
				$suma = $res->result();
				$total = $suma[0]->cantidad+$stock['cantidad'][$i];
				$this->db->set('cantidad',$total);
				$this->db->where('id',$suma[0]->id);
				$this->db->update('stock');

				$bitacora = array('usuario' => $this->session->userdata('user'),
				'accion' => 'Actualizar',
				'tabla' => 'stock',
				'registro' => $suma[0]->id);

				$this->insertBitacora($bitacora);
			}else{
				$this->db->set(array('id_articulo' => $id_articulo, 'id_almacen' => $stock['ids'][$i], 'cantidad' => $stock['cantidad'][$i]));
				$this->db->insert('stock');
				$id = $this->db->query('SELECT @@identity AS id');

				if ($id->num_rows() == 1 ){
					$id = $id->result();
					$bitacora = array('usuario' => $this->session->userdata('user'),
					'accion' => 'Alta',
					'tabla' => 'stock',
					'registro' => $id[0]->id);

					$this->insertBitacora($bitacora);
				}
			}

		}
	}

//Almacenes

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

	function selectAlm(){

		$res = $this->db->get('almacenes');
		return json_decode(json_encode($res->result()), True);
	}

	function consultAlm($id){
		$this->db->where('id', $id);
		$res = $this->db->get('almacenes');
		return json_decode(json_encode($res->result()), True);
	}

	function actualizarAlm($almacen){
		$this->db->where('id',$almacen['id']);
		$this->db->update('almacenes',$almacen);

		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Actualizar',
		'tabla' => 'almacenes');
		$bitacora['registro'] = $almacen['id'];

		$this->insertBitacora($bitacora);
	}

	function eliminarAlm($id){
		$this->db->where('id',$id);
		$this->db->delete('almacenes');

		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Eliminar',
		'tabla' => 'almacenes');
		$this->insertBitacora($bitacora);
	}

//Insertar departamento

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

	function consultaDpto($id){
		$this->db->select('d.id AS id_dpto, d.nombre as nombre_dpto, a.id as id_area, a.nombre as nombre_area ');
		$this->db->from('departamentos d');
		$this->db->where('d.id', $id);
		$this->db->join('areas a', 'd.id = a.id_departamento','left');
		$res = $this->db->get();
		return json_decode(json_encode($res->result()), True);
	}

	function actualizarDpto($depto){
		$this->db->where('id',$depto['id']);
		$this->db->update('departamentos',$depto);

		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Actualizar',
		'tabla' => 'departamentos');
		$bitacora['registro'] = $depto['id'];
		$this->insertBitacora($bitacora);
	}

	function eliminarDpto($id){
		$this->db->where('id_departamento',$id);
		$this->db->delete('areas');

		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Eliminar',
		'tabla' => 'areas');
		$this->insertBitacora($bitacora);

		$this->db->where('id',$id);
		$this->db->delete('departamentos');

		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Eliminar',
		'tabla' => 'departamentos');
		$this->insertBitacora($bitacora);
	}


	// Areas

	function consultaArea($id){
		$this->db->where('id_departamento', $id);
		$res = $this->db->get('areas');
		return json_decode(json_encode($res->result()), True);
	}

	function selectAreas(){
		$this->db->order_by('id_departamento');
		$res = $this->db->get('areas');
		return json_decode(json_encode($res->result()), True);
	}

	function insertarAreas($areas){
		if (!empty($areas)){
			foreach ($areas['nombres'] as $area) {
				if (!empty($area)){
					$insert = array('nombre' => $area,'id_departamento' => $areas['id']);
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


	function actualizarAreas($areas){
		for ($i=0; $i < count($areas['ids']) ; $i++) {
			$this->db->where('id',$areas['ids'][$i]);
			$this->db->set('nombre',$areas['nombre'][$i]);
			$this->db->update('areas');

			$bitacora = array('usuario' => $this->session->userdata('user'),
			'accion' => 'Actualizar',
			'tabla' => 'areas');
			$bitacora['registro'] = $areas['ids'][$i];
			$this->insertBitacora($bitacora);
		}
	}

	function eliminarAreas($areas){
		foreach ($areas['ids'] as $id) {
			$this->db->where('id', $id);
			$this->db->delete('areas');

			$bitacora = array('usuario' => $this->session->userdata('user'),
			'accion' => 'Eliminar',
			'tabla' => 'areas');
			$this->insertBitacora($bitacora);
		}
	}

//Proveedores


	function insertProv($proveedor){
		$this->db->set($proveedor);
		$this->db->insert('proveedores');

		$id = $this->db->query('SELECT @@identity AS id');
		if ($id->num_rows() == 1 ){
			$id = $id->result();
			$bitacora = array('usuario' => $this->session->userdata('user'),
			'accion' => 'Alta',
			'tabla' => 'proveedores');
			$bitacora['registro'] = $id[0]->id;
			$this->insertBitacora($bitacora);
		}
	}

	function selectProv(){
		$this->db->where('activo',1);
		$res = $this->db->get('proveedores');
		return json_decode(json_encode($res->result()), True);
	}

	function consultProv($id){
		$this->db->where('id',$id);
		$this->db->where('activo',1);
		$res = $this->db->get('proveedores');
		return json_decode(json_encode($res->result()), True);
	}

	function actualizaProv($proveedor){
		$this->db->set($proveedor);
		$this->db->where('id',$proveedor['id']);
		$this->db->update('proveedores');

		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Actualizar',
		'tabla' => 'proveedores');
		$bitacora['registro'] = $proveedor['id'];
		$this->insertBitacora($bitacora);
	}

	function eliminarProv($id){
		$this->db->set('activo',0);
		$this->db->where('id', $id);
		$this->db->update('proveedores');

		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Eliminar',
		'tabla' => 'proveedores');
		$bitacora['registro'] = $id;
		$this->insertBitacora($bitacora);
	}

//Clientes



	function insertCliente($cliente){
		$this->db->set($cliente);
		$this->db->insert('clientes');

		$id = $this->db->query('SELECT @@identity AS id');
		if ($id->num_rows() == 1 ){
			$id = $id->result();
			$bitacora = array('usuario' => $this->session->userdata('user'),
			'accion' => 'Alta',
			'tabla' => 'proveedores');
			$bitacora['registro'] = $id[0]->id;
			$this->insertBitacora($bitacora);
		}
	}
	function selectClientes(){
		$this->db->where('activo',1);
		$res = $this->db->get('clientes');
		return json_decode(json_encode($res->result()), True);
	}

	function consultCliente($id){
		$this->db->where('id',$id);
		$this->db->where('activo',1);
		$res = $this->db->get('clientes');
		return json_decode(json_encode($res->result()), True);
	}

	function actualizaCliente($cliente){
		$this->db->set($cliente);
		$this->db->where('id',$cliente['id']);
		$this->db->update('clientes');

		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Actualizar',
		'tabla' => 'clientes');
		$bitacora['registro'] = $cliente['id'];
		$this->insertBitacora($bitacora);
	}

	function eliminarCliente($id){
		$this->db->set('activo',0);
		$this->db->where('id', $id);
		$this->db->update('clientes');

		$bitacora = array('usuario' => $this->session->userdata('user'),
		'accion' => 'Eliminar',
		'tabla' => 'clientes');
		$bitacora['registro'] = $id;
		$this->insertBitacora($bitacora);
	}

	function consultaUb($id){
		$this->db->select('id_almacen, nombre');
		$this->db->join('almacenes a', 'a.id = s.id_almacen','inner');
		$this->db->where('id_articulo',$id);
		$this->db->where('s.cantidad >', 0);
		$res = $this->db->get('stock s');

		return json_decode(json_encode($res->result()),True);
	}

	function consultaExistencias($id_almacen, $id_articulo){
		$this->db->select('cantidad');
		$this->db->where('id_almacen', $id_almacen);
		$this->db->where('id_articulo', $id_articulo);
		$res = $this->db->get('stock');
		$cantidad = $res->result()[0]->cantidad;
		return $cantidad;
	}

	function consultaPrecio($id_articulo){
		$this->db->select('costo_venta');
		$this->db->where('id', $id_articulo);
		$res = $this->db->get('articulos');
		$precio = $res->result()[0]->costo_venta;
		return $precio;
	}

	function existenciaStock($id_art, $id_almacen){
		$this->db->select('a.codigo, a.nombre, a.costo_venta, al.nombre as almacen, s.cantidad, s.id as id_stock');
		$this->db->from('articulos a');
		$this->db->join('stock s','a.id = s.id_articulo', 'inner');
		$this->db->join('almacenes al','al.id = s.id_almacen', 'inner');
		$this->db->where('s.id_articulo', $id_art);
		$this->db->where('s.id_almacen', $id_almacen);
		$res = $this->db->get();

		return json_decode(json_encode($res->result()[0]),True);
	}

	function insertVenta($venta){
		$this->db->set($venta);
		$this->db->insert('ventas');

		$id = $this->db->query('SELECT @@identity AS id');
		if ($id->num_rows() == 1 ){
			$id = $id->result();
			$bitacora = array('usuario' => $this->session->userdata('user'),
			'accion' => 'Alta',
			'tabla' => 'ventas');
			$bitacora['registro'] = $id[0]->id;
			$this->insertBitacora($bitacora);
			return $id[0]->id;
		}
	}

	function registrarArticulos($artculos){
		foreach ($artculos as $articulo) {
			$this->db->set($articulo);
			$this->db->insert('articulos_vendidos');

			$id = $this->db->query('SELECT @@identity AS id');
			if ($id->num_rows() == 1 ){
				$id = $id->result();
				$bitacora = array('usuario' => $this->session->userdata('user'),
				'accion' => 'Alta',
				'tabla' => 'articulos_vendidos');
				$bitacora['registro'] = $id[0]->id;
				$this->insertBitacora($bitacora);
			}
		}
	}

	function updateStock($stock){
		foreach ($stock as $actualizacion) {
			$this->db->set('cantidad', 'cantidad-'.$actualizacion['cantidad'], FALSE);
			$this->db->where('id',$actualizacion['id_stock']);
			$this->db->update('stock');

			$bitacora = array('usuario' => $this->session->userdata('user'),
			'accion' => 'Actualizar',
			'tabla' => 'stock');
			$bitacora['registro'] = $actualizacion['id_stock'];
			$this->insertBitacora($bitacora);
		}
	}

	function consultStock($id){
		$this->db->select('a.codigo, a.nombre, al.nombre as almacen, s.*');
		$this->db->join('articulos a', 's.id_articulo = a.id', 'left');
		$this->db->join('almacenes al', 's.id_almacen = al.id', 'inner');
		$this->db->where('id_almacen',$id);
		$this->db->where('s.cantidad >',0);
		$res = $this->db->get('stock s');

		return json_decode(json_encode($res->result()),True);
	}

	function transferirStock($stock){

		$this->db->where('id',$stock['id_stock']);
		$res = $this->db->get('stock');
		$get_stock = $res->result();

		if ($get_stock != null) {
			$this->db->where('id_almacen',$stock['alm_dest']);
			$this->db->where('id_articulo',$get_stock[0]->id_articulo);
			$res = $this->db->get('stock');
			$res = $res->result();

			if ($res == null){
				$insert = array('id_articulo' => $get_stock[0]->id_articulo,
				 							 'id_almacen' => $stock['alm_dest'],
											 'cantidad' => $stock['cantidad'] );
				$this->db->set($insert);
				$this->db->insert('stock');

			}else{
				$this->db->set('cantidad','cantidad + '.$stock['cantidad'], false);
				$this->db->where('id_almacen',$res[0]->id_almacen);
				$this->db->where('id_articulo',$res[0]->id_articulo);
				$this->db->update('stock');

			}

			$this->db->set('cantidad','cantidad - '.$stock['cantidad'], false);
			$this->db->where('id',$stock['id_stock']);
			$this->db->update('stock');
		}

	}

	function selectPedidos(){
		$this->db->select('SUM(a.cantidad * a.precio_compra) as total, p.nombre_proveedor as proveedor, pd.*');
		$this->db->from('pedidos pd');
		$this->db->join('articulos_pedidos a','pd.id = a.id_pedido', 'left');
		$this->db->join('proveedores p','pd.id_proveedor = p.id', 'left');
		$this->db->group_by("a.id_pedido");
		$this->db->order_by("pd.id");

		$res = $this->db->get();
		$res = $res->result();

		return json_decode(json_encode($res),True);

	}



	function selectArtMultiples(){
		$res = $this->db->query('SELECT id, codigo FROM articulos WHERE id NOT IN (SELECT id_articulo FROM articulo_unico)');
		return json_decode(json_encode($res->result()), True);
	}

	function insertPedido($pedido){
		$this->db->set($pedido);
		$this->db->insert('pedidos');

		$id = $this->db->query('SELECT @@identity AS id');
		if ($id->num_rows() == 1 ){
			$id = $id->result();
			$bitacora = array('usuario' => $this->session->userdata('user'),
			'accion' => 'Alta',
			'tabla' => 'pedidos');
			$bitacora['registro'] = $id[0]->id;
			$this->insertBitacora($bitacora);
			return $id[0]->id;
		}
	}

	function registrarArtPedido($artculos){
		foreach ($artculos as $articulo) {
			$this->db->set($articulo);
			$this->db->insert('articulos_pedidos');
		}
	}

	public function consultArtPedidos($id){
		$this->db->where('id_pedido',$id);
		$res = $this->db->get('articulos_pedidos');
		return json_decode(json_encode($res->result()),True);
	}

	public function updateStockPush($articulos){
		foreach ($articulos as $stock) {
			$this->db->where('id_articulo',$stock['id_articulo']);
			$this->db->where('id_almacen',1);
			$get_stock = $this->db->get('stock');

			if ($get_stock == null){
				$this->db->set($stock);
				$this->db->insert('stock');
			}else{
				$this->db->set('cantidad','cantidad + '.$stock['cantidad'], false);
				$this->db->where('id',$get_stock->result()[0]->id);
				$this->db->update('stock');
			}
		}
	}

	public function checkPedido($id){
		$this->db->set('status',1);
		$this->db->where('id',$id);
		$this->db->update('pedidos');
	}





//

	function insertBitacora($bitacora){
		 $bitacora['dispositivo'] = ($this->agent->is_mobile())? "Movil" : "Escritorio";
		 $this->db->set($bitacora);
		 $this->db->insert('bitacora');
	}






}
