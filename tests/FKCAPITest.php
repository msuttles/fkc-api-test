<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class FKCAPITestClass extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFKCAPI()
    {
        // $this->get('/');

        // $this->assertEquals(
        //     $this->app->version(), $this->response->getContent()
        // );

        // $this->json('GET', '/customers', ['contactLastName' => 'Suttles'])
        // ->seeJson([
        //    'created' => true,
        // ]);

        $this->get("customers", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'customerNumber',
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
            ],
            'meta' => [
                '*' => [
                    'total',
                    'count',
                    'per_page',
                    'current_page',
                    'total_pages',
                    'links',
                ]
            ]
        ]);
    }
}
