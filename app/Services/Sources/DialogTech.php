<?php

namespace App\Services\Sources;

use Illuminate\Support\Facades\DB;

class DialogTech extends Source {

    protected $source = 'dt';

    protected $insert_params = "(
			`date_added`,
			`call_type`,
			`first_activity`,
			`last_activity`,
			`dnis`,
			`ani`,
			`network_minutes`,
			`enhanced_minutes`,
			`adj_switch`,
			`adj_network`,
			`adj_enhanced`,
			`call_duration`,
			`transfer_type`,
			`transfer_to_number`,
			`phone_label`,
			`Call Transfer Status`,
			`URL Tag`,
			`Campaign Name`
            ) VALUES (
			:dateAdded,
			:callType,
			:firstActivity,
			:lastActivity,
			:dnis,
			:ani,
			:networkMinutes,
			:enhancedMinutes,
			:adjSwitch,
			:adjNetwork,
			:adjEnhanced,
			:callDuration,
			:transferType,
			:transferToNumber,
			:phoneLabel,
			:callTransferStatus,
			:urlTag,
			:campaignName)";

    protected function formatParams ($row_data)
    {
        return array(
			':dateAdded' => date('m/d/Y H:i', strtotime($row_data['date_added'])),
			':callType' => $row_data['call_type'],
			':firstActivity' => $row_data['first_activity'],
			':lastActivity' => $row_data['last_activity'],
			':dnis' => $row_data['dnis'],
			':ani' => $row_data['ani'],
			':networkMinutes' => $row_data['network_minutes'],
			':enhancedMinutes' => $row_data['enhanced_minutes'],
			':adjSwitch' => $row_data['adj_switch'],
			':adjNetwork' => $row_data['adj_network'],
			':adjEnhanced' => $row_data['adj_enhanced'],
			':callDuration' => $row_data['call_duration'],
			':transferType' => $row_data['transfer_type'],
			':transferToNumber' => $row_data['transfer_to_number'],
			':phoneLabel' => $row_data['phone_label'],
			':callTransferStatus' => $row_data['Call Transfer Status'],
			':urlTag' => $row_data['URL Tag'],
			':campaignName' => $row_data['Campaign Name']
		);
	}
}




















