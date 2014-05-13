<?php
$dir = $_SERVER["REQUEST_URI"];
$array = split("/", $dir);
$n = count($array);
?>
<div id="main-sidebar" >
	<asside class="navigation">
		<?php
		if($array[$n-1] == "index.php"){
		?>
		<div class="logo">
			<a href="../index.php"><img src="vista/images/logo.png"/></a>
		</div>
		<!-- /.logo -->
		<ul class="main-menu">
			<li class="services">
				<a href='vista/categoria1.php'>servicios</a>
			</li>
			<li class="about">
				<a href="vista/sobrenosotros.php">sobre nosotros</a>
			</li>
			<li class="contact">
				<a href="vista/contacto.php">contacto</a>
			</li>
		</ul>
		<?php
		}else {
		?>
		<div class="logo">
			<a href="../index.php"><img src="images/logo.png"/></a>
		</div>
		<!-- /.logo -->
		<ul class="main-menu">
			<li class="services">
				<a href='categoria1.php'>servicios</a>
			</li>
			<li class="about">
				<a href="sobrenosotros.php">sobre nosotros</a>
			</li>
			<li class="contact">
				<a href="contacto.php">contacto</a>
			</li>
		</ul>
		<?php
		}
		?>
	</asside>
</div>
<!-- /.navigation -->