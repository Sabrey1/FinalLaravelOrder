<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('Customer.CustomerList', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Customer.CustomerCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $customer = new Customer();
           $customer->name = $request->name;
           $customer->email = $request->email;
           $customer->phone = $request->phone;
           $customer->address = $request->address;
           $customer->save();
        return redirect()->route('customer.index')->with('create', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer, $id)
    {
        $customer = Customer::findOrFail($id);
        return view('Customer.customerShow', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer, $id)
    {
        $customer = Customer::findOrFail($id);
        return view('Customer.customerEdit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if($customer){
            $customer->update($request->all());
            return redirect()->route('customer.index')->with('update', 'Customer updated successfully.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('customer.index')->with('delete', 'Customer deleted successfully.');
    }
}
