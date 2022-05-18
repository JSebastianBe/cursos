<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;
use Sebas\Cursos\models\Cliente;
use Sebas\Cursos\models\Curso;
use Sebas\Cursos\models\Pago;
use Sebas\Cursos\models\AvanceCurso;
use Sebas\Cursos\models\AvanceLeccion;
use Sebas\Cursos\models\Usuario;

class ClienteController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function registrarse(){
		$idCurso = $this->post('idCurso');
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
					if($idCurso == ""){
						$this->render('Usuario/iniciarSesion',['notificacion' => $notificacion]);	
					}else{
						$cliente = Cliente::get($cliente->getUsuario());
						if(!$cliente->getInscrito($idCurso)){

							$this->inscribe($idCurso,$cliente->getIdUsuario());
							header('location: /Cursos/detalleCurso?id='.$idCurso);
						}
					}
					
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

	public function inscribirCurso(){
		$idCurso = $this->post('idCurso');
		$usuario = $this->post('usuario');
		$usuario = Usuario::get($usuario);
		$idUsuario = $usuario->getIdUsuario();
		$this->inscribe($idCurso,$idUsuario);
	}

	private function inscribe($idCurso,$idUsuario){
		if(!is_null($idCurso) &&
			!is_null($idUsuario)){
			$curso = Curso::getByIdCurso($idCurso);
			$fecha_inscrip = date('Y-m-d H:i:s', time());
			$valor = $curso->getPrecio();
			$estado = 'Inscrito';
			$pago = new Pago();
			$pago->setFecha_inscrip($fecha_inscrip);
			$pago->setValor($valor);
			$pago->setEstado($estado);
			$pago->setIdUsuario($idUsuario);
			$pago->setIdCurso($idCurso);
			$pago->registrar();
			$this->creaAvanceCurso($idCurso,$idUsuario);
			header('location: /Cursos/detalleCurso?id='.$idCurso);
		}
	}

	private function creaAvanceCurso($idCurso,$idUsuario) {
		$curso = Curso::getByIdCurso($idCurso);
		$avanceCurso = new AvanceCurso();
		$avanceCurso->setIdCurso($idCurso);
		$avanceCurso->setIdUsuario($idUsuario);
		$avanceCurso->crea();
		$avanceCurso = AvanceCurso::get($idUsuario, $idCurso);
		$this->creaAvanceLeccion($idCurso, $avanceCurso->getIdAvanceCurso());
	}

	private function creaAvanceLeccion($idCurso, $idAvanceCurso) {
		$lecciones = (Curso::getByIdCurso($idCurso))->getLecciones();
		foreach($lecciones as $l){
			$avanceLeccion = new AvanceLeccion();
			$avanceLeccion->setIdAvanceCurso($idAvanceCurso);
			$avanceLeccion->setIdLeccion($l->getIdLeccion());
			$avanceLeccion->setVisto(0);
			$avanceLeccion->crea();
		}		
	}
}