<?php

use Sebas\Cursos\controllers\HomeController;
use Sebas\Cursos\controllers\UsuarioController;
use Sebas\Cursos\controllers\ClienteController;
use Sebas\Cursos\controllers\CursoController;
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

function auth($perfil=""){
	if(isset($_SESSION['usuario'])){
		if(unserialize($_SESSION['usuario'])->getPerfil()=="Administrador"){

		}else{
			header('location: /Cursos/inicio');
			exit();
		}
		
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

$router->post('/registrarUsuario', function(){
	auth();
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
	auth();
	$controller = new AdministradorController();
	$controller->modificaUsuario();
});

$router->post('/modificarUsuario', function(){
	auth();
	$controller = new AdministradorController();
	$controller->modificarUsuario();
});


$router->run();