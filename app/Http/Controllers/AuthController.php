<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request) {
        $data = $request->all();
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->route('login')->withInput()->withErrors($errors);
        }
        else{
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = User::where('email', $request->email)->first();
                session()->put('id', $user['id']);
                session()->put('username', $user['user_name']);
    
                return redirect()->route('home')->with('success', 'Login Successfully');
            }
            else {
                return redirect()->route('login')->with('error', 'Login Fail, Please Try Again!');
            }
        }
    }
    
    public function register(Request $request) {
        $data = $request->all();
        $rules = [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ];
        $validator = Validator::make($data, $rules);
        
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->route('register')->withInput()->withErrors($errors);
        } else {
            User::create([
                "role" => 2,
                "user_name" => $request["username"],
                "email" => $request["email"],
                "password" => Hash::make($request["password"])
            ]);
            return redirect()->route('login')->with('success', 'Register Successfully');
        }
    }

    public function logout() {
        session()->flush();
        return redirect()->route('login');
    }
}
