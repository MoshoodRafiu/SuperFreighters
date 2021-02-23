@extends('layout.base')

@section('page_info')
    <div class="c-subheader px-3">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">Orders</li>
            <li class="breadcrumb-item">New</li>
            <li class="breadcrumb-item"><a href="#">Checkout</a></li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="fade-in">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header"><h4>Checkout</h4></div>
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
                            <div class="col-md-12 text-right">
                                <hr>
                                <button onclick="payWithPaystack()" class="btn btn-success">Pay NGN {{ number_format($order['amount']) }}</button>
                            </div>
                        </div>
                        <div class="row">
                            <form method="POST" id="paymentForm" action="{{ route('payment.store') }}">
                                @csrf
                                <label>
                                    <input type="hidden" name="order_id" value="{{ $order['id'] }}">
                                    <input type="hidden" name="reference" id="paymentRef">
                                </label>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        function payWithPaystack() {
            let handler = PaystackPop.setup({
                key: '{{ env('PAYSTACK_KEY') }}', // Replace with your public key
                email: '{{ env('USER_EMAIL') }}',
                amount: {{ $order['amount'] * 100 }},
                ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                // label: "Optional string that replaces customer email"
                onClose: function(){
                    console.log('Window closed.');
                },
                callback: function(response){
                    if (response.status){
                        document.getElementById('paymentRef').value = response.reference;
                        document.getElementById('paymentForm').submit();
                    }
                }
            });
            handler.openIframe();
        }
    </script>
@endsection
