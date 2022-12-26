<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    private $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        return $this->subject('Contacto')->view('mail.contact', compact('data'));

        if(isset($data['file'])){
            return $this->subject('Contacto')
                ->view('mail.contact', compact('data'))
                ->attach(public_path($data['file']));
        }else{
            return $this->subject('Contacto')->view('mail.contact', compact('data'));
        }
    }
}
