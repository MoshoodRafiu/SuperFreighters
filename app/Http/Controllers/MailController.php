<?php

namespace App\Http\Controllers;

use App\Mail\NewOrderMail;
use App\Mail\OrderSuccessMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendNewOrderMail($order)
    {
        $data = [
            'message' => 'There is a new order on SuperFreighters',
            'order' => $order,
            'items' => $order->items,
            'payment' => $order->payment
        ];
        Mail::to(env('ADMIN_EMAIL'))->send(new NewOrderMail($data));
    }
    public static function sendOrderSuccessMail($order)
    {
        $data = [
            'message' => 'Your order on SuperFreighters was successful',
            'order' => $order,
            'items' => $order->items,
            'payment' => $order->payment
        ];
        Mail::to(env('USER_EMAIL'))->send(new OrderSuccessMail($data));
    }
}
