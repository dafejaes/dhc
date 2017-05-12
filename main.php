<?php
include 'include/generic_validate_session.php';
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
		<?php $_ACTIVE_SIDEBAR = ''; include 'include/generic_navbar.php'; ?>
            </div>
	    <div class="container" style="height: 300px; margin: 0 auto !important; text-align: center;">
		<br><br>
		<h1>BIENVENIDO</h1>
	    </div>	    
	</section>
	<footer id="footer_wrap">
	<?php include 'include/generic_footer.php'; ?>
	</footer>
    </body>
</html>