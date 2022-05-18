<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\lib\Model;
use PDO;
use PDOException;

class AvanceLeccion extends Model{

	private int $idAvanceLeccion;
	private int $visto;
	private int $idLeccion;
	private int $idAvanceCurso;

	function __construct(){
		parent::__construct();
	}

	public function crea(){
		try{
			$query = $this->prepare('INSERT INTO avanceLeccion (visto, idLeccion, idAvanceCurso) VALUES(:visto, :idLeccion, :idAvanceCurso)');
			$query->execute([
				'visto' => $this->visto,
				'idLeccion' => $this->idLeccion,
				'idAvanceCurso' => $this->idAvanceCurso,
			]);
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}
	public function getIdAvanceLeccion(){
		return $this->idAvanceLeccion;
	}
	public function getVisto(){
		return $this->visto;
	}	
	public function getIdLeccion(){
		return $this->idLeccion;
	}
	public function getIdAvanceCurso(){
		return $this->idAvanceCurso;
	}
	
	public function setIdAvanceLeccion($idAvanceLeccion){
		$this->idAvanceLeccion = $idAvanceLeccion;
	}
	public function setVisto($visto){
		$this->visto = $visto;
	}		
	public function setIdLeccion($idLeccion){
		$this->idLeccion = $idLeccion;
	}
	public function setIdAvanceCurso($idAvanceCurso){
		$this->idAvanceCurso = $idAvanceCurso;
	}
}