<?php

namespace App\Services;

class BookingHandlingService
{
    public function email_content($considered)
    {
        if ($considered == 'client') {
            return [
                'title' => 'One Rent a Car | Reservation',
                'message' => 'Thank you for choosing us for as rental company',
                'message_two' => 'One of our colleagues will contact you soon so we can confirm the reservation'
            ];
        } elseif ($considered == 'admin') {
            return [
                'title' => 'New Reservation Received',
                'message' => 'You have received new car booking',
                'message_two' => "Click here to go the dashboard to see your reservation"
            ];
        }
    }

}
