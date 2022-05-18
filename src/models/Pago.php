<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\lib\Model;
use PDO;
use PDOException;

class Pago extends Model{

	private int $idPago;
	private string $fecha_inscrip;
	private string $fecha_pago;
	private float $valor;
	private string $estado;
	private int $idUsuario;
	private int $idCurso;

	function __construct(){
		parent::__construct();
	}

	public function registrar(){
		try{
			$query = $this->prepare('INSERT INTO pago (fecha_inscrip, valor, estado, idUsuario, idCurso) VALUES(:fecha_inscrip, :valor, :estado, :idUsuario, :idCurso)');
			$query->execute([
				'fecha_inscrip' => $this->fecha_inscrip, 
				'valor' => $this->valor, 
				'estado' => $this->estado,
				'idUsuario' => $this->idUsuario,
				'idCurso' => $this->idCurso,
			]);
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public function pagar(){
		try{
			$query = $this->prepare('UPDATE pago SET fecha_pago = :fecha_pago WHERE idUsuario = :idUsuario AND idCurso = :idCurso');
			$query->execute([
				'fecha_pago' => $this->fecha_pago, 
				'idUsuario' => $this->idUsuario,
				'idCurso' => $this->idCurso,
			]);
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}
	
	public function getIdPago(){
		return $this->idPago;
	}
	public function getFecha_pago(){
		return $this->fecha_pago;
	}	
	public function getFecha_inscrip(){
		return $this->fecha_inscrip;
	}
	public function getValor(){
		return $this->valor;
	}
	public function getEstado(){
		return $this->estado;
	}
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	public function getIdCurso(){
		return $this->idCurso;
	}
	
	public function setIdPago($idPago){
		$this->idPago = $idPago;
	}
	public function setFecha_pago($fecha_pago){
		$this->fecha_pago = $fecha_pago;
	}
	public function setFecha_inscrip($fecha_inscrip){
		$this->fecha_inscrip = $fecha_inscrip;
	}
	public function setValor($valor){
		$this->valor = $valor;
	}
	public function setEstado($estado){
		$this->estado = $estado;
	}
	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}
	public function setIdCurso($idCurso){
		$this->idCurso = $idCurso;
	}
}