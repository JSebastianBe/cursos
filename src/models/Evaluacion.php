<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\lib\Model;
use PDO;
use PDOException;

class Evaluacion extends Model{
	private int $idEvaluacion;
	private string $fecha;
	private int $correcta;
	private int $idRespuesta;
	private int $idAvanceLeccion;

	function __construct(){
		parent::__construct();
	}

	public function registrar(){
		try{
			$query = $this->prepare('INSERT INTO evaluacion (fecha, correcta, idRespuesta, idAvanceLeccion) VALUES(:fecha, :correcta, :idRespuesta, :idAvanceLeccion)');
			$query->execute([
				'fecha' => $this->fecha, 
				'correcta' => $this->correcta, 
				'idRespuesta' => $this->idRespuesta,
				'idAvanceLeccion' => $this->idAvanceLeccion,
			]);
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public static function get($idRespuesta, $idAvanceLeccion):AvanceCurso{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idEvaluacion, fecha, correcta, idRespuesta, idAvanceLeccion FROM evaluacion WHERE idRespuesta = :idRespuesta AND idAvanceLeccion = :idAvanceLeccion');
			$query->execute([
				'idRespuesta' => $idRespuesta,
				'idAvanceLeccion' => $idAvanceLeccion,
			]);
			$data = $query->fetch(PDO::FETCH_ASSOC);
			if($query->rowCount()>0){
				$evaluacion = new Evaluacion();
				$evaluacion->setIdEvaluacion($data['idEvaluacion']);
				$evaluacion->setFecha($data['fecha']);
				$evaluacion->setCorrecta($data['correcta']);
				$evaluacion->setIdRespuesta($data['idRespuesta']);
				$evaluacion->setIdAvanceLeccion($data['idAvanceLeccion']);
				return $evaluacion;
			}else{
				return NULL;
			}
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}

	public static function getByIdAvanceLeccion($idAvanceLeccion):Array{
		$evaluaciones=[];
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idEvaluacion, fecha, correcta, idRespuesta, idAvanceLeccion FROM evaluacion WHERE idAvanceLeccion = :idAvanceLeccion ORDER BY fecha DESC');
			$query->execute([
				'idAvanceLeccion' => $idAvanceLeccion,
			]);
			while($c = $query->fetch(PDO::FETCH_ASSOC)){
				$evaluacion = new evaluacion();
				$evaluacion->setIdEvaluacion($c['idEvaluacion']);
				$evaluacion->setFecha($c['fecha']);
				$evaluacion->setCorrecta($c['correcta']);
				$evaluacion->setIdRespuesta($c['idRespuesta']);
				$evaluacion->setIdAvanceLeccion($c['idAvanceLeccion']);
				array_push($evaluaciones, $evaluacion);
			}
			return $evaluaciones;	
		}catch(PDOException $e){
			error_log($e->getMessage());
			var_dump("chao");
			return [];
		}
	}

	public function getIdEvaluacion(){
		return $this->idEvaluacion;	
	} 
	public function getFecha(){
		return $this->fecha;	
	} 
	public function getCorrecta(){
		return $this->correcta;	
	} 
	public function getIdRespuesta(){
		return $this->idRespuesta;	
	} 
	public function getIdAvanceLeccion(){
		return $this->idAvanceLeccion;	
	} 


	public function setIdEvaluacion($idEvaluacion){
		$this->idEvaluacion = $idEvaluacion;	
	} 
	public function setFecha($fecha){
		$this->fecha = $fecha;	
	} 
	public function setCorrecta($correcta){
		$this->correcta = $correcta;	
	} 
	public function setIdRespuesta($idRespuesta){
		$this->idRespuesta = $idRespuesta;	
	} 
	public function setIdAvanceLeccion($idAvanceLeccion){
		$this->idAvanceLeccion = $idAvanceLeccion;	
	} 
}