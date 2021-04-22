<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{


    public function index()
    {

        $users = User::when(request('search') != '', function($q) {
            $q->where('name', 'like', '%' . request('search') . '%')
            ->orwhere('email', 'like', '%' . request('search') . '%');
        })->paginate(3);
            
        return view('admin.dashboard', ['data' => $users]);
    }

    public function create(){
      
        return view("admin.register");
    }


    // Add Employee Code

    public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'contact' => 'required|string|max:11',
                'image'=>'required|file|max:255',
            ]);
            
            $user= new User;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->set_as= 0;
            $user->contact=$request->contact;

            if($request->hasfile('image')){
                    $file = $request->file('image');
                    $extension = $file->getClientOriginalExtension(); 
                    // getting image extention
                    $filename = time().'.'. $extension;
                    $file->move('images/', $filename);
                    $user->image = $filename;
                }
                else{
                        // return $request;
                        $user->image='';
                    }
            $user->save();
            return redirect('users')->with('Employee Added Successfully');
}
}
