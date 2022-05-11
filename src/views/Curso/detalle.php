<?php require 'src/views/templates/header.php'; ?>
<?php 
if(isset($this->d['curso'])){
	$curso = $this->d['curso'];

?>
<div class="container col-xxl-8 px-4 py-5">
	<div class="row flex-lg-row-reverse align-items-center g-5 py-5">
	  <div class="col-10 col-sm-8 col-lg-6">
	    <img src="/Cursos/public/img/photos/<?php echo $curso->getImagen(); ?>" class="d-block mx-lg-auto img-fluid" alt="Curso <?php echo $curso->getNombre(); ?>" width="700" height="500" loading="lazy">
	  </div>
	  <div class="col-lg-6">
	    <h1 class="display-5 fw-bold lh-1 mb-3"><?php echo $curso->getNombre(); ?></h1>
	    <p class="lead"><?php echo $curso->getObjetivo(); ?></p>
	    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
	      <button type="button" class="btn boton-p btn-lg px-4 me-md-2">Inscribirse</button>
	      <button type="button" class="btn btn-outline-secondary btn-lg px-4">Ver más</button>
	    </div>
	  </div>
	</div>
	<hr class="featurette-divider">
	<div class="row featurette">
	  <div class="col-md-7 order-md-2">
	    <h2 class="featurette-heading"><?php echo $curso->getNombre(); ?> <span class="text-muted"><?php echo $curso->getDuracion(); ?>(horas)</span></h2>
	    <p class="lead"><?php echo $curso->getDescripcion(); ?></p>
	  </div>
	  <div class="col-md-5 order-md-1">
	  	<video class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" src="/Cursos/public/img/videos/<?php echo $curso->getVideoIntroduc(); ?>" width="500" height="500" controls></video>
	  	<h3><span class="text-muted">Video introductorio</span></h3>
	  </div>
	</div>
	<hr class="featurette-divider">
	<h2 class="pb-2 border-bottom">Detalles</h2>
	<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
	  <div class="col d-flex align-items-start">
	    <div class="fs-4 mb-3">
		    <div>
		      <h4 class="fw-bold mb-0">Precio</h4>
		      <p><i class="bi bi-currency-dollar"></i> <?php echo $curso->getPrecio(); ?> </p>
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
	      		<h4 class="fw-bold mb-0">Cantidad de Capítulos</h4>
	      		<p><i class="bi bi-book"></i> <?php echo $curso->getCantidadCapitulos(); ?></p>
	      	</div>
	    </div>
	  </div>
	  <div class="col d-flex align-items-start">
	    <div class="fs-4 mb-3">
		    <div>
	      		<h4 class="fw-bold mb-0">Duración</h4>
	     		<p><i class="bi bi-alarm"></i> <?php echo $curso->getDuracion(); ?>(horas)</p>
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
		  <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
		    <i class="fs-4 mb-3 bi bi-book"></i>
		    <div class="d-flex gap-2 w-100 justify-content-between">
		      <div>
		        <h6 class="mb-0"><?php echo $l->getTitulo(); ?></h6>
		        <p class="mb-0 opacity-75 text_recor"><?php echo $l->getObjetivo(); ?></p>
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
<?php
}else{
	header('location: /Cursos/catalogo');
}
?>
<?php require 'src/views/templates/footer.php'; ?>

