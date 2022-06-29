<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewBookingEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $content;
    private $considered;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->content['title'])
            ->view('emails.new_booking')
            ->with([
                'message_one' => $this->content['message'],
                'message_two' => $this->content['message_two'],
                'considered' => $this->considered
                ]);
    }
}
