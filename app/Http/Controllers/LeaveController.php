<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LeaveController extends Controller
{

    public function index()
    {
        return view('admin.leaves', ['data' => Leave::get()]);

    }


    public function create()
    {
        
            return view('admin.employee_leave');
    }

    public function store(Request $request)
    {
        $leave= new Leave;
        $leave->employee_id=$request->user()->id;
    	$leave->days=$request->days;
    	$leave->leave_from=$request->leave_from;
    	$leave->leave_to=$request->leave_to;
        $leave->has_approved=now();

        $leave->save();
    }

    public function destroy(Leave $leave)
    {
        try
        {
            // throw new \Exception('item not Deleted');
        $leave->delete();
        Session::flash('message', 'Record Deleted Successfully!');  
        return redirect('admin/leaves');
    }
    catch(exception $e){

        Session::flash('error', 'Record Not Deleted!'); 
        return redirect('admin/leaves');

    }
    
    }

    public function edit(Leave $leave)
    {
        
        return view('admin.edit_leave',['leave'=>$leave]);
    }

    public function update(Request $request)
    {
        $leave=Leave::find($request->id);
    	$leave->days=$request->days;
    	$leave->leave_from=$request->leave_from;
    	$leave->leave_to=$request->leave_to;

        $leave->save();
    }

}
