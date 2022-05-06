<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
	<h1  class="text-center">Registro de cursos</h1>
	<div class="row">
		<?php require 'src/views/templates/notificaciones.php'; 
		if($usuario->getPerfil()=="Cliente"){
				header('location: /Cursos/inicio');
		
		}
		?>
		<div class="col col-lg-4 offset-lg-4">
			<form class="row g-3" action="/Cursos/creaCurso" method="POST" enctype="multipart/form-data">
				<div class="col-lg-12">
					<label for="validationCustomNombre" class="form-model"> Nombre</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-card-text"></i></span>
						<input type="text" class="form-control" name="nombre" value="" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomPrecio" class="form-model"> Precio (cop)</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupPrecio"><i class="bi bi-currency-dollar"></i></span>
						<input type="number" class="form-control" name="precio" min="0" step="0.01" value="" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomDescripcionCorta" class="form-model"> Descripción Corta</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupDescripcionCorta"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" maxlength="100" placeholder="Máximo 100 caracteres.." name="descripcionCorta" required></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomDescripcionLarga" class="form-model"> Descripción Larga</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupDescripcionlarga"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="descripcionLarga" required></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomDuracion" class="form-model"> Duración (horas)</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupDuracion"><i class="bi bi-alarm"></i></span>
						<input type="number" class="form-control" name="duracion" min="0" step="0.1" value="" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomProfesor" class="form-model"> Profesor</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupProfesor"><i class="bi bi-person-circle"></i></span>
						<input type="text" class="form-control" name="profesor" value="" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomImagen" class="form-model"> Imagen</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupImagen"><i class="bi bi-card-image"></i></span>
						<input type="file" class="form-control" name="imagen" value="" accept="image/png, .jpeg, .jpg" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomVideo" class="form-model"> Video</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupVideo"><i class="bi bi-camera-video"></i></span>
						<input type="file" class="form-control" name="videoIntroduc" value="" accept="video/mp4" required>
					</div>
				</div>
				<div class="col-lg-12">
					<input class="btn boton-p" type="submit" value="Crear">
				</div>
			</form>
		</div>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>
