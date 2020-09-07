<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Image;

class EmployeeController extends Controller
{
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
        $employee->nid = $request->nid;
        $employee->address = $request->address;
        $employee->joining_date = $request->joining_date;

        if ($request->photo) {
            $strpos = strpos($request->photo, ';'); //get string position
            $sub = substr($request->photo, 0, $strpos); // cut string 0 to ';' position
            $ex = explode('/', $sub)[1]; //explode from '/'
            $name = time() . '.' . $ex; //time() gives a name and ex get a extension and then join here
            $location = (public_path(Employee::IMAGE_PATH.date('Y').'/'.date('m')) . $name);  // which location we want to save
            $img = Image::make($request->photo)->resize(240, 200); //make image
            $img->save($location); //save to location
            $employee->photo = $location;
        }

        $employee->save();
        return response()->json(['success' => 'Employee added successfully!']);
    }
}
