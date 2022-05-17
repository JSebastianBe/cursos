<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\lib\Model;
use PDO;
use PDOException;

class Respuesta extends Model{

	private int $idRespuesta;
	private string $nombre;
	private string $opcion;
	private int $correcta;
	private int $idPregunta;

	function __construct(){
		parent::__construct();
	}

	public function crea(){
		try{
			$query = $this->prepare('INSERT INTO respuesta (nombre, opcion, correcta, idPregunta) VALUES(:nombre, :opcion, :correcta, :idPregunta)');
			$query->execute([
				'nombre' => $this->nombre, 
				'opcion' => $this->opcion, 
				'correcta' => $this->correcta,
				'idPregunta' => $this->idPregunta,
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
				$query = $this->prepare('UPDATE respuesta SET 
						opcion = :opcion,
						idPregunta = :idPregunta,
						correcta = :correcta
					WHERE idRespuesta = :idRespuesta;');
				$query->execute([ 
					'opcion' => $this->opcion, 
					'idPregunta' => $this->idPregunta, 
					'correcta' => $this->correcta,
					'idRespuesta' => $this->idRespuesta,
				]);
			}else{
				$query = $this->prepare('UPDATE respuesta SET 
						nombre = :nombre,
						opcion = :opcion,
						idPregunta = :idPregunta,
						correcta = :correcta
					WHERE idRespuesta = :idRespuesta;');
				$query->execute([
					'nombre' => $this->nombre, 
					'opcion' => $this->opcion, 
					'idPregunta' => $this->idPregunta,  
					'correcta' => $this->correcta,
					'idRespuesta' => $this->idRespuesta,
				]);
			}	
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public static function getByIdPregunta($idPregunta):Array{
		$respuestas=[];
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idRespuesta, nombre, opcion, correcta, idPregunta FROM respuesta WHERE idPregunta = :idPregunta');
			$query->execute(['idPregunta' => $idPregunta]);
			while($c = $query->fetch(PDO::FETCH_ASSOC)){
				$respuesta = new Respuesta();
				$respuesta->setIdPregunta($c['idPregunta']);
				$respuesta->setIdRespuesta($c['idRespuesta']);
				$respuesta->setNombre($c['nombre']);
				$respuesta->setCorrecta($c['correcta']);
				$respuesta->setOpcion($c['opcion']);
				array_push($respuestas, $respuesta);
			}
			return $respuestas;	
		}catch(PDOException $e){
			error_log($e->getMessage());
			return [];
		}
	}


	public static function getByIdRespuesta($idRespuesta):Respuesta{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idRespuesta, nombre, opcion, correcta, idPregunta FROM respuesta WHERE idRespuesta = :idRespuesta');
			$query->execute(['idRespuesta' => $idRespuesta]);
			$data = $query->fetch(PDO::FETCH_ASSOC);
			$respuesta = new Respuesta();
			$respuesta->setIdPregunta($data['idPregunta']);
			$respuesta->setIdRespuesta($data['idRespuesta']);
			$respuesta->setNombre($data['nombre']);
			$respuesta->setCorrecta($data['correcta']);
			$respuesta->setOpcion($data['opcion']);
			return $respuesta;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}

	public function getIdPregunta(){
		return $this->idPregunta;
	}
	public function getNombre(){
		return $this->nombre;
	}	
	public function getOpcion(){
		return $this->opcion;
	}
	public function getCorrecta(){
		return $this->correcta;
	}
	public function getIdRespuesta(){
		return $this->idRespuesta;
	}

	
	public function setIdPregunta($idPregunta){
		$this->idPregunta = $idPregunta;
	}
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function setOpcion($opcion){
		$this->opcion = $opcion;
	}
	public function setCorrecta($correcta){
		$this->correcta = $correcta;
	}
	public function setIdRespuesta($idRespuesta){
		$this->idRespuesta = $idRespuesta;
	}
}