<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
	<?php require 'src/views/templates/notificaciones.php'; ?>
	<div class="row">
		<div class="col-12" id="contenido-ppal">
			<h1>Catalogo de cursos existentes</h1>
			<div id="catalogo" class="row">
				<?php
				$cursos = $this->d['cursos'];
				foreach($cursos as $c){
				?>
				<div class="card col-lg-3 col-md-6">
					<div class="card-header">
					    <h5 class="card-title"><?php echo $c->getNombre(); ?></h5>
					</div>
					<a href="#?<?php $c->getIdCurso(); ?>"><img src="/Cursos/public/img/photos/<?php echo $c->getImagen(); ?>" class="card-img-top" alt="Curso <?php echo $c->getNombre(); ?>"></a>
					<div class="card-body">
						<p class="card-text"><?php echo $c->getDescripcionCorta(); ?></p>
						<a href="#?<?php $c->getIdCurso(); ?>" class="btn boton-p">Ver más</a>
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