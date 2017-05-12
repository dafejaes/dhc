<?php

?>
<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav">
	    <?php 
	    if($SESSION_DATA->getPermission(1)){
	    ?>
            <li <?php if ($_ACTIVE_SIDEBAR == "instituciones") echo 'class="active"'; ?>><a href="instituciones.php">Instituciones</a></li>
            <li class="divider-vertical"></li>
	    <?php 
	    }
	    if($SESSION_DATA->getPermission(5)){
	    ?>
            <li <?php if ($_ACTIVE_SIDEBAR == "usuario") echo 'class="active"'; ?>><a href="usuario.php">Usuarios</a></li>
            <li class="divider-vertical"></li>
	    <?php 
	    }
	    ?>
            
        </ul>
        <ul class="nav pull-right">
            <li><a href="logout.php">Salir</a></li>
            <li class="divider-vertical"></li>

        </ul>
    </div>

</div>