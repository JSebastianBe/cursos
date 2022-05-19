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
	private Array $evaluaciones =[];

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

	public static function get($idUsuario, $idLeccion):AvanceLeccion{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT al.idAvanceLeccion, al.visto, al.idLeccion, al.idAvanceCurso FROM avanceleccion al INNER JOIN avancecurso ac ON al.idAvanceCurso = ac.idAvanceCurso INNER JOIN usuario u ON ac.idUsuario = u.idUsuario WHERE al.idLeccion = :idLeccion AND u.idUsuario = :idUsuario;');
			$query->execute([
				'idUsuario' => $idUsuario,
				'idLeccion' => $idLeccion,
			]);
			$data = $query->fetch(PDO::FETCH_ASSOC);

			$avanceLeccion = new AvanceLeccion();
			$avanceLeccion->setIdAvanceLeccion($data['idAvanceLeccion']);
			$avanceLeccion->setVisto($data['visto']);
			$avanceLeccion->setIdAvanceCurso($data['idAvanceCurso']);
			$avanceLeccion->setIdLeccion($data['idLeccion']);
			$avanceLeccion->setEvaluaciones(Evaluacion::getByIdAvanceLeccion($avanceLeccion->getIdAvanceLeccion()));
			return $avanceLeccion;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}

	public static function getByIdAvanceCurso($idAvanceCurso):Array{
		$avancesLeccion=[];
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idAvanceLeccion, visto, idLeccion, idAvanceCurso FROM avanceleccion WHERE idAvanceCurso = :idAvanceCurso;');
			$query->execute(['idAvanceCurso' => $idAvanceCurso]);
			while($c = $query->fetch(PDO::FETCH_ASSOC)){
				$avanceLeccion = new AvanceLeccion();
				$avanceLeccion->setIdAvanceLeccion($c['idAvanceLeccion']);
				$avanceLeccion->setVisto($c['visto']);
				$avanceLeccion->setIdAvanceCurso($c['idAvanceCurso']);
				$avanceLeccion->setIdLeccion($c['idLeccion']);
				$avanceLeccion->setEvaluaciones(Evaluacion::getByIdAvanceLeccion($avanceLeccion->getIdAvanceLeccion()));
				array_push($avancesLeccion, $avanceLeccion);
			}
			return $avancesLeccion;	
		}catch(PDOException $e){
			error_log($e->getMessage());
			return [];
		}
	}

	public function getRespuesta($idRespuesta){
		foreach ($this->evaluaciones as $evaluacion) {
			if($evaluacion->getIdRespuesta() == $idRespuesta){
				return $evaluacion;
			}
		}
		return NULL;
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
	public function getEvaluaciones(){
		return $this->evaluaciones;
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
	public function setEvaluaciones($evaluaciones){
		if(is_null($evaluaciones)){
			$this->evaluaciones = [];
		}else{
			$this->evaluaciones = $evaluaciones;
		}
	}
}