<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:suppliers'],
            'phone' => ['required', 'string', 'max:20'],
            'nid' => ['required'],
            'address' => ['required'],
            'joining_date' => ['required'],
        ]);

        $supplier = new Supplier;
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->nid = $request->nid;
        $supplier->address = $request->address;
        $supplier->joining_date = $request->joining_date;
        $supplier->save();
        return response()->json(['success' => 'Supplier added successfully!']);
    }

    public function destroy($id) {
        $supplier = Supplier::find($id)->delete();
        return response()->json(['success', 'Supplier deleted successfully!']);
    }

    public function update($id, Request $request){
        $supplier = Supplier::find($id);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->nid = $request->nid;
        $supplier->address = $request->address;
        $supplier->joining_date = $request->joining_date;
        $supplier->save();
        return response()->json(['success' => 'Supplier Information updated successfully!']);
    }
}
