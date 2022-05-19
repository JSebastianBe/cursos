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