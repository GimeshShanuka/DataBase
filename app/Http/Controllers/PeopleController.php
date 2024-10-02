<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PeopleController extends Controller
{
    
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('customerToken')->plainTextToken;
 
        return response()->json([
            'message' => 'User registered successfully',
            'customer' => $user,
            'token' => $token,
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('customerToken')->plainTextToken;

        return response()->json([
            'message' => 'User logged in successfully',
            'customer' => $user,
            'token' => $token,
        ], 200);
    }
    //user logout function
    public function logout(Request $request)
    {

        $user = $request->user();

        // Revoke the token
        $user->tokens()->delete();

        return response()->json([
            'message' => 'User logged out successfully',
            ],200);
    }
}
