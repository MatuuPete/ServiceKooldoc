<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'email' => [
                'required',
                'email',
                'ends_with:@gmail.com'
            ],
            'contact_number' => [
                'required',
                'regex:/(09)[0-9]{9}/'
            ],
            'subject' => 'required',
            'inquiry' => 'required',
        ]);

        $data = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'subject' => $request->subject,
            'inquiry' => $request->inquiry,
        ];

        Mail::to('kooldocbusiness@gmail.com')->send(new ContactMail($data));

        return response()->json(['message' => 'Email successfully sent!']);
    }
}
