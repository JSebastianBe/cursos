<?php require 'src/views/templates/header.php'; 

if(isset($this->d['curso'])){
	$curso = $this->d['curso'];
}

?>
<div class="container" id="contenedor">
	<div class="row">
		<?php require 'src/views/templates/notificaciones.php'; 
		if($usuario->getPerfil()=="Cliente"){
			header('location: /Cursos/inicio');
		}
		$idCurso = "";
		$idLeccion = "";
		$capitulo = "";
		$titulo = "";
		$objetivo = "";
		$teoria = "";
		$ejercicio = "";
		$video = "";
		$orden = "";
		$nombreBoton = "";
		?>
		<div class="col col-lg-12">
			<?php
				if(isset($this->d['leccionModificar'])){
					$leccion = $this->d['leccionModificar'];
					$nombreBoton = "Modificar";
					$idCurso = $leccion->getIdCurso();
					$idLeccion = $leccion->getIdLeccion();
					$capitulo = $leccion->getCapitulo();
					$titulo = $leccion->getTitulo();
					$objetivo = $leccion->getObjetivo();
					$teoria = $leccion->getTeoria();
					$ejercicio = $leccion->getEjercicio();
					$orden = $leccion->getOrden();
					$video = $leccion->getVideo();
					?>
					<h1  class="text-center">Modifica Lección: <?php echo $titulo;?></h1>
					<form class="row g-3" action="/Cursos/modificarLeccion" method="POST" enctype="multipart/form-data">
						<input type="hidden" class="form-control" name="orden" id="oden" value="<?php echo $orden; ?>" required> 
						<input type="hidden" class="form-control" name="idLeccion" id="idLeccion" value="<?php echo $idLeccion; ?>" required>
					<?php
				}else{
					$nombreBoton = "Registrar";
					?>
					<h1  class="text-center">Registro de Lecciones para el curso: <?php echo $curso->getNombre();?></h1>
					<form class="row g-3" action="/Cursos/crearLeccion" method="POST" enctype="multipart/form-data">
					<?php
				}
			?>
				<input type="hidden" class="form-control" name="idCurso" id="idCurso" value="<?php echo $idCurso; ?>" required>
				<div class="col-lg-6">
					<label for="validationCustomCapitulo" class="form-model"> Capitulo</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupCapitulo"><i class="bi bi-list-ol"></i></span>
						<select name="capitulo" id="capitulo" class="form-select" aria-label="Capitulo" required>
							<option selected>-- Selecione el Capitulo --</option>
							<?php
							for($i= 1; $i<=10; $i++){
								if($capitulo=="Capitulo ".$i){
									?>
									<option value="Capitulo <?php echo $i; ?>" selected>Capitulo <?php echo $i; ?> </option>
									<?php
								}else{
									?>
									<option value="Capitulo <?php echo $i; ?>">Capitulo <?php echo $i; ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-lg-6">
					<label for="validationCustomTitulo" class="form-model"> Titulo</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-card-text"></i></span>
						<input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $titulo; ?>" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomObjetivo" class="form-model"> Objetivo</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupObjetivo"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="objetivo" id="objetivo" required><?php echo $objetivo; ?></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomTeoria" class="form-model"> Teoría</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupTeoria"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="teoria" id="teoria" required><?php echo $teoria; ?></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomEjercicio" class="form-model"> Ejercicio</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupEjercicio"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="ejercicio"  id="ejercicio" required><?php echo $ejercicio; ?></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomVideo" class="form-model"> Video</label>
					<?php
					if($video != ""){
					?>
					<video class="form-model" src="/Cursos/public/img/videos/<?php echo $video; ?>" width="300" height="200" controls></video>
					<?php
					}
					?>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupVideo"><i class="bi bi-camera-video"></i></span>
						<input type="file" class="form-control" name="video" id="video" value="" accept="video/mp4">
					</div>
				</div>
				<div class="col-lg-12">
					<input class="btn boton-p" type="submit" value="<?php echo $nombreBoton;?> Leccion">
				</div>
			</form>
		</div>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>