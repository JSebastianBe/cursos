<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\lib\Model;
use PDO;
use PDOException;

class AvanceCurso extends Model{

	private int $idAvanceCurso;
	private int $idUsuario;
	private int $idCurso;
	private Array $avancesLeccion = [];

	function __construct(){
		parent::__construct();
	}

	public function crea(){
		try{
			$query = $this->prepare('INSERT INTO avanceCurso (idUsuario, idCurso) VALUES(:idUsuario, :idCurso)');
			$query->execute([
				'idUsuario' => $this->idUsuario,
				'idCurso' => $this->idCurso,
			]);
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public static function get($idUsuario, $idCurso):AvanceCurso{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idAvanceCurso, idUsuario, idCurso FROM avanceCurso WHERE idUsuario = :idUsuario AND idCurso = :idCurso');
			$query->execute([
				'idUsuario' => $idUsuario,
				'idCurso' => $idCurso,
			]);
			$data = $query->fetch(PDO::FETCH_ASSOC);

			$avanceCurso = new AvanceCurso();
			$avanceCurso->setIdAvanceCurso($data['idAvanceCurso']);
			$avanceCurso->setIdUsuario($data['idUsuario']);
			$avanceCurso->setIdCurso($data['idCurso']);
			$avanceCurso->setAvancesLeccion(AvanceLeccion::getByIdAvanceCurso($avanceCurso->getIdAvanceCurso()));
			return $avanceCurso;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}

	public static function getByIdCliente($idCliente):Array{
		$avancesCurso=[];
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idAvanceCurso, idUsuario, idCurso FROM avanceCurso WHERE idUsuario = :idUsuario');
			$query->execute(['idUsuario' => $idCliente]);
			while($a = $query->fetch(PDO::FETCH_ASSOC)){
				$avanceCurso = new AvanceCurso();
				$avanceCurso->setIdAvanceCurso($a['idAvanceCurso']);
				$avanceCurso->setIdUsuario($a['idUsuario']);
				$avanceCurso->setIdCurso($a['idCurso']);
				$avanceCurso->setAvancesLeccion(AvanceLeccion::getByIdAvanceCurso($avanceCurso->getIdAvanceCurso()));
				array_push($avancesCurso, $avanceCurso);
			}
			return $avancesCurso;	
		}catch(PDOException $e){
			error_log($e->getMessage());
			return [];
		}
	}

	public function getAvanceLeccion($idLeccion):AvanceLeccion{
		foreach ($this->avancesLeccion as $avanceLeccion) {
			if($avanceLeccion->getIdLeccion() == $idLeccion){
				return $avanceLeccion;
			}
		}
		return null;
	}

	public function getIdAvanceCurso(){
		return $this->idAvanceCurso;
	}
	public function getIdUsuario(){
		return $this->idUsuario;
	}
	public function getIdCurso(){
		return $this->idCurso;
	}

	public function getAvancesLeccion(){
		return $this->avancesLeccion;
	}
	
	public function setIdAvanceCurso($idAvanceCurso){
		$this->idAvanceCurso = $idAvanceCurso;
	}
	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}
	public function setIdCurso($idCurso){
		$this->idCurso = $idCurso;
	}

	public function setAvancesLeccion($avancesLeccion){
		$this->avancesLeccion = $avancesLeccion;
	}
}