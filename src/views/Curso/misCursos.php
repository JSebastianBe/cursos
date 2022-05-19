<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
	<?php require 'src/views/templates/notificaciones.php'; ?>
	<div class="row">
		<div class="col-12" id="contenido-ppal">
			<hr class="featurette-divider">
			<div id="catalogo" class="row album">
				<?php
				$cursos = $this->d['cursos'];
				$cliente = $this->d['cliente'];
				foreach($cursos as $c){
				?>
				<div class="col col-lg-3 col-md-6">

					<div class="card">
						<div class="card-header">
						    <h5 class="card-title"><?php echo $c->getNombre(); ?>
						    	<small>
								<font style="vertical-align: inherit; color: #1a171b;">
									<font style="vertical-align: inherit;"><?php echo $c->getDuracion(); ?>(horas)</font>
								</font>
							</small>
						    </h5>
						</div>
						<a href="detalleCurso?id=<?php echo $c->getIdCurso(); ?>"><img src="/Cursos/public/img/photos/<?php echo $c->getImagen(); ?>" class="card-img-top" alt="Curso <?php echo $c->getNombre(); ?>"></a>
						<div class="card-body">
							<p class="card-text opacity-75"><?php echo $c->getPerfil(); ?></p>
							<hr class="featurette-divider">
							<p class="card-text mb-0"><?php echo substr($c->getDescripcion(), 0, 150); ?></p>
							<a href="detalleCurso?id=<?php echo $c->getIdCurso(); ?>" class="btn boton-p">Acceder al curso</a>
							<hr class="featurette-divider">
							<div class="progress">
								<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?php echo ($cliente->getProgreso($c->getIdCurso())*100);?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo ($cliente->getProgreso($c->getIdCurso())*100);?>%</div>
							</div>
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