<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    public function sendEmailVerification(Request $request)
    {
        if($request->user()->hasVerifiedEmail()){
            return [
                'message' => 'Already Verified!'
            ];
        }

        $request->user()->sendEmailVerificationNotification();

        return['message' => 'Verification link sent!'];

    }

    public function verify(EmailVerificationRequest $request)
    {
        if($request->user()->hasVerifiedEmail()){
            return view('emails.email_already_verified');
        }

        if($request->user()->markEmailAsVerified()){
            event(new Verified($request->user()));
        }

        return view('emails.email_verification_successful');
    }
}
