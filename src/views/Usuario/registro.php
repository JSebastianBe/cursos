<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
	<h1>Registro</h1>
	<div class="row">
		<div class="col col-lg-6 align-self-center">
			<form class="row g-3" action="/Cursos/registrarse" method="post">
				<div class="col-lg-12">
					<label for="validationCustomNombre" class="form-model"> Nombre</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre">N</span>
						<input type="text" class="form-control" name="nombre" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomTelefono" class="form-model"> Teléfono</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupTelefono">T</span>
						<input type="number" class="form-control" name="telefono" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomCorreo" class="form-model"> Correo</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupCorreo">@</span>
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
