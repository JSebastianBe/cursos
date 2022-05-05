<?php
namespace Sebas\Cursos\lib;

class View{

	function __construct(){

	}

	function render(string $name, array $data =[]){
		$this->d = $data;
		require 'src/views/'.$name.'.php';
	}
}