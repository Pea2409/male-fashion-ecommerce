<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        return view('admin.login', [
            'title' => 'Đăng nhập hệ thống'
        ]);
    }
    public function Home()
    {
        return view('admin.Index');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = Employees::where('email', $email)->first();

        if ($user) {
            if (Hash::check($password, $user->Password)) {
                Session::put('admin', $user);
                auth()->login($user);
                return view('admin.Index', [
                    'title' => ''
                ]);
            } else {
                return redirect()->back()->with('error', 'Password Incorrect');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid email');
        } 
    }

    public function SignOut()
    {
        Session::forget('admin');
        Auth::logout();
        return view('admin.login'); 
    }
}
