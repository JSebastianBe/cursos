<?php

use Sebas\Cursos\controllers\HomeController;
use Sebas\Cursos\controllers\UsuarioController;
use Sebas\Cursos\controllers\ClienteController;
/*
use Sebas\Cursos\controllers\Signup;
use Sebas\Cursos\controllers\Login;

use Sebas\Cursos\controllers\Action;
use Sebas\Cursos\controllers\Profile;*/

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
		header('location: /Cursos/home');
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

$router->run();