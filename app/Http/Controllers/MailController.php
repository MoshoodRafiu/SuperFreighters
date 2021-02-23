<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderMail;
use App\Mail\OrderSuccessMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendNewOrderMail()
    {
        $data = [
            'message' => 'There is a new order on SuperFreighters'
        ];
        Mail::to(env('ADMIN_EMAIL'))->send(new NewOrderMail($data));
    }
    public static function sendOrderSuccessMail()
    {
        $data = [
            'message' => 'Your order on SuperFreighters was successful'
        ];
        Mail::to(env('USER_EMAIL'))->send(new OrderSuccessMail($data));
    }
}
