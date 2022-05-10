<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\lib\Model;
use Sebas\Cursos\models\Leccion;
use PDO;
use PDOException;

class Curso extends Model{

	private int $idCurso;
	private string $nombre;
	private float $precio;
	private string $descripcionCorta;
	private string $descripcionLarga;
	private int $duracion;
	private string $profesor;
	private string $imagen;
	private string $videoIntroduc;
	private Array $lecciones = [];

	function __construct(){
		parent::__construct();
		$lecciones = [];
	}

	public static function retornaCursos(){
		$cursos=[];
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idCurso, nombre, precio, descripcionCorta, descripcionLarga, duracion, profesor, imagen, videoIntroduc FROM curso ORDER BY idCurso ASC');
			$query->execute();
			while($c = $query->fetch(PDO::FETCH_ASSOC)){
				$curso = new Curso();
				$curso->setIdCurso($c['idCurso']);
				$curso->setNombre($c['nombre']);
				$curso->setPrecio($c['precio']);
				$curso->setDescripcionCorta($c['descripcionCorta']);
				$curso->setDescripcionLarga($c['descripcionLarga']);
				$curso->setDuracion($c['duracion']);
				$curso->setProfesor($c['profesor']);
				$curso->setImagen($c['imagen']);
				$curso->setVideoIntroduc($c['videoIntroduc']);
				$curso->setLeccion(Leccion::getByIdCurso($curso->getIdCurso()));
				array_push($cursos, $curso);
			}
			return $cursos;	
		}catch(PDOException $e){
			error_log($e->getMessage());
			return [];
		}
	}

	public function crea(){
		try{
			$query = $this->prepare('INSERT INTO curso (nombre, precio, descripcionCorta, descripcionLarga, duracion, profesor, imagen, videoIntroduc) VALUES(:nombre, :precio, :descripcionCorta, :descripcionLarga, :duracion, :profesor, :imagen, :videoIntroduc)');
			$query->execute([
				'nombre' => $this->nombre, 
				'precio' => $this->precio, 
				'descripcionCorta' => $this->descripcionCorta, 
				'descripcionLarga' => $this->descripcionLarga, 
				'duracion' => $this->duracion, 
				'profesor' => $this->profesor, 
				'imagen' => $this->imagen, 
				'videoIntroduc' => $this->videoIntroduc,
			]);
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public function modifica(){
		try{
			$query = $this->prepare('UPDATE curso SET nombre = :nombre,
					precio = :precio,
					descripcionCorta = :descripcionCorta,
					descripcionLarga = :descripcionLarga,
					duracion = :duracion,
					profesor = :profesor,
					imagen = :imagen,
					videoIntroduc = :videoIntroduc
					WHERE idCurso = :idCurso;');
			$query->execute([
				'nombre' => $this->nombre, 
				'precio' => $this->precio, 
				'descripcionCorta' => $this->descripcionCorta, 
				'descripcionLarga' => $this->descripcionLarga, 
				'duracion' => $this->duracion, 
				'profesor' => $this->profesor, 
				'imagen' => $this->imagen, 
				'videoIntroduc' => $this->videoIntroduc,
				'idCurso' => $this->idCurso,
			]);
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public static function get($nombre):Curso{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idCurso, nombre, precio, descripcionCorta, descripcionLarga, duracion, profesor, imagen, videoIntroduc FROM curso WHERE nombre = :nombre');
			$query->execute(['nombre' => $nombre]);
			$data = $query->fetch(PDO::FETCH_ASSOC);

			$curso = new Curso();
			$curso->setIdCurso($data['idCurso']);
			$curso->setNombre($data['nombre']);
			$curso->setPrecio($data['precio']);
			$curso->setDescripcionCorta($data['descripcionCorta']);
			$curso->setDescripcionLarga($data['descripcionLarga']);
			$curso->setDuracion($data['duracion']);
			$curso->setProfesor($data['profesor']);
			$curso->setImagen($data['imagen']);
			$curso->setVideoIntroduc($data['videoIntroduc']);
			$curso->setLeccion(Leccion::getByIdCurso($curso->getIdCurso()));
			return $curso;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}

	public static function getByIdCurso($idCurso):Curso{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idCurso, nombre, precio, descripcionCorta, descripcionLarga, duracion, profesor, imagen, videoIntroduc FROM curso WHERE idCurso = :idCurso');
			$query->execute(['idCurso' => $idCurso]);
			$data = $query->fetch(PDO::FETCH_ASSOC);

			$curso = new Curso();
			$curso->setIdCurso($data['idCurso']);
			$curso->setNombre($data['nombre']);
			$curso->setPrecio($data['precio']);
			$curso->setDescripcionCorta($data['descripcionCorta']);
			$curso->setDescripcionLarga($data['descripcionLarga']);
			$curso->setDuracion($data['duracion']);
			$curso->setProfesor($data['profesor']);
			$curso->setImagen($data['imagen']);
			$curso->setVideoIntroduc($data['videoIntroduc']);
			$curso->setLeccion(Leccion::getByIdCurso($curso->getIdCurso()));
			return $curso;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}

	public function getIdCurso(){
		return $this->idCurso;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function getPrecio(){
		return $this->precio;
	}

	public function getDescripcionCorta(){
		return $this->descripcionCorta;
	}

	public function getDescripcionLarga(){
		return $this->descripcionLarga;
	}

	public function getDuracion(){
		return $this->duracion;
	}

	public function getProfesor(){
		return $this->profesor;
	}

	public function getImagen(){
		return $this->imagen;
	}

	public function getVideoIntroduc(){
		return $this->videoIntroduc;
	}

	public function getLecciones(){
		return $this->lecciones[0];
	}

	public function getCantidadLecciones(){
		return count($this->lecciones[0]);
	}


	public function setIdCurso($idCurso){
		$this->idCurso = $idCurso;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function setPrecio($precio){
		$this->precio = $precio;
	}

	public function setDescripcionCorta($descripcionCorta){
		$this->descripcionCorta = $descripcionCorta;
	}

	public function setDescripcionLarga($descripcionLarga){
		$this->descripcionLarga = $descripcionLarga;
	}

	public function setDuracion($duracion){
		$this->duracion = $duracion;
	}

	public function setProfesor($profesor){
		$this->profesor = $profesor;
	}

	public function setImagen($imagen){
		$this->imagen = $imagen;
	}

	public function setVideoIntroduc($videoIntroduc){
		$this->videoIntroduc = $videoIntroduc;
	}

	public function setLeccion($leccion){
		array_push($this->lecciones,$leccion);
	}

	public function setLecciones($lecciones){
		$this->lecciones = $lecciones;
	}
}