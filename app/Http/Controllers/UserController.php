<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Console\View\Components\Confirm;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(){
        return view('users.register');
    }
    public function store(Request $request){
        $formData = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password'=>['required', 'confirmed', 'min:6'],
            'password_confirmation' => ['required']

        ]);
        $formData['password'] = bcrypt($formData['password']);

        $user = User::create($formData);
        Auth::login($user);
        return redirect('/listings')->with('message', 'User created and logged in');
            
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/listings')->with('message', 'User logged out succesfully');
    }
    public function login (){
        return view('users.login');
    }
    public function authenticate(Request $request){
        $formData = $request->validate([
            'email' => ['required', 'email'],
            'password'=> ['required']
        ]);
        if(auth()->attempt($formData)){
            $request->session()->regenerate();
            return redirect('/listings')->with('message', 'User logged in succesfully');

        }else{
            return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
        }
       
    }
}
