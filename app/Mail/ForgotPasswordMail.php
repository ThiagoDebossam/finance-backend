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
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $expiration = Carbon::now()->addMinutes(30);
        $payload = [
            'id' => $this->user->id,
            'email' => $this->user->email,
            'name' => $this->user->name
        ];
        $token = JWTAuth::fromUser($this->user, ['exp' => $expiration->timestamp, 'iat' => Carbon::now()->timestamp, 'payload' => $payload]);
        $url = env('APP_URL') . 'forgot-password/' . $token;
        return $this->subject('Recuperação de Conta')
                ->view('emails.forgot_password', ['user' => $this->user, 'url'=> $url]);
    }
}
