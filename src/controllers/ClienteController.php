<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;
use Sebas\Cursos\models\Cliente;

class ClienteController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function registrarse(){
		$nombre = $this->post('nombre');
		$correo = $this->post('correo');
		$telefono = $this->post('telefono');
		if(!is_null($nombre) &&
			!is_null($correo) &&
			!is_null($telefono)){
				$cliente = new Cliente($nombre, $telefono, $correo);
				if($cliente->validaCorreo($correo)){
					$cliente->generaClave($cliente->getTelefono());
					$cliente->crear();
					$notificacion = [
					    "mensaje" => "Cliente registrado, por favor inicie sesión con el usuario y clave enviados a su correo..",
					    "error" => FALSE,
					];
					$this->render('Usuario/iniciarSesion',['notificacion' => $notificacion]);
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