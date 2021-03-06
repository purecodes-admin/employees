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
        
            return view('employees.employee_leave');
    }

    public function store(Request $request)
    {
        $leave= new Leave;
        $leave->employee_id=$request->user()->id;
    	$leave->days=$request->days;
    	$leave->leave_from=$request->leave_from;
    	$leave->leave_to=$request->leave_to;
    	$leave->status='pending';

        $leave->save(); 
    }

    public function destroy(Leave $leave)
    {
        try
        {
            // throw new \Exception('item not Deleted');
        $leave->delete();
        Session::flash('message', 'Record Deleted Successfully!');  
        return redirect('employees/leaves');
    }
    catch(exception $e){

        Session::flash('error', 'Record Not Deleted!'); 
        return redirect('employees/leaves');

    }
    
    }

    public function edit(Leave $leave)
    {
        
        return view('employees.edit_leave',['leave'=>$leave]);
    }

    public function EditLeave(Leave $leave)
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


    public function UpdateLeave(Request $request)
    {
        $leave=Leave::find($request->id);
    	$leave->days=$request->days;
    	$leave->leave_from=$request->leave_from;
    	$leave->leave_to=$request->leave_to;

        $leave->save();
    }

    public function UserLeaves()
    {
        return view('employees.leaves', ['data' => Leave::where('employee_id',auth()->user()->id)
        ->get()]);

    }

    public function approve(Leave $leave ,Request $request)
    {
                if(($leave->status == 'pending')){
                    $leave->status='Approved';
                    $leave->has_approved = now();
                    $leave->save();

                    DB::table('users')->where('id',$leave->employee_id)
                    ->decrement('leaves',$leave->days)
                    ;

                    Session::flash('approve', 'Leave Approved Successfully!'); 
                    return redirect('admin/leaves');
            }
            else{
                Session::flash('message', 'Leave Already Approved!'); 
                return redirect('admin/leaves');
            }
    }


    public function reject(Leave $leave ,Request $request)
    {
                if(($leave->status == 'pending')){
                    $leave->status='Rejected';
                    $leave->has_approved = now();
                    $leave->save();
                    Session::flash('reject', 'Leave Rejected Successfully!'); 
                    return redirect('admin/leaves');
            }
            else{
                Session::flash('message1', 'Leave Already Rejected!'); 
                return redirect('admin/leaves');
            }
    }


    public function DestroyLeave(Leave $leave)
    {
        try
        {
            // throw new \Exception('item not Deleted');
        $leave->delete();
        Session::flash('success', 'Record Deleted Successfully!');  
        return redirect('admin/leaves');
    }
    catch(exception $e){

        Session::flash('error', 'Record Not Deleted!'); 
        return redirect('admin/leaves');

    }

}


}
