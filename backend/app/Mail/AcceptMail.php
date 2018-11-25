<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AcceptMail extends Mailable
{
    use Queueable, SerializesModels;
    private $offer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($offfer)
    {
        $this->offer = $offfer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email.accept')->with('offer', $this->offer);
    }
}
