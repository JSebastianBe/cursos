<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;

class CursoController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function catalogo(){
		$this->render('Curso/catalogo');
	}
}