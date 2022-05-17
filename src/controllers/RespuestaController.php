<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;
use Sebas\Cursos\models\Pregunta;
use Sebas\Cursos\models\Respuesta;
use Sebas\Cursos\lib\UtilResources;

class RespuestaController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function detalleRespuesta(){
		$id = $this->get('id');
		$pregunta = Pregunta::getByIdPregunta($id);
		$this->render('pregunta/detalle',['pregunta'=>$pregunta]);
	}

	public function modificaRespuesta(){
		$id = $this->get('id');
		$respuesta = Respuesta::getByIdRespuesta($id);
		$this->render('respuesta/registro',['respuestaModificar'=>$respuesta]);
	}

	public function agregaRespuesta(){
		$idPregunta = $this->get('id');
		$pregunta = Pregunta::getByIdPregunta($idPregunta);
		$this->render('respuesta/registro', ['pregunta'=> $pregunta]);
	}

	public function agregarRespuesta(){
		$idPregunta = $this->post('idPregunta');
		$nombre = $this->post('nombre');
		$opcion = $this->post('opcion');
		$correcta = $this->post('correcta');
		if(	!is_null($idPregunta) &&
			!is_null($nombre) &&
			!is_null($opcion) &&
			!is_null($correcta)){
			$respuesta = new Respuesta();
			$pregunta = Pregunta::getByIdPregunta($idPregunta);
			$respuesta->setidPregunta($idPregunta);
			$respuesta->setNombre($nombre);
			$respuesta->setOpcion($opcion);
			$respuesta->setCorrecta($correcta);
			if($respuesta->crea()){
				$notificacion = [
				    "mensaje" => "Respuesta ". $nombre." registrado correctamente",
				    "error" => FALSE,
				];
				$this->listar(['notificacion' => $notificacion], ['idPregunta' => $idPregunta]);
			}else{
				$notificacion = [
			    "mensaje" => "Ocurrió un error al registrar la Respuesta",
			    "error" => TRUE,
				];
				$this->render('Respuesta/registro',['notificacion' => $notificacion]);
			}
		}else{
			$notificacion = [
			    "mensaje" => "Complete todos los campos..",
			    "error" => TRUE,
			];
			$this->render('Respuesta/registro',['notificacion' => $notificacion]);
		}
	}

	public function listar(array $notificacion = [], array $id = []){
		$perfil = unserialize($_SESSION['usuario'])->getPerfil();
		if($perfil == 'Administrador' || $perfil == 'Asistente'){
			if(isset($id['idPregunta'])){
				$idPregunta = $id['idPregunta'];
			}else{
				$idPregunta = $this->get('id');	
			}
			
			$pregunta = Pregunta::getByIdPregunta($idPregunta);
			$data = array_merge(['pregunta' => $pregunta], $notificacion);
			$this->render('Respuesta/listar',$data);
		}else{
			error_log('No tiene permisos');
			$notificacion = [
			    "mensaje" => "No tiene permisos para entrar a ese módulo",
			    "error" => TRUE,
			];
			$this->render('/',['notificacion' => $notificacion]);
		}
		
	}

	public function modificarRespuesta(){
		$idPregunta = $this->post('idPregunta'); 
		$idRespuesta = $this->post('idRespuesta');
		$nombre = $this->post('nombre');
		$opcion = $this->post('opcion');
		$correcta = $this->post('correcta');
		if(	!is_null($idPregunta) &&
			!is_null($nombre) &&
			!is_null($idRespuesta) &&
			!is_null($correcta) &&
			!is_null($opcion)){
			$respuesta = Respuesta::getByIdRespuesta($idRespuesta);
			$respuesta->setOpcion($opcion);
			$respuesta->setIdPregunta($idPregunta);
			$respuesta->setNombre($nombre);
			$respuesta->setCorrecta($correcta);
			if($respuesta->modifica()){
				$notificacion = [
				    "mensaje" => "Respuesta ". $nombre." modificado correctamente",
				    "error" => FALSE,
				];
				$this->listar(['notificacion' => $notificacion], ['idPregunta' => $idPregunta]);
			}else{
				$notificacion = [
			    "mensaje" => "Ocurrió un error al actualizar la Respuesta",
			    "error" => TRUE,
				];
				$this->render('Respuesta/registro',['notificacion' => $notificacion]);
			}
		}else{
			$notificacion = [
			    "mensaje" => "Complete todos los campos..",
			    "error" => TRUE,
			];
			$this->render('Respuesta/registro',['notificacion' => $notificacion]);
		}
	}
}