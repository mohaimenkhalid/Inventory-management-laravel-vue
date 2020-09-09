<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employees'],
            'phone' => ['required', 'string', 'max:20'],
            'salary' => ['required'],
            'gender' => ['required'],
            'nid' => ['required'],
            'address' => ['required'],
            'joining_date' => ['required'],
        ]);

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->salary = $request->salary;
        $employee->gender = $request->gender;
        $employee->nid = $request->nid;
        $employee->address = $request->address;
        $employee->joining_date = $request->joining_date;
        $employee->save();
        return response()->json(['success' => 'Employee added successfully!']);
    }

    public function destroy($id) {
        $employee = Employee::find($id)->delete();
        return response()->json(['success', 'Employee deleted successfully!']);
    }

     public function update($id, Request $request){
         $employee = Employee::find($id);
         $employee->name = $request->name;
         $employee->email = $request->email;
         $employee->phone = $request->phone;
         $employee->salary = $request->salary;
         $employee->gender = $request->gender;
         $employee->nid = $request->nid;
         $employee->address = $request->address;
         $employee->joining_date = $request->joining_date;
         $employee->save();
         return response()->json(['success' => 'Employee Information updated successfully!']);
     }
}
