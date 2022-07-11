<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminNewBooking extends Mailable
{
    use Queueable, SerializesModels;

    private $for_admin;
    private $client;
    private $booking;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client, $booking)
    {
        //
        $this->client = $client;
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.admin.booking')
            ->with([
                'client' => $this->client,
                'booking' => $this->booking
            ]);
    }
}
