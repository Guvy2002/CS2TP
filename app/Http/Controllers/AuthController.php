<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function login() {
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }

    public function loginUser(Request $request) 
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', '=', $request->email)->first();
        
        if (!$user) return back()->with('fail', 'Email not recognized');
        if (Hash::check($request->password, $user->passwordHash)) 
        { 
            $request->session()->put('loginId', $user->id); 
  
            return redirect('home');
        }
        else return back()->with('fail', 'Account details incorrect');

    }

    public function registerUser(Request $request) 
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:24',
            'password2' => 'required'
        ]);

        $pass1 = $request->password;
        $pass2 = $request->password2;

        if ($pass1 != $pass2) return back()->with('mismatch', 'Passwords do not match');

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->passwordHash = Hash::make($request->password);
        $res = $user->save();

        if($res) return back()->with('success', 'Account registered');
        else return back()->with('fail', 'Unable to create account');
    }

    public function home()
    {
        $data = array();
        if(Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('home', compact('data'));
    }

    public function logout() {
        if(Session::has('loginId')) {
            Session::pull('loginId'); //unset logged in account
            Session::pull('cart'); //clear basket session
        }
        return redirect('login');
    }
}
