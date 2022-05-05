<?php

namespace Sebas\Cursos\controllers;

use Sebas\Cursos\lib\Controller;

class HomeController extends Controller{

	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->render('home/index');
	}
}