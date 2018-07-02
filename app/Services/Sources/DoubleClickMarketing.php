<?php

namespace App\Services\Sources;

use Illuminate\Support\Facades\DB;

class DoubleClickMarketing extends Source {

    protected $source = 'dcm';

    protected $insert_params = "(
			`Date`,
			`Campaign Name`,
			`Site (DCM)`,
			`Placement`,
			`Ad`,
			`Impressions`,
			`Clicks`,
			`DBM Cost USD`,
			`Display: Generic Paid Ad Landing Page: Total Conversions`,
			`Display: Get Directions Link: Total Conversions`,
			`Display: Search Result Page: Total Conversions`,
			`Display: Facility Listing & Detail: Total Conversions`,
			`Display: Online Referral Start: Total Conversions`,
			`Display: Online Referral Complete: Total Conversions`,
			`Display: Home Dialysis at Home Start: Total Conversions`,
			`Display: Home Dialysis at Home Complete: Total Conversions`,
			`Display: Travel Form Start: Total Conversions`,
			`Display: Travel Form Thank You Page: Total Conversions`,
			`Display: Contact Us Thank You: Total Conversions`,
			`Display: KidneyCare: 365: Total Conversions`,
			`Display: Email SignUp: Total Conversions`
            ) VALUES (
			:date,
			:campaignName,
			:siteDCM,
			:placement,
			:ad,
			:impressions,
			:clicks,
			:dbmCostUSD,
			:displayGenericPaidAdLandingPageTotalConversions,
			:displayGetDirectionsLinkTotalConversions,
			:displaySearchResultPageTotalConversions,
			:displayFacilityListingDetailTotalConversions,
			:displayOnlineReferralStartTotalConversions,
			:displayOnlineReferralCompleteTotalConversions,
			:displayHomeDialysisAtHomeStartTotalConversions,
			:displayHomeDialysisAtHomeCompleteTotalConversions,
			:displayTravelFormStartTotalConversions,
			:displayTravelFormThankYouPageTotalConversions,
			:displayContactUsThankYouTotalConversions,
			:displayKidneyCare365TotalConversions,
			:displayEmailSignUpTotalConversions)";

    protected function formatParams ($row_data)
    {
        return array(
			':date' => $row_data['Date'],
			':campaignName' => $row_data['Campaign'],
			':siteDCM' => $row_data['Site (DCM)'],
			':placement' => $row_data['Placement'],
			':ad' => $row_data['Ad'],
			':impressions' => $row_data['Impressions'],
			':clicks' => $row_data['Clicks'],
			':dbmCostUSD' => $row_data['DBM Cost USD'],
			':displayGenericPaidAdLandingPageTotalConversions' => $row_data['Paid Search : Generic Paid Ad Landing Page: Total Conversions'],
			':displayGetDirectionsLinkTotalConversions' => $row_data['Paid Search : Get Directions Link: Total Conversions'],
			':displaySearchResultPageTotalConversions' => $row_data['Paid Search : Search Result Page: Total Conversions'],
			':displayFacilityListingDetailTotalConversions' => $row_data['Paid Search : Facility Listing & Detail: Total Conversions'],
			':displayOnlineReferralStartTotalConversions' => $row_data['Paid Search : Online Referral Start: Total Conversions'],
			':displayOnlineReferralCompleteTotalConversions' => $row_data['Paid Search : Online Referral Complete: Total Conversions'],
			':displayHomeDialysisAtHomeStartTotalConversions' => $row_data['Paid Search : UltraCare at Home Start: Total Conversions'],
			':displayHomeDialysisAtHomeCompleteTotalConversions' => $row_data['Paid Search : UltraCare at Home Complete: Total Conversions'],
			':displayTravelFormStartTotalConversions' => $row_data['Paid Search : Travel Form Start: Total Conversions'],
			':displayTravelFormThankYouPageTotalConversions' => $row_data['Paid Search : Travel Form Thank You Page: Total Conversions'],
			':displayContactUsThankYouTotalConversions' => $row_data['Paid Search : Contact Us Thank You: Total Conversions'],
			':displayKidneyCare365TotalConversions' => $row_data['Paid Search : Treatment Options Program Thank You (Lead): Total Conversions'],
			':displayEmailSignUpTotalConversions' => $row_data['Paid Search : Email SignUp: Total Conversions']
		);
	}
}

