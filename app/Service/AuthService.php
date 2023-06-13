<?php

namespace  App\Service;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class AuthService
{
    protected $message = '';

    public function login($data)
    {
        $result = false;
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = User::where('email', $data['email'])->first();
            if ($user->status == User::STATUS_UNCONFIRMED) {
                $this->message = __('auth.verify_check_mail');
            } else {
                $this->message = __('auth.login_success');
                $result = true;
            }
        } else {
            $this->message = __('auth.login_error');
        }
        return [
            'message' => $this->message, 
            'result' => $result
        ];
    }
    public function register($data)
    {
        $token = Str::random(64);
        $user = User::create(["user_name" => $data["username"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
            "role" => User::ROLE_USER, 
            "status" => User::STATUS_UNCONFIRMED,
            "token_verify_email" => $token,
        ]);
        if ($user) {
            $dataSendMail = ['title' => "Hi ".$user['user_name']." !",'token' => $token,];
            Mail::to($user['email'])->send(new SendMail($dataSendMail));
            return true;
        }
            return false;
    }
    public function verifyEmail(string $token)
    {
        $user = User::where('token_verify_email', $token)->where('email_verified_at', null)->first();
        if ($user) {
            $user->update(['email_verified_at' => now(), 'status' => User::STATUS_VERIFIED]);
            return __('auth.verify_success');
        }
        return __('auth.email_unregistered');
    }
}
?>
