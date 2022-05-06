<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
	<h1 class="text-center">Iniciar sesi�n</h1>
	<div class="row">
		<div class="col col-lg-4 offset-lg-4">
			<?php require 'src/views/templates/notificaciones.php'; ?>
			<form class="row g-3" action="/Cursos/inicioSesion" method="post">
				<div class="col-lg-12">
					<label class="form-model"> Usuario</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-file-person"></i></span>
						<input type="email" class="form-control" name="usuario" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label class="form-model"> Clave</label>
					<div class="input-group has-validation">
						<span class="input-group-text"><i class="bi bi-file-lock2"></i></span>
						<input type="password" class="form-control" name="clave" required>
					</div>
				</div>
				<div class="col-lg-6">
					<input class="btn boton-p" type="submit" value="Iniciar Sesi�n">
				</div>
				<div class="col-lg-6">
					<a class="btn boton-s" href="#">Recordar contrase�a</a>
				</div>


			</form>
		</div>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>
