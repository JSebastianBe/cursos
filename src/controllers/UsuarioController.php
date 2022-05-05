<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;
use Sebas\Cursos\models\Usuario;
use Sebas\Cursos\models\Cliente;

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
					$perfil = Usuario::retornaPerfil($pusuario);
					if($perfil=="Cliente"){
						$usuario = Cliente::get($pusuario);
					}/*
					if($perfil=="Administrador"){
						$usuario = Administrador::get($pusuario);
					}
					if($perfil=="Asistente"){
						$usuario = Asistente::get($pusuario);
					}*/
					if($usuario->validaInicioSesion($clave)){
						
						$_SESSION['usuario'] = serialize($usuario);
						error_log('Usuario loggeado');
						$notificacion = [
						    "mensaje" => "Inicio de sesión exitoso. Hola, " . $usuario->getNombre(),
						    "error" => FALSE,
						];
						$this->render('Home/index',['notificacion' => $notificacion]);
					}else{
						error_log('No coincide la contraseña');
						$notificacion = [
						    "mensaje" => "No coincide la contraseña",
						    "error" => TRUE,
						];
						$this->render('Usuario/iniciarSesion',['notificacion' => $notificacion]);
					}
				}else{
					error_log('No existe el usuario');
					$notificacion = [
					    "mensaje" => "No existe el usuario",
					    "error" => TRUE,
					];
					$this->render('Usuario/iniciarSesion',['notificacion' => $notificacion]);
				}
		}else{
			error_log('Información incompleta');
			$notificacion = [
			    "mensaje" => "Complete todos los campos",
			    "error" => TRUE,
			];
			$this->render('Usuario/iniciarSesion',['notificacion' => $notificacion]);
		}
	}

	public function cerrarSesion(){
		unset($_SESSION['usuario']);
		error_log('Usuario loggeado');
		$notificacion = [
		    "mensaje" => "Sesión cerrada con éxito",
		    "error" => FALSE,
		];
		$this->render('Home/index',['notificacion' => $notificacion]);
	}

}