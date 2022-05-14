<?php require 'src/views/templates/header.php'; 
$curso = $this->d['curso'];?>
<div class="container" id="contenedor">
<h1>Listado de lecciones para el Curso: <?php echo $curso->getNombre();?></h1>
<a class="btn boton-s" href="/Cursos/crearLecciones?id=<?php echo $curso->getIdCurso(); ?>" role="button"><i class="bi bi-plus-circle"></i></a>
<?php require 'src/views/templates/notificaciones.php'; ?>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
			    <tr>		
					<th scope="col"> Orden </th>
					<th scope="col"> Capitulo </th>	
					<th scope="col"> Lección </th>	
					<th scope="col"> Preguntas </th>
					<th scope="col"> Detalle </th>
				</tr> 
			  </thead>
			<tbody>
			<?php 
			
			foreach($curso->getLecciones() as $l){
				?>
					<tr>
						<th scope="col"><?php echo $l->getOrden(); ?></th>
						<th><?php echo $l->getCapitulo(); ?></th>
						<th><?php echo $l->getTitulo(); ?></th>
						<th scope="col"><a class="btn boton-s" href="listarPreguntas?id=<?php echo $c->getIdLeccion(); ?>"><i class="bi bi-book"></i></a></th>
				      <th scope="col"><a class="btn boton-p" href="modificaLeccion?id=<?php echo $c->getIdLeccion(); ?>"><i class="bi bi-zoom-in"></i></a></th>
				    </tr>
				<?php
			}
			?>
			 </tbody>
		 </table>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>
