<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\models\Usuario;
use PDO;
use PDOException;

class Cliente extends Usuario{

	private int $idCliente;

	function __construct($nombre,$telefono,$correo){
		parent::__construct($correo,$nombre, $telefono);
	}

	public function crear(){
		$this->perfil="Cliente";
		$this->usuario=$this->correo;
		try{
			$query = $this->prepare('INSERT INTO usuario (nombre, correo, telefono, usuario, perfil, clave) VALUES(:nombre, :correo, :telefono, :usuario, :perfil, :clave)');
			$query->execute([
				'nombre' => $this->nombre,
				'correo' => $this->correo,
				'telefono' => $this->telefono,
				'usuario' => $this->usuario,
				'perfil' => $this->perfil,
				'clave' => $this->clave,
			]);
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public static function get($usuario):Cliente{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idUsuario, nombre, correo, telefono, clave, perfil FROM usuario WHERE usuario = :usuario');
			$query->execute(['usuario' => $usuario]);
			$data = $query->fetch(PDO::FETCH_ASSOC);
			$cliente = new Cliente($data['nombre'],$data['telefono'],$data['correo']);
			$cliente->setIdUsuario($data['idUsuario']);
			$cliente->setIdCliente($data['idUsuario']);
			$cliente->setPerfil($data['perfil']);
			$cliente->setClave($data['clave']);
			$cliente->setUsuario($usuario);
			return $cliente;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}


	public function setIdCliente($id){
		$this->idCliente=$id;
	}

	public function getInscrito($idCurso){
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idPago FROM pago WHERE idCurso = :idCurso AND idUsuario = :idUsuario;');
			$query->execute(['idCurso' => $idCurso,
							'idUsuario' => $this->idCliente]);
			if($query->rowCount()>0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

}