<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register(Request $request)
    {

        if ($request->all()) {
            $formData = $request->validate([
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required'
            ]);

            $user = User::create([
                'name' => $formData['name'],
                'last_name' => $formData['last_name'],
                'email' => $formData['email'],
                'password' =>  Hash::make($formData['password']),
            ]);
            if ($user)
                return redirect()->route('login');
            return redirect()->back()->with('error', 'User registration failed');
        }

        return view('user/register');
    }

    public function login(Request $request)
    {
        if ($request->all()) {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = User::where('email', $credentials['email'])->first();

            if ($user && Hash::check($credentials['password'], $user->password)){
                Auth::login($user);
                return redirect()->route('home');
            }

            return redirect()->back()->with('error', 'Invalid credentials');
        }
        return view('user/login');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
