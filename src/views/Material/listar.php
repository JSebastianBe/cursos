<?php require 'src/views/templates/header.php'; 
$leccion = $this->d['leccion'];?>
<div class="container" id="contenedor">
<h1>Listado de Materiales para la lección: <?php echo $leccion->getTitulo();?></h1>
<a class="btn boton-s" href="/Cursos/creaMateriales?id=<?php echo $leccion->getIdLeccion(); ?>" role="button"><i class="bi bi-plus-circle"></i></a>
<?php require 'src/views/templates/notificaciones.php'; ?>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
			    <tr>		
					<th scope="col"> Nombre </th>	
					<th scope="col"> Archivo </th>	
					<th scope="col"> Modificar </th>
				</tr> 
			  </thead>
			<tbody>
			<?php 
			
			foreach($leccion->getMateriales() as $m){
				?>
					<tr>
						<th><?php echo $m->getNombre(); ?></th>
						<th><?php echo $m->getArchivo(); ?></th>
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
