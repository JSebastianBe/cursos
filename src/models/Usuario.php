<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\lib\Model;
use PDO;
use PDOException;

class Usuario extends Model{

	private int $idUsuario;
	protected string $usuario;
	protected string $perfil;
	protected string $clave;
	protected string $correo;
	protected string $nombre;
	protected string $telefono;

	function __construct($correo, $nombre, $telefono){
		parent::__construct();
		$this->correo = $correo;
		$this->nombre = $nombre;
		$this->telefono = $telefono;
	}

	public static function validaCorreo($correo){
		try{
			
			$db = new Database();
			$query = $db->connect()->prepare('SELECT correo FROM usuario WHERE correo = :correo');
			$query->execute(['correo' => $correo]);
			if($query->rowCount()>0){
				return false;
			}else{
				return true;
			}
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public static function retornaPerfil($usuario){
		try{
			
			$db = new Database();
			$query = $db->connect()->prepare('SELECT perfil FROM usuario WHERE usuario = :usuario');
			$query->execute(['usuario' => $usuario]);
			$data = $query->fetch(PDO::FETCH_ASSOC);
			return $data['perfil'];
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}

	public static function retornaUsuarios(){
		$usuarios=[];
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idUsuario, usuario, nombre, correo, telefono, clave, perfil FROM usuario ORDER BY idUsuario ASC');
			$query->execute();
			while($u = $query->fetch(PDO::FETCH_ASSOC)){
				$usuario = new Usuario($u['correo'],$u['nombre'],$u['telefono']);
				$usuario->setIdUsuario($u['idUsuario']);
				$usuario->setPerfil($u['perfil']);
				$usuario->setClave($u['clave']);
				$usuario->setUsuario($u['usuario']);
				array_push($usuarios, $usuario);
			}
			return $usuarios;	
		}catch(PDOException $e){
			error_log($e->getMessage());
			return [];
		}
	}

	public function generaClave($dato){
		$hash = $this->getHashedPassword($dato);
		$this->clave = $hash;
	}

	public function crear(){
		echo "Crear usuario desde usuario";
	}

	public static function get($pusuario):Usuario{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idUsuario, nombre, correo, telefono, clave, perfil FROM usuario WHERE usuario = :usuario');
			$query->execute(['usuario' => $pusuario]);
			$data = $query->fetch(PDO::FETCH_ASSOC);
			$usuario = new Usuario($data['correo'],$data['nombre'],$data['telefono']);
			$usuario->setIdUsuario($data['idUsuario']);
			$usuario->setPerfil($data['perfil']);
			$usuario->setClave($data['clave']);
			$usuario->setUsuario($pusuario);
			return $usuario;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}

	private function getHashedPassword($password){
		return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
	}

	public function validaInicioSesion(string $clave):bool{
		return password_verify($clave,$this->clave);
	}

	public function getClave(){
		return $this->clave;
	}
	
	public function setClave($clave){
		$this->clave = $clave;
	}

	public function setUsuario($usuario){
		$this->usuario=$usuario;
	}

	public function getUsuario(){
		return $this->usuario;
	}

	public function setPerfil($perfil){
		$this->perfil=$perfil;
	}

	public function setIdUsuario($id){
		$this->idUsuario=$id;
	}

	public function getPerfil(){
		return $this->perfil;
	}

	public function getIdUsuario(){
		return $this->idUsuario;
	}

	public function getCorreo(){
		return $this->correo;
	}

	public function getTelefono(){
		return $this->telefono;
	}

	public function getNombre(){
		return $this->nombre;
	}

}