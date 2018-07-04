<?php

namespace App\Http\Controllers;
	
class DBConnection {
	private $pdo;
		
	function __construct()
	{

	}
	
	public function connect()
	{
		if ($this->pdo instanceof \PDO) {
			return $this->pdo;
		} else {
			$dsn = getenv('MYSQL_DSN');
			$user = getenv('MYSQL_USER');
			$password = getenv('MYSQL_PASSWORD');
			$this->pdo = new \PDO($dsn, $user, $password);
			
			return $this->pdo;
		}
	}
}