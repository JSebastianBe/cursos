<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
<a class="btn btn-primary" href="/Cursos/registro" role="button"><i class="bi bi-person-plus"></i></a>
<table class="table table-striped">
	<thead>
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Nombre</th>
	      <th scope="col">Telefono</th>
	      <th scope="col">Correo</th>
	      <th scope="col">Usuario</th>
	      <th scope="col">Actualizar</th>
	    </tr>
	  </thead>
	<tbody>
	<?php 
	$usuarios = $this->d['usuarios'];
	foreach($usuarios as $u){
		?>
			<tr>
		      <th scope="row">c</th>
		      <th><?php echo $u->getNombre(); ?></th>
		      <th><?php echo $u->getTelefono(); ?></th>
		      <th><?php echo $u->getCorreo(); ?></th>
		      <th><?php echo $u->getUsuario(); ?></th>
		      <th scope="col"><a class="btn boton-p" href="#<?php echo $u->getIdUsuario(); ?>"><i class="bi bi-arrow-clockwise"></i></a></th>
		    </tr>
		<?php
	}
	?>
	 </tbody>
 </table>
</div>
<?php require 'src/views/templates/footer.php'; ?>

