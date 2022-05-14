<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;
use Sebas\Cursos\models\Leccion;
use Sebas\Cursos\models\Curso;

class LeccionController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function detalleLeccion(){
		$id = $this->get('id');
		$leccion = Leccion::getByIdLeccion($id);
		$this->render('leccion/detalle',['leccion'=>$leccion]);
	}

	public function agregarLeccion(){
		$idCurso = $this->get('id');
		$idCurso = $this->get('id');
		$curso = Curso::getByIdCurso($idCurso);
		$this->render('leccion/registro', ['curso'=> $curso]);
	}



	public function listar(array $notificacion = []){
		$perfil = unserialize($_SESSION['usuario'])->getPerfil();
		if($perfil == 'Administrador' || $perfil == 'Asistente'){
			$idCurso = $this->get('id');
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
}