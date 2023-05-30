<?php

namespace App\Mail;
use Carbon\Carbon;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(User $user)
    {   
        $expiration = Carbon::now()->addMinutes(30);
        $payload = [
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name
        ];
        $token = JWTAuth::fromUser($user, ['exp' => $expiration->timestamp, 'iat' => Carbon::now()->timestamp], $payload);
        $url = env('APP_URL') . 'forgot-password/' . $token;
        return $this->subject('Recuperação de Conta')
                ->view('emails.forgot_password', ['user' => $user, 'url'=> $url]);
    }
}
