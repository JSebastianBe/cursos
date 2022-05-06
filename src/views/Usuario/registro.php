<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
	<h1  class="text-center">Registro</h1>
	<div class="row">
		<div class="col col-lg-4 offset-lg-4">
			<?php require 'src/views/templates/notificaciones.php'; ?>
			<?php if(unserialize($_SESSION['usuario'])->getPerfil()=="Administrador"){ ?>
				<form class="row g-3" action="/Cursos/registrarUsuario" method="GET">
			<?php }else{
				?>
				<form class="row g-3" action="/Cursos/registrarse" method="GET">
				<?php
			}?>
				<div class="col-lg-12">
					<label for="validationCustomNombre" class="form-model"> Nombre</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-card-text"></i></span>
						<input type="text" class="form-control" name="nombre" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomTelefono" class="form-model"> Tel�fono</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupTelefono"><i class="bi bi-phone"></i></span>
						<input type="number" class="form-control" name="telefono" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomCorreo" class="form-model"> Correo</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupCorreo"><i class="bi bi-mailbox"></i></span>
						<input type="email" class="form-control" name="correo" required>
					</div>
				</div>
				<div class="col-lg-12">
					<input class="btn boton-p" type="submit" value="Registrarse">
				</div>
			</form>
		</div>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>
