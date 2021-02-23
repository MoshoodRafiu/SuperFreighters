<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <title>SuperFreighters</title>
</head>
<body>
    <div class="fade-in">
    <div class="row">
        <div class="col-sm-6 mt-5 mx-auto">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <img src="{{ asset('assets/img/success.gif') }}" height="200px" alt="success">
                        </div>
                        <div class="col-12 text-success text-center">
                            <h3>Your Order Was Successful</h3>
                        </div>
                        <div class="col-12 mt-3 text-center">
                            <a href="{{ route('orders', 'all') }}" class="btn btn-success">Go to Orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
