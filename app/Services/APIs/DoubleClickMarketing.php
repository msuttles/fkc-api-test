<?php

namespace App\Services\APIs;

use Illuminate\Support\Facades\DB;
use GuzzleHttp\Psr7;

class DoubleClickMarketing {

	public function __construct(){
		//
	}

	public function downloadData ()
	{

		$KEY_FILE_LOCATION = __DIR__ . '/../../../ga_apikey.json';
		$tokenStore = __DIR__ . '/../../../tokenStore.txt';

		$client = new \Google_Client();
        $client->setApplicationName("DoubleClickMarketing");
		
		$client->addScope(\Google_Service_Dfareporting::DFAREPORTING);

		$client->setAuthConfig($KEY_FILE_LOCATION);

		$service = new \Google_Service_Dfareporting($client);

		// get profile
		$result = $service->userProfiles->listUserProfiles();
		$userProfile = current($result['items']);
		$userProfileId = $userProfile->getProfileId();

		$reportId = '128241395';

		$file = $service->reports->run($userProfileId, $reportId);

		sleep(10);

		$loop_count = 0;
		$file_ready = 0;
		while ($file_ready != 1) {
			$response = $service->reports_files->listReportsFiles(
				$userProfileId,
				$reportId
			);
			$files = $response->getItems();
			$file = $files[0];

			if ($file->status == 'PROCESSING') {
				sleep(10);
			} else {
				$file_ready = 1;
			}

			if ($loop_count > 4) {
				//echo "DCM Report failed to load.";
				abort(500, "DCM Report failed to load.");
				//exit;
			}
			$loop_count++;
		}
		$fileId = $file->id;

		// Retrieve the file metadata.
		$file = $service->files->get($reportId, $fileId);
		$dcm_data = array();

		if ($file->getStatus() === 'REPORT_AVAILABLE') {
			try {
				// Prepare a local file to download the report contents to.
				$fileName = base_path()."/imports/dcm_dump.csv";
				$fileResource = fopen($fileName, 'w+');
				$fileStream = \GuzzleHttp\Psr7\stream_for($fileResource);

				// Execute the get request and download the file.
				$httpClient = $service->getClient()->authorize();
				$result = $httpClient->request('GET', $file->getUrls()->getApiUrl(), [
					\GuzzleHttp\RequestOptions::SINK => $fileStream
				]);

				//printf('<h3>DCM Report file saved to: %s</h3>', $fileName);

			} finally {
				fclose($fileResource);
				$fileStream->close();				
			}

			$file = fopen($fileName,"r");
	
			while(! feof($file))
			{
				$line = fgets($file, 4096);
				$dcm_data[] = $line; 
			}
			fclose($file);

			for ($i=0; $i < 14; $i++) {
				unset($dcm_data[$i]);
			}	
			
		} else {
			//echo "DCM Report Not Available.";
			abort(500, "DCM Report Not Available.");
			//exit;
		}

		$exploded_data = array_map('str_getcsv', $dcm_data);
		
		array_pop($exploded_data);
		array_pop($exploded_data);

		// Execute each array element using arrCombine function below
		array_walk($exploded_data, function(&$arrCombine) use ($exploded_data) {

			// Create an array by using the elements from array_walk above
			$arrCombine = array_combine($exploded_data[14], $arrCombine);
		});

		// remove the header row from the top and two invalid rows from the bottom
		array_shift($exploded_data);

		return $exploded_data;

	}

	// write the file
	function generateFilename()
	{
		return substr(md5(microtime()), 0, 6);
	}
}