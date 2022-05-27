<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="/Cursos/src/views/src/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/Cursos/src/views/src/node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="/Cursos/src/views/src/css/styles.css">
    <link rel="icon" type="image/x-icon" href="/Cursos/src/views/src/images/favicon.ico">
    <title>Cursos - UCENTRAL</title>
  </head>
  <body>
	<nav class="navbar navbar-expand-lg navbar-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="/Cursos/inicio">
				<div id="logo-img" alt="Logo image"></div>
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<i class="bi bi-list" id="icon-menu"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="/Cursos/catalogo">Catalogo</a>
					</li>
					<?php
					$usuario =[];
					if(!isset($_SESSION['usuario'])){
					?>
					<li class="nav-item">
						<a class="nav-link" href="/Cursos/registro">Registrarse</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/Cursos/iniciarSesion">Iniciar Sesión</a>
					</li>
					<?php
					}else{
						$usuario = unserialize($_SESSION['usuario']);
					?>

						<li class="nav-item dropdown">
						  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						    <?php echo $usuario->getNombre();?>(<?php echo $usuario->getPerfil();?>)
						  </a>
						  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						  	<?php
						  	if($usuario->getPerfil()=="Cliente"){
							?>
								<li><a class="dropdown-item" href="/Cursos/misCursos">Mis Cursos</a></li>
							<?php
							}
						  	if($usuario->getPerfil()=="Asistente"){
							?>
								<li><a class="dropdown-item" href="/Cursos/listarCursos">Cursos</a></li>
							<?php
							}
							if($usuario->getPerfil()=="Administrador"){
							?>
								<li><a class="dropdown-item" href="/Cursos/listarCursos">Cursos</a></li>
								<li><a class="dropdown-item" href="#">Pagos</a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="/Cursos/listarUsuarios">Usuarios</a></li>
							<?php
							}
							?>
							<li><hr class="dropdown-divider"></li>
							<!-- <li><a class="dropdown-item" href="#">Cambiar Clave</a></li> -->
						    <li><a class="dropdown-item" href="/Cursos/cerrarSesion">Cerrar Sesión</a></li>
						  </ul>
						</li>
					<?php	
					}
					?>
				</ul>
			</div>
		</div>
	</nav>
