<?php

namespace App\Services;


use App\Mail\VisitorContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContactService
{
    public function sendMail(Request $request)
    {
        Mail::to('richard@humvite.com')->send(new VisitorContact([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ]));

        Session::flash('message', 'Email successfully sent.');
    }
}
