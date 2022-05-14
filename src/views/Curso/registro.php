<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
	<div class="row">
		<?php require 'src/views/templates/notificaciones.php'; 
		if($usuario->getPerfil()=="Cliente"){
			header('location: /Cursos/inicio');
		}
		$idCurso = "";
		$nombre = "";
		$precio = "";
		$objetivo = "";
		$descripcion = "";
		$duracion = "";
		$perfil = "";
		$profesor = "";
		$imagen = "";
		$videoIntroduc = "";
		//$lecciones = "";
		$nombreBoton = "Crear";
		?>
		<div class="col col-lg-12">
			<?php
			if(isset($this->d['cursoModificar'])){
				$nombreBoton = "Modificar";
				$cursoModificar = $this->d['cursoModificar'];

				$idCurso = $cursoModificar->getIdCurso();
				$nombre = $cursoModificar->getNombre();
				$precio = $cursoModificar->getPrecio();
				$objetivo = $cursoModificar->getObjetivo();
				$descripcion = $cursoModificar->getDescripcion();
				$perfil = $cursoModificar->getPerfil();
				$duracion = $cursoModificar->getDuracion();
				$profesor = $cursoModificar->getProfesor();
				$imagen = $cursoModificar->getImagen();
				$videoIntroduc = $cursoModificar->getVideoIntroduc();
				//$lecciones = $cursoModificar->getLecciones();
				?>
				<h1  class="text-center">Actualización de curso <?php echo $nombre;?></h1>
				<form class="row g-3" action="/Cursos/modificarCurso" method="POST" enctype="multipart/form-data">
					<input type="hidden" class="form-control" name="idCurso" id="idCurso" value="<?php echo $idCurso; ?>" required>
				<?php
			}else{
				?>
				<h1  class="text-center">Registro de cursos</h1>
				<form class="row g-3" action="/Cursos/creaCurso" method="POST" enctype="multipart/form-data">
				<?php
			}
			?>
				<div class="col-lg-4">
					<label for="validationCustomNombre" class="form-model"> Nombre</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-card-text"></i></span>
						<input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>" required>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomPrecio" class="form-model"> Precio (cop)</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupPrecio"><i class="bi bi-currency-dollar"></i></span>
						<input type="number" class="form-control" name="precio" min="0" step="0.01" value="<?php echo $precio; ?>" required>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomProfesor" class="form-model"> Profesor</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupProfesor"><i class="bi bi-person-circle"></i></span>
						<input type="text" class="form-control" name="profesor" value="<?php echo $profesor; ?>" required>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomDuracion" class="form-model"> Duración (horas)</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupDuracion"><i class="bi bi-alarm"></i></span>
						<input type="number" class="form-control" name="duracion" min="0" step="0.1" value="<?php echo $duracion; ?>" required>
					</div>
				</div>
				<div class="col-lg-4">
					<?php
					if($imagen != ""){
					?>
					<img src="/Cursos/public/img/photos/<?php echo $imagen; ?>" class="card-img-top" alt="Curso <?php echo $imagen; ?>">
					<?php
					}
					?>
					<label for="validationCustomImagen" class="form-model"> Imagen</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupImagen"><i class="bi bi-card-image"></i></span>
						<input type="file" class="form-control" name="imagen" value="" width="300" accept="image/png, .jpeg, .jpg">
					</div>
				</div>
				<div class="col-lg-4">
					<?php
					if($videoIntroduc != ""){
					?>
					<video class="form-model" src="/Cursos/public/img/videos/<?php echo $videoIntroduc; ?>" width="300" height="200" controls></video>
					<?php
					}
					?>
					<label for="validationCustomVideo" class="form-model"> Video introductorio</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupVideo"><i class="bi bi-camera-video"></i></span>
						<input type="file" class="form-control" name="videoIntroduc" value="" accept="video/mp4">
					</div>
				</div>
				<div class="col-lg-6">
					<label for="validationCustomObjetivo" class="form-model"> Objetivo</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupObjetivo"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="objetivo" required><?php echo $objetivo; ?></textarea>
					</div>
				</div>
				<div class="col-lg-6">
					<label for="validationCustomPerfil" class="form-model"> Perfil profesional</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupPerfil"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="100" placeholder="Máximo 100 caracteres.." name="perfil" required><?php echo $perfil; ?></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomDescripcion" class="form-model"> Descripción</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupDescripcion"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="descripcion" required><?php echo $descripcion; ?></textarea>
					</div>
				</div>
				 <div class="col-lg-12">
					<input class="btn boton-p" type="submit" value="<?php echo $nombreBoton;?> Curso">
				</div>
			</form>
		</div>
	</div>
</div>

<?php require 'src/views/templates/footer.php'; ?>