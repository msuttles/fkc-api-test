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
        'customerName', 'contactLastName', 'contactFirstName', 'phone', 'addressLine1', 'addressLine2', 'city', 'state', 'postalCode', 'country', 'salesRepEmployeeNumber', 'creditLimit', 'updated_at', 'created_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public static function filterByLastName($name)
    {
        $results = \DB::select('select * from customers where contactLastName = :contactlastname', ['contactlastname' => $name]);
        return $results;
    }

    public static function insertNew($newRow)
    {
        //var_dump($newRow);exit;
        $sql = \DB::insert('insert into customers (customerName, contactLastName, contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, country, creditLimit) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )', [$newRow['customerName'],$newRow['contactLastName'],$newRow['contactFirstName'],$newRow['phone'],$newRow['addressLine1'],$newRow['addressLine2'],$newRow['city'],$newRow['state'],$newRow['postalCode'],$newRow['country'],$newRow['creditLimit']]);
        return $sql;
    }

    public static function updateRecord($id,$rowData)
    {
        //$sql = \DB::update('update customers set customerName = '.$rowData['customerName'].', contactLastName = '.$rowData['contactLastName'].', contactFirstName = '.$rowData['contactFirstName'].', phone = '.$rowData['phone'].', addressLine1 = '.$rowData['addressLine1'].', city = '.$rowData['city'].', state = '.$rowData['state'].', postalCode = '.$rowData['postalCode'].', country = '.$rowData['country'].', creditLimit ='.$rowData['creditLimit'].' where id = ?', [$rowData['id']]);
        $sql = \DB::table('customers')->where('id', $id)->update(['customerName' => $rowData['customerName'], 'contactLastName' => $rowData['contactLastName'], 'contactFirstName' => $rowData['contactFirstName'], 'phone' => $rowData['phone'], 'addressLine1' => $rowData['addressLine1'], 'city' => $rowData['city'], 'state' => $rowData['state'], 'postalCode' => $rowData['postalCode'], 'country' => $rowData['country'], 'creditLimit' => $rowData['creditLimit']]);
        return $sql;
    }
}