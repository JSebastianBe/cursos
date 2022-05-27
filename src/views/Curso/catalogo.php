<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
	<?php require 'src/views/templates/notificaciones.php'; ?>
	<div class="row">
		<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
			    <div class="carousel-indicators">
			      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
			      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
			      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class="active" aria-current="true"></button>
			    </div>
			    <div class="carousel-inner">
			      <div class="carousel-item active">
			        <img src="src/views/src/images/libro.jpg" width="100%" height="600px">

			        <div class="container">
			          <div class="carousel-caption">
			          	<a class="navbar-brand" href="#">
							<img src="src/views/src/images/logo-central.png" alt="">
						</a>
			            <h1>Cursos Universidad central</h1>
			            <p>A continuación encontrarás la oferta de los cursos disponibles</p>
			            <p><a class="btn btn-lg btn-primary" href="#catalogo">¡Quiero verlos!</a></p>
			          </div>
			        </div>
			      </div>
			      <div class="carousel-item">
			        <img src="src/views/src/images/LAPIZ.jpg" width="100%" height="600px">
			        <div class="container">
			          <div class="carousel-caption">
			          	<a class="navbar-brand" href="#">
							<img src="src/views/src/images/logo-central.png" alt="">
						</a>
			            <h1>Catalogo de cursos</h1>
			            <p>A continuación encontrarás la oferta de los cursos disponibles</p>
			            <p><a class="btn btn-lg btn-primary" href="#catalogo">¡Quiero verlos!</a></p>
			          </div>
			        </div>
			      </div>
			      <div class="carousel-item">
			        <img src="src/views/src/images/tablero.jpg" width="100%" height="600px">
			        <div class="container">
			          <div class="carousel-caption">
			          	<a class="navbar-brand" href="#">
							<img src="src/views/src/images/logo-central.png" alt="">
						</a>
			            <h1>Catalogo de cursos</h1>
			            <p>A continuación encontrarás la oferta de los cursos disponibles</p>
			            <p><a class="btn btn-lg btn-primary" href="#catalogo">¡Quiero verlos!</a></p>
			          </div>
			        </div>
			      </div>
			    </div>
			    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
			      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			      <span class="visually-hidden">Previous</span>
			    </button>
			    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
			      <span class="carousel-control-next-icon" aria-hidden="true"></span>
			      <span class="visually-hidden">Next</span>
			    </button>
			</div>
		<div class="col-12" id="contenido-ppal">
			<hr class="featurette-divider">
			<div id="catalogo" class="row album">
				<?php
				$cursos = $this->d['cursos'];
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
							<a href="detalleCurso?id=<?php echo $c->getIdCurso(); ?>" class="btn boton-p">Ver más</a>
							<font style="vertical-align: inherit;">
								<font style="vertical-align: inherit;">$ <?php echo $c->getPrecio(); ?></font>
							</font>
						</div>
					</div>	
				</div>
				<?php
				}
				?>
			</div>
			<!-- <nav aria-label="Page navigation example">
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
			</nav> -->
		</div>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>