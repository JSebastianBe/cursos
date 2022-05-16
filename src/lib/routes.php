<?php

use Sebas\Cursos\controllers\HomeController;
use Sebas\Cursos\controllers\UsuarioController;
use Sebas\Cursos\controllers\ClienteController;
use Sebas\Cursos\controllers\CursoController;
use Sebas\Cursos\controllers\LeccionController;
use Sebas\Cursos\controllers\MaterialController;
use Sebas\Cursos\controllers\AdministradorController;

$router = new \Bramus\Router\Router();
session_start();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../config/');
$dotenv->load();

function noAuth(){
	if(!isset($_SESSION['usuario'])){
		header('location: /Cursos/iniciarSesion');
		exit();
	}
}

function auth(){
	if(isset($_SESSION['usuario'])){
		header('location: /Cursos/inicio');
		exit();
	}
}

$router->get('/', function(){
	$controller = new CursoController();
	$controller->catalogo();
});

$router->get('/inicio', function(){
	$controller = new CursoController();
	$controller->catalogo();
});

$router->get('/catalogo', function(){
	$controller = new CursoController();
	$controller->catalogo();
});

$router->get('/detalleCurso', function(){
	$controller = new CursoController();
	$controller->detalleCurso();
});

$router->get('/detalleLecciones', function(){
	noAuth();
	$controller = new LeccionController();
	$controller->detalleLecciones();
});


$router->get('/listarMaterial', function(){
	noAuth();
	$controller = new MaterialController();
	$controller->listar();
});


$router->get('/listarLecciones', function(){
	noAuth();
	$controller = new LeccionController();
	$controller->listar();
});

$router->get('/creaLecciones', function(){
	noAuth();
	$controller = new LeccionController();
	$controller->agregaLeccion();
});

$router->post('/crearLeccion', function(){
	noAuth();
	$controller = new LeccionController();
	$controller->agregarLeccion();
});

$router->get('/modificaLeccion', function(){
	noAuth();
	$controller = new LeccionController();
	$controller->modificaLeccion();
});

$router->post('/modificarLeccion', function(){
	noAuth();
	$controller = new LeccionController();
	$controller->modificarLeccion();
});

$router->get('/modificaCurso', function(){
	noAuth();
	$controller = new CursoController();
	$controller->modificaCurso();
});

$router->post('/modificarCurso', function(){
	noAuth();
	$controller = new CursoController();
	$controller->modificarCurso();
});



$router->get('/registro', function(){
	//auth();
	$controller = new UsuarioController();
	$controller->registro();
});


$router->post('/registrarse', function(){
	auth();
	$controller = new ClienteController();
	$controller->registrarse();
});

$router->post('/registrarUsuario', function(){
	noAuth();
	$controller = new AdministradorController();
	$controller->registrarUsuario();
});


$router->get('/iniciarSesion', function(){
	auth();
	$controller = new UsuarioController();
	$controller->iniciarSesion();
});

$router->post('/inicioSesion', function(){
	auth();
	$controller = new UsuarioController;
	$controller->inicioSesion();
});

$router->get('/cerrarSesion', function(){
	noAuth();
	$controller = new UsuarioController;
	$controller->cerrarSesion();
});

$router->get('/listarUsuarios', function(){
	noAuth();
	$controller = new AdministradorController;
	$controller->listar();
});

$router->get('/modificaUsuario', function(){
	noAuth();
	$controller = new AdministradorController();
	$controller->modificaUsuario();
});

$router->post('/modificarUsuario', function(){
	noAuth();
	$controller = new AdministradorController();
	$controller->modificarUsuario();
});

$router->get('/listarCursos', function(){
	noAuth();
	$controller = new CursoController();
	$controller->listar();
});

$router->get('/crearCursos', function(){
	noAuth();
	$controller = new CursoController();
	$controller->agregarCruso();
});

$router->post('/creaCurso', function(){
	noAuth();
	$controller = new CursoController();
	$controller->creaCurso();
});

$router->run();