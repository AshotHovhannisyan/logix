<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function login(Request $request)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if ($validatedData->fails())
                return response()->json(['errors' => $validatedData->errors()], 422);

            $credentials = $validatedData->validated();
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('authToken')->accessToken;

                return response()->json(['token' => $token], 200);
            }

            return response()->json(['message' => 'Unauthorized'], 401);
        }catch (\Exception $e){
            logger($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 501);
        }

    }

    public function register(Request $request)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required'
            ]);

            if ($validatedData->fails())
                return response()->json(['errors' => $validatedData->errors()], 422);

            $data = $validatedData->validated();
            $user = User::create([
                'name' => $data['name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            if ($user)
                return response()->json(['message' => 'User registered successfully'], 201);
            return response()->json(['message' => 'Failed to register user'], 500);
        } catch (\Exception $e) {
            logger($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 501);
        }
    }
}
