<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // if ($request->getMethod() == 'POST') {
        //     $credentials = $request->only('email', 'password');

        //     // Attempt login for admin (is_admin = 1)
        //     $credentials['is_admin'] = 1;
        //     if (Auth::attempt($credentials)) {
        //         return redirect()->route('admin.admin-dashboard.index')->with('success', 'You have been logged in successfully as admin.');
        //     }

        //     // Attempt login for branch admin (is_admin = 2)
           
        // }
        if ($request->getMethod() == 'POST') {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                switch ($user->is_admin) {

                    case '1':
                        return redirect()->route('admin.admin-dashboard.index')->with('success', 'You have been logged in successfully as admin.');
                    case '2':
                        return redirect()->route('admin.branch-dashboard.index')->with('success', 'You have been logged in successfully as admin.');

                    default:
                        Auth::logout();
                        return redirect()->route('admin.login')->with('message', 'Wrong Email & Password');
                }
            } else {
                return redirect()->back()->with('error', 'Wrong email or password. Please try again.');
            }
        }


        return view('Admin.Login.login');
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }
    public function profile()
    {
        return view('Admin.Login.profile');
    }
   
    
}
