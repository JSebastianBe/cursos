<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
	<h1 class="text-center">Iniciar sesión</h1>
	<div class="row">
		<div class="col col-lg-4 offset-lg-4">
			<?php require 'src/views/templates/notificaciones.php'; ?>
			<form class="row g-3" action="/Cursos/inicioSesion" method="post">
				<div class="col-lg-12">
					<label class="form-model"> Usuario</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre">U</span>
						<input type="text" class="form-control" name="usuario" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label class="form-model"> Clave</label>
					<div class="input-group has-validation">
						<span class="input-group-text">C</span>
						<input type="password" class="form-control" name="clave" required>
					</div>
				</div>
				<div class="col-lg-12">
					<input class="btn boton-p" type="submit" value="Iniciar Sesión">
				</div>
			</form>
		</div>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>
