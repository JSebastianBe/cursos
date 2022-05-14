<?php require 'src/views/templates/header.php'; 
$curso = $this->d['curso'];?>
<div class="container" id="contenedor">
	<div class="row">
		<?php require 'src/views/templates/notificaciones.php'; 
		if($usuario->getPerfil()=="Cliente"){
			header('location: /Cursos/inicio');
		}
		?>
		<div class="col col-lg-12">
			<h1  class="text-center">Registro de Lecciones para el curso: <?php echo $curso->getNombre();?></h1>
			<form class="row g-3" action="/Cursos/creaLeccion" method="POST" enctype="multipart/form-data">
				<!-- <input type="hidden" class="form-control" name="idLeccion" id="idLeccion" value="" required> -->
				<input type="hidden" class="form-control" name="idCurso" id="idCurso" value="<?php echo $curso->getIdCurso(); ?>" required>
				<div class="col-lg-6">
					<label for="validationCustomCapitulo" class="form-model"> Capitulo</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupCapitulo"><i class="bi bi-list-ol"></i></span>
						<select name="capitulo" id="capitulo" class="form-select" aria-label="Capitulo" required>
							<option selected>-- Selecione el Capitulo --</option>
							<?php
							for($i= 1; $i<=10; $i++){
								?>
								<option value="Capitulo <?php echo $i; ?>">Capitulo <?php echo $i; ?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-lg-6">
					<label for="validationCustomTitulo" class="form-model"> Titulo</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-card-text"></i></span>
						<input type="text" class="form-control" name="titulo" id="titulo" value="" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomObjetivo" class="form-model"> Objetivo</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupObjetivo"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="objetivo" id="objetivo" required></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomTeoria" class="form-model"> Teoría</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupTeoria"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="teoria" id="teoria" required></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomEjercicio" class="form-model"> Ejercicio</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupEjercicio"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="ejercicio"  id="ejercicio" required></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomVideo" class="form-model"> Video</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupVideo"><i class="bi bi-camera-video"></i></span>
						<input type="file" class="form-control" name="video" id="video" value="" accept="video/mp4" required>
					</div>
				</div>
				<div class="col-lg-12">
					<input class="btn boton-p" type="submit" value="Registrar Leccion">
				</div>
			</form>
		</div>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>