<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function register()
    {
        return view('customer.register');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users|',
            'password' => 'required',  
        ],[
            'first_name.required' => 'Please Enter Your FirstName',
            'last_name.required' => 'Please Enter Your LastName',
            'email.required' => 'Please Enter Your Email',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'Please Enter Your password',
        ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'role' => 'customer', // Assign the role here
        ]);

        // You can customize the redirect or message as needed
        return redirect('/')->with('success', 'customer registration successful.');
    }

    public function login(Request $request)
    {
            return view('customer.login');
    }

    public function loginverify(Request $request)
    { 
        $user = User::where('email',$request->email)->exists();
        if($user ==true)
        {
            $user = User::where('email',$request->email)->first();
            if($user->role == 'customer')
            {
                
                return redirect()->route('customer.getdata')->withErrors(['error' => 'You are not allowed to login from here.']);
            }else{
                return redirect()->route('customer.getdata')->withErrors(['error' => 'You are not allowed to login from here.']);

            }
            
        }
       
    }
}
