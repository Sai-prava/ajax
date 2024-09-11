<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    public function login()
    {
        if (!empty(Auth::check())) {
            return redirect()->route('student.index');
        }
        return view('auth.login');
    }
    public function storeregister(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:5",
            "phone" => "required",
        ]);

        $storeregister = new User();
        $storeregister->name = $request->name;
        $storeregister->email = $request->email;
        $storeregister->password = Hash::make($request->password);
        //password(123456789)
        $storeregister->phone = $request->phone;
        $storeregister->save();

        return redirect()->route('student.index')->with('Success', 'Register Successfully');
    }


    public function storelogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            return redirect()->route('student.index')->with('success', 'login Successfully');
        } else {
            return redirect()->back()->with('error');
        }
    }

    // //logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
