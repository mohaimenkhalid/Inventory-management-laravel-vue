<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'phone' => ['required', 'string', 'max:20'],
            'gender' => ['required'],
            'nid' => ['required'],
            'address' => ['required'],
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->gender = $request->gender;
        $customer->nid = $request->nid;
        $customer->address = $request->address;
        $customer->save();
        return response()->json(['success' => 'Employee added successfully!']);
    }

    public function destroy($id) {
        $customer = Customer::find($id)->delete();
        return response()->json(['success', 'Employee deleted successfully!']);
    }

    public function update($id, Request $request){
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->salary = $request->salary;
        $customer->gender = $request->gender;
        $customer->nid = $request->nid;
        $customer->address = $request->address;
        $customer->joining_date = $request->joining_date;
        $customer->save();
        return response()->json(['success' => 'Employee Information updated successfully!']);
    }
}
