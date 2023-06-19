<?php

namespace App\Service;

use App\Mail\ForgotPassword;
use App\Mail\SendPassword;
use App\Mail\VerifyAccount;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthService
{
    public function login($data)
    {
        return Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => User::STATUS_ACTIVE]);
    }

    public function register($data)
    {
        $token = Str::random(64);
        $user = User::create(['user_name' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_USER,
            'token_verify_email' => $token,
        ]);
        if ($user) {
            $dataSendMail = ['title' => 'Hi '.$user['user_name'].' !', 'token' => $token];
            Mail::to($user['email'])->send(new VerifyAccount($dataSendMail));

            return true;
        }

        return false;
    }

    public function verifyEmail(string $token)
    {
        $user = User::where('token_verify_email', $token)->where('email_verified_at', null)->first();
        if ($user) {
            $user->update(['email_verified_at' => now(), 'status' => User::STATUS_ACTIVE]);

            return __('auth.verify_success');
        }

        return __('auth.email_unregistered');
    }

    public function forgotPassword(string $email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            $tokenResetPassword = $user->createToken('auth_token')->plainTextToken;
            $passwordReset = PasswordResetToken::create(['user_id' => $user->id, 'token' => $tokenResetPassword]);
            if ($passwordReset) {
                $dataSendMail = ['token' => $tokenResetPassword];
                Mail::to($email)->send(new ForgotPassword($dataSendMail));

                return true;
            }
        }

        return false;
    }

    public function createPasswordNew($token)
    {
        $userId = PasswordResetToken::where(['token' => $token])->pluck('user_id')->first();
        if ($userId) {
            $user = User::where('id', $userId)->first();
            $passwordNew = $user->user_name.'_'.Str::random(5);
            $user->update(['password' => Hash::make($passwordNew)]);
            $dataSendMail = ['password' => $passwordNew];
            Mail::to($user->email)->send(new SendPassword($dataSendMail));

            return true;
        }

        return false;
    }
}
