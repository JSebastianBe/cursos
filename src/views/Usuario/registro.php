<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
	<h1  class="text-center">Registro de usuarios</h1>
	<div class="row">
		<div class="col col-lg-4 offset-lg-4">
			<?php require 'src/views/templates/notificaciones.php'; ?>
			<?php 
			$nombre ="";
			$perfil ="";
			$telefono ="";
			$correo ="";
			$nombreBoton = "Registrarse";

			if($usuario != []){
				if($usuario->getPerfil()=="Administrador"){ 
					if(isset($this->d['usuarioModificar'])){
						$usuarioModificar = $this->d['usuarioModificar'];
						$nombre = $usuarioModificar->getNombre();
						$telefono = $usuarioModificar->getTelefono();
						$perfil = $usuarioModificar->getPerfil();
						$correo = $usuarioModificar->getCorreo();
						$nombreBoton = "Actualizar";
						?><form class="row g-3" action="/Cursos/modificarUsuario" method="POST">
							<input type="hidden" class="form-control" name="idUsuario" value="<?php echo $usuarioModificar->getidUsuario()?>" required><?php
					}else{
						$nombreBoton = "Registrar";?>
					<form class="row g-3" action="/Cursos/registrarUsuario" method="POST">
					<?php
					}?>
					<div class="col-lg-12">
						<label for="validationCustomPerfil" class="form-model"> Perfil</label>
						<div class="input-group has-validation">
							<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-list-ol"></i></span>
							<select name="perfil" class="form-select" aria-label="Perfil" required>
							  <option selected>-- Selecione el perfil --</option>
							  <option value="Cliente" <?php if($perfil=="Cliente"){ echo "selected";} ?>>Cliente</option>
							  <option value="Asistente" <?php if($perfil=="Asistente"){ echo "selected";} ?>>Asistente</option>
							  <option value="Administrador" <?php if($perfil=="Administrador"){ echo "selected";} ?>>Administrador</option>
							</select>
						</div>
					</div>
			<?php 
				}else{
					header('location: /Cursos/inicio');
				}
			}else{
				?>
				<form class="row g-3" action="/Cursos/registrarse" method="POST">
				<?php
			}?>
				<div class="col-lg-12">
					<label for="validationCustomNombre" class="form-model"> Nombre</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-card-text"></i></span>
						<input type="text" class="form-control" name="nombre" value="<?php echo $nombre;?>" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomTelefono" class="form-model"> Teléfono</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupTelefono"><i class="bi bi-phone"></i></span>
						<input type="number" class="form-control" name="telefono" value="<?php echo $telefono;?>" required>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomCorreo" class="form-model"> Correo</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupCorreo"><i class="bi bi-mailbox"></i></span>
						<input type="email" class="form-control" name="correo" value="<?php echo $correo;?>" required>
					</div>
				</div>
				<div class="col-lg-12">
					<input class="btn boton-p" type="submit" value="<?php echo $nombreBoton;?>">
				</div>
			</form>
		</div>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>
