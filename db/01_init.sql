-- SE CARGAN Instituciones
INSERT INTO `dhc_institucion` (`ins_id`, `ins_dtcreate`, `ins_nombre`, `ins_estado`, `ins_email`, `ins_url`, `ins_telefono`, `ins_fecha_inicio`, `ins_fecha_fin`, `ins_nit`, `ins_pais`, `ins_departamento`, `ins_ciudad`, `ins_direccion`) VALUES ('1', '2017-04-26 00:00:00', 'Universidad de Antioquia', 'activo', 'info@udea.edu.co', 'http://www.udea.edu.co', '1234567', '2013-05-01 00:00:00', '2020-06-12 00:00:00', '987654321-1', 'Colombia', 'Antioquia', 'Medellin', 'Carrera 88A #88-88');
-- SE CARGAN USUARIOS
INSERT INTO `dhc_usuario` (`usr_id`, `dhc_institucion_ins_id`, `usr_dtcreate`, `usr_habilitado`, `usr_email`, `usr_pass`, `usr_nombre`, `usr_apellido`, `usr_identificacion`, `usr_cargo`, `usr_telefono`, `usr_celular`, `usr_pais`, `usr_departamento`, `usr_ciudad`, `usr_direccion`) VALUES
(1, 1, NOW(), 1, 'prueba@correo.com', '95B490918894B85EB280AF6B54DB9DBF811ED3D7', 'prueba', 'apellido_prueba', '123456789', 'testing', '654987321', '321654987', 'elpais', 'departamento-estado', 'laciudad', 'ladireccion');

-- SE CARGAN PERFILES
INSERT INTO `dhc_perfiles` (`prf_id`, `prf_nombre`, `prf_descripcion`) VALUES
(1, 'Instituciones - Ver', NULL),
(2, 'Instituciones - Crear', NULL),
(3, 'Instituciones - Editar', NULL),
(4, 'Instituciones - Eliminar', NULL),
(5, 'Usuarios - Ver', NULL),
(6, 'Usuarios - Crear', NULL),
(7, 'Usuarios - Editar', NULL),
(8, 'Usuarios - Eliminar', NULL),
(9, 'Usuarios - Permisos', NULL);

-- SE INICIALIZAN PERFILES
INSERT INTO dhc_usuario_has_dhc_perfiles (dhc_usuario_usr_id, dhc_perfiles_prf_id, dtcreate) VALUES 
('1', '1', NOW()),
('1', '2', NOW()),
('1', '3', NOW()),
('1', '4', NOW()),
('1', '5', NOW()),
('1', '6', NOW()),
('1', '7', NOW()),
('1', '8', NOW()),
('1', '9', NOW());