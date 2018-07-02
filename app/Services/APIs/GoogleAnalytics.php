<?php

namespace App\Services\APIs;

use Illuminate\Support\Facades\DB;

class GoogleAnalytics {

	public function __construct(){
		//
	}

	public function downloadData ()
    {
        $analytics = $this->initializeAnalytics();
        $profile = $this->getFirstProfileId($analytics);
        $results1 = $this->getResults($analytics, $profile, 1);
        $results2 = $this->getResults($analytics, $profile, 2);
        $results3 = $this->getResults($analytics, $profile, 3);

        return $this->formatResults($results1, $results2, $results3);
    }

    function initializeAnalytics()
    {
        // Creates and returns the Analytics Reporting service object.

        // Use the developers console and download your service account
        // credentials in JSON format. Place them in this directory or
        // change the key file location if necessary.
        $KEY_FILE_LOCATION = __DIR__ . '/../../../ga_apikey.json';

        // Create and configure a new client object.
        $client = new \Google_Client();
        $client->setApplicationName("Analytics Reporting");
        $client->setAuthConfig($KEY_FILE_LOCATION);
        $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
        $analytics = new \Google_Service_Analytics($client);

        return $analytics;
    }

    function getFirstProfileId($analytics) {
        // Get the user's first view (profile) ID.

        // Get the list of accounts for the authorized user.
        $accounts = $analytics->management_accounts->listManagementAccounts();

        if (count($accounts->getItems()) > 0) {
            $items = $accounts->getItems();
            $firstAccountId = $items[0]->getId();

            // Get the list of properties for the authorized user.
            $properties = $analytics->management_webproperties
                ->listManagementWebproperties($firstAccountId);

            if (count($properties->getItems()) > 0) {
            $items = $properties->getItems();
            $firstPropertyId = $items[0]->getId();

            // Get the list of views (profiles) for the authorized user.
            $profiles = $analytics->management_profiles
                ->listManagementProfiles($firstAccountId, $firstPropertyId);

            if (count($profiles->getItems()) > 0) {
                $items = $profiles->getItems();

                // Return the first view (profile) ID.
                return $items[0]->getId();

            } else {
                //throw new Exception('No views (profiles) found for this user.');
                abort(500, 'No views (profiles) found for this user.');
            }
            } else {
            //throw new Exception('No properties found for this user.');
            abort(500, 'No properties found for this user.');
            }
        } else {
            //throw new Exception('No accounts found for this user.');
            abort(500, 'No accounts found for this user.');
        }
    }

    function getResults($analytics, $profileId, $field_list) {

        if ($field_list == 3) {
            $fields = [
                'ga:goal5Completions',
                'ga:goal16Completions',
                'ga:goal6Completions',
                'ga:goal17Completions',
                'ga:goal4Completions',
                'ga:goal7Completions'
            ];

            $dimensions = [
                'ga:date',
                'ga:channelGrouping',
                'ga:sourceMedium',
                'ga:metro',
                'ga:campaign'
            ];

        } elseif ($field_list == 2) {
            $fields = [
                'ga:sessionDuration',
                'ga:avgSessionDuration',
                'ga:goal2Completions',
                'ga:goal3Completions',
                'ga:goal15Completions'
            ];

            $dimensions = [
                'ga:date',
                'ga:channelGrouping',
                'ga:sourceMedium',
                'ga:metro',
                'ga:campaign'
            ];

        } else {
            $fields = [
                'ga:sessions',
                'ga:pageViews',
                'ga:pageviewsPerSession',
                'ga:bounces',
                'ga:bounceRate'
            ];

            $dimensions = [
                'ga:date',
                'ga:channelGrouping',
                'ga:sourceMedium',
                'ga:metro',
                'ga:campaign'
            ];
        }

        $date = new \DateTime();
        $date->modify('-1 day');
        $yesterday = $date->format('Y-m-d');

        return $analytics->data_ga->get(
            'ga:' . $profileId,
            $yesterday,
            $yesterday,
            implode(',', $fields),
            [
                'dimensions' => implode(',', $dimensions),
                'max-results' => '10000'
            ]
        );
    }

    function formatResults($results1, $results2, $results3) {

        if (count($results1->getRows()) > 0 && count($results2->getRows()) > 0 && count($results3->getRows())) {

            // Get the profile name.
            $profileName = $results1->getProfileInfo()->getProfileName();

            $headers1 = $results1->getColumnHeaders();
            $rows1 = $results1->getRows();

            $headers2 = $results2->getColumnHeaders();
            $rows2 = $results2->getRows();

            $headers3 = $results3->getColumnHeaders();
            $rows3 = $results3->getRows();

            if (count($rows1) != count($rows2) || count($rows1) != count($rows3)) {

                http_response_code(500);

                // echo "GA returned row count does not match for all three requests.";

                // echo "<br><br>First: " . count($rows1);
                // echo "<br>Second: " . count($rows2);
                // echo "<br>Third: " . count($rows3);
                
                //print_r(array_diff($tmp_row1, $tmp_row2));
                exit;
            }

            foreach ($rows1 as $key => $value) {
                foreach ($rows1[$key] as $key2 => $value) {
                    $data[$key][$headers1[$key2]->getName()] = $value;
                }
                foreach ($rows2[$key] as $key3 => $value) {
                    $data[$key][$headers2[$key3]->getName()] = $value;
                }
                foreach ($rows3[$key] as $key4 => $value) {
                    $data[$key][$headers3[$key4]->getName()] = $value;
                }
            }

            //If we have data let's insert it into the DB
            if(!empty($data)){
                return $data;
            }

        }

        return false;
    }
}