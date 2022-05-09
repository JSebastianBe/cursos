<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
<a class="btn boton-s" href="/Cursos/registro" role="button"><i class="bi bi-person-plus"></i></a>
<?php require 'src/views/templates/notificaciones.php'; ?>
<div class="row">
	
</div>
	<div class="table-responsive">
		<table class="table table-hover">
		<thead>
		    <tr>
		      <th scope="col">Nombre</th>
		      <th scope="col">Telefono</th>
		      <th scope="col">Correo</th>
		      <th scope="col" >Usuario</th>
		      <th scope="col">Perfil</th>
		      <th scope="col">Actualizar</th>
		    </tr>
		  </thead>
		<tbody>
		<?php 
		$usuarios = $this->d['usuarios'];
		foreach($usuarios as $u){
			?>
				<tr>
			      <th><?php echo $u->getNombre(); ?></th>
			      <th><?php echo $u->getTelefono(); ?></th>
			      <th><?php echo $u->getCorreo(); ?></th>
			      <th ><?php echo $u->getUsuario(); ?></th>
			      <th><?php echo $u->getPerfil(); ?></th>
			      <th scope="col"><a class="btn boton-p" href="modificaUsuario?id=<?php echo $u->getIdUsuario(); ?>"><i class="bi bi-arrow-clockwise"></i></a></th>
			    </tr>
			<?php
		}
		?>
		 </tbody>
	 </table>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>

