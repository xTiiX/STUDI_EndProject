<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\TestMail;
use App\Mail\RegisterMail;

class MailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Mail from Loockers !',
            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('kiritagawa@gmail.com')->send(new TestMail($mailData));

        dd("Email is sent successfully.");
    }

    public function sendRegisterMail(Request $req)
    {
        $mailData = [
            'title' => 'Bienvenue chez Loockers ! - Création de compte',
            'email' => $req->email,
            'password' => $req->password
        ];

        Mail::to($req->email)->send(new RegisterMail($mailData));
    }
}
