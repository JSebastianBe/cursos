<?php require 'src/views/templates/header.php'; 
$leccion = $this->d['leccion'];?>
<div class="container" id="contenedor">
<h1>Listado de Preguntas para la lección: <?php echo $leccion->getTitulo();?></h1>
<a class="btn boton-s" href="/Cursos/creaPregunta?id=<?php echo $leccion->getIdLeccion(); ?>" role="button"><i class="bi bi-plus-circle"></i></a>
<?php require 'src/views/templates/notificaciones.php'; ?>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
			    <tr>		
					<th scope="col"> Pregunta </th>	
					<th scope="col"> Descripción </th>	
					<th scope="col"> Respuestas </th>
					<th scope="col"> Modificar </th>
				</tr> 
			  </thead>
			<tbody>
			<?php 
			
			foreach($leccion->getPreguntas() as $p){
				?>
					<tr>
						<th><?php echo $p->getNombre(); ?></th>
						<th><?php echo $p->getDescripcion(); ?></th>
						<th scope="col"><a class="btn boton-s" href="listarRespuestas?id=<?php echo $p->getIdPregunta(); ?>"><i class="bi bi-book"></i></a></th>
				      	<th scope="col"><a class="btn boton-p" href="modificaPregunta?id=<?php echo $p->getIdPregunta(); ?>"><i class="bi bi-pencil"></i></a></th>
				    </tr>
				<?php
			}
			?>
			 </tbody>
		 </table>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>