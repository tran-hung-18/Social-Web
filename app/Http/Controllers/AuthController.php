<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Service\AuthService;

class AuthController extends Controller
{
    protected AuthService $authServices;
    public function __construct(AuthService $authServices)
    {   
        $this->authServices = $authServices;
    }
    public function viewLogin()
    {
        return view('auth.login');
    }
    public function viewRegister()
    {
        return view('auth.register');
    }
    public function login(LoginRequest $request) 
    {
        $result = $this->authServices->login($request->all());
        if ($result['result']) {
            return redirect()->route('home')->with('message', $result['message']);
        } else {
            return redirect()->route('view-login')->with('message', $result['message']);
        }
    }
    public function register(RegisterRequest $request) 
    {
        $result = $this->authServices->register($request->all());
        if ($result) {
            return redirect()->route('view-login')->with('message', __('auth.register_success'));
        } else {
            return redirect()->route('view-register')->with('message', __('auth.register_error'));
        }
    }
    public function verifyEmail(string $token) 
    {
        $message = $this->authServices->verifyEmail($token);
        return redirect()->route('view-login')->with('message', $message);
    }
    public function logout() 
    {
        Auth::logout();
        return redirect()->route('view-login');
    }
}
