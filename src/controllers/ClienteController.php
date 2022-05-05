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
					header('location: /Cursos/iniciarSesion');
				}else{
					error_log('Correo ya existe');
					header('location: /Cursos/registro');
				}
				
		}else{
			$this->render('errors/index');
		}
	}
}