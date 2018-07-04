<?php

namespace App\Http\Controllers;

use App\Customers;
use Illuminate\Http\Request;
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

        // $this->validate($request, [
        //     'customerNumber' => 'required'
        //     'customerName' => 'required|email|unique:users',
        //     'contactLastName' => 'required|alpha',
        //     'contactFirstName' => 'required',
        //     'phone' => 'required',
        //     'addressLine1' => 'required',
        //     'addressLine2' => 'required',
        //     'city' => 'required',
        //     'state' => 'required',
        //     'postalCode' => 'required', 
        //     'country' => 'required', 
        //     'salesRepEmployeeNumber' => 'required', 
        //     'creditLimit' => 'required'
        // ]);
       //var_dump($request->all());exit;

        //$author = Customers::create($request->all());
        $insert = Customers::insertNew($request->all());
        return response()->json($insert, 201);

        //return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        //$author = Customers::findOrFail($id);
        //$author->update($request->all());
        $update = Customers::updateRecord($id, $request->all());
        return response()->json($update, 200);

        //return response()->json($author, 200);
    }

    public function delete($id)
    {
        Customers::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}