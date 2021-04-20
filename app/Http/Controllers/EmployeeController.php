<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{

    public function index()
    {
        return view('admin.employees', ['data' => Employee::get()]);

    }


    public function create()
    {
        
            return view('admin.add_employee');
    }

    public function store(Request $request)
    {
        $employee= new Employee;
    	$employee->salary=$request->salary;
    	$employee->joining_date=$request->joining;
    	$employee->leaves=$request->leaves;
    	$employee->remaining_leaves=$request->remaining_leaves;

        $employee->save();
    }

    public function edit(Employee $employee)
    {
        
        return view('admin.edit',['employee'=>$employee]);
    }

    public function update(Request $request)
    {
        $employee=Employee::find($request->id);
        $employee->salary=$request->salary;
    	$employee->joining_date=$request->joining;
    	$employee->leaves=$request->leaves;
    	$employee->remaining_leaves=$request->remaining_leaves;
        $employee->save();
    }

    public function destroy(Employee $employee)
    {
        try
        {
            // throw new \Exception('item not Deleted');
        $employee->delete();
        Session::flash('message', 'Employee Deleted Successfully!');  
        return redirect('admin');
    }
    catch(exception $e){

        Session::flash('error', 'Employee Not Deleted!'); 
        return redirect('admin');

    }
    
    }
}