<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\models\Usuario;
use PDO;
use PDOException;

class Asistente extends Usuario{

	private int $idAsistente;

	function __construct($nombre,$telefono,$correo){
		parent::__construct($correo,$nombre, $telefono);
	}

	public static function get($usuario):Asistente{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idUsuario, nombre, correo, telefono, clave, perfil FROM usuario WHERE usuario = :usuario');
			$query->execute(['usuario' => $usuario]);
			$data = $query->fetch(PDO::FETCH_ASSOC);
			$asistente = new Asistente($data['nombre'],$data['telefono'],$data['correo']);
			$asistente->setIdUsuario($data['idUsuario']);
			$asistente->setIdAsistente($data['idUsuario']);
			$asistente->setPerfil($data['perfil']);
			$asistente->setClave($data['clave']);
			$asistente->setUsuario($usuario);
			return $asistente;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}
	public function setIdAsistente($id){
		$this->idAsistente=$id;
	}

}