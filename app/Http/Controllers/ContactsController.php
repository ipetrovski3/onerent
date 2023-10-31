<?php

namespace App\Http\Controllers;

use App\Mail\ContactForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    public function create(Request $request)
    {
        $name = $request->name;
        $phone = $request->phone;
        $sender = $request->email;
        $contact_message = $request->message;
        $admin = User::first()->email;

        Mail::to($admin)->queue(new ContactForm($name, $phone, $sender, $contact_message));
        return redirect()->back();
    }
}
