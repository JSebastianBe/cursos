<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\lib\Model;
use PDO;
use PDOException;

class Leccion extends Model{

	private int $idLeccion;
	private string $capitulo;
	private string $titulo;
	private string $objetivo;
	private string $teoria;
	private string $video;
	private string $ejercicio;
	private int $orden;
	private int $idCurso;
	private Array $materiales = [];
	private Array $preguntas = [];

	function __construct(){
		parent::__construct();
	}

	public function crea(){
		try{
			$query = $this->prepare('INSERT INTO leccion (capitulo, titulo, objetivo, teoria, video, ejercicio, orden, idCurso) VALUES(:capitulo, :titulo, :objetivo, :teoria, :video, :ejercicio, :orden, :idCurso)');
			$query->execute([
				'capitulo' => $this->capitulo, 
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

	public function modifica(){
		try{
			if($this->titulo == ""){
				$query = $this->prepare('UPDATE leccion SET 
						objetivo = :objetivo,
						teoria = :teoria,
						video = :video,
						ejercicio = :ejercicio,
						orden = :orden,
						idCurso = :idCurso
					WHERE idLeccion = :idLeccion;');
				$query->execute([
					'objetivo' => $this->objetivo, 
					'teoria' => $this->teoria, 
					'video' => $this->video, 
					'ejercicio' => $this->ejercicio, 
					'orden' => $this->orden, 
					'idCurso' => $this->idCurso,
					'idLeccion' => $this->idLeccion,
				]);
			}else{
				$query = $this->prepare('UPDATE leccion SET 	titulo = :titulo,
						objetivo = :objetivo,
						teoria = :teoria,
						video = :video,
						ejercicio = :ejercicio,
						orden = :orden,
						idCurso = :idCurso
					WHERE idLeccion = :idLeccion;');
				$query->execute([
					'titulo' => $this->titulo, 
					'objetivo' => $this->objetivo, 
					'teoria' => $this->teoria, 
					'video' => $this->video, 
					'ejercicio' => $this->ejercicio, 
					'orden' => $this->orden, 
					'idCurso' => $this->idCurso,
					'idLeccion' => $this->idLeccion,
				]);
			}	
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public static function getByIdCurso($idCurso):Array{
		$lecciones=[];
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idLeccion, capitulo, titulo, objetivo, teoria, video, ejercicio, orden, idCurso FROM leccion WHERE idCurso = :idCurso ORDER BY orden ASC');
			$query->execute(['idCurso' => $idCurso]);
			while($c = $query->fetch(PDO::FETCH_ASSOC)){
				$leccion = new Leccion();
				$leccion->setIdLeccion($c['idLeccion']);
				$leccion->setCapitulo($c['capitulo']);
				$leccion->setTitulo($c['titulo']);
				$leccion->setObjetivo($c['objetivo']);
				$leccion->setTeoria($c['teoria']);
				$leccion->setVideo($c['video']);
				$leccion->setEjercicio($c['ejercicio']);
				$leccion->setOrden($c['orden']);
				$leccion->setIdCurso($c['idCurso']);
				$leccion->setMateriales(Material::getByIdLeccion($leccion->getIdLeccion()));
				$leccion->setPreguntas(Pregunta::getByIdLeccion($leccion->getIdLeccion()));
				array_push($lecciones, $leccion);
			}
			return $lecciones;	
		}catch(PDOException $e){
			error_log($e->getMessage());
			return [];
		}
	}


	public static function getByIdLeccion($idLeccion):Leccion{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idLeccion, capitulo, titulo, objetivo, teoria, video, ejercicio, orden, idCurso FROM leccion WHERE idLeccion = :idLeccion');
			$query->execute(['idLeccion' => $idLeccion]);
			$data = $query->fetch(PDO::FETCH_ASSOC);
			$leccion = new Leccion();
			$leccion->setIdLeccion($data['idLeccion']);
			$leccion->setCapitulo($data['capitulo']);
			$leccion->setTitulo($data['titulo']);
			$leccion->setObjetivo($data['objetivo']);
			$leccion->setTeoria($data['teoria']);
			$leccion->setVideo($data['video']);
			$leccion->setEjercicio($data['ejercicio']);
			$leccion->setOrden($data['orden']);
			$leccion->setIdCurso($data['idCurso']);
			$leccion->setMateriales(Material::getByIdLeccion($leccion->getIdLeccion()));
			$leccion->setPreguntas(Pregunta::getByIdLeccion($leccion->getIdLeccion()));
			return $leccion;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}

	public function habilitaLeccion($idCliente):int{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT al.visto visto FROM avanceleccion al INNER JOIN avancecurso ac ON al.idAvanceCurso=ac.idAvanceCurso INNER JOIN usuario u ON ac.idUsuario = u.idUsuario INNER JOIN leccion l ON al.idLeccion = l.idLeccion INNER JOIN curso c ON ac.idCurso = c.idCurso WHERE c.idCurso = :idCurso AND u.idUsuario = :idUsuario AND l.idLeccion = :idLeccion;');
			$query->execute(['idCurso' => $this->idCurso,
							 'idUsuario' => $idCliente,
							'idLeccion' => $this->idLeccion]);
			if($query->rowCount()>0){
				$data = $query->fetch(PDO::FETCH_ASSOC);
				return $data['visto'];
			}else{
				return 0;
			}
		}catch(PDOException $e){
			error_log($e->getMessage());
			return 0;
		}
	}

	public function leccionActual($idCliente){
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT min(l.idLeccion) idLeccion FROM avanceleccion al INNER JOIN avancecurso ac ON al.idAvanceCurso=ac.idAvanceCurso INNER JOIN usuario u ON ac.idUsuario = u.idUsuario INNER JOIN leccion l ON al.idLeccion = l.idLeccion INNER JOIN curso c ON ac.idCurso = c.idCurso WHERE c.idCurso = :idCurso AND u.idUsuario = :idUsuario AND al.visto = 0;');
			$query->execute(['idCurso' => $this->idCurso,
							 'idUsuario' => $idCliente]);
			if($query->rowCount()>0){
				$data = $query->fetch(PDO::FETCH_ASSOC);
				if($this->idLeccion == $data['idLeccion']){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public function getCurso():Curso{
		return Curso::getByIdCurso($this->idCurso);
	}

	public function getIdLeccion(){
		return $this->idLeccion;
	}
	public function getCapitulo(){
		return $this->capitulo;
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

	public function getMateriales(){
		return $this->materiales;
	}

	public function getPreguntas(){
		return $this->preguntas;
	}

	public function setIdLeccion($idLeccion){
		$this->idLeccion = $idLeccion;
	}
	public function setCapitulo($capitulo){
		$this->capitulo = $capitulo;
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

	public function setMateriales($materiales){
		$this->materiales = $materiales;
	}

	public function setPreguntas($preguntas){
		$this->preguntas = $preguntas;
	}

	public function getCantidadPreguntas(){
		return count($this->preguntas);
	}

}