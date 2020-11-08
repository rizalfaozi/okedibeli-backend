<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifikasiReg extends Mailable
{
    use Queueable, SerializesModels;
    public $url;
    public $key;
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url,$key,$name)
    {
        $this->url = $url;
        $this->key = $key;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from(env('MAIL_USERNAME', 'ARKADIA ME'))->subject('Aktivasi Akun')->view('auth.emails.verifikasiReg');

    }
}
