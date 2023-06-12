<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)
                    ->where('password', $request->password)
                    ->get();

        if($user->isEmpty()) {
            return redirect()->route('login')->with('error', 'Login Fail, Please Try Again!');
        }
        else {
            return redirect()->route('home')->with('success', 'Login Successfully');
        }    
    }
    public function register(Request $request){
        dd($request->all());

        // return User::create([
        //     'user_name' => $request->username,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);
    }
}
