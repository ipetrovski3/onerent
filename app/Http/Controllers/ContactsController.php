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
        $email = $request->email;
        $message = $request->message;

        Mail::to(User::first()->email)->send(new ContactForm($name, $phone, $email, $message));
    }
}
