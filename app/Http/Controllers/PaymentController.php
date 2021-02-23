<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function makePayment(Order $order)
    {
        return view('orders.checkout', ['order' => $order]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', 'numeric'],
            'reference' => ['required', 'string']
        ]);
        if ($validator->fails()){
            return back()->withErrors($validator);
        }
        $payment = new Payment();
        $payment['order_id'] = $request['order_id'];
        $payment['reference'] = $request['reference'];
        $payment['status'] = 'success';
        if ($payment->save()){
            return view('orders.success');
        }
        return back()->with(['error' => 'Something went wrong']);
    }
}
