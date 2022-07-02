<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!auth()->attempt($credentials)) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('access_token')->plainTextToken;

        return response()->json(['status' => 'success', 'accessToken' => $token, 'message' => 'Bienvenido ' . $user->name, 'data' => $user], 200);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return response()->json(['status' => 'success', 'message' => 'Sesión cerrada'], 200);
    }

    public function register(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ])->validate();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('access_token')->plainTextToken;

        return response()->json(['status' => 'success', 'accessToken' => $token, 'message' => 'Bienvenido ' . $user->name, 'data' => $user], 201);
    }
}
