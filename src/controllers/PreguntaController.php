<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;
use Sebas\Cursos\models\Leccion;
use Sebas\Cursos\models\Pregunta;
use Sebas\Cursos\lib\UtilResources;

class PreguntaController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function detallePregunta(){
		$id = $this->get('id');
		$leccion = Leccion::getByIdLeccion($id);
		$this->render('leccion/detalle',['leccion'=>$leccion]);
	}

	public function modificaPregunta(){
		$id = $this->get('id');
		$pregunta = Pregunta::getByIdPregunta($id);
		$this->render('pregunta/registro',['preguntaModificar'=>$pregunta]);
	}

	public function agregaPregunta(){
		$idLeccion = $this->get('id');
		$leccion = Leccion::getByIdLeccion($idLeccion);
		$this->render('pregunta/registro', ['leccion'=> $leccion]);
	}

	public function agregarPregunta(){
		$idLeccion = $this->post('idLeccion');
		$nombre = $this->post('nombre');
		$descripcion = $this->post('descripcion');
		if(	!is_null($idLeccion) &&
			!is_null($nombre) &&
			!is_null($descripcion)){
			$pregunta = new Pregunta();
			$Leccion = Leccion::getByIdLeccion($idLeccion);
			$pregunta->setidLeccion($idLeccion);
			$pregunta->setNombre($nombre);
			$pregunta->setDescripcion($descripcion);
			if($pregunta->crea()){
				$notificacion = [
				    "mensaje" => "Pregunta ". $nombre." registrado correctamente",
				    "error" => FALSE,
				];
				$this->listar(['notificacion' => $notificacion], ['idLeccion' => $idLeccion]);
			}else{
				$notificacion = [
			    "mensaje" => "Ocurrió un error al registrar la Pregunta",
			    "error" => TRUE,
				];
				$this->render('Pregunta/registro',['notificacion' => $notificacion]);
			}
		}else{
			$notificacion = [
			    "mensaje" => "Complete todos los campos..",
			    "error" => TRUE,
			];
			$this->render('Pregunta/registro',['notificacion' => $notificacion]);
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
			$this->render('Pregunta/listar',$data);
		}else{
			error_log('No tiene permisos');
			$notificacion = [
			    "mensaje" => "No tiene permisos para entrar a ese módulo",
			    "error" => TRUE,
			];
			$this->render('/',['notificacion' => $notificacion]);
		}
		
	}

	public function modificarPregunta(){
		$idLeccion = $this->post('idLeccion'); 
		$idPregunta = $this->post('idPregunta');
		$nombre = $this->post('nombre');
		$descripcion = $this->post('descripcion');
		if(	!is_null($idLeccion) &&
			!is_null($nombre) &&
			!is_null($idLeccion)){
			$pregunta = Pregunta::getByIdPregunta($idPregunta);
			$pregunta->setDescripcion($descripcion);
			$pregunta->setIdLeccion($idLeccion);
			$pregunta->setNombre($nombre);
			if($pregunta->modifica()){
				$notificacion = [
				    "mensaje" => "Pregunta ". $nombre." modificado correctamente",
				    "error" => FALSE,
				];
				$this->listar(['notificacion' => $notificacion], ['idLeccion' => $idLeccion]);
			}else{
				$notificacion = [
			    "mensaje" => "Ocurrió un error al actualizar la Pregunta",
			    "error" => TRUE,
				];
				$this->render('Pregunta/registro',['notificacion' => $notificacion]);
			}
		}else{
			$notificacion = [
			    "mensaje" => "Complete todos los campos..",
			    "error" => TRUE,
			];
			$this->render('Pregunta/registro',['notificacion' => $notificacion]);
		}
	}
}