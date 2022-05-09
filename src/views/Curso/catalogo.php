<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
	<?php require 'src/views/templates/notificaciones.php'; ?>
	<div class="row">
		<div class="col-12" id="contenido-ppal">
			<section class="py-5 text-center container">
				<div class="row py-lg-5">
					<div class="col-lg-6 col-md-8 mx-auto">
						<h1 class="fw-light">
							<font style="vertical-align: inherit;">
								<font style="vertical-align: inherit;">
									Catalogo de cursos
								</font>
							</font>
						</h1>
						<p class="lead text-muted">
							<font style="vertical-align: inherit;">
								<font style="vertical-align: inherit;">
									A continuación encontrarás la oferta de los cursos disponibles
								</font>
								<font style="vertical-align: inherit;">
									Selecciona el curso de tu preferencia, entérate de los detalles e inscríbete.
								</font>
							</font>
						</p>
						<p></p>
					</div>
				</div>
			</section> 
			<hr class="featurette-divider">
			<div id="catalogo" class="row album">
				<?php
				$cursos = $this->d['cursos'];
				foreach($cursos as $c){
				?>
				<div class="col col-lg-3 col-md-6">
					<div class="card">
						<div class="card-header">
						    <h5 class="card-title"><?php echo $c->getNombre(); ?></h5>
						</div>
						<a href="detalleCurso?id=<?php echo $c->getIdCurso(); ?>"><img src="/Cursos/public/img/photos/<?php echo $c->getImagen(); ?>" class="card-img-top" alt="Curso <?php echo $c->getNombre(); ?>"></a>
						<div class="card-body">
							<p class="card-text"><?php echo $c->getDescripcionCorta(); ?></p>
							<a href="detalleCurso?id=<?php echo $c->getIdCurso(); ?>" class="btn boton-p">Ver más</a>
							<small class="text-muted">
								<font style="vertical-align: inherit;">
									<font style="vertical-align: inherit;"><?php echo $c->getDuracion(); ?>(horas)</font>
								</font>
							</small>
						</div>
					</div>	
				</div>
				<?php
				}
				?>
			</div>
			<nav aria-label="Page navigation example">
				<ul class="pagination justify-content-center">
					<li class="page-item disabled">
						<a class="page-link boton-p">Previous</a>
					</li>
					<li class="page-item "><a class="page-link boton-p" href="#">1</a></li>
					<li class="page-item"><a class="page-link boton-p" href="#">2</a></li>
					<li class="page-item"><a class="page-link boton-p" href="#">3</a></li>
					<li class="page-item">
						<a class="page-link boton-p" href="#">Next</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>