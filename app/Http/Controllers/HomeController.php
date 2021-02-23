<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $orders = Order::all();
        return view('home', ['orders' => $orders]);
    }
}
