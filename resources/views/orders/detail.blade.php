@extends('layout.base')

@section('page_info')
    <div class="c-subheader px-3">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">Orders</li>
            <li class="breadcrumb-item"><a href="#">Detail</a></li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="fade-in">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header"><h4>Order Details</h4></div>
                    <div class="card-body">
                        @if(Session::has('message'))
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5>OrderID</h5>
                                    <div>{{ $order['orderID'] }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5>Order Date</h5>
                                    <div>{{ date('M d, Y', strtotime($order['created_at'])) }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5>Order Status</h5>
                                    <div>{{ $order['status'] }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5>Payment Status</h5>
                                    <div>{{ $order->payment ? $order->payment['status'] : 'Not Paid' }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5>Items Information</h5>
                                    <ul>
                                        @foreach($order->items as $item)
                                            <li class="mb-3">{{ $item['description'] }} ( {{ $item['weight'] }} kg )</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5>Pickup Country</h5>
                                    <div>{{ $order['pickUpCountry'] }}</div>
                                </div>
                                <div class="mb-3">
                                    <h5>Pickup Address</h5>
                                    <div>{{ $order['pickUpAddress'] }}</div>
                                </div>
                                <div class="mb-3">
                                    <h5>Delivery Address</h5>
                                    <div>{{ $order['deliveryAddress'] }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="my-3">
                                    <h5>Pickup Date</h5>
                                    <div>{{ date('M d, Y', strtotime($order['pickUpDate'])) }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="my-3">
                                    <h5>Delivery Date</h5>
                                    <div>{{ date('M d, Y', strtotime($order['deliveryDate'])) }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="my-3">
                                    <h5>Delivery Method</h5>
                                    <div>{{ $order['modeOfDelivery'] }}</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="my-3">
                                    <h5>Payment Information</h5>
                                    <div class="">
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div>Price Per Kg:</div>
                                            <div>NGN {{ $order['modeOfDelivery'] === 'Air' ? '10,000' : '2,000' }}</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div>Total Price for {{ $order->items()->sum('weight') }}kg:</div>
                                            <div>NGN {{ number_format($order['modeOfDelivery'] === 'Air' ? (10000 * $order->items()->sum('weight')) : (2000 * $order->items()->sum('weight'))) }}</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div>Flat Rate:</div>
                                            <div>NGN {{ $order['pickUpCountry'] === 'US' ? '1,500' : '800' }}</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div>Tax:</div>
                                            <div>NGN {{ number_format(($order['modeOfDelivery'] === 'Air' ? (10000 * $order->items()->sum('weight')) : (2000 * $order->items()->sum('weight'))) * 0.1) }}</div>
                                        </div>
                                        <hr>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div><strong>Total</strong></div>
                                            <div><strong>NGN {{ number_format($order['amount']) }}</strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
