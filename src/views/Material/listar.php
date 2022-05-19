<?php require 'src/views/templates/header.php'; 
$leccion = $this->d['leccion'];?>
<div class="container" id="contenedor">
<h1>Listado de Materiales para la lección: <?php echo $leccion->getTitulo();?></h1>
<a class="btn boton-s" href="/Cursos/creaMaterial?id=<?php echo $leccion->getIdLeccion(); ?>" role="button"><i class="bi bi-plus-circle"></i></a>
<?php require 'src/views/templates/notificaciones.php'; ?>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
			    <tr>
			    	<th scope="col"> Tipo </th>	
					<th scope="col"> Nombre </th>	
					<th scope="col"> Archivo </th>	
					<th scope="col"> Modificar </th>
				</tr> 
			  </thead>
			<tbody>
			<?php 
			
			foreach($leccion->getMateriales() as $m){
				if($m->getExtension() == 'docx' ||
					$m->getExtension() == 'docx' ||
					$m->getExtension() == 'odf'){
					$icon = 'file-word';
				}
				if($m->getExtension() == 'mp4'){
					$icon = 'file-play';
				}
				if($m->getExtension() == 'pdf'){
					$icon = 'file-pdf';
				}
				if($m->getExtension() == 'txt'){
					$icon = 'file-text';
				}
				if($m->getExtension() == 'png' ||
					$m->getExtension() == 'jpeg' ||
					$m->getExtension() == 'jpg'){
					$icon = 'file-image';
				}
				if($m->getExtension() == 'xls' ||
					$m->getExtension() == 'xlsx' ||
					$m->getExtension() == 'csv'){
					$icon = 'file-excel';
				}
				?>
					<tr>
						<th><h3><i class="bi bi-<?php echo $icon; ?>"></i></h3></th>
						<th><?php echo $m->getNombre(); ?></th>
						<th><a href="/Cursos/public/img/files/<?php echo $m->getArchivo(); ?>">Descargar</a></th>
				      	<th scope="col"><a class="btn boton-p" href="modificaMaterial?id=<?php echo $m->getIdMaterial(); ?>"><i class="bi bi-pencil"></i></a></th>
				    </tr>
				<?php
			}
			?>
			 </tbody>
		 </table>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>
