<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;
use Sebas\Cursos\models\Leccion;
use Sebas\Cursos\models\Material;
use Sebas\Cursos\lib\UtilResources;

class MaterialController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function detalleMaterial(){
		$id = $this->get('id');
		$leccion = Leccion::getByIdLeccion($id);
		$this->render('leccion/detalle',['leccion'=>$leccion]);
	}

	public function modificaMaterial(){
		$id = $this->get('id');
		$leccion = Leccion::getByIdLeccion($id);
		$this->render('leccion/registro',['leccionModificar'=>$leccion]);
	}

	public function agregaMaterial(){
		$idCurso = $this->get('id');
		$curso = Curso::getByIdCurso($idCurso);
		$this->render('leccion/registro', ['curso'=> $curso]);
	}

	public function agregarMaterial(){
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
			if(isset($id['idLeccion'])){
				$idLeccion = $id['idLeccion'];
			}else{
				$idLeccion = $this->get('id');	
			}
			
			$leccion = Leccion::getByIdLeccion($idLeccion);
			$data = array_merge(['leccion' => $leccion], $notificacion);
			$this->render('Material/listar',$data);
		}else{
			error_log('No tiene permisos');
			$notificacion = [
			    "mensaje" => "No tiene permisos para entrar a ese módulo",
			    "error" => TRUE,
			];
			$this->render('/',['notificacion' => $notificacion]);
		}
		
	}

	public function modificarMaterial(){
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