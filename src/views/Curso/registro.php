<?php require 'src/views/templates/header.php'; ?>
<div class="container" id="contenedor">
	<div class="row">
		<?php require 'src/views/templates/notificaciones.php'; 
		if($usuario->getPerfil()=="Cliente"){
			header('location: /Cursos/inicio');
		}
		?>
		<div class="col col-lg-12">
			<h1  class="text-center">Registro de cursos</h1>
			<form class="row g-3" action="/Cursos/creaCurso" method="POST" enctype="multipart/form-data">
				<div class="col-lg-4">
					<label for="validationCustomNombre" class="form-model"> Nombre</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupNombre"><i class="bi bi-card-text"></i></span>
						<input type="text" class="form-control" name="nombre" value="" required>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomPrecio" class="form-model"> Precio (cop)</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupPrecio"><i class="bi bi-currency-dollar"></i></span>
						<input type="number" class="form-control" name="precio" min="0" step="0.01" value="" required>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomProfesor" class="form-model"> Profesor</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupProfesor"><i class="bi bi-person-circle"></i></span>
						<input type="text" class="form-control" name="profesor" value="" required>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomDuracion" class="form-model"> Duración (horas)</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupDuracion"><i class="bi bi-alarm"></i></span>
						<input type="number" class="form-control" name="duracion" min="0" step="0.1" value="" required>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomImagen" class="form-model"> Imagen</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupImagen"><i class="bi bi-card-image"></i></span>
						<input type="file" class="form-control" name="imagen" value="" accept="image/png, .jpeg, .jpg" required>
					</div>
				</div>
				<div class="col-lg-4">
					<label for="validationCustomVideo" class="form-model"> Video introductorio</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupVideo"><i class="bi bi-camera-video"></i></span>
						<input type="file" class="form-control" name="videoIntroduc" value="" accept="video/mp4" required>
					</div>
				</div>
				<div class="col-lg-6">
					<label for="validationCustomDescripcionCorta" class="form-model"> Descripción Corta</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupDescripcionCorta"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="100" placeholder="Máximo 100 caracteres.." name="descripcionCorta" required></textarea>
					</div>
				</div>
				<div class="col-lg-6">
					<label for="validationCustomDescripcionLarga" class="form-model"> Descripción Larga</label>
					<div class="input-group has-validation">
						<span class="input-group-text" id="inputGroupDescripcionlarga"><i class="bi bi-card-text"></i></span>
						<textarea class="form-control" rows="5" maxlength="1000" placeholder="Máximo 1000 caracteres.." name="descripcionLarga" required></textarea>
					</div>
				</div>
				<div class="col-lg-12">
					<button type="button" class="btn boton-s" data-bs-toggle="modal" data-bs-target="#agregarLeccion" onclick=modalLeecion(-1)>
				 		<i class="bi bi-node-plus"></i> Agregar Lección
					</button>
				</div>
				<table class="table table-hover">
					<thead>   
						<tr>		
							<th scope="col"> idLeccion </th>		
							<th scope="col"> Titulo </th>		
							<th scope="col"> Acciones </th>	
						</tr> 
					</thead>
					<tbody id="lecciones">
					</tbody>
				 </table>
				 <input name="arr_lecciones" id="arr_lecciones" required>
				 <div class="col-lg-12">
					<input class="btn boton-p" type="submit" value="Crear Curso">
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="agregarLeccion" tabindex="-1" aria-labelledby="agregarLeccion" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
			    <div class="modal-content">
					<div class="modal-header" id="labelLeccion">
					</div>
					<div class="modal-body">
						<form class="row g-3" action="#" method="POST">
							<input type="hidden" class="form-control" name="idLeccion" id="idLeccion" value="" required>
							<div class="col-lg-12">
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
							<div class="col-lg-12">
								<label for="validationCustomVideo" class="form-model"> Video</label>
								<div class="input-group has-validation">
									<span class="input-group-text" id="inputGroupVideo"><i class="bi bi-camera-video"></i></span>
									<input type="file" class="form-control" name="video" id="video" value="" accept="video/mp4" required>
								</div>
							</div>
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
	var titulo = document.getElementById("titulo");
	var objetivo = document.getElementById("objetivo");
	var teoria = document.getElementById("teoria");
	var ejercicio = document.getElementById("ejercicio");
	var video = document.getElementById("video");

	if(titulo.value =="" || objetivo.value =="" || teoria.value =="" || ejercicio.value =="" || video.value ==""){
		window.alert('Diligencie todos los datos');
	}else{
		array_lecciones.push([titulo.value, objetivo.value, teoria.value, ejercicio.value, video.files[0]]);
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
	   	insertarDetalle += '<th scope="col"><a class="btn boton-p" data-bs-toggle="modal" data-bs-target="#agregarLeccion" onclick=modalLeecion('+i+') href="#"><i class="bi bi-pencil"></i></a><a class="btn boton-s" onclick=borrarLeccion('+i+') href="#"><i class="bi bi-trash3"></i></a></th></tr>';
	} 

	tabla.innerHTML += insertarDetalle;
	document.getElementById("arr_lecciones").value = JSON.stringify(array_lecciones);
}

function limpiarCampos(){
	document.getElementById("titulo").value = '';
	document.getElementById("objetivo").value = '';
	document.getElementById("teoria").value = '';
	document.getElementById("ejercicio").value = '';
	document.getElementById("video").value = '';
}

function borrarLeccion(id){
	array_lecciones.splice(id,1);
	mostrarLeeciones()
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
	
	labelLeccion.innerHTML = '<h5 class="modal-title" >'+accionText+'</h5>						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
	footerLeccion.innerHTML = '<button type="button" class="btn boton-s" data-bs-dismiss="modal">Cerrar</button>						<button type="button" class="btn boton-p" '+accion+'>'+accionText+'</button>';
}

function rellenaCamposLeccion(id){
	if(id>=0){
		document.getElementById("idLeccion").value = id;
		document.getElementById("titulo").value = array_lecciones[id][0];
		document.getElementById("objetivo").value = array_lecciones[id][1];
		document.getElementById("teoria").value = array_lecciones[id][2];
		document.getElementById("ejercicio").value = array_lecciones[id][3];
		rellenaVideo(id);
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
	var idLeccion = document.getElementById("idLeccion");
	var titulo = document.getElementById("titulo");
	var objetivo = document.getElementById("objetivo");
	var teoria = document.getElementById("teoria");
	var ejercicio = document.getElementById("ejercicio");
	var video = document.getElementById("video");

	if(idLeccion.value =="" || titulo.value =="" || objetivo.value =="" || teoria.value =="" || ejercicio.value =="" || video.value ==""){
		window.alert('Diligencie todos los datos');
	}else{
		if(idLeccion.value >= 0){
			array_lecciones[idLeccion.value][0] = titulo.value;
			array_lecciones[idLeccion.value][1] = objetivo.value;
			array_lecciones[idLeccion.value][2] = teoria.value;
			array_lecciones[idLeccion.value][3] = ejercicio.value;
			array_lecciones[idLeccion.value][4] = video.value;
		}
	}
	mostrarLeeciones();
}
</script>
