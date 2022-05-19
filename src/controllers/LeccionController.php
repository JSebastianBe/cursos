<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;
use Sebas\Cursos\models\Leccion;
use Sebas\Cursos\models\Curso;
use Sebas\Cursos\models\AvanceLeccion;
use Sebas\Cursos\lib\UtilResources;

class LeccionController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function detalleLeccion(){
		$id = $this->get('idLeccion');
		$leccion = Leccion::getByIdLeccion($id);
		$this->render('leccion/detalle',['leccion'=>$leccion]);
	}

	public function modificaLeccion(){
		$id = $this->get('id');
		$leccion = Leccion::getByIdLeccion($id);
		$this->render('leccion/registro',['leccionModificar'=>$leccion]);
	}

	public function agregaLeccion(){
		$idCurso = $this->get('id');
		$curso = Curso::getByIdCurso($idCurso);
		$this->render('leccion/registro', ['curso'=> $curso]);
	}

	public function avanzaLeccion(){
		$idLeccion = $this->post('idLeccion');
		$idAvanceCurso = $this->post('idAvanceCurso');
		$leccion = Leccion::getByIdLeccion($idLeccion);
		$avanceLeccion = AvanceLeccion::getByIdLecAvanCur($idAvanceCurso, $idLeccion);
		$avanceLeccion->ver();
		header('location: /Cursos/detalleCurso?id='.$leccion->getIdCurso());
	}

	public function agregarLeccion(){
		$idCurso = $this->post('idCurso');
		$capitulo = $this->post('capitulo');
		$titulo = $this->post('titulo');
		$objetivo = $this->post('objetivo');
		$teoria = $this->post('teoria');
		$ejercicio = $this->post('ejercicio');
		$video = $this->file('video');
		if(	!is_null($idCurso) &&
			!is_null($capitulo) &&
			!is_null($titulo) &&
			!is_null($objetivo) &&
			!is_null($teoria) &&
			!is_null($ejercicio) &&
			!is_null($video)){
			$video = UtilResources::storeVideo($video);
			$leccion = new Leccion();
			$curso = Curso::getByIdCurso($idCurso);
			$leccion->setIdCurso($idCurso);
			$leccion->setCapitulo($capitulo);
			$leccion->setTitulo($titulo);
			$leccion->setObjetivo($objetivo);
			$leccion->setTeoria($teoria);
			$leccion->setEjercicio($ejercicio);
			$leccion->setVideo($video);
			$orden = ($curso->getCantidadLecciones())+1;
			$leccion->setOrden($orden);
			if($leccion->crea()){
				$notificacion = [
				    "mensaje" => "Lección ". $titulo." registrado correctamente",
				    "error" => FALSE,
				];
				$this->listar(['notificacion' => $notificacion], ['idCurso' => $idCurso]);
			}else{
				$notificacion = [
			    "mensaje" => "Ocurrió un error al registrar la leccion",
			    "error" => TRUE,
				];
				$this->render('Leccion/registro',['notificacion' => $notificacion]);
			}
		}else{
			$notificacion = [
			    "mensaje" => "Complete todos los campos..",
			    "error" => TRUE,
			];
			$this->render('Leccion/registro',['notificacion' => $notificacion]);
		}
	}

	public function listar(array $notificacion = [], array $id = []){
		$perfil = unserialize($_SESSION['usuario'])->getPerfil();
		if($perfil == 'Administrador' || $perfil == 'Asistente'){
			if(isset($id['idCurso'])){
				$idCurso = $id['idCurso'];
			}else{
				$idCurso = $this->get('id');	
			}
			
			$curso = Curso::getByIdCurso($idCurso);
			$data = array_merge(['curso' => $curso], $notificacion);
			$this->render('Leccion/listar',$data);
		}else{
			error_log('No tiene permisos');
			$notificacion = [
			    "mensaje" => "No tiene permisos para entrar a ese módulo",
			    "error" => TRUE,
			];
			$this->render('/',['notificacion' => $notificacion]);
		}
		
	}

	public function modificarLeccion(){
		$idLeccion = $this->post('idLeccion'); 
		$idCurso = $this->post('idCurso');
		$capitulo = $this->post('capitulo');
		$titulo = $this->post('titulo');
		$objetivo = $this->post('objetivo');
		$teoria = $this->post('teoria');
		$ejercicio = $this->post('ejercicio');
		$video = $this->file('video');
		$orden = $this->post('orden');
		if(	!is_null($idCurso) &&
			!is_null($capitulo) &&
			!is_null($titulo) &&
			!is_null($objetivo) &&
			!is_null($teoria) &&
			!is_null($ejercicio) &&
			!is_null($idLeccion) &&
			!is_null($orden)){
			$leccion = Leccion::getByIdLeccion($idLeccion);
			if($video["name"] != ""){
				$video = UtilResources::storeVideo($video);
			}else{
				$video = $leccion->getVideo();
			}
			$leccion->setIdCurso($idCurso);
			$leccion->setCapitulo($capitulo);
			$leccion->setTitulo($titulo);
			$leccion->setObjetivo($objetivo);
			$leccion->setTeoria($teoria);
			$leccion->setEjercicio($ejercicio);
			$leccion->setVideo($video);
			$leccion->setOrden($orden);
			if($leccion->modifica()){
				$notificacion = [
				    "mensaje" => "Lección ". $titulo." modificado correctamente",
				    "error" => FALSE,
				];
				$this->listar(['notificacion' => $notificacion], ['idCurso' => $idCurso]);
			}else{
				$notificacion = [
			    "mensaje" => "Ocurrió un error al actualizar la leccion",
			    "error" => TRUE,
				];
				$this->render('Leccion/registro',['notificacion' => $notificacion]);
			}
		}else{
			$notificacion = [
			    "mensaje" => "Complete todos los campos..",
			    "error" => TRUE,
			];
			$this->render('Leccion/registro',['notificacion' => $notificacion]);
		}
	}
}