<?php

namespace App\Http\Controllers;

use App\Models\Increment;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Session;

class IncrementController extends Controller
{


    public function index()
    {

        $increments = Increment::with('employee')->when(request('search') != '', function($q) {
            $q->where('name', 'like', '%' . request('search') . '%');
        })->paginate(3);
            
        return view('admin.increments-history', ['data' => $increments]);
    }

//     public function Increment(Increment $user)
//     {
//         return view('admin.increment',['user'=>$user]);
    
//     }

   public function UpdateSalary(Request $request)
    {
        
        $request->validate([
          
            'salary' => 'required|string',
        ]);
        $increment=Increment::find($request->id);
        $increment->salary=$request->salary;
        $increment->save();
    }
}
