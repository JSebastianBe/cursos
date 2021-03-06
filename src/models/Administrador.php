<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\models\Usuario;
use PDO;
use PDOException;

class Administrador extends Usuario{

	private int $idAdministrador;

	function __construct($nombre,$telefono,$correo){
		parent::__construct($correo,$nombre, $telefono);
	}

	public static function get($usuario):Administrador{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idUsuario, nombre, correo, telefono, clave, perfil FROM usuario WHERE usuario = :usuario');
			$query->execute(['usuario' => $usuario]);
			$data = $query->fetch(PDO::FETCH_ASSOC);
			$administrador = new Administrador($data['nombre'],$data['telefono'],$data['correo']);
			$administrador->setIdUsuario($data['idUsuario']);
			$administrador->setIdAdministrador($data['idUsuario']);
			$administrador->setPerfil($data['perfil']);
			$administrador->setClave($data['clave']);
			$administrador->setUsuario($usuario);
			return $administrador;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}
	public function setIdAdministrador($id){
		$this->idAdministrador=$id;
	}

}