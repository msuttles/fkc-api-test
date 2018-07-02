<?php

namespace App\Services\Sources;

use Illuminate\Support\Facades\DB;

class Facebook extends Source {

    protected $source = 'fb';

    protected $insert_params = "(
			`Reporting Starts`,
			`Reporting Ends`,
			`Campaign Name`,
			`Ad Set Name`,
			`Reach`,
			`Frequency`,
			`Impressions`,
			`Amount Spent (USD)`,
			`Clicks (All)`,
			`Unique Clicks (All)`,
			`Page Likes`,
			`Post Reactions`,
			`Post Comments`,
			`Post Shares`,
			`Link Clicks`,
			`Get Directions Link`,
			`Facility Search`,
			`Facility Listing Details`,
			`Online Referral Form Submission`,
			`Home Dialysis Form Submission`,
			`Travel Form Submission`,
			`Contact Us Form Submission`,
			`KidneyCare:365 Form Submission`,
			`Email Update Form Submission`
      ) VALUES (
			:reportingStarts,
			:reportingEnds,
			:campaignName,
			:adSetName,
			:reach,
			:frequency,
			:impressions,
			:amountSpentUsd,
			:clicksAll,
			:uniqueClicksAll,
			:pageLikes,
			:postReactions,
			:postComments,
			:postShares,
			:linkClicks,
			:getDirectionsLink,
			:facilitySearch,
			:facilityListingDetails,
			:onlineReferralFormSubmission,
			:homeDialysisFormSubmission,
			:travelFormSubmission,
			:contactUsFormSubmission,
			:kidneyCare365FormSubmission,
			:emailUpdateFormSubmission)";

    protected function formatParams ($row_data)
    {
			// check for actions
			$gLike = 0;
			$gComment = 0;
			$gPostReaction = 0;
			$gPostShares = 0;
			$gLinkClick = 0;
			$gGetDirectionsLink = 0;
			$gFacilitySearch = 0;
			$gFacilityListingDetails = 0;
			$gOnlineReferralFormSubmission = 0;
			$gHomeDialysisFormSubmission = 0;
			$gTravelFormSubmission = 0;
			$gContactUsFormSubmission = 0;
			$gKidneyCare365FormSubmission = 0;
			$gEmailUpdateFormSubmission = 0;

			if(isset($row_data['actions'])){
				foreach ($row_data['actions'] as $k => $v) {
					if($v['action_type'] == "like"){
						$gLike = $v['value'];
					}

					if($v['action_type'] == "comment"){
						$gComment = $v['value'];
					}

					if($v['action_type'] == "post"){
						$gPostShares = $v['value'];
					}

					if($v['action_type'] == "post_reaction"){
						$gPostReaction = $v['value'];
					}

					if($v['action_type'] == "link_click"){
						$gLinkClick = $v['value'];
					}

					if($v['action_type'] == "offsite_conversion.custom.593515867519122"){
						$gGetDirectionsLink = $v['value'];
					}

					if($v['action_type'] == "offsite_conversion.custom.379117789154412"){
						$gFacilitySearch = $v['value'];
					}

					if($v['action_type'] == "offsite_conversion.custom.892167800922781"){
						$gFacilityListingDetails = $v['value'];
					}

					if($v['action_type'] == "offsite_conversion.custom.734582943371802"){
						$gOnlineReferralFormSubmission = $v['value'];
					}

					if($v['action_type'] == "offsite_conversion.custom.1720685408221658"){
						$gHomeDialysisFormSubmission = $v['value'];
					}

					if($v['action_type'] == "offsite_conversion.custom.828507287300517"){
						$gTravelFormSubmission = $v['value'];
					}

					if($v['action_type'] == "offsite_conversion.custom.766214823549837"){
						$gContactUsFormSubmission = $v['value'];
					}

					if($v['action_type'] == "offsite_conversion.custom.1722519941372720"){
						$gKidneyCare365FormSubmission = $v['value'];
					}

					if($v['action_type'] == "offsite_conversion.custom.673031496215532"){
						$gEmailUpdateFormSubmission = $v['value'];
					}
				}
			}

	    return array(
			':reportingStarts' => $row_data['date_start'],
			':reportingEnds' => $row_data['date_stop'],
			':campaignName' => $row_data['campaign_name'],
			':adSetName' => $row_data['adset_name'],
			':reach' => $row_data['reach'],
			':frequency' => $row_data['frequency'],
			':impressions' => $row_data['impressions'],
			':amountSpentUsd' => $row_data['spend'],
			':clicksAll' => $row_data['clicks'],
			':uniqueClicksAll' => $row_data['unique_clicks'],
			':pageLikes' => $gLike,
			':postReactions' => $gPostReaction,
			':postComments' => $gComment,
			':postShares' => $gPostShares,
			':linkClicks' => $gLinkClick,
			':getDirectionsLink' => $gGetDirectionsLink,
			':facilitySearch' => $gFacilitySearch,
			':facilityListingDetails' => $gFacilityListingDetails,
			':onlineReferralFormSubmission' => $gOnlineReferralFormSubmission,
			':homeDialysisFormSubmission' => $gHomeDialysisFormSubmission,
			':travelFormSubmission' => $gTravelFormSubmission,
			':contactUsFormSubmission' => $gContactUsFormSubmission,
			':kidneyCare365FormSubmission' => $gKidneyCare365FormSubmission,
			':emailUpdateFormSubmission' => $gEmailUpdateFormSubmission
		);
	}
}