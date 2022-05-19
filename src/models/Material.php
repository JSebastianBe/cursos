<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\lib\Model;
use PDO;
use PDOException;

class Material extends Model{

	private int $idMaterial;
	private string $nombre;
	private string $archivo;
	private int $idLeccion;

	function __construct(){
		parent::__construct();
	}

	public function crea(){
		try{
			$query = $this->prepare('INSERT INTO material (nombre, archivo, idLeccion) VALUES(:nombre, :archivo, :idLeccion)');
			$query->execute([
				'nombre' => $this->nombre, 
				'archivo' => $this->archivo, 
				'idLeccion' => $this->idLeccion,
			]);
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public function modifica(){
		try{
			if($this->nombre == ""){
				$query = $this->prepare('UPDATE material SET 
						archivo = :archivo,
						idLeccion = :idLeccion
					WHERE idMaterial = :idMaterial;');
				$query->execute([ 
					'archivo' => $this->archivo, 
					'idLeccion' => $this->idLeccion, 
					'idMaterial' => $this->idMaterial,
				]);
			}else{
				$query = $this->prepare('UPDATE material SET 
						nombre = :nombre,
						archivo = :archivo,
						idLeccion = :idLeccion
					WHERE idMaterial = :idMaterial;');
				$query->execute([
					'nombre' => $this->nombre, 
					'archivo' => $this->archivo, 
					'idLeccion' => $this->idLeccion, 
					'idMaterial' => $this->idMaterial,
				]);
			}	
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public static function getByIdLeccion($idLeccion):Array{
		$materiales=[];
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idMaterial, nombre, archivo, idLeccion FROM material WHERE idLeccion = :idLeccion');
			$query->execute(['idLeccion' => $idLeccion]);
			while($c = $query->fetch(PDO::FETCH_ASSOC)){
				$material = new Material();
				$material->setIdLeccion($c['idLeccion']);
				$material->setIdMaterial($c['idMaterial']);
				$material->setNombre($c['nombre']);
				$material->setArchivo($c['archivo']);
				array_push($materiales, $material);
			}
			return $materiales;	
		}catch(PDOException $e){
			error_log($e->getMessage());
			return [];
		}
	}


	public static function getByIdMaterial($idMaterial):Material{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idMaterial, nombre, archivo, idLeccion FROM material WHERE idMaterial = :idMaterial');
			$query->execute(['idMaterial' => $idMaterial]);
			$data = $query->fetch(PDO::FETCH_ASSOC);
			$material = new Material();
			$material->setIdLeccion($data['idLeccion']);
			$material->setIdMaterial($data['idMaterial']);
			$material->setNombre($data['nombre']);
			$material->setArchivo($data['archivo']);
			return $material;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}

	public function getExtension(){
		$extarr = explode('.',$this->archivo);
		$extension = $extarr[1];
		return $extension;
	}

	public function getIdLeccion(){
		return $this->idLeccion;
	}
	public function getNombre(){
		return $this->nombre;
	}	
	public function getArchivo(){
		return $this->archivo;
	}
	public function getIdMaterial(){
		return $this->idMaterial;
	}

	
	public function setIdLeccion($idLeccion){
		$this->idLeccion = $idLeccion;
	}
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function setArchivo($archivo){
		$this->archivo = $archivo;
	}
	public function setIdMaterial($idMaterial){
		$this->idMaterial = $idMaterial;
	}
}