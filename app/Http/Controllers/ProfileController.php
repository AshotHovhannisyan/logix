<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ManageProfile;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        return view('profile/index');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|exists:users,email',
        ]);

        $user = User::whereEmail($request->input('email'))->first();
        if (!$user) return redirect()->back()->with('error', 'Email does not exist');

        $accessToken = $user->createToken('authToken')->accessToken;
        $token = $accessToken->token;
        Session::put('password_token', $token);
        Session::put('email_verification_email', $user->email);
        try {
            Mail::to($user->email)->send(new ManageProfile($token, 'Change Password', 'changePassword'));
            return redirect()->back()->with('success', 'Password reset email sent successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send password reset email: ' . $e->getMessage());
        }
    }

    public function changeEmail(Request $request)
    {
        $request->validate([
            'change_email' => 'required|string|email|max:255|exists:users,email',
        ]);

        $user = User::whereEmail($request->input('change_email'))->first();
        if (!$user) return redirect()->back()->with('error', 'Email does not exist');

        $verificationCode = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $expiration = now()->addMinutes(30);
        Session::put('email_verification_code', $verificationCode);
        Session::put('email_verification_email', $user->email);
        Session::put('email_verification_expires_at', $expiration);

        try {
            Mail::to($user->email)->send(new ManageProfile($verificationCode, 'Change Email', 'changeEmail'));
            return redirect()->route('email.reset.email');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to send password reset email: ' . $e->getMessage());
        }
    }

    public function resetPassword(Request $request)
    {
        $all_data = $request->all();
        if (isset($all_data['password'])) {
            $formData = $request->validate([
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required'
            ]);
            $email = Session::get('email_verification_email');
            $user = User::where('email', $email)->first();

            if ($user) {
                $user->password = Hash::make($formData['password']);
                $user->save();
                return redirect()->route('logout');
            }
            return redirect()->back()->with('error', 'User not found');
        } elseif (isset($all_data['token'])) {
            $accessToken = Session::get('password_token');
            if ($accessToken && $all_data['token'] === $accessToken)
                return view('profile/resetPassword');
            Session::flash('error', 'The token has expired or does not match.');
            return redirect()->route('home');
        }
        return response()->view('errors', [], 404);
    }

    public function resetEmail(Request $request)
    {
        $code = Session::get('email_verification_code');
        $all_data = $request->all();
        if (isset($all_data['code'])) {

            $formData = $request->validate([
                'code' => 'required|numeric|digits:4',
                'email' => 'required|email'
            ]);
            $email = Session::get('email_verification_email');
            $expiration = Session::get('email_verification_expires_at');
            $user = User::where('email', $email)->first();

            if ($user) {
                if ($code && $expiration && now()->lt($expiration)) {
                    if ($code == $formData['code']) {
                        $user->email = $formData['email'];
                        $user->save();
                        return redirect()->route('logout');
                    } else return redirect()->back()->with('error', 'Code is incorrect');
                }else return redirect()->back()->with('error', "Code has expired or doesn't exist");
            }else return redirect()->back()->with('error', 'User not found');
        }elseif ($code)
            return view('profile/resetEmail');

        return redirect()->back()->with('error', 'The code has expired') ;
    }
}
