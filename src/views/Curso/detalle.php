<?php require 'src/views/templates/header.php'; ?>
<?php 
if(isset($this->d['curso'])){
	$curso = $this->d['curso'];

?>
<div class="container" id="contenido-ppal">
	<h1 class="display-5 fw-bold lh-1 mb-3"><?php echo $curso->getNombre(); ?> <!-- <span class="text-muted"><?php echo $curso->getDuracion(); ?>(horas)</span> --></h1>
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
							<a href="#" class="btn boton-p btn-lg px-4 me-md-2 disabled" aria-current="true" >Registrarse</a>
							<?php
						}else{
							if($usuario->getPerfil()=="Cliente"){
								if($usuario->getInscrito($curso->getIdCurso())){
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
						}
						?>
						<!-- <button type="button" class="btn btn-outline-secondary btn-lg px-4">Ver más</button> -->
					</div>
				</div>
			</div>
		</div>
	<hr class="featurette-divider">
	<?php
	$capitulos = $curso->getCapitulos();
	foreach($capitulos as $c){
	?>
	<h2 class="pb-2 border-bottom"><?php echo $c['capitulo'];?></h2>
		<div class="list-group">
		<?php
		$lecciones = $curso->getLeccionesByCap($c['capitulo']);
		foreach($lecciones as $l){
		?>
		  <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true" >
		    <i class="fs-4 mb-3 bi bi-book"></i>
		    <div class="d-flex gap-2 w-100 justify-content-between">
		      <div>
		        <h6 class="mb-0"><?php echo $l->getTitulo(); ?></h6>
		        <!-- <p class="mb-0 opacity-75 text_recor"><?php echo $l->getObjetivo(); ?></p> -->
		      </div>
		      <small class="opacity-50 text-nowrap"><?php echo $l->getOrden(); ?></small>
		    </div>
		  </a>
		<?php
		}
		?>
		</div>
	<?php
	}
	?>
	</div>
</div>
<?php
}else{
	header('location: /Cursos/catalogo');
}
?>
<?php require 'src/views/templates/footer.php'; ?>

