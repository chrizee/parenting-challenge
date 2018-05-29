<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEbookToUser extends Mailable
{
    use Queueable, SerializesModels;
    private $viewPath = "public.emails.";

    public $ebook;
    /**
     * Create a new message instance.
     *
     * @param string $ebook
     *
     * @return void
     */
    public function __construct($ebook)
    {
        $this->ebook = $ebook;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->viewPath.'ebook');
    }
}
