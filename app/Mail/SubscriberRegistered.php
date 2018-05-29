<?php

namespace App\Mail;

use App\Subscribers;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriberRegistered extends Mailable
{
    use Queueable, SerializesModels;
    private $viewPath = "public.emails.";
    /*
     * The suscriber instance
     *
     * @var suscriber
     */
    public $subscriber;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Subscribers $subscribers)
    {
        $this->subscriber = $subscribers;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->viewPath.'subscriber')->subject('Thank you for Subscribing');
    }
}
