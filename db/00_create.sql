CREATE TABLE `dhc_usuario` (
  `usr_id` int(11) NOT NULL auto_increment,
  `dhc_institucion_ins_id` int(11) default NULL,
  `usr_dtcreate` datetime NOT NULL,
  `usr_nombre` varchar(100) default NULL,
  `usr_apellido` varchar(100) default NULL,
  `usr_cargo` varchar(45) default NULL,
  `usr_identificacion` varchar(45) default NULL,
  `usr_email` varchar(100) default NULL,
  `usr_pass` varchar(60) default NULL,
  `usr_telefono` varchar(45) default NULL,
  `usr_celular` varchar(45) default NULL,
  `usr_habilitado` varchar(10) default NULL,
  `usr_contacto` varchar(10) default NULL,
  `usr_pais` varchar(100) default NULL,
  `usr_departamento` varchar(100) default NULL,
  `usr_ciudad` varchar(100) default NULL,
  `usr_direccion` varchar(100) default NULL,
  PRIMARY KEY  (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;


CREATE TABLE `dhc_institucion` (
  `ins_id` int(11) NOT NULL auto_increment,
  `ins_dtcreate` datetime NOT NULL,
  `ins_nombre` varchar(100) default NULL,
  `ins_nit` varchar(45) default NULL,
  `ins_email` varchar(100) default NULL,
  `ins_telefono` varchar(45) default NULL,
  `ins_pais` varchar(45) default NULL,
  `ins_departamento` varchar(45) default NULL,
  `ins_ciudad` varchar(45) default NULL,
  `ins_direccion` varchar(100) default NULL,
  `ins_estado` varchar(100) default NULL,
  `ins_url` varchar(100) default NULL,
  `ins_fecha_inicio` datetime NOT NULL,
  `ins_fecha_fin` datetime NOT NULL,
  PRIMARY KEY  (`ins_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `dhc_perfiles` (
  `prf_id` int(11) NOT NULL auto_increment,
  `prf_nombre` varchar(45) NOT NULL,
  `prf_descripcion` varchar(45) default NULL,
  PRIMARY KEY  (`prf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE `dhc_usuario_has_dhc_perfiles` (
  `dhc_usuario_usr_id` int(11) NOT NULL,
  `dhc_perfiles_prf_id` int(11) NOT NULL,
  `dtcreate` datetime NOT NULL,
  PRIMARY KEY  (`dhc_usuario_usr_id`,`dhc_perfiles_prf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;