<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;
use Sebas\Cursos\models\Leccion;
use Sebas\Cursos\models\Material;
use Sebas\Cursos\lib\UtilResources;

class MaterialController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function detalleMaterial(){
		$id = $this->get('id');
		$leccion = Leccion::getByIdLeccion($id);
		$this->render('leccion/detalle',['leccion'=>$leccion]);
	}

	public function modificaMaterial(){
		$id = $this->get('id');
		$material = Material::getByIdMaterial($id);
		$this->render('material/registro',['materialModificar'=>$material]);
	}

	public function agregaMaterial(){
		$idLeccion = $this->get('id');
		$leccion = Leccion::getByIdLeccion($idLeccion);
		$this->render('Material/registro', ['leccion'=> $leccion]);
	}

	public function agregarMaterial(){
		$idLeccion = $this->post('idLeccion');
		$nombre = $this->post('nombre');
		$archivo = $this->file('archivo');
		if(	!is_null($idLeccion) &&
			!is_null($nombre) &&
			!is_null($archivo)){
			$archivo = UtilResources::storeFile($archivo);
			$material = new Material();
			$Leccion = Leccion::getByIdLeccion($idLeccion);
			$material->setidLeccion($idLeccion);
			$material->setNombre($nombre);
			$material->setArchivo($archivo);
			if($material->crea()){
				$notificacion = [
				    "mensaje" => "Material ". $nombre." registrado correctamente",
				    "error" => FALSE,
				];
				$this->listar(['notificacion' => $notificacion], ['idLeccion' => $idLeccion]);
			}else{
				$notificacion = [
			    "mensaje" => "Ocurrió un error al registrar el material",
			    "error" => TRUE,
				];
				$this->render('Material/registro',['notificacion' => $notificacion]);
			}
		}else{
			$notificacion = [
			    "mensaje" => "Complete todos los campos..",
			    "error" => TRUE,
			];
			$this->render('Material/registro',['notificacion' => $notificacion]);
		}
	}

	public function listar(array $notificacion = [], array $id = []){
		$perfil = unserialize($_SESSION['usuario'])->getPerfil();
		if($perfil == 'Administrador' || $perfil == 'Asistente'){
			if(isset($id['idLeccion'])){
				$idLeccion = $id['idLeccion'];
			}else{
				$idLeccion = $this->get('id');	
			}
			
			$leccion = Leccion::getByIdLeccion($idLeccion);
			$data = array_merge(['leccion' => $leccion], $notificacion);
			$this->render('Material/listar',$data);
		}else{
			error_log('No tiene permisos');
			$notificacion = [
			    "mensaje" => "No tiene permisos para entrar a ese módulo",
			    "error" => TRUE,
			];
			$this->render('/',['notificacion' => $notificacion]);
		}
		
	}

	public function modificarMaterial(){
		$idLeccion = $this->post('idLeccion'); 
		$idMaterial = $this->post('idMaterial');
		$nombre = $this->post('nombre');
		$archivo = $this->file('archivo');
		if(	!is_null($idLeccion) &&
			!is_null($nombre) &&
			!is_null($idLeccion)){
			$material = Material::getByIdMaterial($idMaterial);
			if($archivo["name"] != ""){
				$archivo = UtilResources::storeFile($archivo);
			}else{
				$archivo = $material->getArchivo();
			}
			$material->setIdLeccion($idLeccion);
			$material->setNombre($nombre);
			if($material->modifica()){
				$notificacion = [
				    "mensaje" => "Material ". $nombre." modificado correctamente",
				    "error" => FALSE,
				];
				$this->listar(['notificacion' => $notificacion], ['idLeccion' => $idLeccion]);
			}else{
				$notificacion = [
			    "mensaje" => "Ocurrió un error al actualizar el material",
			    "error" => TRUE,
				];
				$this->render('Leccion/registro',['notificacion' => $notificacion]);
			}
		}else{
			$notificacion = [
			    "mensaje" => "Complete todos los campos..",
			    "error" => TRUE,
			];
			$this->render('Leccion/registro',['notificacion' => $notificacion]);
		}
	}
}