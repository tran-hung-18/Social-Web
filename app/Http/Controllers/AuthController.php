<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SendMailRequest;
use Illuminate\Support\Facades\Auth;
use App\Service\AuthService;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {   
        $this->authService = $authService;
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
        if ($this->authService->login($request->all())) {
            return redirect()->route('home')->with('message', __('auth.login_success'));
        } else {
            return redirect()->route('view-login')->with('message', __('auth.login_error'));
        }
    }
    public function register(RegisterRequest $request) 
    {
        $result = $this->authService->register($request->all());
        if ($result) {
            return redirect()->route('view-login')->with('message', __('auth.register_success'));
        } else {
            return redirect()->route('view-register')->with('message', __('auth.register_error'));
        }
    }
    public function verifyEmail(string $token) 
    {
        $message = $this->authService->verifyEmail($token);
        return redirect()->route('view-login')->with('message', $message);
    }
    public function formForgotPassword()
    {
        return view('auth.form_forgot_password');
    }
    public function forgotPassword(Request $request)
    {
        
        $result = $this->authService->forgotPassword($request->email);
        if ($result) {
            return redirect()->route('view-login')->with('message', __('auth.forgot_password_check_mail'));
        }
        return redirect()->route('view-login')->with('message', __('auth.try_again'));
    }
    public function getPassword($token)
    {
        $result = $this->authService->createPasswordNew($token);
        if ($result) {
            return redirect()->route('view-login')->with('message', __('auth.password_new'));
        }
        return redirect()->route('view-login')->with('message', __('auth.try_again'));
    }
    public function logout() 
    {
        Auth::logout();
        return redirect()->route('view-login');
    }
}
