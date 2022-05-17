<?php require 'src/views/templates/header.php'; 
$pregunta = $this->d['pregunta'];?>
<div class="container" id="contenedor">
<h1>Listado de Respuestas para la Pregunta: <?php echo $pregunta->getNombre();?></h1>
<a class="btn boton-s" href="/Cursos/creaRespuesta?id=<?php echo $pregunta->getIdPregunta(); ?>" role="button"><i class="bi bi-plus-circle"></i></a>
<?php require 'src/views/templates/notificaciones.php'; ?>
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
			    <tr>		
					<th scope="col"> Opcion </th>	
					<th scope="col"> Respuesta </th>	
					<th scope="col"> Correcta </th>
					<th scope="col"> Modificar </th>
				</tr> 
			  </thead>
			<tbody>
			<?php 
			
			foreach($pregunta->getRespuestas() as $r){
				?>
					<tr>
						<th><?php echo $r->getOpcion(); ?></th>
						<th><?php echo $r->getNombre(); ?></th>
						<th><?php if($r->getCorrecta()==1){ 
								echo '<i class="alert-success bi bi-check-circle"></i>';
							}else{
								echo '<i class="alert-danger bi bi-dash-circle"></i></h6>';
							} ?></th>
				      	<th scope="col"><a class="btn boton-p" href="modificaRespuesta?id=<?php echo $r->getIdRespuesta(); ?>"><i class="bi bi-pencil"></i></a></th>
				    </tr>
				<?php
			}
			?>
			 </tbody>
		 </table>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>