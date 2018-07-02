<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Services\DBConnection;
use Illuminate\Support\Facades\Mail;

class ExportToFileHelper {

	protected $pdo;

	public function __construct(){
		$db = new DBConnection;
		$this->pdo = $db->connect();
		$this->env_emails = env('MAIL_EMAILS');
    $this->get_emails = explode(";", $this->env_emails);
	}

	public function exportCSV($source){

		$source_table = $source . '_data';

		$header_query = $this->pdo->query("DESCRIBE ".$source_table);

		if ($this->pdo->errorCode() != '00000') {
			//echo "Query failed!";
			abort(500, 'PDO Error: Query failed!');
		}

		$header_rows = $header_query->fetchAll();

		$headers = array();
		foreach ($header_rows as $header) {
			$headers[] = $header['Field'];

		}

		try {
			$results = $this->pdo->query("SELECT * FROM ".$source."_data");
			$results = $results->fetchAll(\PDO::FETCH_OBJ);
		} catch(\PDOException $ex){
			dd($ex->getMessage());

			// send email notifications
      $report = "ExportToFileHelper error: {$e}";

      foreach($this->get_emails as $email) {
        Mail::raw($report, function($msg) use ($email) {
          $msg->to($email);
          $msg->from(['datamart@wunderman.com']);
        });
      }
		}

		$date = new \DateTime();
		$today = $date->format('Ymd');

		try {
			$sources = $this->pdo->prepare("SELECT * FROM sources WHERE source = :source");
			$sources->execute([':source' => $source]);
			$sources = $sources->fetchAll(\PDO::FETCH_OBJ);
		} catch(\PDOException $ex) {
			dd($ex->getMessage());

			// send email notifications
      $report = "ExportToFileHelper error: {$e}";

      foreach($this->get_emails as $email) {
        Mail::raw($report, function($msg) use ($email) {
          $msg->to($email);
          $msg->from(['datamart@wunderman.com']);
        });
      }
		}

		$file = 'Wunderman_' . $sources[0]->file_reference_name . '_' . $today . '.csv';

		$fp = fopen(base_path().'/exports/'.$file, 'w');

		if ($fp && $results) {
			fputcsv($fp, $headers);

			foreach ($results as $row){
				// TODO: Replace with formatting field in the GA source class.
				if ($source == 'ga' && isset($row->Date)) {
					$row->Date = str_replace('-', '', $row->Date);
				}

				if ($source == 'dcm' && isset($row->Date)) {
					$date_parts = explode('-', $row->Date);
					$row->Date = $date_parts[1] . '/' . $date_parts[2] . '/' . $date_parts[0];
				}

				fputcsv($fp, get_object_vars($row));
			}
		}

		fclose($fp);

		$this->conn = null;

		return $file;
	}
}
