<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
                'leaves' => 'required|string|max:11',
                'image'=>'required|file|max:255',
            ]);
            
            $user= new User;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->set_as= 0;
            $user->contact=$request->contact;
            $user->leaves=$request->leaves;

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
            return redirect('admin')->with('Employee Added Successfully');
}

        public function AdminLogin(Request $request)
        {
            $credentials = $request->only('email', 'password');   

            // $credentials['set_as'] = 1; 2nd method to pass data

            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'set_as' => 1])) {
                $request->session()->regenerate();

                return redirect()->intended('admin');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        public function destroy(Request $request)
            {
                Auth::logout();
        
                $request->session()->invalidate();
        
                $request->session()->regenerateToken();
        
                return redirect('admin-login');
            }

            public function delete(User $user)
            {
               
                $user->delete();
            }

            public function edit(User $user)
            {
                return view('admin.edit-employee',['user'=>$user]);
            
            }


            public function UpdateEmployee(Request $request)
            {
                
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255',
                    'contact' => 'required|string|max:11',
                ]);
                $user=User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->contact = $request->contact;
                $user->save();
            }

            public function history()
            {
        
                $users = User::where('id',auth()->user()->id)->get();
                    
                return view('employees.history', ['data' => $users]);
            }

}
