CREATE TABLE empleados (id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(60) NOT NULL,
    apellidop VARCHAR(60) NOT NULL,
    apellidom VARCHAR(60),
    tel VARCHAR(20) NOT NULL,
    tel_atl VARCHAR(20),
    calle VARCHAR(60) NOT NULL,
    colonia VARCHAR(60) NOT NULL,
    cod_pos VARCHAR(12) NOT NULL,
    email VARCHAR(60) NOT NULL);

CREATE TABLE usuarios (id INT AUTO_INCREMENT PRIMARY KEY,
      usuario VARCHAR(60) NOT NULL,
      password VARCHAR(32) NOT NULL,
      id_empleado INT,
      tipo INT NOT NULL,
      activo INT(1) DEFAULT 1,
      fecha_rgistro TIMESTAMP,
      FOREIGN KEY (id) REFERENCES empleados(id));

CREATE TABLE clientes (id INT AUTO_INCREMENT PRIMARY KEY,
      nombre_cliente VARCHAR(60) NOT NULL,
      nombre VARCHAR(60) NOT NULL,
      apellidop VARCHAR(60) NOT NULL,
      apellidom VARCHAR(60),
      direccion_fac VARCHAR(255) NOT NULL,
      ciudad VARCHAR(60) NOT NULL,
      estado VARCHAR(60) NOT NULL,
      cod_pos VARCHAR(12) NOT NULL,
      pais VARCHAR(60) NOT NULL,
      telefono VARCHAR(20) NOT NULL,
      activo INT(1) DEFAULT 1,
      fecha_rgistro TIMESTAMP);

CREATE TABLE proveedores (id INT AUTO_INCREMENT PRIMARY KEY,
      nombre_proveedor VARCHAR(60) NOT NULL,
      nombre VARCHAR(60) NOT NULL,
      apellidop VARCHAR(60) NOT NULL,
      apellidom VARCHAR(60),
      calle VARCHAR(60) NOT NULL,
      colonia VARCHAR(60) NOT NULL,
      cod_pos VARCHAR(12) NOT NULL,
      telefono VARCHAR(20) NOT NULL,
      tel_atl VARCHAR(20),
      email VARCHAR(60) NOT NULL,
      activo INT(1) DEFAULT 1,
      fecha_rgistro TIMESTAMP);

CREATE TABLE almacenes (id INT AUTO_INCREMENT PRIMARY KEY,
      nombre VARCHAR(60) NOT NULL,
      ubicacion VARCHAR(255));

CREATE TABLE departamentos (id INT AUTO_INCREMENT PRIMARY KEY,
      nombre VARCHAR(60) NOT NULL);

CREATE TABLE areas (id INT AUTO_INCREMENT PRIMARY KEY,
      nombre VARCHAR(60) NOT NULL,
      id_departamento INT,
      FOREIGN KEY (id_departamento) REFERENCES departamentos(id));

CREATE TABLE articulos (id INT AUTO_INCREMENT PRIMARY KEY,
      codigo VARCHAR(60) NOT NULL,
      descripcion TEXT,
      id_departamento INT,
      id_area INT,
      costo_compra FLOAT,
      costo_venta FLOAT,
      nota TEXT,
      fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP);     
      
CREATE TABLE articulo_unico(id_articulo INT,
      marca VARCHAR(60), 
      modelo VARCHAR(60),      
      serie VARCHAR(60),
      fecha_instalacion DATE,
      FOREIGN KEY (id_articulo) REFERENCES articulos(id));

CREATE TABLE manteniemiento_tipo (id INT AUTO_INCREMENT PRIMARY KEY,
      tipo VARCHAR (225));
  
CREATE TABLE manteniemientos(id INT AUTO_INCREMENT PRIMARY KEY,
      id_articulo INT ,
      id_mantenimiento INT,
      fecha_programado DATE,
      fecha_realizado DATE,
      realizado INT,
      FOREIGN KEY (id_articulo) REFERENCES articulos(id),
      FOREIGN KEY (id_mantenimiento) REFERENCES manteniemiento_tipo(id));
      
CREATE TABLE pedidos (id INT AUTO_INCREMENT PRIMARY KEY,
            nombre_pedido VARCHAR(60) NOT NULL,
            id_proveedor INT,
            fecha_emision DATE,
            fecha_llegada DATE,
            FOREIGN KEY (id_proveedor) REFERENCES proveedores(id));

CREATE TABLE articulos_pedidos (id INT AUTO_INCREMENT PRIMARY KEY,
              id_articulo INT,
              id_pedido INT,
              FOREIGN KEY (id_articulo) REFERENCES articulos(id),
              FOREIGN KEY (id_pedido) REFERENCES pedidos(id));

CREATE TABLE ventas (id INT AUTO_INCREMENT PRIMARY KEY,
            nombre_venta VARCHAR(60) NOT NULL,
            id_cliente INT,
            fecha_venta DATE,
            FOREIGN KEY (id_cliente) REFERENCES clientes(id));

CREATE TABLE articulos_vendidos (id INT AUTO_INCREMENT PRIMARY KEY,
              id_articulo INT,
              id_venta INT,
              FOREIGN KEY (id_articulo) REFERENCES articulos(id),
              FOREIGN KEY (id_venta) REFERENCES ventas(id));

CREATE TABLE stock (id INT AUTO_INCREMENT PRIMARY KEY,
            id_articulo INT,
            id_almacen INT,
            cantidad INT);

CREATE TABLE bitacora (id INT AUTO_INCREMENT PRIMARY KEY,
            usuario VARCHAR(60) NOT NULL,
            accion VARCHAR(60) NOT NULL,
            tabla VARCHAR(60) NOT NULL,
            registro VARCHAR(60) NOT NULL,
            fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
