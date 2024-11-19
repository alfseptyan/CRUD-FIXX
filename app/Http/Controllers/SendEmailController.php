<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function index()
 {
        $content = [
            'name' => 'logok koe',
            'subject' => 'Ini subject email',
            'body' => 'Ini adalah isi email yang
dikirim dari laravel 10'
        ];
        Mail::to('aureliusbevanyudirapalevi@mail.ugm.ac.id')->send(new 
        SendEmail($content));

        return "Email berhasil dikirim.";
 }
}
