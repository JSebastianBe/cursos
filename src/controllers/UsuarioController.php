<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;
use Sebas\Cursos\models\Usuario;

class UsuarioController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->render('usuario/index');
	}

	public function registro(){
		$this->render('usuario/registro');
	}

	public function iniciarSesion(){
		$this->render('usuario/iniciarSesion');
	}

	public function inicioSesion(){
		$pusuario = $this->post('usuario');
		$clave = $this->post('clave');
		if(!is_null($pusuario) &&
			!is_null($clave)){
				if(!Usuario::validaCorreo($pusuario)){
					$usuario = Usuario::get($pusuario);
					if($usuario->validaInicioSesion($clave)){
						$_SESSION['usuario'] = serialize($usuario);
						error_log('Usuario loggeado');
						header('location: /Cursos/inicio');
					}else{
						error_log('No coincide la contraseña');
						header('location: /Cursos/iniciarSesion');
					}
				}else{
					error_log('No existe el usuario');
					header('location: /Cursos/iniciarSesion');
				}
		}else{
			error_log('Información incompleta');
			header('location: /Cursos/iniciarSesion');
		}
	}

}