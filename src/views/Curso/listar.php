<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
<a class="btn boton-s" href="/Cursos/crearCursos" role="button"><i class="bi bi-plus-circle"></i></a>
<?php require 'src/views/templates/notificaciones.php'; ?>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
			    <tr>
					<th scope="col"> idCurso </th>
					<th scope="col"> Nombre </th>
					<th scope="col"> Precio </th>
					<th scope="col"> Duracion </th>
					<th scope="col"> Profesor </th>
					<th scope="col"> Lecciones </th>
					<th scope="col"> Detalle </th>
			    </tr>
			  </thead>
			<tbody>
			<?php 
			$cursos = $this->d['cursos'];
			foreach($cursos as $c){
				?>
					<tr>
						<th scope="col"><?php echo $c->getIdCurso(); ?></th>
						<th><?php echo $c->getNombre(); ?></th>
						<th><?php echo $c->getPrecio(); ?></th>
						<th><?php echo $c->getDuracion(); ?></th>
						<th><?php echo $c->getProfesor(); ?></th>
						<th scope="col"><a class="btn boton-s" href="listarLecciones?id=<?php echo $c->getIdCurso(); ?>"><i class="bi bi-book"></i></a></th>
				      <th scope="col"><a class="btn boton-p" href="modificaCurso?id=<?php echo $c->getIdCurso(); ?>"><i class="bi bi-zoom-in"></i></a></th>
				    </tr>
				<?php
			}
			?>
			 </tbody>
		 </table>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>
