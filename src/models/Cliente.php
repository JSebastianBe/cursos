<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\models\Usuario;
use PDO;
use PDOException;

class Cliente extends Usuario{

	private int $id;
	private string $nombre;
	private string $telefono;

	function __construct($nombre,$telefono,$correo){
		parent::__construct($correo);
		$this->nombre = $nombre;
		$this->telefono = $telefono;

	}


	public function getTelefono(){
		return $this->telefono;
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
}