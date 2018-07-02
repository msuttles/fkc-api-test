<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Services\DBConnection;

class AutoIncrement {

	protected $pdo;

	public function __construct(){
		$db = new DBConnection;
		$this->pdo = $db->connect();
	}

	public function getAutoId($gsrc){
		try{
			$sql = $this->pdo->query("SELECT * FROM sources WHERE source = '$gsrc'");
			$sql = $sql->fetchAll(\PDO::FETCH_OBJ);
			foreach ($sql as $row) {
				//echo $row->last_end_id."<br /><br />";
	    	return $row->last_end_id;
	    }
	  } catch(\PDOException $ex){
			//echo "[BROKE] ";
			//dd($ex->getMessage());
			abort(500, 'PDO Error: ' . $ex->getMessage());
		}
	}

	public function alterTableAutoIncrement($gsrc,$gid,$gtable){
		try{
			$this->pdo->query("ALTER TABLE ".$gtable." AUTO_INCREMENT=".($gid+1));
		} catch(\PDOException $ex){
			//echo "[BROKE] ";
			//dd($ex->getMessage());
			abort(500, 'PDO Error: ' . $ex->getMessage());
		}
	}

	public function getLastEntryUid($gdb){
		try {
			$sql2 = $this->pdo->query("SELECT `Unique ID` FROM ".$source."_data_sample_live ORDER BY `Unique ID` DESC LIMIT 1");
			$sql2 = $sql2->fetchAll(\PDO::FETCH_OBJ);
			foreach ($sql2 as $row) {
				echo "<br /><br />".$row->{'Unique ID'};
				return $row->{'Unique ID'};
			}
		} catch(\PDOException $ex){
			//echo "[BROKE] ";
			//dd($ex->getMessage());
			abort(500, 'PDO Error: ' . $ex->getMessage());
		}
	}

	public function setAutoId($gsrc, $gid){
		try{
			$this->pdo->query("UPDATE sources SET last_end_id = '".$gid."' WHERE source = '".$gsrc."'");
		} catch(\PDOException $ex){
			//echo "[BROKE] ";
			//dd($ex->getMessage());
			abort(500, 'PDO Error: ' . $ex->getMessage());
		}
	}
}
