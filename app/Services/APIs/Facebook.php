<?php

namespace App\Services\APIs;

use Illuminate\Support\Facades\DB;
use App\Services\DBConnection;
use Facebook\Facebook as FB;
#use Google\Cloud\BigQuery\BigQueryClient;

#sample code
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdFields;
use FacebookAds\Object\AdsInsights;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;

class Facebook {

	public function __construct()
	{
		$db = new DBConnection;
		$this->pdo = $db->connect();
	}

	public function downloadData ()
	{
		$access_token = getenv('FACEBOOK_USER_TOKEN');
		$ad_account_id = 'act_1086755048080350';
		$app_secret = getenv('FACEBOOK_APP_SECRET');
		$app_id = getenv('FACEBOOK_APP_ID');

		$api = Api::init($app_id, $app_secret, $access_token);
		$api->setLogger(new CurlLogger());
		$yesterday = date('Y-m-d', strtotime("-1 days"));

		$fields = array(
			'date_start',
			'date_stop',
			'campaign_name',
			'adset_name',
			'reach',
			'frequency',
			'impressions',
			'spend',
			'clicks',
			'unique_clicks',
			'actions',
		);
		$params = array(
			'level' => 'ad',
			'filtering' => array(),
			'breakdowns' => array(),
			'time_range' => array('since' => $yesterday,'until' => date('Y-m-d')),
		);

		$json_a = json_encode((new AdAccount($ad_account_id))->getInsights($fields,$params)->getResponse()->getContent(), JSON_PRETTY_PRINT);

		$obj = json_decode($json_a, true);

		foreach($obj['data'] as $key => $value){
			$j_array[] = $value;
		}

		return $j_array;
	}
}
