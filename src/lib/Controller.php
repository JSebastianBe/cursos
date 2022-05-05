<?php
namespace	Sebas\Cursos\lib;
use			Sebas\Cursos\lib\View;

class Controller{

	private View $view;

	function __construct(){
		$this->view = new View();
	}

	public function render(string $name, array $data =[]){
		$this->view->render($name, $data);
	}

	protected function post(string $param){
		if(!isset($_POST[$param])){
			return NULL;
		}else{
			return $_POST[$param];
		}
	}

	protected function get(string $param){
		if(!isset($_GET[$param])){
			return NULL;
		}else{
			return $_GET[$param];
		}
	}

	protected function file(string $param){

		if(!isset($_FILES[$param])){
			error_log('ExistPost: No existe parametro $param: ' .$param);
			return NULL;
		}else{
			return $_FILES[$param];
		}
	}
}