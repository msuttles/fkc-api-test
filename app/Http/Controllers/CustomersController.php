<?php

namespace App\Http\Controllers;

use App\Customers;
use Illuminate\Http\Request;
use App\Http\Controllers\APIHelperController;
//use App\Http\Controllers\DBConnection;
use App\Http\Controllers\Schema;

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

    public function GetRankedData($plantype)
    {
        // get active sources
        if (empty($plantype)) {
            $tablename = 'RankedAllPlans';
        } else {
            $tablename = 'Ranked'.$plantype;
        }

        $Plan_Data = Customers::RankData('AllPlanTypes');
        Customers::TruncateData($tablename);
        foreach($Plan_Data as $rankedData){
            Customers::insertRankedData($rankedData,$tablename);
        }

        $arrHeaders = \Schema::getColumnListing($tablename);

        $date = new \DateTime();
		$today = $date->format('Ymd');
        $file = $tablename . '_Data_Export' . '_' . $today . '.csv';
        $fp = fopen(base_path().'/exports/'.$file, 'w');
        if ($fp && $Plan_Data) {
			fputcsv($fp, $arrHeaders);
			
			foreach ($Plan_Data as $row){
                $row = (object) $row;
				fputcsv($fp, get_object_vars($row));
			}
		}

        return response()->json($Plan_Data, 200);
    }

}