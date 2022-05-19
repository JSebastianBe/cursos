<?php require 'src/views/templates/header.php'; 
$leccion = $this->d['leccion'];
?>
<div class="container" id="contenedor">
	<div class="row">
		<?php require 'src/views/templates/notificaciones.php'; 
		if(isset($_SESSION['usuario']) && 
			$usuario->getPerfil()=="Cliente"){
			$cliente = $usuario->getCliente();
			if($cliente->getPago($leccion->getIdCurso())){
				if($leccion->leccionActual($leccion->getIdCurso(), $cliente->getIdCliente())){
					var_dump($leccion);
				}else{
					header('location: /Cursos/catalogo');
				}
			}else{
				header('location: /Cursos/catalogo');
			}
		}else{
			header('location: /Cursos/catalogo');
		}
		?>
		
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>