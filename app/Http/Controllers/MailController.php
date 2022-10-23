<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\TestMail;

class MailController extends Controller
{

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function index()
    {
        $mailData = [
            'title' => 'Mail from Loockers !',
            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('kiritagawa@gmail.com')->send(new TestMail($mailData));

        dd("Email is sent successfully.");
    }

}
