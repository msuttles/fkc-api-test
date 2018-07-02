<?php

namespace App\Http\Controllers;

use App\customers;
use Illuminate\Http\Request;

class CustomersController extends Controller
{

    public function showAllCustomers()
    {
        return response()->json(customers::all());
    }

    public function showOneCustomer($customerNumber)
    {
        //return response()->json(customers::find($customerNumber));
        return response()->json(customers::fromQuery($customerNumber));
    }

    public function create(Request $request)
    {

        $this->validate($request, [
            'customerNumber' => 'required'
            // 'customerName' => 'required|email|unique:users',
            // 'contactLastName' => 'required|alpha',
            // 'contactFirstName' => 'required',
            // 'phone' => 'required',
            // 'addressLine1' => 'required',
            // 'addressLine2' => 'required',
            // 'city' => 'required',
            // 'state' => 'required',
            // 'postalCode' => 'required', 
            // 'country' => 'required', 
            // 'salesRepEmployeeNumber' => 'required', 
            // 'creditLimit' => 'required'
        ]);

        $author = customers::create($request->all());

        return response()->json($author, 201);
    }

    public function update($id, Request $request)
    {
        $author = customers::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        customers::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}