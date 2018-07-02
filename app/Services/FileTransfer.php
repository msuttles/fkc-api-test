<?php

namespace App\Services;

use \phpseclib\Net\SFTP;
use Illuminate\Support\Facades\DB;
use App\Services\DBConnection;
use Illuminate\Support\Facades\Mail;

define('NET_SFTP_LOGGING', SFTP::LOG_COMPLEX);

class FileTransfer {
	private $sftp;

	public function __construct(){
		$db = new DBConnection;
		$this->pdo = $db->connect();
		$this->sftp = new SFTP(env('SFTP1_SERVER'));
		$this->env_emails = env('MAIL_EMAILS');
    $this->get_emails = explode(";", $this->env_emails);

		if (!$this->sftp->login(env('SFTP1_USERNAME'), env('SFTP1_PASSWORD'))){
			// login fails
			$this->emails->report("Login Failed");
			exit('Login Failed');
		}
	}

	public function transferFile($localfile,$source_name){

		date_default_timezone_set('America/Chicago');

		$this->sftp->put($localfile, base_path().'/exports/'.$localfile, SFTP::SOURCE_LOCAL_FILE);

		return $this->getTransferStatus($localfile,$source_name);
	}

	public function getTransferStatus($localfile,$source_name){

		$narray = $this->sftp->rawlist();

		foreach ($narray as $key => $na){
			if($key == $localfile){

				$localfilestat = stat(base_path()."/exports/".$localfile);
				$fstat = $this->sftp->stat($key);

				if($localfilestat['size'] == $fstat['size']){
					//echo $key."(found file! local file: size=".$localfilestat['size']." and server file: size=".$fstat['size'].") <br />";
					echo 'Export successful';

					try {
						// update database that file was successfully transfered
						$squery = $this->pdo->prepare("UPDATE sources SET lastsuccessfulrun=NOW() WHERE source='{$source_name}'");
						$squery->execute();
					} catch (\PDOException $e) {
			      // send email notifications
			      $report = "FileTransfer error: {$e}";

			      foreach($this->get_emails as $email) {
			        Mail::raw($report, function($msg) use ($email) {
			          $msg->to($email);
			          $msg->from(['datamart@wunderman.com']);
			        });
			      }
			    }
				}
			}
		}
	}
}
