<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);
        $fields['password'] = bcrypt($fields['password']);
        $user = User::create($fields);

        $token = $user->createToken('myapptoken')->plainTextToken;
        
        return response([
            'user'=> $user,
            'token' => $token
        ]);
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return 'Logged Out';
    }
    public function login(Request $request){
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $fields['email'])->first();
        if(!$user || !Hash::check($fields['password'], $user['password'])){
            return response([
                'message'=> 'Invalid Credentials'
            ]);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;
        
        return response([
            'user'=> $user,
            'token' => $token
        ]);
    }
}
