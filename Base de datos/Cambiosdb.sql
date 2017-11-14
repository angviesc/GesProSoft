ALTER TABLE articulos ADD nombre VARCHAR(60) NOT NULL AFTER codigo;

INSERT INTO empleados (id, nombre, apellidop, tel, calle, colonia, cod_pos, email)
VALUES (1,'Administrador','Sistema','3 33 33 33', 'Calle numero 33', 'Colonia tal', '55000', 'email@email.com');

INSERT INTO usuarios (usuario, password, id_empleado, tipo)
VALUES ('Admin',md5('pass'), 1, 1);

//Debería ir
ALTER TABLE clientes ADD correo VARCHAR(40) NOT NULL AFTER activo;

ALTER TABLE `bitacora` ADD `dispositivo` VARCHAR(30) NOT NULL AFTER `accion`;


//Cambios 09/11/2017

ALTER TABLE `articulos_vendidos` ADD `precio_venta` FLOAT UNSIGNED NOT NULL AFTER `id_articulo`;

INSERT INTO `proveedores` (`id`, `nombre_proveedor`, `nombre`, `apellidop`, `apellidom`, `calle`, `colonia`, `cod_pos`, `telefono`, `tel_atl`, `email`, `activo`, `fecha_rgistro`) VALUES (NULL, 'Clinica San Miguel', 'Miguel', 'Perez', 'Perez', 'Calle', 'Colonia', '58000', '2222222', NULL, 'email@q.com', '1', CURRENT_TIMESTAMP);

ALTER TABLE `articulo_unico` ADD `status` INT NOT NULL AFTER `serie`;
ALTER TABLE `articulo_unico` ADD `id_proveedor` INT NOT NULL AFTER `status`;

ALTER TABLE `ventas` ADD `nota` TEXT NOT NULL AFTER `id_cliente`;

ALTER TABLE `ventas` ADD `fecha_registro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `fecha_venta`;

/*ALTER TABLE `bitacora` ADD `val_ant` TEXT NOT NULL AFTER `registro`, ADD `val_act` TEXT NOT NULL AFTER `val_ant`;*/

/*ALTER TABLE clientes ADD direnvio VARCHAR(50) NOT NULL AFTER correo;
ALTER TABLE clientes ADD correo VARCHAR(40) NOT NULL AFTER activo;*/
