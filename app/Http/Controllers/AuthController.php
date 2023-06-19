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

    public function viewUser()
    {
        return view('users.home');
    }

    public function viewAdmin()
    {
        return view('admin.home');
    }

    public function viewPost()
    {
        return view('guest.home');
    }

    public function login(LoginRequest $request)
    {
        if ($this->authService->login($request->all())) {
            return redirect()->route('home-posts')->with('message', __('auth.login_success'));
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
