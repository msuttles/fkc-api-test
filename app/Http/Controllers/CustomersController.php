<?php

namespace App\Http\Controllers;

use App\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\APIHelperController;
//use App\Http\Controllers\DBConnection;

class CustomersController extends Controller
{

    public function getAll()
    {
        return response()->json(Customers::all());
    }

    public function getByID($customerID)
    {
        return response()->json(Customers::find($customerID));
    }

    public function getByName($name)
    {
        return response()->json(Customers::filterByLastName($name));
    }

    public function create(Request $request)
    {
        $Validationfields = [
            'customerName' => 'string|digits_between:0,50',
            'contactLastName' => 'string|digits_between:0,50',
            'contactFirstName' => 'string|digits_between:0,50',
            'phone' => 'regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/',
            'addressLine1' => 'string|digits_between:0,50',
            'addressLine2' => 'string|digits_between:0,50|nullable',
            'city' => 'string|digits_between:0,50',
            'state' => 'string|digits_between:0,50',
            'postalCode' => 'string|digits_between:0,10', 
            'country' => 'string|digits_between:0,50', 
            'salesRepEmployeeNumber' => 'numeric|nullable', 
            'creditLimit' => 'numeric'
        ];
        APIHelperController::FormatChecker($request, $Validationfields);

        $insert = Customers::insertNew($request->all());
        return response()->json($insert, 201);
    }

    public function update($id, Request $request)
    {
        $Validationfields = [
            'customerName' => 'string|digits_between:0,50',
            'contactLastName' => 'string|digits_between:0,50',
            'contactFirstName' => 'string|digits_between:0,50',
            'phone' => 'regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/',
            'addressLine1' => 'string|digits_between:0,50',
            'addressLine2' => 'string|digits_between:0,50|nullable',
            'city' => 'string|digits_between:0,50',
            'state' => 'string|digits_between:0,50',
            'postalCode' => 'string|digits_between:0,10', 
            'country' => 'string|digits_between:0,50', 
            'salesRepEmployeeNumber' => 'numeric|nullable',        
            'creditLimit' => 'numeric'
        ];
        APIHelperController::FormatChecker($request, $Validationfields);

        $update = Customers::updateRecord($id, $request->all());
        return response()->json($update, 200);
    }

    public function delete($id)
    {
        Customers::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

    public function GetRankedData()
    {
        $HMO_Data = Customers::RankData('ByCounty');
        $insert_table = 'RankedData';
        Customers::TruncateData($insert_table);
        foreach($HMO_Data as $rankedData){
            Customers::insertRankedData($rankedData,$insert_table);
        }

        $arrHeaders = array('Order', 'PY Plan', 'CY Plan', 'Product Type', 'SNP Type', 'Combo', 'Priority', 'State', 'County', 'StateCounty', 'FIPS', 'Premium', 'Membership', 'Lookup', 'Rank');

        $date = new \DateTime();
		$today = $date->format('Ymd');
        $file = 'Humana_Ranked_Data_Export' . '_' . $today . '.csv';
        $fp = fopen(base_path().'/exports/'.$file, 'w');
        if ($fp && $HMO_Data) {
			fputcsv($fp, $arrHeaders);
			
			foreach ($HMO_Data as $row){
                $row = (object) $row;
				fputcsv($fp, get_object_vars($row));
			}
		}

        return response()->json($HMO_Data, 200);
    }

    public function GetRankedHMOData()
    {
        $HMO_Data = Customers::RankData('HMO');
        $insert_table = 'RankedHMO';
        Customers::TruncateData('RankedData');
        foreach($HMO_Data as $rankedData){
            Customers::insertRankedData($rankedData,$insert_table);
        }

        $arrHeaders = array('Order', 'PY Plan', 'CY Plan', 'Product Type', 'SNP Type', 'Combo', 'Priority', 'State', 'County', 'StateCounty', 'FIPS', 'Premium', 'Membership', 'Lookup', 'Rank');

        $date = new \DateTime();
		$today = $date->format('Ymd');
        $file = 'Humana_Ranked_Data_Export' . '_' . $today . '.csv';
        $fp = fopen(base_path().'/exports/'.$file, 'w');
        if ($fp && $HMO_Data) {
			fputcsv($fp, $arrHeaders);
			
			foreach ($HMO_Data as $row){
                $row = (object) $row;
				fputcsv($fp, get_object_vars($row));
			}
		}

        return response()->json($HMO_Data, 200);
    }

    public function GetRankedPPOData()
    {
        $HMO_Data = Customers::RankData('PPO');
        $insert_table = 'RankedPPO';
        Customers::TruncateData($insert_table);
        foreach($HMO_Data as $rankedData){
            Customers::insertRankedData($rankedData,$insert_table);
        }

        $arrHeaders = array('Order', 'PY Plan', 'CY Plan', 'Product Type', 'SNP Type', 'Combo', 'Priority', 'State', 'County', 'StateCounty', 'FIPS', 'Premium', 'Membership', 'Lookup', 'Rank');

        $date = new \DateTime();
		$today = $date->format('Ymd');
        $file = 'Humana_Ranked_Data_Export' . '_' . $today . '.csv';
        $fp = fopen(base_path().'/exports/'.$file, 'w');
        if ($fp && $HMO_Data) {
			fputcsv($fp, $arrHeaders);
			
			foreach ($HMO_Data as $row){
                $row = (object) $row;
				fputcsv($fp, get_object_vars($row));
			}
		}

        return response()->json($HMO_Data, 200);
    }

    public function GetRankedLPPOData()
    {
        $HMO_Data = Customers::RankData('LPPO');
        $insert_table = 'RankedLPPO';
        Customers::TruncateData('RankedLPPO');
        foreach($HMO_Data as $rankedData){
            Customers::insertRankedData($rankedData, $insert_table);
        }

        $arrHeaders = array('Order', 'PY Plan', 'CY Plan', 'Product Type', 'SNP Type', 'Combo', 'Priority', 'State', 'County', 'StateCounty', 'FIPS', 'Premium', 'Membership', 'Lookup', 'Rank');

        $date = new \DateTime();
		$today = $date->format('Ymd');
        $file = 'Humana_Ranked_Data_Export' . '_' . $today . '.csv';
        $fp = fopen(base_path().'/exports/'.$file, 'w');
        if ($fp && $HMO_Data) {
			fputcsv($fp, $arrHeaders);
			
			foreach ($HMO_Data as $row){
                $row = (object) $row;
				fputcsv($fp, get_object_vars($row));
			}
		}

        return response()->json($HMO_Data, 200);
    }

    public function GetRankedRPPOData()
    {
        $HMO_Data = Customers::RankData('RPPO');
        $insert_table = 'RankedRPPO';
        Customers::TruncateData('RankedData');
        foreach($HMO_Data as $rankedData){
            Customers::insertRankedData($rankedData,$insert_table);
        }

        $arrHeaders = array('Order', 'PY Plan', 'CY Plan', 'Product Type', 'SNP Type', 'Combo', 'Priority', 'State', 'County', 'StateCounty', 'FIPS', 'Premium', 'Membership', 'Lookup', 'Rank');

        $date = new \DateTime();
		$today = $date->format('Ymd');
        $file = 'Humana_Ranked_Data_Export' . '_' . $today . '.csv';
        $fp = fopen(base_path().'/exports/'.$file, 'w');
        if ($fp && $HMO_Data) {
			fputcsv($fp, $arrHeaders);
			
			foreach ($HMO_Data as $row){
                $row = (object) $row;
				fputcsv($fp, get_object_vars($row));
			}
		}

        return response()->json($HMO_Data, 200);
    }
}