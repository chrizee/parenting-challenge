<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Broadcast extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public $messages;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($broadcast)
    {
        $this->messages = $broadcast;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('public.emails.broadcast')->subject("This week's Fact/Tip");
    }
}
