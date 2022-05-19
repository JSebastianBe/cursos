<?php

namespace Sebas\Cursos\models;

use	Sebas\Cursos\lib\Database;
use Sebas\Cursos\models\Usuario;
use PDO;
use PDOException;

class Cliente extends Usuario{

	private int $idCliente;
	private Array $pagos;
	private Array $cursos;
	private Array $avancesCurso =[];

	function __construct($nombre,$telefono,$correo){
		parent::__construct($correo,$nombre, $telefono);
		$this->cursos =[];
	}

	public function crear(){
		$this->perfil="Cliente";
		$this->usuario=$this->correo;
		try{
			$query = $this->prepare('INSERT INTO usuario (nombre, correo, telefono, usuario, perfil, clave) VALUES(:nombre, :correo, :telefono, :usuario, :perfil, :clave)');
			$query->execute([
				'nombre' => $this->nombre,
				'correo' => $this->correo,
				'telefono' => $this->telefono,
				'usuario' => $this->usuario,
				'perfil' => $this->perfil,
				'clave' => $this->clave,
			]);
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public static function get($usuario):Cliente{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idUsuario, nombre, correo, telefono, clave, perfil FROM usuario WHERE usuario = :usuario');
			$query->execute(['usuario' => $usuario]);
			$data = $query->fetch(PDO::FETCH_ASSOC);
			$cliente = new Cliente($data['nombre'],$data['telefono'],$data['correo']);
			$cliente->setIdUsuario($data['idUsuario']);
			$cliente->setIdCliente($data['idUsuario']);
			$cliente->setPerfil($data['perfil']);
			$cliente->setClave($data['clave']);
			$cliente->setUsuario($usuario);
			$cliente->setPagos(Pago::getByIdCliente($cliente->getIdCliente()));
			$cliente->setCursos($cliente->getCursosByPagos());
			$cliente->setAvancesCursos(AvanceCurso::getByIdCliente($cliente->getIdCliente()));
			return $cliente;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return NULL;
		}
	}

	public function getInscrito($idCurso){
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT idPago FROM pago WHERE idCurso = :idCurso AND idUsuario = :idUsuario;');
			$query->execute(['idCurso' => $idCurso,
							'idUsuario' => $this->idCliente]);
			if($query->rowCount()>0){
				return true;
			}else{
				return false;
			}
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public function getCursosByPagos():Array{
		$cursos = [];
		foreach($this->getPagos() as $p){
			$curso = Curso::getByIdCurso($p->getIdCurso());
			array_push($cursos, $curso);
		}
		return $cursos;
	}

	public function pagar($idCurso, $fecha_pago){
		try{
			$query = $this->prepare('UPDATE pago SET fecha_pago = :fecha_pago WHERE idUsuario = :idUsuario AND idCurso = :idCurso');
			$query->execute([
				'fecha_pago' => $fecha_pago, 
				'idUsuario' => $this->idCliente,
				'idCurso' => $idCurso,
			]);
			return true;
		}catch(PDOException $e){
			error_log($e->getMessage());
			return false;
		}
	}

	public function getPago($idCurso){
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT fecha_pago FROM pago WHERE idCurso = :idCurso AND idUsuario = :idUsuario;');
			$query->execute(['idCurso' => $idCurso,
							'idUsuario' => $this->idCliente]);
			if($query->rowCount()>0){
				$data = $query->fetch(PDO::FETCH_ASSOC);
				if(!is_null($data['fecha_pago'])){
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

	public function getProgreso($idCurso):float{
		try{
			$db = new Database();
			$query = $db->connect()->prepare('SELECT nvl(sum(al.visto)/count(al.visto),0)progreso FROM avanceleccion al INNER JOIN avancecurso ac ON al.idAvanceCurso=ac.idAvanceCurso INNER JOIN usuario u ON ac.idUsuario = u.idUsuario INNER JOIN curso c ON ac.idCurso = c.idCurso WHERE c.idCurso = :idCurso AND u.idUsuario = :idUsuario;');
			$query->execute(['idCurso' => $idCurso,
							'idUsuario' => $this->idCliente]);
			if($query->rowCount()>0){
				$data = $query->fetch(PDO::FETCH_ASSOC);
				return $data['progreso'];
			}else{
				return 0;
			}
		}catch(PDOException $e){
			error_log($e->getMessage());
			return 0;
		}
	}

	public function getAvanceCurso($idCurso):AvanceCurso{
		foreach ($this->avancesCurso as $avanceCurso) {
			if($avanceCurso->getIdCurso() == $idCurso){
				return $avanceCurso;
			}
		}
		return null;
	}

	public function getCursos(){
		return $this->cursos;
	}

	public function setCursos($cursos){
		$this->cursos = $cursos;
	}

	public function getPagos(){
		return $this->pagos;
	}

	public function setPagos($pagos){
		$this->pagos = $pagos;
	}

	public function getIdCliente(){
		return $this->idCliente;
	}

	public function setIdCliente($id){
		$this->idCliente=$id;
	}	

	public function getAvancesCursos(){
		return $this->avancesCurso[0];
	}

	public function setAvancesCursos($avancesCurso){
		$this->avancesCurso=$avancesCurso;
	}	
}