-- SE CREA TABLA PARA VARIABLES A MEDIR --
CREATE TABLE IF NOT EXISTS `dhc_db`.`dhc_variable` ( 
    `var_id` INT(11) NOT NULL AUTO_INCREMENT , 
    `var_nombre` VARCHAR(50) NULL DEFAULT NULL , 
    `var_descripcion` VARCHAR(255) NULL DEFAULT NULL , 
    `var_unidad` VARCHAR(50) NULL DEFAULT NULL ,
    PRIMARY KEY (`var_id`)
) ENGINE = InnoDB;

-- SE CREA TABLA DE RELACIÓN ENTRE LAS VARIABLES Y EL USUARIO--
CREATE TABLE IF NOT EXISTS `dhc_db`.`dhc_usuario_dhc_variable` (
    `dhc_usuario_usr_id` INT(11) NOT NULL DEFAULT '0' , 
    `dhc_variable_var_id` INT(11) NOT NULL DEFAULT '0' , 
    `var_valor` VARCHAR(50) NULL DEFAULT NULL 
) ENGINE = InnoDB;

-- SE CREA EL NUEVO PERFIL PARA VER LAS VARIABLES DEL USUARIO--
INSERT INTO `dhc_perfiles` (`prf_id`, `prf_nombre`, `prf_descripcion`) VALUES
(10, 'Usuarios - Variables', NULL);

--SE CREAN LAS VARIABLES QUE SE VAN A MEDIR POR DEFECTO--
INSERT INTO `dhc_variable`(`var_id`, `var_nombre`, `var_descripcion`, `var_unidad`) VALUES
(1, 'Presion Arterial', 'Presion sistolica y diastolica del paciente', 'mmHg'),
(2, 'Temperatura', 'Temperatura del paciente', 'ºC'),
(3, 'Frecuencia Cardiaca', 'Frecuencia del paciente', 'lat/min'),
(4, 'Frecuencia Respiratoria', 'Frecuencia respiratoria del paciente', 'resp/min'),
(5, 'Saturacion de Oxigeno', 'Porcentaje de oxigeno en sangre del paciente', '%');

--SE CARGAN VALORES DE VARIABLES AL USUARIO CON ID 2--
INSERT INTO `dhc_usuario_dhc_variable` (`dhc_usuario_usr_id`, `dhc_variable_var_id`, `var_valor`) VALUES 
(1, 1, '120/80'),
(1, 2, '37.2'),
(1, 3, '80'),
(1, 4, '45'),
(1, 5, '99'),
(3, 1, '120/80'),
(3, 2, '37.2'),
(3, 3, '80'),
(3, 4, '45'),
(3, 5, '99');

--SE AGREGA NUEVO PERFIL A LOS USUARIOS--
INSERT INTO dhc_usuario_has_dhc_perfiles (dhc_usuario_usr_id, dhc_perfiles_prf_id, dtcreate) VALUES 
('1', '10', NOW()),
('3', '10', NOW());

--CAMBIOS 22 MAYO 2017--
--SE CREA CAMPO PARA LA FECHA Y HORA DE LA TOMA DE LA MEDIDA --
ALTER TABLE `dhc_usuario_dhc_variable` ADD `var_fecha_hora` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `var_valor`;
-- SE CREA EL NUEVO PERFIL PARA CARGAR VARIABLES DESDE UN ARCHIVO DE TXT--
INSERT INTO `dhc_perfiles` (`prf_id`, `prf_nombre`, `prf_descripcion`) VALUES
(11, 'Usuarios - Cargar datos', NULL);
INSERT INTO `dhc_perfiles` (`prf_id`, `prf_nombre`, `prf_descripcion`) VALUES
(12, 'Usuarios - Ver solo cuenta propia', NULL);