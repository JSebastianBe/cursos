<?php require 'src/views/templates/header.php'; ?>
<?php 
if(isset($this->d['curso'])){
	$curso = $this->d['curso'];

?>
<div class="container" id="contenido-ppal">
	<h1 class="display-5 fw-bold lh-1 mb-3  text-center"><?php echo $curso->getNombre(); ?> <!-- <span class="text-muted"><?php echo $curso->getDuracion(); ?>(horas)</span> --></h1>
	<div class="row">
		<div class="col col-lg-12">
			<h2 class="featurette-heading">Descripción: </h2>
			<p class="lead"><?php echo $curso->getDescripcion(); ?></p>
		</div>
		<div class="col col-lg-12">
			<h2 class="featurette-heading">Objetivo: </h2>
			<p class="lead"><?php echo $curso->getObjetivo(); ?></p>			
		</div>
		<div class="col col-lg-12">
			<div class="row">
				<div class="col col-lg-5">
					<h3><span class="text-muted">Video introductorio</span></h3>
					<video class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" src="/Cursos/public/img/videos/<?php echo $curso->getVideoIntroduc(); ?>" width="500" height="500" controls></video>
				</div>
				<div class="col col-lg-7">
					<!-- <h2 class="pb-2 border-bottom">Detalles</h2> -->
					<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
						<div class="col d-flex align-items-start">
							<div class="fs-4 mb-3">
								<div>
									<h4 class="fw-bold mb-0"># Capítulos</h4>
									<p><i class="bi bi-book"></i> <?php echo $curso->getCantidadCapitulos(); ?></p>
								</div>
							</div>
						</div>
						<div class="col d-flex align-items-start">
							<div class="fs-4 mb-3">
								<div>
									<h4 class="fw-bold mb-0">Duración</h4>
									<p><i class="bi bi-alarm"></i> <?php echo $curso->getDuracion(); ?> (horas)</p>
								</div>
							</div>
						</div>
						<div class="col d-flex align-items-start">
							<div class="fs-4 mb-3">
								<div>
									<h4 class="fw-bold mb-0">Profesor</h4>
									<p><i class="bi bi-file-person"></i> <?php echo $curso->getProfesor(); ?></p>
								</div>
							</div>
						</div>
						<div class="col d-flex align-items-start">
							<div class="fs-4 mb-3">
								<div>
									<h4 class="fw-bold mb-0">Precio</h4>
									<p><i class="bi bi-currency-dollar"></i> <?php echo $curso->getPrecio(); ?> </p>
								</div>
							</div>
						</div>
					</div>
					<div class="">
						<?php
						if(!isset($_SESSION['usuario'])){
							?>
								<form action="/Cursos/registrarCurso" method="POST">
									<input type="hidden" class="form-control" name="idCurso" id="idCurso" value="<?php echo $curso->getIdCurso(); ?>" required>
									<input class="btn boton-p" type="submit" value="Registrarse">
								</form>
							<?php
						}else{
							if($usuario->getPerfil()=="Cliente"){
								$cliente = $usuario->getCliente();
								if($cliente->getPago($curso->getIdCurso())){
									?>	
										<span>¡Es tuyo!</span>
									<?php
								}else{
									if($cliente->getInscrito($curso->getIdCurso())){
										?>	
										<form action="/Cursos/pagarCurso" method="POST">
											<input type="hidden" class="form-control" name="idCurso" id="idCurso" value="<?php echo $curso->getIdCurso(); ?>" required>
											<input type="hidden" class="form-control" name="usuario" id="usuario" value="<?php echo $usuario->getUsuario(); ?>" required>
											<input class="btn boton-s" type="submit" value="Realizar inversión">
										</form>
									<?php
									}else{
									?>	
										<form action="/Cursos/inscribirCurso" method="POST">
											<input type="hidden" class="form-control" name="idCurso" id="idCurso" value="<?php echo $curso->getIdCurso(); ?>" required>
											<input type="hidden" class="form-control" name="usuario" id="usuario" value="<?php echo $usuario->getUsuario(); ?>" required>
											<input class="btn boton-p" type="submit" value="Inscribirse">
										</form>
									<?php
									}
								}
							}else{
								?>
								<a href="#" class="btn boton-p btn-lg px-4 me-md-2 disabled" aria-current="true"  >Registrarse</a>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<hr class="featurette-divider">
		<h2 class="featurette-heading">Contenido </h2>
		<ol class="list-group list-group-numbered">
		<?php
		$capitulos = $curso->getCapitulos();
		if(isset($_SESSION['usuario']) && 
			$usuario->getPerfil()=="Cliente"){
			$cliente = $usuario->getCliente();
			if($cliente->getPago($curso->getIdCurso())){
				?>
				<hr class="featurette-divider">
				<div class="progress">
					<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo ($cliente->getProgreso($curso->getIdCurso())*100);?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo ($cliente->getProgreso($curso->getIdCurso())*100);?>%</div>
				</div>
				<?php
				foreach($capitulos as $c){
				?>

					<li class="list-group-item d-flex justify-content-between align-items-start">
	   					<div class="ms-2 me-auto">
	      				<div class="fw-bold"><?php echo $c['capitulo'];?></div>
						<?php
						$lecciones = $curso->getLeccionesByCap($c['capitulo']);
						foreach($lecciones as $l){
							$visto = $l->habilitaLeccion($cliente->getIdCliente());
							if($visto == 0){
								if($l->leccionActual($cliente->getIdCliente())){
									$valorBtnLeccion = 'Ver lección';
									$disabled = 'boton-s';
								}else{
									$valorBtnLeccion = 'Ver lección';
									$disabled = 'boton-p disabled';
								}
								
							}else{
								$disabled = 'boton-p';
								$valorBtnLeccion = 'Ver de nuevo';
							}
						?>
							<ol class="list-group list-group-numbered">
								<li class="list-group-item"><?php echo $l->getTitulo(); ?></li>
								<form action="/Cursos/detalleLeccion" method="GET">
									<input type="hidden" class="form-control" name="idLeccion" id="idLeccion" value="<?php echo $l->getIdLeccion(); ?>" required>
									<input class="btn <?php echo $disabled;?>" type="submit" value="<?php echo $valorBtnLeccion;?>">
								</form>
						  	</ol>
						<?php
						}
					?>
						</div>
				    <!-- <span class="badge bg-primary rounded-pill">14</span> -->
				  </li>
				<?php
				}
			}else{
				foreach($capitulos as $c){
				?>
					<li class="list-group-item d-flex justify-content-between align-items-start">
	   					<div class="ms-2 me-auto">
	      				<div class="fw-bold"><?php echo $c['capitulo'];?></div>
						<?php
						$lecciones = $curso->getLeccionesByCap($c['capitulo']);
						foreach($lecciones as $l){
						?>
							<ol class="list-group list-group-numbered">
								<li class="list-group-item"><?php echo $l->getTitulo(); ?></li>
						  	</ol>
						<?php
						}
					?>
						</div>
				    <!-- <span class="badge bg-primary rounded-pill">14</span> -->
				  </li>
				<?php
				}
			}
			
		}else{
			foreach($capitulos as $c){
			?>
				<li class="list-group-item d-flex justify-content-between align-items-start">
   					<div class="ms-2 me-auto">
      				<div class="fw-bold"><?php echo $c['capitulo'];?></div>
					<?php
					$lecciones = $curso->getLeccionesByCap($c['capitulo']);
					foreach($lecciones as $l){
					?>
						<ol class="list-group list-group-numbered">
							<li class="list-group-item"><?php echo $l->getTitulo(); ?></li>
					  	</ol>
					<?php
					}
				?>
					</div>
			    <!-- <span class="badge bg-primary rounded-pill">14</span> -->
			  </li>
			<?php
			}
		}
		
		?>
		</ol>
	</div>
</div>
<?php
}else{
	header('location: /Cursos/catalogo');
}
?>
<?php require 'src/views/templates/footer.php'; ?>

