<?php

use Sebas\Cursos\controllers\HomeController;
use Sebas\Cursos\controllers\UsuarioController;
use Sebas\Cursos\controllers\ClienteController;
use Sebas\Cursos\controllers\CursoController;
use Sebas\Cursos\controllers\LeccionController;
use Sebas\Cursos\controllers\MaterialController;
use Sebas\Cursos\controllers\PreguntaController;
use Sebas\Cursos\controllers\RespuestaController;
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

/*BEGIN Usuario*/
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
/*END Usuario*/

/*BEGIN Cursos */
$router->get('/catalogo', function(){
	$controller = new CursoController();
	$controller->catalogo();
});

$router->get('/detalleCurso', function(){
	$controller = new CursoController();
	$controller->detalleCurso();
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
/*END Cursos */

/*BEGIN Leccion*/
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

$router->get('/detalleLeccion', function(){
	noAuth();
	$controller = new LeccionController();
	$controller->detalleLeccion();
});
/*END Leccion*/

/*BEGIN Material */
$router->get('/listarMaterial', function(){
	noAuth();
	$controller = new MaterialController();
	$controller->listar();
});

$router->get('/creaMaterial', function(){
	noAuth();
	$controller = new MaterialController();
	$controller->agregaMaterial();
});

$router->post('/crearMaterial', function(){
	noAuth();
	$controller = new MaterialController();
	$controller->agregarMaterial();
});

$router->get('/modificaMaterial', function(){
	noAuth();
	$controller = new MaterialController();
	$controller->modificaMaterial();
});

$router->post('/modificarMaterial', function(){
	noAuth();
	$controller = new MaterialController();
	$controller->modificarMaterial();
});
/*END Material*/

/*BEGIN Pregunta*/
$router->get('/listarPreguntas', function(){
	noAuth();
	$controller = new PreguntaController();
	$controller->listar();
});

$router->get('/creaPregunta', function(){
	noAuth();
	$controller = new PreguntaController();
	$controller->agregaPregunta();
});

$router->post('/crearPregunta', function(){
	noAuth();
	$controller = new PreguntaController();
	$controller->agregarPregunta();
});

$router->get('/modificaPregunta', function(){
	noAuth();
	$controller = new PreguntaController();
	$controller->modificaPregunta();
});

$router->post('/modificarPregunta', function(){
	noAuth();
	$controller = new PreguntaController();
	$controller->modificarPregunta();
});
/*END Pregunta*/

/*BEGIN Respuesta*/
$router->get('/listarRespuestas', function(){
	noAuth();
	$controller = new RespuestaController();
	$controller->listar();
});

$router->get('/creaRespuesta', function(){
	noAuth();
	$controller = new RespuestaController();
	$controller->agregaRespuesta();
});

$router->post('/crearRespuesta', function(){
	noAuth();
	$controller = new RespuestaController();
	$controller->agregarRespuesta();
});

$router->get('/modificaRespuesta', function(){
	noAuth();
	$controller = new RespuestaController();
	$controller->modificaRespuesta();
});

$router->post('/modificarRespuesta', function(){
	noAuth();
	$controller = new RespuestaController();
	$controller->modificarRespuesta();
});
/*END Respuestas*/

/**/
$router->post('/inscribirCurso', function(){
	noAuth();
	$controller = new ClienteController();
	$controller->inscribirCurso();
});

$router->post('/registrarCurso', function(){
	auth();
	$controller = new UsuarioController();
	$controller->registro();
});

$router->post('/pagarCurso', function(){
	noAuth();
	$controller = new ClienteController();
	$controller->pagarCurso();
});

$router->get('/misCursos', function(){
	noAuth();
	$controller = new ClienteController();
	$controller->listarCursos();
});

$router->post('/respondePregunta', function(){
	noAuth();
	$controller = new ClienteController();
	$controller->respondePregunta();
});

$router->post('/avanzaLeccion', function(){
	noAuth();
	$controller = new LeccionController();
	$controller->avanzaLeccion();
});



$router->run();