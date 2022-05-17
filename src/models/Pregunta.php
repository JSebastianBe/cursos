<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\lib\Model;
use PDO;
use PDOException;

class Pregunta extends Model{

	private int $idPregunta;
	private string $nombre;
	private string $descripcion;
	private int $idLeccion;
	private Array $respuestas = [];

	function __construct(){
		parent::__construct();
	}

	public function crea(){
		try{
			$query = $this->prepare('INSERT INTO pregunta (nombre, descripcion, idLeccion) VALUES(:nombre, :descripcion, :idLeccion)');
			$query->execute([
				'nombre' => $this->nombre, 
				'descripcion' => $this->descripcion, 
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
				$query = $this->prepare('UPDATE pregunta SET 
						descripcion = :descripcion,
						idLeccion = :idLeccion
					WHERE idPregunta = :idPregunta;');
				$query->execute([ 
					'descripcion' => $this->descripcion, 
					'idLeccion' => $this->idLeccion, 
					'idPregunta' => $this->idPregunta,
				]);
			}else{
				$query = $this->prepare('UPDATE pregunta SET 
						nombre = :nombre,
						descripcion = :descripcion,
						idLeccion = :idLeccion
					WHERE idPregunta = :idPregunta;');
				$query->execute([
					'nombre' => $this->nombre, 
					'descripcion' => $this->descripcion, 
					'idLeccion' => $this->idLeccion, 
					'idPregunta' => $this->idPregunta,
				]);
			}	
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public static function getByIdLeccion($idLeccion):Array{
		$preguntas=[];
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idPregunta, nombre, descripcion, idLeccion FROM pregunta WHERE idLeccion = :idLeccion');
			$query->execute(['idLeccion' => $idLeccion]);
			while($c = $query->fetch(PDO::FETCH_ASSOC)){
				$pregunta = new Pregunta();
				$pregunta->setIdLeccion($c['idLeccion']);
				$pregunta->setIdPregunta($c['idPregunta']);
				$pregunta->setNombre($c['nombre']);
				$pregunta->setDescripcion($c['descripcion']);
				$pregunta->setRespuestas(Respuesta::getByIdPregunta($pregunta->getIdPregunta()));
				array_push($preguntas, $pregunta);
			}
			return $preguntas;	
		}catch(PDOException $e){
			error_log($e->getMessage());
			return [];
		}
	}


	public static function getByIdPregunta($idPregunta):Pregunta{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idPregunta, nombre, descripcion, idLeccion FROM pregunta WHERE idPregunta = :idPregunta');
			$query->execute(['idPregunta' => $idPregunta]);
			$data = $query->fetch(PDO::FETCH_ASSOC);
			$pregunta = new Pregunta();
			$pregunta->setIdLeccion($data['idLeccion']);
			$pregunta->setIdPregunta($data['idPregunta']);
			$pregunta->setNombre($data['nombre']);
			$pregunta->setDescripcion($data['descripcion']);
			$pregunta->setRespuestas(Respuesta::getByIdPregunta($pregunta->getIdPregunta()));
			return $pregunta;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}

	public function getIdLeccion(){
		return $this->idLeccion;
	}
	public function getNombre(){
		return $this->nombre;
	}	
	public function getDescripcion(){
		return $this->descripcion;
	}
	public function getIdPregunta(){
		return $this->idPregunta;
	}
	public function getRespuestas(){
		return $this->respuestas;
	}
	
	public function setIdLeccion($idLeccion){
		$this->idLeccion = $idLeccion;
	}
	public function setNombre($nombre){
		$this->nombre = $nombre;
	}
	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}
	public function setIdPregunta($idPregunta){
		$this->idPregunta = $idPregunta;
	}
	public function setRespuestas($respuestas){
		$this->respuestas = $respuestas;
	}
}