<?php require 'src/views/templates/header.php'; 
$leccion = $this->d['leccion'];
$curso = $leccion->getCurso();
?>
<div class="container" id="contenedor">
	<div class="row">
		<?php require 'src/views/templates/notificaciones.php'; 
		if(isset($_SESSION['usuario']) && 
			$usuario->getPerfil()=="Cliente"){
			$cliente = $usuario->getCliente();
			if($cliente->getPago($leccion->getIdCurso())){
				if($leccion->leccionActual($cliente->getIdCliente()) || $leccion->habilitaLeccion($cliente->getIdCliente())){
					?>
					<div class="container" id="contenido-ppal">
						<h1 class="display-5 fw-bold lh-1 mb-3 text-center">Contenido <?php echo $curso->getNombre(); ?></h1>
						<h2 class="display-5 fw-bold lh-1 mb-3"><?php echo $leccion->getCapitulo(); ?>: <span class="text-muted"><?php echo $leccion->getTitulo(); ?></span></h2>
						<div class="row">
							<div class="col col-lg-7" id="contenidoLeccion">
								<div class="row">
									<div class="col col-lg-12">
										<h3 class="featurette-heading">Vídeo: </h3>
										<video class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" src="/Cursos/public/img/videos/<?php echo $leccion->getVideo(); ?>" width="100%" height="500" controls></video>
									</div>
									<div class="col col-lg-12">
										<h3 class="featurette-heading">Objetivo: </h3>
										<p class="lead"><?php echo $leccion->getObjetivo(); ?></p>
									</div>
									<div class="col col-lg-12">
										<h3 class="featurette-heading">Teoría: </h3>
										<p class="lead"><?php echo $leccion->getTeoria(); ?></p>			
									</div>
									<div class="col col-lg-12">
										<h3 class="featurette-heading">Ejercicios: </h3>
										<p class="lead"><?php echo $leccion->getEjercicio(); ?></p>			
									</div>
								</div>
							</div>
							<div class="col col-lg-5" id="material">
								<h3 class="featurette-heading">Material de apoyo: </h3>
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
										    <tr>		
										    	<th scope="col"> Tipo </th>	
												<th scope="col"> Nombre </th>	
												<th scope="col"> Descargar </th>	
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
											    </tr>
											<?php
										}
										?>
										 </tbody>
									 </table>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col col-lg-12" id="preguntas">
								<h3 class="featurette-heading">Evaluación de la lección: </h3>
								<?php var_dump($leccion->getPreguntas());?>
							</div>
						</div>
					</div>
					<?php
				}else{
					header('location: /Cursos/misCursos');
				}
			}else{
				header('location: /Cursos/misCursos');
			}
		}else{
			header('location: /Cursos/misCursos');
		}
		?>
		
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>