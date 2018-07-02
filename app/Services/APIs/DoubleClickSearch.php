<?php

namespace App\Services\APIs;

use Illuminate\Support\Facades\DB;
use App\Services\DBConnection;

class DoubleClickSearch {

	public function __construct(){

	}

	public function downloadData ()
	{
		$client = new \Google_Client();
		$credentials_file = __DIR__ . '/../../../ga_apikey.json';
		$client->setAuthConfig($credentials_file);
		$client->setApplicationName("DoubleClickSearch");
		$client->setScopes(['https://www.googleapis.com/auth/doubleclicksearch']);
		$service = new \Google_Service_Doubleclicksearch($client);

		$reportScope = new \Google_Service_Doubleclicksearch_ReportRequestReportScope();
		$reportScope->setAgencyId('20700000000001231'); 
		$reportScope->setAdvertiserId('21700000001023237'); 

		$report_request = new \Google_Service_Doubleclicksearch_ReportRequest();
		$report_request->setReportType("keyword");
		$report_request->setDownloadFormat("csv");
		$report_request->setReportScope($reportScope);
		$report_request->setMaxRowsPerFile(1000000);
		$report_request->setStatisticsCurrency('usd');
		
		$report_timerange = new \Google_Service_Doubleclicksearch_ReportRequestTimeRange();
		$yesterday = date('Y-m-d', strtotime("-1 days"));

		$report_timerange->setStartDate($yesterday);
		$report_timerange->setEndDate($yesterday);
		$report_request->setTimeRange($report_timerange);

		$report_request->columns = array(		
			array(
				"columnName" => "status",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Status"
			),
			array(
				"columnName" => "date",
				"headerText" => "From",
				"startDate" => $yesterday,
				"endDate" => $yesterday

			),
			array(
				"columnName" => "date",
				"headerText" => "To",
				"startDate" => $yesterday,
				"endDate" => $yesterday				
			),
			array(
				"columnName" => "accountType",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Digital Vendor"
			),
			array(
				"columnName" => "account",
				"headerText" => "Account",
				"startDate" => $yesterday,
				"endDate" => $yesterday				
			),
			array(
				"columnName" => "campaign",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			array(
				"columnName" => "adGroup",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			array(
				"columnName" => "keywordMatchType",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Match type"
			),
			array(
				"columnName" => "engineStatus",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Engine status"
			),
			array(
				"columnName" => "effectiveKeywordMaxCpc",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Effective keyword max CPC"
			),
			array(
				"columnName" => "keywordMaxCpc",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Keyword max CPC"
			),
			array(
				"columnName" => "clicks",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Clicks"
			),
			array(
				"columnName" => "impr",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Impr"
			),
			array(
				"columnName" => "cost",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Cost"
			),
			array(
				"columnName" => "ctr",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "CTR"
			),
			array(
				"columnName" => "avgCpc",
				"platformSource" => "floodlight",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Avg CPC"
			),
			array(
				"columnName" => "avgPos",
				"platformSource" => "floodlight",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Avg pos"
			),
			array(
				"savedColumnName" => "Get Directions",
				"platformSource" => "floodlight",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			array(
				"savedColumnName" => "Facility Searches",
				"platformSource" => "floodlight",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			array(
				"savedColumnName" => "Facility Listing and Detail Interactions",
				"platformSource" => "floodlight",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			array(
				"savedColumnName" => "Online Referral Complete",
				"platformSource" => "floodlight",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			array(
				"savedColumnName" => "Home Dialysis Lead Complete",
				"platformSource" => "floodlight",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			array(
				"savedColumnName" => "Travel Form Lead Complete",
				"platformSource" => "floodlight",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			array(
				"savedColumnName" => "Lead: Contact Us Form Submits",
				"platformSource" => "floodlight",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			array(
				"savedColumnName" => "TOPS Lead Complete",
				"platformSource" => "floodlight",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "KidneyCare: 365 Lead Complete"
			),
			array(
				"savedColumnName" => "Email Signups",
				"platformSource" => "floodlight",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			array(
				"columnName" => "keywordLandingPage",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Keyword landing page"
			),
			array(
				"columnName" => "advertiserId",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Advertiser ID"
			),
			array(
				"columnName" => "advertiser",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Advertiser"
			),
			array(
				"columnName" => "accountId",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Account ID"
			),
			array(
				"columnName" => "campaignId",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "DoubleClick Search Campaign ID"
			),
			array(
				"columnName" => "adGroupId",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Ad group ID"
			),
			array(
				"columnName" => "keywordId",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Keyword ID"
			),
			array(
				"columnName" => "keywordLabels",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Label"
			),
			array(
				"columnName" => "keywordUrlParams",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "URL parameters"
			),
			array(
				"columnName" => "keywordMinBid",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Effective min bid"
			),
			array(
				"columnName" => "keywordMaxBid",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Effective max bid"
			),
			array(
				"columnName" => "keywordMinBid",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Min bid"
			),
			array(
				"columnName" => "keywordMaxBid",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Max bid"
			),
			array(
				"headerText" => "Advertiser bid strategy",
				"columnName" => "bidStrategyInherited",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			array(
				"columnName" => "effectiveBidStrategy",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Effective bid strategy"
			),
			array(
				"headerText" => "Effective engine bid strategy name",
				"columnName" => "effectiveBidStrategyId",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			array(
				"headerText" => "Engine bid strategy name",
				"columnName" => "effectiveBidStrategyId",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			
			array(
				"columnName" => "keywordClickserverUrl",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Clickserver URL"
			),
			array(
				"headerText" => "URL template",
				"columnName" => "adDisplayUrl",
				"startDate" => $yesterday,
				"endDate" => $yesterday
			),
			array(
				"headerText" => "Inferred match type",
				"columnName" => "keywordMatchType",
				"startDate" => $yesterday,
				"endDate" => $yesterday				
			),
			array(
				"columnName" => "keywordText",
				"startDate" => $yesterday,
				"endDate" => $yesterday,
				"headerText" => "Keyword"
			)
		);
		$report_request->filters = array(
			array( "column" =>
				array("columnName" => "impr"),
				"operator" => "greaterThan",
				"values" => array(0)
			),
			array( "column" =>
				array("columnName" => "status"),
				"operator" => "equals",
				"values" => array("Active")
			)
		);

		$request = $service->reports->request($report_request);

		$report_id = $request->getId();

		$report = $service->reports->get($report_id);

		sleep(10);

		$loop_count = 0;
		$file_ready = 0;
		while($file_ready !== 1){
			$report = $service->reports->get($report_id);
			if ( empty($report->isReportReady) || (!isset($report->isReportReady)) ) {
				sleep(5);
			} else if($report->isReportReady == 1){
				$file_ready = 1;
				return $this->DownloadReport($service,$report);
			}

			if ($loop_count > 4) {
				//echo "DS Report failed to load.";
				abort(500, "DS Report failed to load.");
				//exit;
			}
			$loop_count++;

		}
		
	}

	function DownloadReport($service,$report)
	{
			try {

				$file = $report->files;

				// Prepare a local file to download the report contents to.
				$fileName = base_path().'/imports/ds_dump.csv';
				$fileResource = fopen($fileName, 'w+');
				$fileStream = \GuzzleHttp\Psr7\stream_for($fileResource);

				// Execute the get request and download the file.
				$httpClient = $service->getClient()->authorize();
				$result = $httpClient->request('GET', $file[0]->url, [
					\GuzzleHttp\RequestOptions::SINK => $fileStream
				]);

				//printf('<h3>DS Report file saved to: %s</h3>', $fileName);

			} finally {
				fclose($fileResource);
				$fileStream->close();				
			}

			$ds_data = array();

			$file = fopen($fileName,"r");
	
			while(! feof($file))
			{
				$line = fgets($file, 4096);
				$ds_data[] = $line; 
			}
			fclose($file);

			return $this->formatResults($ds_data);
	}

	function formatResults ($output)
	{
	
		$results = array_map('str_getcsv', $output);
		
		//Delete the extra row (last row in array)
		array_pop($results);

		// Combine array header row $results[0] as keys for each rows in multidimensional array
		array_walk($results, function(&$arrCombine) use ($results) {			
			$arrCombine = array_combine($results[0], $arrCombine);
		});
	
		array_shift($results); # remove column header
		$resultsCount = count($results);
		

		// Set defaults for the Avg CPC rows that don't have values in order to insert into the db successfully
		for ($i = 0; $i < $resultsCount; ++$i) {
			$params[] = explode("?", $results[$i]['Keyword landing page']);
			if( isset($params[$i][1]) ){
				$results[$i]['URL parameters'] = $params[$i][1];
			}
			if( ( !strlen($results[$i]['Avg CPC'])) || (!isset($results[$i]['Avg CPC'])) ){ $results[$i]['Avg CPC'] = (float) 0.00; }
			if( ($results[$i]['Advertiser bid strategy'] == 0) && (strlen($results[$i]['Effective bid strategy'])) ){
				$results[$i]['Advertiser bid strategy'] = $results[$i]['Effective bid strategy'];
			}
			else if( $results[$i]['Advertiser bid strategy'] == 1){
				$results[$i]['Advertiser bid strategy'] = '(inherited)';
			}
			else if( ($results[$i]['Advertiser bid strategy'] == 0) && (!strlen($results[$i]['Effective bid strategy'])) ){
				$results[$i]['Advertiser bid strategy'] = '(manual)';
			}
			if( !strlen($results[$i]['Effective bid strategy']) ){ $results[$i]['Effective bid strategy'] = '(manual)'; }
			else if( strlen($results[$i]['Effective bid strategy']) ){
				$results[$i]['Max bid'] = '(inherited)';
				$results[$i]['Min bid'] = '(inherited)';
			}
			if( $results[$i]['Advertiser bid strategy'] === '(inherited)' || $results[$i]['Advertiser bid strategy'] === '' ){
				$results[$i]['Engine bid strategy name'] = '(inherited)';
			}
			if( (!strlen($results[$i]['Effective max bid'])) ){
				$results[$i]['Effective max bid'] = NULL;
			}
			if( (!strlen($results[$i]['Effective min bid'])) ){
				$results[$i]['Effective min bid'] = NULL;
			}

		}

		return $results;
	}
}