<?php

namespace App\Services\APIs;

use Illuminate\Support\Facades\DB;
#use Google\Cloud\BigQuery\BigQueryClient;
use Illuminate\Support\Facades\Mail;

class DialogTech {

	public function __construct(){
		$this->env_emails = env('MAIL_EMAILS');
    $this->get_emails = explode(";", $this->env_emails);
	}

	public function downloadData ()
	{
		$initDownload = $this->DTAPICallinit();
		$Results = $this->RunCurl($initDownload);
		return $this->formatResults($Results);
	}

	function DTAPICallinit (){

		// Create cURL resource
		//$ch = curl_init();
		$baseuri = "https://secure.dialogtech.com/ibp_api.php?";

		// API Specific Static Parameters
		$action = "report.call_detail";

		// Required User Parameters To Request the API
		$access_key = env("DT_API_Key");
		$secret_access_key = env("DT_Secret_Access_Key");
		$date = new \DateTime();
		$date->modify('-1 day');
		$yesterday = $date->format('Ymd');
		//$yesterday = date('Ymd', strtotime("yesterday"))

		$start_date = $yesterday;
		$end_date = $yesterday;

		// Parameters that define the fields returned
		$ani = "1";
		$call_duration = "1";
		$call_type_filter = "All";
		$date_added = "1";
		$dnis = "1";
		$switch_minutes = "1";
		$network_minutes = "1";
		$enhanced_minutes = "1";
		$adj_switch = "1";
		$adj_network = "1";
		$adj_enhanced = "1";
		$format = "csv";
		$phone_label = "1";
		$call_transfer_status = "1";
		$transfer_to_number = "1";
		$transfer_type = "1";
		$call_type = "1";
		$url_tag = "1";
		$campaign = "1";
		$first_activity = "1";
		$last_activity = "1";



		// Construct the full URL
		$full_url = $baseuri .
			"&action=" . $action .
			"&access_key=" . $access_key .
			"&secret_access_key=" . $secret_access_key .
			"&start_date=" . $start_date .
			"&end_date=" . $end_date .
			"&ani=" . $ani .
			"&call_duration=" . $call_duration .
			"&call_type_filter=" . $call_type_filter .
			"&date_added=" . $date_added .
			"&dnis=" . $dnis .
			"&switch_minutes=" . $switch_minutes .
			"&network_minutes=" . $network_minutes .
			"&enhanced_minutes=" . $enhanced_minutes .
			"&adj_switch=" . $adj_switch .
			"&adj_network=" . $adj_network .
			"&adj_enhanced=" . $adj_enhanced .
			"&format=" . $format .
			"&phone_label=" . $phone_label .
			"&transfer_type=" . $transfer_type .
			"&phone_label=" . $phone_label .
			"&call_transfer_status=" . $call_transfer_status .
			"&transfer_to_number=" . $transfer_to_number .
			"&call_type=" . $call_type .
			"&url_tag=" . $url_tag .
			"&campaign=" . $campaign .
			"&first_activity=" . $first_activity .
			"&last_activity=" . $last_activity;

			return $full_url;
	}

	function RunCurl($full_url){
		// Create cURL resource
		$ch = curl_init();

		// Set the URL
		curl_setopt($ch, CURLOPT_URL, $full_url);

		// Sets the return options of the cURL to return the actual result from the curl request, and FALSE on failure
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		// Sets the $output variable to the result of the curl
		$output = curl_exec($ch);

		//var_dump($output);exit;

		// curl error
		if (curl_error($ch)) {
			$error_msg = curl_error($ch);

			// send email notifications if error
			$report = "Monitor CURL error: {$error_msg}";

			foreach($this->get_emails as $email){
				Mail::raw($report, function($msg) use ($email) {
					$msg->to($email);
					$msg->from(['datamart@wunderman.com']);
					$msg->subject('Monitor source build was unsuccessful because of a CURL error');
				});
			}
		}

		// Close curl resource to free up system resources
		curl_close($ch);

		return $output;
	}

	function formatResults ($output){
		$csvFile = str_getcsv($output, "\n");

		// Use "Camapign Name" as field so that dt_data table is congruent with the data dictionary
		$csvFile[0] = str_replace('Campaign', 'Campaign Name', $csvFile[0]);

		$results = array_map('str_getcsv', $csvFile);

		// echo "<pre>";
		// print_r($output);
		// echo "</pre>";

		// Execute each array element using arrCombine function below
		array_walk($results, function(&$arrCombine) use ($results) {

			// Create an array by using the elements from array_walk above
			$arrCombine = array_combine($results[0], $arrCombine);
		});

		array_shift($results); # remove column header

		return $results;
	}
}
