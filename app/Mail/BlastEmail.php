<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BlastEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $title;
    public $description;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$description)
    {
        $this->title = $title;
        $this->description = $description;
        

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from(env('MAIL_USERNAME', 'ARKADIA ME'))->subject($this->title)->view('mail.sendblast');

    }
}
