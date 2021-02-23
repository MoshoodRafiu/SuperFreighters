<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>
<body>
<p>Hello,</p>
<p>{{ $data['message'] }}</p>
<p>Order ID is {{ $data['order']['orderID'] }}, items in your order are listed below</p>
<ul>
    @foreach($data['items'] as $item)
        <li>{{ $item['description'] }} ( {{ $item['weight'] }}Kg)</li>
    @endforeach
</ul>
<p>Total amount paid is {{ number_format($data['order']['amount']) }} and payment reference is {{ $data['payment']['reference'] }}</p>
<p>The order should be picked up on {{ $data['order']['pickUpDate'] }} and delivered to {{ $data['order']['deliveryAddress'] }} on {{ $data['order']['deliveryDate'] }} by {{ $data['order']['modeOfDelivery'] }}.</p>
<p><a href="https://superfreightersapp.herokuapp.com/orders">click here</a> for more details</p>
</body>
</html>
