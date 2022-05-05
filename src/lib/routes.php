<?php

use Sebas\Cursos\controllers\HomeController;
use Sebas\Cursos\controllers\UsuarioController;
use Sebas\Cursos\controllers\ClienteController;
use Sebas\Cursos\controllers\CursoController;

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
	$controller = new HomeController();
	$controller->index();
});

$router->get('/inicio', function(){
	$controller = new HomeController();
	$controller->index();
});

$router->get('/catalogo', function(){
	$controller = new CursoController();
	$controller->catalogo();
});

$router->get('/registro', function(){
	auth();
	$controller = new UsuarioController();
	$controller->registro();
});


$router->post('/registrarse', function(){
	auth();
	$controller = new ClienteController();
	$controller->registrarse();
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
$router->run();