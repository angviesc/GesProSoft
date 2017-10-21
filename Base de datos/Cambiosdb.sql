ALTER TABLE articulos ADD nombre VARCHAR(60) NOT NULL AFTER codigo;

INSERT INTO empleados (id, nombre, apellidop, tel, calle, colonia, cod_pos, email)
VALUES (1,'Administrador','Sistema','3 33 33 33', 'Calle numero 33', 'Colonia tal', '55000', 'email@email.com');

INSERT INTO usuarios (usuario, password, id_empleado, tipo)
VALUES ('Admin',md5('pass'), 1, 1);
