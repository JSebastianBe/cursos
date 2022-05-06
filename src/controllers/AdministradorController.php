<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;
use Sebas\Cursos\models\Usuario;

class AdministradorController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function modificarUsuario(){
		$idUsuario = $this->post('idUsuario');
		$perfil = $this->post('perfil');
		$nombre = $this->post('nombre');
		$correo = $this->post('correo');
		$telefono = $this->post('telefono');
		if(!is_null($idUsuario) &&
			!is_null($perfil) &&
			!is_null($nombre) &&
			!is_null($correo) &&
			!is_null($telefono)){
				$usuario = Usuario::getByIdUsuario($idUsuario);
				$usuario->setNombre($nombre);
				$usuario->setCorreo($correo);
				$usuario->setTelefono($telefono);
				$usuario->setPerfil($perfil);
				if($usuario->validaCorreobyId($correo, $idUsuario)){
					$usuario->modificar();
					$notificacion = [
					    "mensaje" => "Usuario ". $nombre." actualizado correctamente",
					    "error" => FALSE,
					];
					$this->listar(['notificacion' => $notificacion]);
				}else{
					error_log('Correo ya existe');
					$notificacion = [
					    "mensaje" => "El correo registrado ya existe..",
					    "error" => TRUE,
					];
					$this->render('Usuario/registro',['notificacion' => $notificacion,
													  'usuarioModificar' => $usuario]);
				}
		}else{
			$notificacion = [
			    "mensaje" => "Complete todos los campos..",
			    "error" => TRUE,
			];
			$this->render('Usuario/registro',['notificacion' => $notificacion]);
		}
	}

	public function modificaUsuario(){
		$id = $this->get('id');
		$usuario = Usuario::getByIdUsuario($id);
		$this->render('usuario/registro',['usuarioModificar'=>$usuario]);
	}


	public function registrarUsuario(){
		$perfil = $this->post('perfil');
		$nombre = $this->post('nombre');
		$correo = $this->post('correo');
		$telefono = $this->post('telefono');
		if(!is_null($perfil) &&
			!is_null($nombre) &&
			!is_null($correo) &&
			!is_null($telefono)){
				$usuario = new Usuario($correo, $nombre, $telefono);
				if($usuario->validaCorreo($correo)){
					$usuario->generaClave($usuario->getTelefono());
					$usuario->setPerfil($perfil);
					$usuario->crear();
					$notificacion = [
					    "mensaje" => "Usuario ". $nombre." registrado correctamente",
					    "error" => FALSE,
					];
					$this->listar(['notificacion' => $notificacion]);
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

	public function listar(array $notificacion = []){
		if(unserialize($_SESSION['usuario'])->getPerfil() == 'Administrador'){
			$usuarios = Usuario::retornaUsuarios();
			$data = array_merge(['usuarios' => $usuarios], $notificacion);
			$this->render('Usuario/listar',$data);
		}else{
			error_log('No tiene permisos');
			$notificacion = [
			    "mensaje" => "No tienes permisos para entrar a ese módulo",
			    "error" => TRUE,
			];
			$this->render('Home/index',['notificacion' => $notificacion]);
		}
		
	}
}