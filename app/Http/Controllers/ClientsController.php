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
    public function create(Request $request, BookingHandlingService  $bookingHandlingService)
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'pick_up' => 'required',
            'drop_off' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        
        if ($request->has('from_cars')) {
//            11/15/2022 10:51 PM
            $from_date = Carbon::parse($request->from_date)->format('m/d/yy g:i');
            $to_date = Carbon::parse($request->to_date)->format('m/d/yy g:i');
                session(['from_date' => $from_date]);
                session(['to_date' => $to_date]);
                session(['pick_up_id' => $request->pick_up]);
                session(['drop_off_id' => $request->drop_off]);
                // dd($request->all());
        }

        $car_id = $request->car_id;

        $client = Client::create($request->all());
        $booking = $bookingHandlingService->make_reservation();
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


}
