<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
	<div class="row">
		<?php require 'src/views/templates/notificaciones.php'; 
		if($usuario->getPerfil()=="Cliente"){
			header('location: /Cursos/inicio');
		}
		$idCurso = "";
		$nombre = "";
		$precio = "";
		$objetivo = "";
		$descripcion = "";
		$duracion = "";
		$perfil = "";
		$profesor = "";
		$imagen = "";
		$videoIntroduc = "";
		$lecciones = "";
		$nombreBoton = "Crear";
		?>
		<div class="col col-lg-12">
			<?php
			if(isset($this->d['cursoModificar'])){
				$nombreBoton = "Modificar";
				$cursoModificar = $this->d['cursoModificar'];

				$idCurso = $cursoModificar->getIdCurso();
				$nombre = $cursoModificar->getNombre();
				$precio = $cursoModificar->getPrecio();
				$objetivo = $cursoModificar->getObjetivo();
				$descripcion = $cursoModificar->getDescripcion();
				$perfil = $cursoModificar->getPerfil();
				$duracion = $cursoModificar->getDuracion();
				$profesor = $cursoModificar->getProfesor();
				$imagen = $cursoModificar->getImagen();
				$videoIntroduc = $cursoModificar->getVideoIntroduc();
				$lecciones = $cursoModificar->getLecciones();
				?>
				<h1  class="text-center">Actualización de curso <?php echo $nombre;?></h1>
				<form class="row g-3" action="/Cursos/modificarCurso" method="POST" enctype="multipart/form-data">
					<input type="hidden" class="form-control" name="idCurso" id="idCurso" value="<?php echo $idCurso; ?>" required>
				<?php
			}else{
				?>
				<h1  class="text-center">Registro de cursos</h1>
				<form class="row g-3" action="/Cursos/creaCurso" method="POST" enctype="multipart/form-data">
				<?php
			}
			?>
				<div class="col-lg-4">
					<label for="validationCustomNombre" class="form-model"> Nombre</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-card-text"></i></span>
						<input type="text" class="form-control" name="nombre" value="<?php echo $nombre; ?>" required>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomPrecio" class="form-model"> Precio (cop)</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupPrecio"><i class="bi bi-currency-dollar"></i></span>
						<input type="number" class="form-control" name="precio" min="0" step="0.01" value="<?php echo $precio; ?>" required>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomProfesor" class="form-model"> Profesor</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupProfesor"><i class="bi bi-person-circle"></i></span>
						<input type="text" class="form-control" name="profesor" value="<?php echo $profesor; ?>" required>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomDuracion" class="form-model"> Duración (horas)</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupDuracion"><i class="bi bi-alarm"></i></span>
						<input type="number" class="form-control" name="duracion" min="0" step="0.1" value="<?php echo $duracion; ?>" required>
					</div>
				</div>
				<div class="col-lg-4">
					<?php
					if($imagen != ""){
					?>
					<img src="/Cursos/public/img/photos/<?php echo $imagen; ?>" class="card-img-top" alt="Curso <?php echo $imagen; ?>">
					<?php
					}
					?>
					<label for="validationCustomImagen" class="form-model"> Imagen</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupImagen"><i class="bi bi-card-image"></i></span>
						<input type="file" class="form-control" name="imagen" value="" width="300" accept="image/png, .jpeg, .jpg">
					</div>
				</div>
				<div class="col-lg-4">
					<?php
					if($videoIntroduc != ""){
					?>
					<video class="form-model" src="/Cursos/public/img/videos/<?php echo $videoIntroduc; ?>" width="300" height="200" controls></video>
					<?php
					}
					?>
					<label for="validationCustomVideo" class="form-model"> Video introductorio</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupVideo"><i class="bi bi-camera-video"></i></span>
						<input type="file" class="form-control" name="videoIntroduc" value="" accept="video/mp4">
					</div>
				</div>
				<div class="col-lg-6">
					<label for="validationCustomObjetivo" class="form-model"> Objetivo</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupObjetivo"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="objetivo" required><?php echo $objetivo; ?></textarea>
					</div>
				</div>
				<div class="col-lg-6">
					<label for="validationCustomPerfil" class="form-model"> Perfil profesional</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupPerfil"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="100" placeholder="Máximo 100 caracteres.." name="perfil" required><?php echo $perfil; ?></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<label for="validationCustomDescripcion" class="form-model"> Descripción</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupDescripcion"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="descripcion" required><?php echo $descripcion; ?></textarea>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomCantCap" class="form-model"> Cantidad de capítulos:</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupCantCap"><i class="bi bi-list-ol"></i></span>
						<input type="number" class="form-control" id="cantidadCap" name="cantidadCap" min="0" step="1" value="" onchange="alistaCapitulos()" required>
					</div>
				</div>
				<div class="col-lg-12">
					<button type="button" class="btn boton-s" data-bs-toggle="modal" data-bs-target="#agregarLeccion" onclick=modalLeecion(-1)>
				 		<i class="bi bi-node-plus"></i> Agregar Lección a un capitulo
					</button>
				</div>
				<table class="table table-hover">
					<thead>   
						<tr>		
							<th scope="col"> Orden </th>
							<th scope="col"> Capitulo </th>	
							<th scope="col"> Lección </th>	
							<th scope="col"> Acciones </th>
						</tr> 
					</thead>
					<tbody id="lecciones">
					</tbody>
				 </table>
				 <input name="arr_lecciones" id="arr_lecciones" type="hidden" required>
				 <div class="col-lg-12">
					<input class="btn boton-p" type="submit" value="<?php echo $nombreBoton;?> Curso">
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="agregarLeccion" tabindex="-1" aria-labelledby="agregarLeccion" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
	    <div class="modal-content">
			<div class="modal-header" id="labelLeccion">
			</div>
			<div class="modal-body">
				<form class="row g-3" action="#" method="POST">
					<input type="hidden" class="form-control" name="idLeccion" id="idLeccion" value="" required>
					<div class="col-lg-6">
						<label for="validationCustomCapitulo" class="form-model"> Capitulo</label>
						<div class="input-group has-validation">
							<span class="input-group-text" id="inputGroupCapitulo"><i class="bi bi-list-ol"></i></span>
							<select name="capitulo" id="capitulo" class="form-select" aria-label="Capitulo" required>

							</select>
						</div>
					</div>
					<div class="col-lg-6">
						<label for="validationCustomTitulo" class="form-model"> Titulo</label>
						<div class="input-group has-validation">
							<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-card-text"></i></span>
							<input type="text" class="form-control" name="titulo" id="titulo" value="" required>
						</div>
					</div>
					<div class="col-lg-12">
						<label for="validationCustomObjetivo" class="form-model"> Objetivo</label>
						<div class="input-group has-validation">
							<span class="input-group-text" id="inputGroupObjetivo"><i class="bi bi-card-text"></i></span>
							<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="objetivo" id="objetivo" required></textarea>
						</div>
					</div>
					<div class="col-lg-12">
						<label for="validationCustomTeoria" class="form-model"> Teoría</label>
						<div class="input-group has-validation">
							<span class="input-group-text" id="inputGroupTeoria"><i class="bi bi-card-text"></i></span>
							<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="teoria" id="teoria" required></textarea>
						</div>
					</div>
					<div class="col-lg-12">
						<label for="validationCustomEjercicio" class="form-model"> Ejercicio</label>
						<div class="input-group has-validation">
							<span class="input-group-text" id="inputGroupEjercicio"><i class="bi bi-card-text"></i></span>
							<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="ejercicio"  id="ejercicio" required></textarea>
						</div>
					</div>
					<!-- <div class="col-lg-12">
						<label for="validationCustomVideo" class="form-model"> Video</label>
						<div class="input-group has-validation">
							<span class="input-group-text" id="inputGroupVideo"><i class="bi bi-camera-video"></i></span>
							<input type="file" class="form-control" name="video" id="video" value="" accept="video/mp4" required>
						</div>
					</div> -->
				</form>
			</div>
			<div class="modal-footer" id="footerLeccion">
			</div>
	    </div>
	</div>
</div>
<?php require 'src/views/templates/footer.php'; ?>
<script type="text/javascript">
	var array_lecciones =[];
	var tabla = document.getElementById("lecciones");
	function addLeccion(){
		var capitulo = document.getElementById("capitulo");
		var titulo = document.getElementById("titulo");
		var objetivo = document.getElementById("objetivo");
		var teoria = document.getElementById("teoria");
		var ejercicio = document.getElementById("ejercicio");
		// var video = document.getElementById("video");

		if((capitulo.value == "" || capitulo.value == '-- Selecione el Capitulo --') || titulo.value =="" || objetivo.value =="" || teoria.value =="" || ejercicio.value ==""){
			window.alert('Diligencie todos los datos');
		}else{
			array_lecciones.push([capitulo.value, titulo.value, objetivo.value, teoria.value, ejercicio.value]);
		}
		mostrarLeeciones();
		limpiarCampos()
	}

	function mostrarLeeciones(){
		insertarDetalle = '';
		tabla.innerHTML = insertarDetalle;
		for (i=0;i<array_lecciones.length;i++){ 
		   	insertarDetalle += '<tr> <th>'+(i+1)+'</th>';
		   	insertarDetalle += '<th>'+array_lecciones[i][0]+'</th>';
		   	insertarDetalle += '<th>'+array_lecciones[i][1]+'</th>';
		   	insertarDetalle += '<th scope="col"><a class="btn boton-p" data-bs-toggle="modal" data-bs-target="#agregarLeccion" onclick=modalLeecion('+i+') href="#"><i class="bi bi-pencil"></i></a><a class="btn boton-s" onclick=borrarLeccion('+i+') href="#"><i class="bi bi-trash3"></i></a></th></tr>';
		} 

		tabla.innerHTML += insertarDetalle;
		document.getElementById("arr_lecciones").value = JSON.stringify(array_lecciones);
	}

	function limpiarCampos(){
		document.getElementById("capitulo").value ="";
		document.getElementById("titulo").value = '';
		document.getElementById("objetivo").value = '';
		document.getElementById("teoria").value = '';
		document.getElementById("ejercicio").value = '';
		// document.getElementById("video").value = '';
	}

	function borrarLeccion(id){
		array_lecciones.splice(id,1);
		mostrarLeeciones();
	}

	function modalLeecion(id){
		labelLeccion = document.getElementById("labelLeccion");
		footerLeccion = document.getElementById("footerLeccion");
		if(id==-1){
			accionText = 'Agregar Lección';
			accion = 'onclick="addLeccion()"';
		}else{
			accionText = 'Modificar Lección #'+(1+id);
			accion = 'onclick="modifLeccion()"';
			rellenaCamposLeccion(id);
		}
		
		labelLeccion.innerHTML = '<h5 class="modal-title" >'+accionText+'</h5>						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"onclick="limpiarCampos()"></button>';
		footerLeccion.innerHTML = '<button type="button" class="btn boton-s" data-bs-dismiss="modal">Cerrar</button>						<button type="button" class="btn boton-p" '+accion+'>'+accionText+'</button>';
	}

	function rellenaCamposLeccion(id){
		if(id>=0){
			document.getElementById("idLeccion").value = id;
			document.getElementById("capitulo").value = array_lecciones[id][0];
			document.getElementById("titulo").value = array_lecciones[id][1];
			document.getElementById("objetivo").value = array_lecciones[id][2];
			document.getElementById("teoria").value = array_lecciones[id][3];
			document.getElementById("ejercicio").value = array_lecciones[id][4];
			// rellenaVideo(id);
		}
	}

	function rellenaVideo(id){
		var fReader = new FileReader();
		fReader.readAsDataURL(array_lecciones[id][4]);
		fReader.onloadend = function(event){
		    var video = document.getElementById("video");
		    video.src = event.target.result;
		}
	}

	function modifLeccion(){
		var capitulo = document.getElementById("capitulo");
		var idLeccion = document.getElementById("idLeccion");
		var titulo = document.getElementById("titulo");
		var objetivo = document.getElementById("objetivo");
		var teoria = document.getElementById("teoria");
		var ejercicio = document.getElementById("ejercicio");
		// var video = document.getElementById("video");

		if((capitulo.value == "" || capitulo.value == '-- Selecione el Capitulo --') || idLeccion.value =="" || titulo.value =="" || objetivo.value =="" || teoria.value =="" || ejercicio.value ==""){
			window.alert('Diligencie todos los datos');
		}else{
			if(idLeccion.value >= 0){
				array_lecciones[idLeccion.value][0] = capitulo.value;
				array_lecciones[idLeccion.value][1] = titulo.value;
				array_lecciones[idLeccion.value][2] = objetivo.value;
				array_lecciones[idLeccion.value][3] = teoria.value;
				array_lecciones[idLeccion.value][4] = ejercicio.value;
				// array_lecciones[idLeccion.value][4] = video.value;
			}
		}
		mostrarLeeciones();
	}

	function alistaCapitulos(){
		var cantidadCap = document.getElementById("cantidadCap").value;
		var capitulo  = document.getElementById("capitulo");
		var opcion = '<option selected>-- Selecione el Capitulo --</option>';
		for (var i=1; i<=cantidadCap; i++){
			opcion += '<option value="Capitulo '+i+'">Capitulo '+i+'</option>';
		}
		capitulo.innerHTML =opcion;
	}


	window.onload=function() {
		var capitulo ="";
		var titulo ="";
		var objetivo ="";
		var teoria ="";
		var ejercicio ="";
		var idLeccion = "";

		<?php 
		if($lecciones == ""){

		}else{

			foreach($lecciones as $l){ ?>
				capitulo = '<?php echo $l->getCapitulo(); ?>';
				titulo = '<?php echo $l->getTitulo(); ?>';
				objetivo = '<?php echo $l->getObjetivo(); ?>';
				teoria = '<?php echo $l->getTeoria(); ?>';
				ejercicio = '<?php echo $l->getEjercicio(); ?>';
				idLeccion = '<?php echo $l->getidLeccion(); ?>';
				// var video = document.getElementById("video");
				array_lecciones.push([capitulo, titulo, objetivo, teoria, ejercicio,idLeccion]);
			<?php
			}
		}
		?>
		mostrarLeeciones();
		limpiarCampos()
	}

</script>
