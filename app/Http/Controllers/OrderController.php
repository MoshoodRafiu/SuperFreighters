<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function getOrders($type)
    {
        $orders = null;
        switch ($type){
            case 'all':
                $orders = Order::latest()->simplePaginate(10);
                break;
            case 'pending':
                $orders = Order::where('status', '=', 'pending')->simplePaginate(10);
                break;
            case 'cancelled':
                $orders = Order::where('status', '=', 'cancelled')->simplePaginate(10);
                break;
            case 'delivered':
                $orders = Order::where('status', '=', 'delivered')->simplePaginate(10);
                break;
        }
        return view('orders.index', ['orders' => $orders, 'type' => $type]);
    }
    public function create()
    {
        return view('orders.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'items' => ['required', 'string'],
            'pickUpCountry' => ['required', 'string'],
            'pickUpAddress' => ['required', 'string'],
            'pickUpDate' => ['required', 'date'],
            'deliveryAddress' => ['required', 'string'],
            'modeOfDelivery' => ['required', 'string'],
        ]);

        if ($validator->fails()){
            return back()->withErrors($validator)->with(['error' => 'Invalid data input']);
        }

        $order = new Order();
        $order['orderID'] = $this->generateOrderID();
        $order['pickUpCountry'] = $request['pickUpCountry'];
        $order['pickUpAddress'] = $request['pickUpAddress'];
        $order['deliveryAddress'] = $request['deliveryAddress'];
        $order['pickUpDate'] = $request['pickUpDate'];
        $order['deliveryDate'] = $request['modeOfDelivery'] === "Air" ? $this->generateDeliveryDate($request['pickUpDate'], 2) : $this->generateDeliveryDate($request['pickUpDate'], 20);
        $order['modeOfDelivery'] = $request['modeOfDelivery'];
        if ($order->save()){
            if ($this->saveOrderItems($order['id'], json_decode($request['items'], true))){
                $weight = $order->items()->sum('weight');
                $order['amount'] = $this->calculateAmount($weight, $order['pickUpCountry'], $order['modeOfDelivery']);
                if ($order->update()){
                    return view('orders.checkout', ['order' => $order]);
                }
            }
        }
        return back()->with(['error' => 'Something went wrong']);
    }
    public function cancelOrder(Order $order): \Illuminate\Http\RedirectResponse
    {
        $order['status'] = 'cancelled';
        if ($order->update()){
            return back()->with(['success' => 'Order cancelled successfully']);
        }
        return back()->with(['error' => 'Something went wrong']);
    }
    public function detail(Order $order)
    {
        return view('orders.detail', ['order' => $order]);
    }
    protected function generateOrderID(): int
    {
        do {
            $unique_code =  rand(11111111,99999999);
        } while (Order::where('orderID', $unique_code)->count() > 0);
        return $unique_code;
    }
    protected function generateDeliveryDate($pickup, $days)
    {
        return date('Y-m-d', strtotime($pickup.'+ '.$days.' days'));
    }
    protected function saveOrderItems($order, $items): bool
    {
        $success = true;
        foreach ($items as $val){
            $item = new Item();
            $item['order_id'] = $order;
            $item['description'] = $val['description'];
            $item['weight'] = $val['weight'];
            if (!$item->save()){
                $success = false;
            }
        }
        return $success;
    }
    protected function calculateAmount($weight, $country, $mode){
        $amount = null;
        $flat_rate = null;
        switch ($mode) {
            case 'Air':
                $amount = 10000 * $weight;
                break;
            case 'Sea':
                $amount = 2000 * $weight;
                break;
        }
        switch ($country) {
            case 'US':
                $flat_rate = 1500;
                break;
            case 'UK':
                $flat_rate = 800;
        }
        $tax = $amount * 0.1;
        return $amount + $tax + $flat_rate;
    }
}
