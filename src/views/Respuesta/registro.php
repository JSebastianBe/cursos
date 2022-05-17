<?php require 'src/views/templates/header.php'; 

if(isset($this->d['pregunta'])){
	$pregunta = $this->d['pregunta'];
}

?>
<div class="container" id="contenedor">
	<div class="row">
		<?php require 'src/views/templates/notificaciones.php'; 
		if($usuario->getPerfil()=="Cliente"){
			header('location: /Cursos/inicio');
		}
		$idRespuesta = "";
		$idPregunta = "";
		$nombre = "";
		$opcion = "";
		$correcta = "";
		$nombreBoton = "";
		?>
		<div class="col col-lg-12">
			<?php
				if(isset($this->d['respuestaModificar'])){
					$respuesta = $this->d['respuestaModificar'];
					$nombreBoton = "Modificar";
					$idRespuesta = $respuesta->getIdRespuesta();
					$idPregunta = $respuesta->getIdPregunta();
					$nombre = $respuesta->getNombre();
					$correcta = $respuesta->getCorrecta();
					$opcion = $respuesta->getOpcion();
					?>
					<h1  class="text-center">Modifica Respuesta: <?php echo $nombre;?></h1>
					<form class="row g-3" action="/Cursos/modificarRespuesta" method="POST" enctype="multipart/form-data">
						<input type="hidden" class="form-control" name="idRespuesta" id="idRespuesta" value="<?php echo $idRespuesta; ?>" required>
						<input type="hidden" class="form-control" name="idPregunta" id="idPregunta" value="<?php echo $idPregunta; ?>" required>
					<?php
				}else{
					$nombreBoton = "Registrar";
					?>
					<h1  class="text-center">Registro de Respuestas para la lección: <?php echo $pregunta->getNombre();?></h1>
					<form class="row g-3" action="/Cursos/crearRespuesta" method="POST" enctype="multipart/form-data">
					<input type="hidden" class="form-control" name="idPregunta" id="idPregunta" value="<?php echo $pregunta->getIdPregunta(); ?>" required>
					<?php
				}
			?>
				<div class="col-lg-4">
					<label for="validationCustomOpcion" class="form-model"> Opcion</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupVideo"><i class="bi bi-card-text"></i></span>
						<input type="text" class="form-control" name="opcion" id="opcion" value="<?php echo $opcion; ?>" required>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomNombre" class="form-model"> Respuesta</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-card-text"></i></span>
						<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomCorrecta" class="form-model"> Correcto/label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupCorrecta"><i class="bi bi-list-ol"></i></span>
						<select name="correcta" class="form-select" aria-label="Correcto" required>
						  <option selected>-- Selecione el correcto --</option>
						  <option value="1" <?php if($correcta==1){ echo "selected";} ?>>Correcto</option>
						  <option value="0" <?php if($correcta==0){ echo "selected";} ?>>Incorrecto</option>
						</select>
					</div>
				</div>
				<div class="col-lg-12">
					<input class="btn boton-p" type="submit" value="<?php echo $nombreBoton;?> Respuesta">
				</div>
			</form>
		</div>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>