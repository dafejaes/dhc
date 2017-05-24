<?php
include 'include/generic_validate_session.php';
include 'lib/ControllerUser.php';
/**
 * se cargan los permisos 
 */
if (!$SESSION_DATA->getPermission(5)){
    header('Location: main.php');
}
$create = $SESSION_DATA->getPermission(6);
$edit = $SESSION_DATA->getPermission(7);
$delete = $SESSION_DATA->getPermission(8);
$editpermission = $SESSION_DATA->getPermission(9);
$viewvariables = $SESSION_DATA->getPermission(10);
$uploaddata = $SESSION_DATA->getPermission(11);
/**
 * se cargan datos
 */
$USUARIO = new ControllerUser();
$USUARIO->usrget();
$arrusuarios = $USUARIO->getResponse();
$isvalid = $arrusuarios['output']['valid'];
$arrusuarios = $arrusuarios['output']['response'];
?>
<!DOCTYPE html>
<html>
    <head>
	<?php include 'include/generic_head.php'; ?>
    </head>
    <body>
        <header>
	    <?php
	    include 'include/generic_header.php';
	    ?>
        </header>
        <section id="section_wrap">
            <div class="container">
		<?php
		$_ACTIVE_SIDEBAR = 'usuario';
		include 'include/generic_navbar.php';
		?>
            </div>
            <div class="container">
		<?php
		if ($create) {
		    ?>
                    <a class="btn btn-info botoncrear" href="#" id="crearusuario" >Crear</a>
		    <?php
		}
		?>
                <div>
                    <table class="table table-hover dyntable" id="dynamictable">
                        <thead>
                            <tr>
                                <th class="head0" style="width: 70px;">Acciones</th>
                                <th class="head1">Nombre completo</th>
                                <th class="head0">Email</th>
                                <th class="head1">Telefono / Celular</th>
                                <th class="head0">País</th>
                            </tr>
                        </thead>
                        <colgroup>
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                            <col class="con1" />
                            <col class="con0" />
                        </colgroup>
<!--                                    <td class="con0"><a href="#" onclick="editdata();"><span class="ui-icon ui-icon-pencil"></span></a><a href="#"><span class="ui-icon ui-icon-trash"></span></a></td>-->
                        <tbody>
			    <?php
			    $c = count($arrusuarios);
			    if ($isvalid) {
				for ($i = 0; $i < $c; $i++) {
				    ?>
				    <tr class="gradeC">
					<td class="con0">
					    <?php
					    if ($delete) {
						?>
	    				    <a href="#" onclick="USUARIO.editdata(<?php echo $arrusuarios[$i]['id']; ?>);"><span class="icon-pencil"></span></a><span>&nbsp;&nbsp;</span>
						<?php
					    }
					    if ($edit) {
						?>
	    				    <a href="#" onclick="USUARIO.deletedata(<?php echo $arrusuarios[$i]['id']; ?>);"><span class="icon-trash"></span></a><span>&nbsp;&nbsp;</span>
						<?php
					    }
					    if ($editpermission) {
						?>
	    				    <a href="#" onclick="USUARIO.editpermission(<?php echo $arrusuarios[$i]['id']; ?>);"><span class="icon-ban-circle"></span></a>
						<?php
					    }
                                            if ($viewvariables) {
						?>
	    				    <a href="#" onclick="USUARIO.getVariables(<?php echo $arrusuarios[$i]['id']; ?>);"><span class="icon-eye-open"></span></a><span>&nbsp;&nbsp;</span>
						<?php
					    }
                                            if ($uploaddata) {
						?>
	    				    <a href="#" onclick="USUARIO.showUploadDataForm(<?php echo $arrusuarios[$i]['id']; ?>);"><span class="icon-upload"></span></a><span>&nbsp;&nbsp;</span>
						<?php
					    }
					    ?>
					</td>
					<td class="con1"><?php echo $arrusuarios[$i]['nombre'] . ' ' . $arrusuarios[$i]['apellido']; ?></td>
					<td class="con0"><?php echo $arrusuarios[$i]['email']; ?></td>
					<td class="con1"><?php echo $arrusuarios[$i]['telefono'] . ' / ' . $arrusuarios[$i]['celular']; ?></td>
					<td class="con0"><?php echo $arrusuarios[$i]['pais']; ?></td>
				    </tr>
				    <?php
				}
			    }
			    ?>
                        </tbody>
                    </table>
                </div>
            </div>	    
        </section>
        <footer id="footer_wrap">
	    <?php include 'include/generic_footer.php'; ?>
        </footer>
        <div id="dialog-form" title="Usuario" style="display: none;">
            <p class="validateTips"></p>
            <table>
                <tr>
                    <td>
                        <form id="formcreate1" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Pertenenece a</label>
				<div class="controls">
				    <select name="idins" id="idins" class="text ui-widget-content ui-corner-all">
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Nombres</label>
                                <div class="controls"><input type="text" name="nombre" id="nombre" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Apellidos</label>
                                <div class="controls"><input type="text" name="apellido" id="apellido" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls"><input type="email" name="email" id="email" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Contraseña</label>
                                <div class="controls"><input type="password" name="pass" id="pass" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Repita Contraseña</label>
                                <div class="controls"><input type="password" name="pass1" id="pass1" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Identificación</label>
                                <div class="controls"><input type="text" name="identificacion" id="identificacion" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Cargo</label>
                                <div class="controls"><input type="text" name="cargo" id="cargo" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                        </form>
                    </td>
                    <td>
                        <form id="formcreate2" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Celular</label>
                                <div class="controls"><input type="text" name="celular" id="celular" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Telefono</label>
                                <div class="controls"><input type="text" name="telefono" id="telefono" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">País</label>
                                <div class="controls"><input type="text" name="pais" id="pais" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Departamento</label>
                                <div class="controls"><input type="text" name="departamento" id="departamento" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Ciudad</label>
                                <div class="controls"><input type="text" name="ciudad" id="ciudad" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Dirección</label>
                                <div class="controls"><input type="text" name="direccion" id="direccion" class="text ui-widget-content ui-corner-all" /></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Habilitado</label>
                                <div class="controls"><select name="habilitado" id="habilitado" class="text ui-widget-content ui-corner-all">
                                        <option value="1">Sí</option>
                                        <option value="2">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">&nbsp;</label>
                                <div class="controls">&nbsp;</div>
                            </div>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
	<div id="dialog-permission" title="Permisos" style="display: none;">
            <p class="validateTips"></p>
            <form class="form-horizontal" id="formpermission">
            </form>
        </div>
        <div id="dialog-variables" title="Variables" style="display: none;">
            <p class="validateTips"></p>
            <form class="form-horizontal" id="formvariable">
            </form>
        </div>
        <div id="dialog-cargar" title="Cargar datos" style="display: none;">
            <p class="validateTips"></p>
            <form class="form-horizontal" id="formcargar">
                <div class="control-group">
                    <input type="file" id="fileinput" /><label for="files">Seleccione archivo de datos del usuario</label>
                </div>
                    
                <table id="variables_table" class="table table-hover dyntable">
                    
                </table>
            </form>
        </div>
	<?php include 'include/generic_script.php'; ?>
        <link rel="stylesheet" media="screen" href="css/dynamictable.css" type="text/css" />
        <script type="text/javascript" src="js/jquery/jquery-dataTables.js"></script>
        <script type="text/javascript" src="js/lib/data-sha1.js"></script>
        <script type="text/javascript" src="js/usuario.js"></script>
    </body>
</html>