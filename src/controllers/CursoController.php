<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;
use Sebas\Cursos\models\Curso;
use Sebas\Cursos\models\Leccion;
use Sebas\Cursos\lib\UtilResources;

class CursoController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function catalogo(){
		$cursos = Curso::retornaCursos();
		$data = array_merge(['cursos' => $cursos]);
		$this->render('Curso/catalogo',$data);

	}

	public function agregarCruso(){
		$this->render('curso/registro');
	}


	public function modificaCurso(){
		$id = $this->get('id');
		$curso = Curso::getByIdCurso($id);
		$this->render('curso/registro',['cursoModificar'=>$curso]);
	}

	public function detalleCurso(){
		$id = $this->get('id');
		$curso = Curso::getByIdCurso($id);
		$this->render('curso/detalle',['curso'=>$curso]);
	}


	public function listar(array $notificacion = []){
		$perfil = unserialize($_SESSION['usuario'])->getPerfil();
		if($perfil == 'Administrador' || $perfil == 'Asistente'){
			$cursos = Curso::retornaCursos();
			$data = array_merge(['cursos' => $cursos], $notificacion);
			$this->render('Curso/listar',$data);
		}else{
			error_log('No tiene permisos');
			$notificacion = [
			    "mensaje" => "No tiene permisos para entrar a ese módulo",
			    "error" => TRUE,
			];
			$this->render('Home/index',['notificacion' => $notificacion]);
		}
		
	}

	public function creaCurso(){
		$nombre = $this->post('nombre');
		$precio = $this->post('precio');
		$objetivo = $this->post('objetivo');
		$descripcion = $this->post('descripcion');
		$perfil = $this->post('perfil');
		$duracion = $this->post('duracion');
		$profesor = $this->post('profesor');
		$imagen = $this->file('imagen');
		$videoIntroduc = $this->file('videoIntroduc');
		//$lecciones=json_decode($_POST["arr_lecciones"], true );
		if(	!is_null($nombre) &&
			!is_null($precio) &&
			!is_null($objetivo) &&
			!is_null($descripcion) &&
			!is_null($duracion) &&
			!is_null($perfil) &&
			!is_null($profesor) &&
			!is_null($imagen) &&
			!is_null($videoIntroduc)){
			$imagen = UtilResources::storeImage($imagen);
			$videoIntroduc = UtilResources::storeVideo($videoIntroduc);
			$curso = new Curso();
			$curso->setNombre($nombre);
			$curso->setPrecio($precio);
			$curso->setObjetivo($objetivo);
			$curso->setDescripcion($descripcion);
			$curso->setPerfil($perfil);
			$curso->setDuracion($duracion);
			$curso->setProfesor($profesor);
			$curso->setImagen($imagen);
			$curso->setVideoIntroduc($videoIntroduc);
			if($curso->crea()){
				$curso->setIdCurso(Curso::get($nombre)->getIdCurso());
				//$this->agregaLecciones($lecciones,$curso,"Crea");
				$notificacion = [
				    "mensaje" => "Curso ". $nombre." registrado correctamente",
				    "error" => FALSE,
				];
				$this->listar(['notificacion' => $notificacion]);
			}else{
				$notificacion = [
			    "mensaje" => "Ocurrió un error al registrar el curso",
			    "error" => TRUE,
				];
				$this->render('Curso/registro',['notificacion' => $notificacion]);
			}
		}else{
			$notificacion = [
			    "mensaje" => "Complete todos los campos..",
			    "error" => TRUE,
			];
			$this->render('Curso/registro',['notificacion' => $notificacion]);
		}
	}

	public function modificarCurso(){
		$idCurso = $this->post('idCurso'); 
		$nombre = $this->post('nombre');
		$precio = $this->post('precio');
		$objetivo = $this->post('objetivo');
		$descripcion = $this->post('descripcion');
		$perfil = $this->post('perfil');
		$duracion = $this->post('duracion');
		$profesor = $this->post('profesor');
		$imagen = $this->file('imagen');
		$videoIntroduc = $this->file('videoIntroduc');
		//$lecciones=json_decode($_POST["arr_lecciones"], true );
		if(	!is_null($nombre) &&
			!is_null($idCurso) &&
			!is_null($precio) &&
			!is_null($objetivo) &&
			!is_null($descripcion) &&
			!is_null($perfil) &&
			!is_null($duracion) &&
			!is_null($profesor)){
			$curso = Curso::getByIdCurso($idCurso);
			if($videoIntroduc["name"] != ""){
				$videoIntroduc = UtilResources::storeVideo($videoIntroduc);
			}else{
				$videoIntroduc = $curso->getVideoIntroduc();
			}
			if($imagen["name"] != ""){
				$imagen = UtilResources::storeImage($imagen);
			}else{
				$imagen = $curso->getImagen();
			}
			$curso->setNombre($nombre);
			$curso->setPrecio($precio);
			$curso->setObjetivo($objetivo);
			$curso->setDescripcion($descripcion);
			$curso->setPerfil($perfil);
			$curso->setDuracion($duracion);
			$curso->setProfesor($profesor);
			$curso->setImagen($imagen);
			$curso->setVideoIntroduc($videoIntroduc);
			//$this->agregaLecciones($lecciones,$curso,"Modifica");
			if($curso->modifica()){
				$this->agregaLecciones($lecciones,$curso,"Modifica");
				$notificacion = [
				    "mensaje" => "Curso ". $nombre." modificado correctamente",
				    "error" => FALSE,
				];
				$this->listar(['notificacion' => $notificacion]);
			}else{
				$notificacion = [
			    "mensaje" => "Ocurrió un error al actualizar el curso",
			    "error" => TRUE,
				];
				$this->render('Curso/registro',['notificacion' => $notificacion]);
			}
		}else{
			$notificacion = [
			    "mensaje" => "Complete todos los campos..",
			    "error" => TRUE,
			];
			$this->render('Curso/registro',['notificacion' => $notificacion]);
		}
	}

	public function agregaLecciones(array $lecciones_p, Curso $curso, String $accion){
		$lecciones=[];
		$i=1;
		if ($accion == "Crea"){
			foreach($lecciones_p as $l){
				$leccion = new Leccion();
				$leccion->setCapitulo($l[0]);
				$leccion->setTitulo($l[1]);
				$leccion->setObjetivo($l[2]);
				$leccion->setTeoria($l[3]);
				$leccion->setEjercicio($l[4]);
				$leccion->setVideo("");
				$leccion->setOrden($i);
				$leccion->setIdCurso($curso->getIdCurso());
				$leccion->crea();
				$i=$i+1;
				array_push($lecciones, $leccion);
			}
		}
		if ($accion == "Modifica"){
			foreach($lecciones_p as $l){
				if (!isset($l[5])) {
					$leccion = new Leccion();
					$leccion->setCapitulo($l[0]);
					$leccion->setTitulo($l[1]);
					$leccion->setObjetivo($l[2]);
					$leccion->setTeoria($l[3]);
					$leccion->setEjercicio($l[4]);
					$leccion->setVideo("");
					$leccion->setOrden($i);
					$leccion->setIdCurso($curso->getIdCurso());
					$leccion->crea();
				}else{
					$leccion = Leccion::getByIdLeccion($l[5]);
					if($l[1] == $leccion->getTitulo()){
						$leccion->setTitulo("");
					}else{
						$leccion->setTitulo($l[1]);	
					}					
					$leccion->setObjetivo($l[2]);
					$leccion->setTeoria($l[3]);
					$leccion->setEjercicio($l[4]);
					$leccion->setOrden($i);
					$leccion->modifica();
				}
				$i=$i+1;
				array_push($lecciones, $leccion);
			}
		}
		$curso->setLecciones($lecciones);
	}
}