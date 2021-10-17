<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $bc;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bc)
    {
        $this->bc = $bc;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject($this->bc->subject)
            ->view('mails.email')
            ->bcc(env('MAIL_FROM_ADDRESS'))
            ->attach(public_path('/images') . '/logos/logo_new_sm.jpg',
                [
                    'as' => 'logo.png',
                    'mime' => 'image/jpeg',
                ]
            );
    }
}
