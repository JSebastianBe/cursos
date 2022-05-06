<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;
use Sebas\Cursos\models\Usuario;

class AdministradorController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function registrarUsuario(){
		$nombre = $this->post('nombre');
		$correo = $this->post('correo');
		$telefono = $this->post('telefono');
		if(!is_null($nombre) &&
			!is_null($correo) &&
			!is_null($telefono)){
				$usuario = new Usuario($correo, $nombre, $telefono);
				if($usuario->validaCorreo($correo)){
					$usuario->generaClave($usuario->getTelefono());
					$usuario->crear();
					$notificacion = [
					    "mensaje" => "Usuario registrado correctamente",
					    "error" => FALSE,
					];
					$this->render('Usuario/listar',['notificacion' => $notificacion]);
				}else{
					error_log('Correo ya existe');
					$notificacion = [
					    "mensaje" => "El correo registrado ya existe..",
					    "error" => TRUE,
					];
					$this->render('Usuario/registro',['notificacion' => $notificacion]);
				}
				
		}else{
			$notificacion = [
			    "mensaje" => "Complete todos los campos..",
			    "error" => TRUE,
			];
			$this->render('Usuario/registro',['notificacion' => $notificacion]);
		}
	}
}