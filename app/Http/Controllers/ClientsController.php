<?php

namespace App\Http\Controllers;

use App\Mail\AdminNewBooking;
use App\Mail\NewBookingEmail;
use App\Models\Booking;
use App\Models\Client;
use App\Models\User;
use App\Services\BookingHandlingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClientsController extends Controller
{
    public function create(Request $request, BookingHandlingService $bookingHandlingService)
    {
        // dd($request->all());
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'personal_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'pick_up' => 'required',
            'drop_off' => 'required'
        ]);
        // dd($request->from_date);
        // if ($request->has('from_cars')) {
        if ($request) {
            // $date_and_time_of_pick_up = $this->format_date($request->from_date);
            $date_and_time_of_pick_up = $bookingHandlingService->format_from_date($request->from_date);
            $booking = new Booking;
            $booking->pick_up_id = $request->pick_up;
            $booking->drop_off_id = $request->drop_off;
            $booking->from_date = $date_and_time_of_pick_up['from_date'];
            $booking->to_date = $bookingHandlingService->format_to_date($request->to_date);
            $booking->time_of_pick_up = $date_and_time_of_pick_up['pick_up_time'];
            $booking->save();
        }
        // else {
        //     $booking = Booking::find($request->booking_id);
        // }

        $car_id = $request->car_id;

        $client = Client::create($request->all());
        $booking->update(['client_id' => $client->id, 'car_id' => $car_id]);
        $admin_email = User::first()->email;
        $this->send_emails($admin_email, $client->email, $booking, $client);

        return redirect()->route('home')->with(['success' => 'Your Booking was successfully']);
    }

    private function send_emails($admin, $client_email, $booking, $client)
    {
        $for_client = $this->email_content('client', $client, $booking);
        Mail::to($admin)->send(new AdminNewBooking($client, $booking));
        Mail::to($client_email)->send(new NewBookingEmail($for_client));
    }

    private function email_content($considered, $client, $booking)
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

    private function format_date($date)
    {
        $date = explode(' ', $date);
        return [
            'date' => $date[0],
            'time' => $date[1]
        ];
    }
}
