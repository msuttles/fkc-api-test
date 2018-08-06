<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customerName', 'contactLastName', 'contactFirstName', 'phone', 'addressLine1', 'addressLine2', 'city', 'state', 'postalCode', 'country', 'salesRepEmployeeNumber', 'creditLimit'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function filterByLastName($name)
    {
        $sql = \DB::select('select * from customers where contactLastName = :contactlastname', ['contactlastname' => $name]);
        return $sql;
    }

    public static function insertNew($newRow)
    {
        //var_dump($newRow);exit;
        $sql = \DB::insert('insert into customers (customerName, contactLastName, contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, country, salesRepEmployeeNumber, creditLimit) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )', [$newRow['customerName'],$newRow['contactLastName'],$newRow['contactFirstName'],$newRow['phone'],$newRow['addressLine1'],$newRow['addressLine2'],$newRow['city'],$newRow['state'],$newRow['postalCode'],$newRow['country'],$newRow['salesRepEmployeeNumber'],$newRow['creditLimit']]);
        return $sql;
    }

    public static function updateRecord($id,$rowData)
    {
        //$sql = \DB::update('update customers set customerName = '.$rowData['customerName'].', contactLastName = '.$rowData['contactLastName'].', contactFirstName = '.$rowData['contactFirstName'].', phone = '.$rowData['phone'].', addressLine1 = '.$rowData['addressLine1'].', city = '.$rowData['city'].', state = '.$rowData['state'].', postalCode = '.$rowData['postalCode'].', country = '.$rowData['country'].', creditLimit ='.$rowData['creditLimit'].' where id = ?', [$rowData['id']]);
        $sql = \DB::table('customers')->where('id', $id)->update(['customerName' => $rowData['customerName'], 'contactLastName' => $rowData['contactLastName'], 'contactFirstName' => $rowData['contactFirstName'], 'phone' => $rowData['phone'], 'addressLine1' => $rowData['addressLine1'], 'city' => $rowData['city'], 'state' => $rowData['state'], 'postalCode' => $rowData['postalCode'], 'country' => $rowData['country'], 'creditLimit' => $rowData['creditLimit']]);
        return $sql;
    }

    public static function RankData($tablename){
        $results = \DB::select('select * from ' . $tablename);
		$arrFIPS = [];
		$dupeCount = 0;
		foreach ($results as $result) {
            $points = 0;
            $result->{'Points'} = 0;
            
			if($result->{'Product Type'} == 'HMO'){
				$points += 30;
			}
			if($result->{'Product Type'} == 'LPPO' || $result->{'Product Type'} == 'RPPO'){
				$points += 20;
			}
			if($result->{'SNP Type'} == 'Non-SNP'){
				$points += 30;
			}
			if($result->{'SNP Type'} == 'Dual-Eligible'){
				$points += 20;
			}
			if($result->{'SNP Type'} == 'Value Plus'){
				$points += 10;
			}
			$isInArr = in_array($result->{'FIPS'}, $arrFIPS);
			if(!$isInArr){
                $rank = 1;
				$dupeCount = 0;
				$points += 100;
				array_push($arrFIPS,$result->{'FIPS'}); 
			}
			if($isInArr){
                $rank += 1;
                $dupeCount += 1;
                if($dupeCount >= 1){
					switch($dupeCount){
						case 1:
							$points += 90;
							break;
						case 2:
							$points += 80;
							break;
						case 3:
							$points += 70;
							break;
						case 4:
							$points += 60;
							break;
						case 5:
							$points += 50;
							break;
						case 6:
							$points += 40;
							break;
						case 7:
							$points += 30;
							break;
						case 8:
							$points += 20;
							break;
						case 9:
							$points += 10;
							break;
					}
				}
			}
            $result->{'Points'} = $points;
            $result->{'Rank'} = $rank;	
			$results_array[] = (array) $result;
		}
		// echo '<pre>';
		//  print_r($results_array);
        // echo '</pre>';
        return $results_array;
    }

    public static function TruncateData($truncateTable)
    {
        \DB::statement('TRUNCATE '.$truncateTable);
    }

    public static function insertRankedData($rankedData,$table)
    {      
        $sql = \DB::insert('insert into '. $table .' (`Order`, `PY Plan`, `CY Plan`, `Product Type`, `SNP Type`, `Combo`, `Priority`, `State`, `County`, `State-County`, `FIPS`, `Premium`, `Membership`, `Lookup`, `Rank`) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$rankedData['Order'],$rankedData['PY Plan'],$rankedData['CY Plan'],$rankedData['Product Type'],$rankedData['SNP Type'],$rankedData['Combo'],$rankedData['Priority'],$rankedData['State'],$rankedData['County'],$rankedData['State-County'],$rankedData['FIPS'],$rankedData['Premium'],$rankedData['Membership'],$rankedData['Lookup'],$rankedData['Rank']]);
        return $sql;
    }
}