<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteEmail extends Mailable
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
        
        if(isset($data['image'])){
            return $this->subject('Solicitud de cotización')
                ->view('mail.quote', compact('data'))
                ->attach(public_path($data['image']));
        }else{
            return $this->subject('Solicitud de cotización')->view('mail.quote', compact('data'));
        }

    }
}
