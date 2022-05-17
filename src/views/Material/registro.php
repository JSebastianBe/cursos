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
		$idMaterial = "";
		$idLeccion = "";
		$nombre = "";
		$archivo = "";
		$nombreBoton = "";
		?>
		<div class="col col-lg-12">
			<?php
				if(isset($this->d['materialModificar'])){
					$material = $this->d['materialModificar'];
					$nombreBoton = "Modificar";
					$idMaterial = $material->getIdMaterial();
					$idLeccion = $material->getIdLeccion();
					$nombre = $material->getNombre();
					$archivo = $material->getArchivo();
					?>
					<h1  class="text-center">Modifica Material: <?php echo $nombre;?></h1>
					<form class="row g-3" action="/Cursos/modificarMaterial" method="POST" enctype="multipart/form-data">
						<input type="hidden" class="form-control" name="idMaterial" id="idMaterial" value="<?php echo $idMaterial; ?>" required>
					<?php
				}else{
					$nombreBoton = "Registrar";
					?>
					<h1  class="text-center">Registro de Materiales para la lección: <?php echo $leccion->getTitulo();?></h1>
					<form class="row g-3" action="/Cursos/crearMaterial" method="POST" enctype="multipart/form-data">
					<?php
				}
			?>
				<input type="hidden" class="form-control" name="idLeccion" id="idLeccion" value="<?php echo $idLeccion; ?>" required>
				<div class="col-lg-6">
					<label for="validationCustomArchivo" class="form-model"> Archivo</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupVideo"><i class="bi bi-cloud-upload"></i></span>
						<input type="file" class="form-control" name="archivo" id="archivo" value="" accept="application/pdf, .doc, .docx, .odf, video/mp4">
					</div>
				</div>
				<div class="col-lg-6">
					<label for="validationCustomNombre" class="form-model"> Nombre</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-card-text"></i></span>
						<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>" required>
					</div>
				</div>
				<div class="col-lg-12">
					<input class="btn boton-p" type="submit" value="<?php echo $nombreBoton;?> Material">
				</div>
			</form>
		</div>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>