<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        return view('pages.mail');
    }
    public function send( )
    {
        // Code d'envoi
                Mail::to('administrateur@chezmoi.com')
            ->send(new TestMail());

        $msg='Email envoyé !';
        return view('pages.mail', compact('msg'));
    }
}