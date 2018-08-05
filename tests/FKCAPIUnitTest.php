<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class FKCAPITest extends TestCase
{
    /**
     * /customers [GET]
     */
    public function testShouldReturnAllProducts(){
        //$this->get("customers", []);
        $this->get("http://fkctestapi.io/api/customers/", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'customerName',
                'contactLastName',
                'contactFirstName',
                'phone',
                'addressLine1',
                'addressLine2',
                'city',
                'state',
                'postalCode', 
                'country', 
                'salesRepEmployeeNumber', 
                'creditLimit'
            ]
        );
        
    }
    /**
     * /customers/id [GET]
     */
    public function testShouldReturnProduct(){
        //$this->get("customers/id/{id}", []);
        $this->get("http://fkctestapi.io/api/customers/id/1", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            [
                'id',
                'customerName',
                'contactLastName',
                'contactFirstName',
                'phone',
                'addressLine1',
                'addressLine2',
                'city',
                'state',
                'postalCode', 
                'country', 
                'salesRepEmployeeNumber', 
                'creditLimit'
            ] 
        );
        
    }
    /**
     * /customers [POST]
     */
    public function testShouldCreateProduct(){
        $parameters = [
            "customerName" => "Code That Doesnt Crumble",
            "contactLastName" => "Shocker",
            "contactFirstName" => "Sosa",
            "phone" => "9017854522",
            "addressLine1" => "4262 Indian Bend Ave",
            "addressLine2" => "",
            "city" => "Olive Branch",
            "state" => "MS",
            "postalCode" => "38654",
            "country" => "US",
            "salesRepEmployeeNumber" => "",
            "creditLimit" => "136800.00"
        ];
        //$this->post("customers", $parameters, []);
        $this->post("http://fkctestapi.io/api/customers/", $parameters, ['Content-Type'=>'application/x-www-form-urlencoded']);
        $this->seeStatusCode(201);
        //Post responses with true (boolean) after post request works so no need for seeJsonStructure function since no json is returned
        //$this->seeJsonStructure(
            // ['data' =>
            //     [
            //         'product_name',
            //         'product_description',
            //         'created_at',
            //         'updated_at',
            //         'links'
            //     ]
            // ]
            // [
            //     'id',
            //     'customerName',
            //     'contactLastName',
            //     'contactFirstName',
            //     'phone',
            //     'addressLine1',
            //     'addressLine2',
            //     'city',
            //     'state',
            //     'postalCode', 
            //     'country', 
            //     'salesRepEmployeeNumber', 
            //     'creditLimit'
            // ]    
        //);
        
    }
    
    /**
     * /customers/id [PUT]
     */
    public function testShouldUpdateProduct(){
        $parameters = [
            'customerName' => 'Code That Doesnt Suck',
            'contactLastName' => 'Suttles',
            "contactFirstName" => "Sosa",
            "phone" => "9017854522",
            "addressLine1" => "4262 Indian Bend Ave",
            "addressLine2" => "",
            "city" => "Olive Branch",
            "state" => "MS",
            "postalCode" => "38654",
            "country" => "US",
            "salesRepEmployeeNumber" => "",
            "creditLimit" => "136800.00"
        ];
        //$this->put("customers/{id}", $parameters, []);
        $this->put("http://fkctestapi.io/api/customers/505", $parameters, ['Content-Type'=>'application/x-www-form-urlencoded']);
        $this->seeStatusCode(200);
        //$this->seeJsonStructure(
            // ['data' =>
            //     [
            //         'product_name',
            //         'product_description',
            //         'created_at',
            //         'updated_at',
            //         'links'
            //     ]
            // ]
        //);
    }
    /**
     * /customers/id [DELETE]
     */
    public function testShouldDeleteProduct(){
        
        //$this->delete("customers/{id}", [], []);
        $this->delete("http://fkctestapi.io/api/customers/499", [], []);
        $this->seeStatusCode(200);
        //$this->seeStatusCode(410);
        // $this->seeJsonStructure([
        //         'status',
        //         'message'
        // ]);
    }

    /**
     * / Validation checker [POST]
     * 
     * / returns  if validations works and  if validation finds an error
     */
}