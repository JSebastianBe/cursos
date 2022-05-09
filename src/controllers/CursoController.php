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
		$descripcionCorta = $this->post('descripcionCorta');
		$descripcionLarga = $this->post('descripcionLarga');
		$duracion = $this->post('duracion');
		$profesor = $this->post('profesor');
		$imagen = $this->file('imagen');
		$videoIntroduc = $this->file('videoIntroduc');
		$lecciones=json_decode($_POST["arr_lecciones"], true );
		if(	!is_null($nombre) &&
			!is_null($precio) &&
			!is_null($descripcionCorta) &&
			!is_null($descripcionLarga) &&
			!is_null($duracion) &&
			!is_null($profesor) &&
			!is_null($imagen) &&
			!is_null($videoIntroduc)){
			$imagen = UtilResources::storeImage($imagen);
			$videoIntroduc = UtilResources::storeVideo($videoIntroduc);
			$curso = new Curso();
			$curso->setNombre($nombre);
			$curso->setPrecio($precio);
			$curso->setDescripcionCorta($descripcionCorta);
			$curso->setDescripcionLarga($descripcionLarga);
			$curso->setDuracion($duracion);
			$curso->setProfesor($profesor);
			$curso->setImagen($imagen);
			$curso->setVideoIntroduc($videoIntroduc);
			$curso->crea();
			$curso->setIdCurso(Curso::get($nombre)->getIdCurso());
			$this->agregaLecciones($lecciones,$curso);
			$notificacion = [
			    "mensaje" => "Curso ". $nombre." registrado correctamente",
			    "error" => FALSE,
			];
			$this->listar(['notificacion' => $notificacion]);
		}else{
			$notificacion = [
			    "mensaje" => "Complete todos los campos..",
			    "error" => TRUE,
			];
			$this->render('Curso/registro',['notificacion' => $notificacion]);
		}
	}

	public function agregaLecciones(array $lecciones_p, Curso $curso){
		$i=1;
		foreach($lecciones_p as $l){
			$leccion = new Leccion();
			$leccion->setTitulo($l[0]);
			$leccion->setObjetivo($l[1]);
			$leccion->setTeoria($l[2]);
			$leccion->setEjercicio($l[3]);
			$leccion->setVideo("");
			$leccion->setOrden($i);
			$leccion->setIdCurso($curso->getIdCurso());
			$leccion->crea();
			$curso->setLeccion($leccion);
			$i=$i+1;
		}
	}
}