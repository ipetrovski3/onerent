<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $phone;
    private $email;
    private $message;
    private $contact_message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $phone, $from, $contact_message)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->from = $from;
        $this->contact_message = $contact_message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact_form')
            ->with([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->from,
                'message' => $this->contact_message
            ]);
    }
}
