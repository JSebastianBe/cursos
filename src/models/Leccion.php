<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\lib\Model;
use PDO;
use PDOException;

class Leccion extends Model{

	private int $idLeccion;
	private string $titulo;
	private string $objetivo;
	private string $teoria;
	private string $video;
	private string $ejercicio;
	private int $orden;
	private int $idCurso;

	function __construct(){
		parent::__construct();
	}

	public function crea(){
		try{
			$query = $this->prepare('INSERT INTO leccion (titulo, objetivo, teoria, video, ejercicio, orden, idCurso) VALUES(:titulo, :objetivo, :teoria, :video, :ejercicio, :orden, :idCurso)');
			$query->execute([
				'titulo' => $this->titulo, 
				'objetivo' => $this->objetivo, 
				'teoria' => $this->teoria, 
				'video' => $this->video, 
				'ejercicio' => $this->ejercicio, 
				'orden' => $this->orden, 
				'idCurso' => $this->idCurso,
			]);
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public function getIdLeccion(){
		return $this->idLeccion;
	}
	public function getTitulo(){
		return $this->titulo;
	}
	public function getObjetivo(){
		return $this->objetivo;
	}
	public function getTeoria(){
		return $this->teoria;
	}
	public function getVideo(){
		return $this->video;
	}
	public function getEjercicio(){
		return $this->ejercicio;
	}
	public function getOrden(){
		return $this->orden;
	}	
	public function getIdCurso(){
		return $this->idCurso;
	}

	public function setIdLeccion($idLeccion){
		$this->idLeccion = $idLeccion;
	}
	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}
	public function setObjetivo($objetivo){
		$this->objetivo = $objetivo;
	}
	public function setTeoria($teoria){
		$this->teoria = $teoria;
	}
	public function setVideo($video){
		$this->video = $video;
	}
	public function setEjercicio($ejercicio){
		$this->ejercicio = $ejercicio;
	}
	public function setOrden($orden){
		$this->orden = $orden;
	}
	public function setIdCurso($idCurso){
		$this->idCurso = $idCurso;
	}








}