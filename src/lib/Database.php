<?php
namespace Sebas\Cursos\lib;

use PDO;
use PDOException;
use Sebas\Cursos\config\Constants;

class Database{
	private string $host;
	private string $db;
	private string $user;
	private string $password;
	private string $charset;

	function __construct(){
		$this->host = Constants::$HOTS;
		$this->db = Constants::$DB;
		$this->user = Constants::$USER;
		$this->password = Constants::$PASSWORD;
		$this->charset = Constants::$CHARSET;
	}

	public function connect():PDO{
		try{
			$connection = "mysql:host=".$this->host.";dbname=".$this->db;
			$options = [
				PDO::ATTR_ERRMODE			=> PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_EMULATE_PREPARES	=> false,
			];
			$pdo = new PDO(
					$connection,
					$this->user,
					$this->password,
					$options);

			return $pdo;
		}catch(PDOException $e){
			throw $e;
		}
	}
}