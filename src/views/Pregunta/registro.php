<?php require 'src/views/templates/header.php'; 

if(isset($this->d['leccion'])){
	$leccion = $this->d['leccion'];
}

?>
<div class="container" id="contenedor">
	<div class="row">
		<?php require 'src/views/templates/notificaciones.php'; 
		if($usuario->getPerfil()=="Cliente"){
			header('location: /Cursos/inicio');
		}
		$idPregunta = "";
		$idLeccion = "";
		$nombre = "";
		$descripcion = "";
		$nombreBoton = "";
		?>
		<div class="col col-lg-12">
			<?php
				if(isset($this->d['preguntaModificar'])){
					$pregunta = $this->d['preguntaModificar'];
					$nombreBoton = "Modificar";
					$idPregunta = $pregunta->getIdPregunta();
					$idLeccion = $pregunta->getIdLeccion();
					$nombre = $pregunta->getNombre();
					$descripcion = $pregunta->getDescripcion();
					?>
					<h1  class="text-center">Modifica Pregunta: <?php echo $nombre;?></h1>
					<form class="row g-3" action="/Cursos/modificarPregunta" method="POST" enctype="multipart/form-data">
						<input type="hidden" class="form-control" name="idPregunta" id="idPregunta" value="<?php echo $idPregunta; ?>" required>
						<input type="hidden" class="form-control" name="idLeccion" id="idLeccion" value="<?php echo $idLeccion; ?>" required>
					<?php
				}else{
					$nombreBoton = "Registrar";
					?>
					<h1  class="text-center">Registro de Preguntas para la lección: <?php echo $leccion->getTitulo();?></h1>
					<form class="row g-3" action="/Cursos/crearPregunta" method="POST" enctype="multipart/form-data">
					<input type="hidden" class="form-control" name="idLeccion" id="idLeccion" value="<?php echo $leccion->getIdLeccion(); ?>" required>
					<?php
				}
			?>
				<div class="col-lg-6">
					<label for="validationCustomNombre" class="form-model"> Pregunta</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-card-text"></i></span>
						<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required>
					</div>
				</div>
				<div class="col-lg-6">
					<label for="validationCustomDescripcion" class="form-model"> Descripcion</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupVideo"><i class="bi bi-card-text"></i></span>
						<input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>" required>
					</div>
				</div>
				<div class="col-lg-12">
					<input class="btn boton-p" type="submit" value="<?php echo $nombreBoton;?> Pregunta">
				</div>
			</form>
		</div>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>