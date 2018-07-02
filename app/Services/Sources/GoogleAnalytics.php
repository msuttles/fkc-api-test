<?php

namespace App\Services\Sources;

use Illuminate\Support\Facades\DB;

class GoogleAnalytics extends Source {

    protected $source = 'ga';

    protected $insert_params = "(
            `Date`,
            `Default Channel Grouping`,
            `Source / Medium`,
            `Metro`,
            `Campaign Name`,
            `Sessions`,
            `Pageviews`,
            `Pages / Session`,
            `Bounces`,
            `Bounce Rate`,
            `Session Duration`,
            `Avg Session Duration`,
            `Facility Searches (Goal 2 Completions)`,
            `Facility Listing Interactions (Goal 3 Completions)`,
            `Get Directions Link Click Goal (Goal 15 Completions)`,
            `Contact Us Form Submits (Goal 5 Completions)`,
            `Enews Signups (Goal 16 Completions)`,
            `Home Dialysis Complete (Goal 6 Completions)`,
            `Thrive On Story Form Submissions (Goal 17 Completions)`,
            `Travel Form Submits (Goal 4 Completions)`,
            `KidneyCare: 365 Lead Form (Goal 7 Completions)`
            ) VALUES (
            :date,
            :channelGrouping,
            :sourceMedium,
            :metro,
            :campaign,
            :sessions,
            :pageViews,
            :pageviewsPerSession,
            :bounces,
            :bounceRate,
            :sessionDuration,
            :avgSessionDuration,
            :goal2Completions,
            :goal3Completions,
            :goal15Completions,
            :goal5Completions,
            :goal16Completions,
            :goal6Completions,
            :goal17Completions,
            :goal4Completions,
            :goal7Completions)";

    protected function formatParams ($row_data)
    {
        return array(
                    ':date' => $row_data['ga:date'],
                    ':channelGrouping' => $row_data['ga:channelGrouping'],
                    ':sourceMedium' => $row_data['ga:sourceMedium'],
                    ':metro' => $row_data['ga:metro'],
                    ':campaign' => $row_data['ga:campaign'],
                    ':sessions' => $row_data['ga:sessions'],
                    ':pageViews' => $row_data['ga:pageViews'],
                    ':pageviewsPerSession' => $row_data['ga:pageviewsPerSession'],
                    ':bounces' => $row_data['ga:bounces'],
                    ':bounceRate' => $row_data['ga:bounceRate'],
                    ':sessionDuration' => $row_data['ga:sessionDuration'],
                    ':avgSessionDuration' => $row_data['ga:avgSessionDuration'],
                    ':goal2Completions' => $row_data['ga:goal2Completions'],
                    ':goal3Completions' => $row_data['ga:goal3Completions'],
                    ':goal15Completions' => $row_data['ga:goal15Completions'],
                    ':goal5Completions' => $row_data['ga:goal5Completions'],
                    ':goal16Completions' => $row_data['ga:goal16Completions'],
                    ':goal6Completions' => $row_data['ga:goal6Completions'],
                    ':goal17Completions' => $row_data['ga:goal17Completions'],
                    ':goal4Completions' => $row_data['ga:goal4Completions'],
                    ':goal7Completions' => $row_data['ga:goal7Completions']
                );
    }

}