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
													<th><h3><a href="/Cursos/public/img/files/<?php echo $m->getArchivo(); ?>"><i class="bi bi-download"></i></a></h3></th>
											    </tr>
											<?php
										}
										?>
										 </tbody>
									 </table>
								</div>
							</div>
						</div>
						<hr class="featurette-divider">
						<div class="row">
							<div class="col col-lg-2"></div>
							<div class="col col-lg-8" id="preguntas">
								<h3 class="featurette-heading">Evaluación de la lección: </h3>
								<?php
									$cantidaPreg = $leccion->getCantidadPreguntas();
									$cantidaPregOk=0;
									$avanceCurso =$cliente->getAvanceCurso($curso->getIdCurso());
									$i = 1;
									if($cantidaPreg==0){
										?>
										<div class="alert alert-info" role="alert">
											<span class="alert-heading">¡Enhorabuena!</span>
										  	, esta lección no tiene preguntas, puedes continuar...
										</div>
										<?php
									}else{
										foreach($leccion->getPreguntas() as $pregunta){
											$claseAlerta='';
											$disable = '';
											$avanceLeccion =$avanceCurso->getAvanceLeccion($pregunta->getIdLeccion());
											if($pregunta->contestadaCorrecta($avanceLeccion->getEvaluaciones())==1){
												$claseAlerta = 'success';
												$disable = 'disabled';
											}
											if($pregunta->contestadaCorrecta($avanceLeccion->getEvaluaciones())==0){
												$claseAlerta = 'danger';
											}
											?>
											<div class="alert alert-<?php echo $claseAlerta; ?>" role="alert">
												<form action="/Cursos/respondePregunta" method="POST">
													<h3 class="featurette-heading"><?php echo $i.". ".$pregunta->getNombre(); ?> </h3>
													<input type="hidden" class="form-control" name="idPregunta" id="idPregunta" value="<?php echo $pregunta->getIdPregunta(); ?>" required>
													<input type="hidden" class="form-control" name="idCliente" id="idCliente" value="<?php echo $usuario->getIdUsuario(); ?>" required>
													<?php
													$j=1;
													$resCorr = '';
													foreach($pregunta->getRespuestas() as $respuesta){
														if($claseAlerta == 'success'){
															$respon = $avanceLeccion->getRespuesta($respuesta->getIdRespuesta());

															if(!is_null($respon) && $respon->getCorrecta() == 1){
																$resCorr='checked';
																$cantidaPregOk = $cantidaPregOk + 1;
															}	
														}
														
														
													?>
														<div class="form-check">
															<input class="form-check-input " type="radio" value="<?php echo $respuesta->getIdRespuesta();?>" name="idRespuesta" id="respuesta<?php echo $j;?>" required <?php echo $disable;?> <?php echo $resCorr; ?> >
															<label class="form-check-label" for="respuesta<?php echo $j;?>">
																<?php echo $respuesta->getOpcion().") ".$respuesta->getNombre();?>
															</label>
														</div>
													<?php
														$j=$j+1;
													}
													?>
													<input class="btn boton-s <?php echo $disable;?>" type="submit" value="Responder">
												</form>
											</div>
											<hr class="featurette-divider">
											<?php
											$i=$i+1;
										}
									}
								?>
							</div>
						</div>
						<div class="row text-center">
							<?php
							$disabled_btn = 'disabled';
							if($cantidaPreg == $cantidaPregOk){
								$disabled_btn = '';
							}
							?>
							<form action="/Cursos/avanzaLeccion" method="POST">
								<input type="hidden" class="form-control" name="idLeccion" id="idLeccion" value="<?php echo $leccion->getIdLeccion(); ?>" required>
								<input type="hidden" class="form-control" name="idAvanceCurso" id="idAvanceCurso" value="<?php echo $avanceCurso->getIdAvanceCurso(); ?>" required>
								<input class="btn boton-p <?php echo $disabled_btn; ?>" type="submit" value="Continuar a la siguiente lección">
							</form>
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