@extends('layout.base')

@section('page_info')
    <div class="c-subheader px-3">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">Orders</li>
            <li class="breadcrumb-item"><a href="#" class="text-capitalize">{{ $type }}</a></li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="fade-in">
        @if(Session::has('success'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
                </div>
            </div>
        @elseif(Session::has('error'))
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">{{ Session::get('error') }}</div>
                </div>
            </div>
        @endif
        <table class="table table-responsive-sm table-hover bg-white table-outline mb-0">
            <thead class="thead-light">
            <tr>
                <th><span class="fa fa-sort"></span></th>
                <th>OrderID</th>
                <th>Items</th>
                <th>Pickup Country</th>
                <th>Amount <span class="small">(NGN)</span></th>
                <th>Pickup Date</th>
                <th>Delivery Date</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(count($orders) > 0)
                @foreach($orders as $key=>$order)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            <div>{{ $order['orderID'] }}</div>
                            <div class="small text-muted">Payment Ref: {{ $order->payment ? $order->payment['reference'] : '' }}</div>
                        </td>
                        <td>
                            {{ $order->items()->count() }}
                        </td>
                        <td>
                            {{ $order['pickUpCountry'] }}
                        </td>
                        <td>
                            {{ number_format($order['amount']) }}
                        </td>
                        <td>
                            {{ $order['pickUpDate'] }}
                        </td>
                        <td>
                            {{ $order['deliveryDate'] }}
                        </td>
                        <td>
                            {{ $order->payment ? $order->payment['status'] : 'not paid' }}
                        </td>
                        <td>
                            pending
                        </td>
                        <td class="text-center d-flex">
                            @if(($order->payment && $order->payment['status'] === 'success') || $order['status'] !== 'pending')
                                <button class="btn btn-sm mx-1 btn-success" disabled>Pay</button>
                            @else
                                <a href="{{ route('order.pay', $order) }}"  class="btn btn-sm mx-1 btn-success">Pay</a>
                            @endif
                            <a href="{{ route('order.detail', $order) }}" class="btn btn-sm mx-1 btn-info">Details</a>
                            <form action="{{ route('order.cancel', $order) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-sm mx-1 btn-danger" @if($order['status'] !== 'pending') disabled @endif>Cancel</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td></td>
                    <td>No order(s)</td>
                </tr>
            @endif
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 my-3 text-right">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
