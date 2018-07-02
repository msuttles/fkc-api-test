<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Services\DBConnection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;



class InitController extends BaseController
{

	protected $pdo;
	public $sources;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct ()
	{

		$db = new DBConnection;
		$this->pdo = $db->connect();
	}

	public function index($source){
		if ($source == 'customers') {
			$sources = $this->pdo->prepare("SELECT * FROM customers");
		} elseif($source == 'employees') {
			$sources = $this->pdo->prepare("SELECT * FROM employees");			
		} elseif($source == 'offices') {
			$sources = $this->pdo->prepare("SELECT * FROM offices");
		} elseif($source == 'orderdetails') {
			$sources = $this->pdo->prepare("SELECT * FROM orderdetails");
		} elseif($source == 'orders') {
			$sources = $this->pdo->prepare("SELECT * FROM orders");
		} elseif($source == 'payments') {
			$sources = $this->pdo->prepare("SELECT * FROM payments");
		} elseif($source == 'productlines') {
			$sources = $this->pdo->prepare("SELECT * FROM productlines");
		} elseif($source == 'products') {
			$sources = $this->pdo->prepare("SELECT * FROM products");
		}
		$sources->execute();
		$sources = $sources->fetchAll(\PDO::FETCH_OBJ);
		return response()->json($sources);
		//return response()->json(['response' => 'success', 'results' => var_dump($sources)]);
	}
}
