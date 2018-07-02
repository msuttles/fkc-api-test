<?php

namespace App\Services\Sources;

use Illuminate\Support\Facades\DB;

class DoubleClickSearch extends Source {

    protected $source = 'ds';

    protected $insert_params = "(
		`Status`,
		`From`,
		`To`,
		`Digital Vendor`,
		`Account`,
		`Campaign`,
		`Ad group`,
		`Keyword`,
		`Match type`,
		`Engine status`,
		`Effective keyword max CPC`,
		`Keyword max CPC`,
		`Advertiser bid strategy`,
		`Effective bid strategy`,
		`Effective engine bid strategy name`,
		`Clicks`,
		`Impr`,
		`Cost`,
		`CTR`,
		`Avg CPC`,
		`Avg pos`,
		`Get Directions`,
		`Facility Searches`,
		`Facility Listing and Detail Interactions`,
		`Online Referral Complete`,
		`Home Dialysis Lead Complete`,
		`Travel Form Lead Complete`,			
		`Lead: Contact Us Form Submits`,
		`KidneyCare: 365 Lead Complete`,
		`Email Signups`,
		`Keyword landing page`,
		`Advertiser ID`,
		`Advertiser`,
		`Account ID`,
		`DoubleClick Search Campaign ID`,
		`Ad group ID`,
		`Keyword ID`,
		`Label`,
		`URL parameters`,
		`Min bid`,
		`Max bid`,
		`Effective min bid`,
		`Effective max bid`,
		`Engine bid strategy name`,
		`Clickserver URL`,
		`URL template`
		) VALUES (
		:status,
		:from,
		:to,
		:engine,
		:account,
		:campaign,
		:adgroup,
		:keyword,
		:matchtype,
		:enginestatus,
		:effectivekeywordmaxCPC,
		:keywordmaxCPC,
		:advertiserbidstrategy,
		:effectivebidstrategy,
		:bidstrategyname,
		:clicks,
		:impr,
		:cost,
		:ctr,
		:avgCPC,
		:avgpos,
		:getDirections,
		:facilitySearches,
		:detailInteractions,
		:onlineReferralComplete,
		:homeDialysisLeadComplete,
		:travelFormLeadComplete,			
		:leadContactUsFormSubmits,
		:kidneyCare365LeadComplete,
		:emailSignups,
		:keywordlandingpage,
		:advertiserID,
		:advertiser,
		:accountID,
		:dblclicksearchcampaignID,
		:adgroupID,
		:keywordID,
		:label,
		:urlparameters,
		:minbid,
		:maxbid,
		:effectiveminbid,
		:effectivemaxbid,
		:engineBidStrategyName,
		:clickserverURL,
		:urltemplate
		)";

	protected function formatParams ($row_data)
	{
		return array(
			":status" => $row_data["Status"],
			":from" => date('Y-m-d', strtotime($row_data["From"])),
			":to" => date('Y-m-d', strtotime($row_data["To"])),
			":engine" => $row_data["Digital Vendor"],
			":account" => $row_data["Account"],
			":campaign" => $row_data["campaign"],
			":adgroup" => $row_data["adGroup"],
			":keyword" => $row_data["Keyword"],
			":matchtype" => $row_data["Match type"],
			":enginestatus" => $row_data["Engine status"],
			":effectivekeywordmaxCPC" => $row_data["Effective keyword max CPC"],
			":keywordmaxCPC" => $row_data["Keyword max CPC"],
			":advertiserbidstrategy" => $row_data["Advertiser bid strategy"],
			":effectivebidstrategy" => $row_data["Effective bid strategy"],
			":bidstrategyname" => $row_data["Effective engine bid strategy name"],
			":clicks" => $row_data["Clicks"],
			":impr" => $row_data["Impr"],
			":cost" => $row_data["Cost"],
			":ctr" => $row_data["CTR"],
			":avgCPC" => $row_data["Avg CPC"],
			":avgpos" => $row_data["Avg pos"],
			":getDirections" => $row_data["Get Directions"],
			":facilitySearches" => $row_data["Facility Searches"],
			":detailInteractions" => $row_data["Facility Listing and Detail Interactions"],
			":onlineReferralComplete" => $row_data["Online Referral Complete"],
			":homeDialysisLeadComplete" => $row_data["Home Dialysis Lead Complete"],
			":travelFormLeadComplete" => $row_data["Travel Form Lead Complete"],
			":leadContactUsFormSubmits" => $row_data["Lead: Contact Us Form Submits"],
			":kidneyCare365LeadComplete" => $row_data["KidneyCare: 365 Lead Complete"],
			":emailSignups" => $row_data["Email Signups"],
			":keywordlandingpage" => $row_data["Keyword landing page"],
			":advertiserID" => $row_data["Advertiser ID"],
			":advertiser" => $row_data["Advertiser"],
			":accountID" => $row_data["Account ID"],
			":dblclicksearchcampaignID" => $row_data["DoubleClick Search Campaign ID"],
			":adgroupID" => $row_data["Ad group ID"],
			":keywordID" => $row_data["Keyword ID"],
			":label" => $row_data["Label"],
			":urlparameters" => $row_data["URL parameters"],
			":minbid" => $row_data["Min bid"],
			":maxbid" => $row_data["Max bid"],
			":effectiveminbid" => $row_data["Effective min bid"],
			":effectivemaxbid" => $row_data["Effective max bid"],
			":engineBidStrategyName" => $row_data["Engine bid strategy name"],
			":clickserverURL" => $row_data["Clickserver URL"],
			":urltemplate" => $row_data["URL template"]	
		);
	}
}

















