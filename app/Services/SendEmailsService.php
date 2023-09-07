<?php

namespace App\Services;

use App\Mail\AdminNewBooking;
use App\Mail\NewBookingEmail;
use Illuminate\Support\Facades\Mail;

class SendEmailsService
{
    public function send_emails($admin, $client_email, $booking, $client)
    {
        $for_client = $this->email_content('client', $client, $booking);
        Mail::to($admin)->queue(new AdminNewBooking($client, $booking));
        Mail::to($client_email)->queue(new NewBookingEmail($for_client));
    }

    public function email_content($considered, $client, $booking)
    {
        if ($considered == 'client') {
            return [
                'title' => 'One Rent a Car | Reservation',
                'message' => 'Thank you for choosing us for as rental company',
                'message_two' => 'One of our colleagues will contact you soon so we can confirm the reservation',
                'client' => null,
                'booking' => null
            ];
        } elseif ($considered == 'admin') {
            return [
                'title' => 'New Reservation Received',
                'message' => 'You have received new car booking',
                'message_two' => "Click here to go the dashboard to see your reservation",
                'client' => $client,
                'booking' => $booking
            ];
        }
    }
}
