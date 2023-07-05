<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->route('blogs.home')->with('message', __('auth.login_success'));
        }

        return redirect()->route('view.login')->with('message', __('auth.login_error'));
    }

    public function register(RegisterRequest $request)
    {
        if ($this->authService->register($request->all())) {
            return redirect()->route('view.login')->with('message', __('auth.register_success'));
        }

        return redirect()->route('view.register')->with('message', __('auth.register_error'));
    }

    public function verifyEmail(string $token)
    {
        $message = $this->authService->verifyEmail($token);

        return redirect()->route('view.login')->with('message', $message);
    }

    public function formForgotPassword()
    {
        return view('auth.form_forgot_password');
    }

    public function forgotPassword(Request $request)
    {

        $result = $this->authService->forgotPassword($request->email);

        return redirect()->route('view.login')->with('message', $result);
    }

    public function getPassword(string $token)
    {
        $result = $this->authService->createPasswordNew($token);

        return redirect()->route('view.login')->with('message', $result);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('view.login');
    }
}
