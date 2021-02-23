<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v3.2.0
* @link https://coreui.io
* Copyright (c) 2020 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SuperFreighters</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body class="c-app">
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <h4>SuperFreighters</h4>
    </div>
    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item @if(Request::is('/')) active-nav @endif">
            <a class="c-sidebar-nav-link" href="{{ route('home') }}">
                <span class="fa fa-th-large mx-2"></span> Dashboard
            </a>
        </li>
        <li class="c-sidebar-nav-item @if(Request::is('orders/new/create') || Request::is('orders/checkout')) active-nav @endif">
            <a class="c-sidebar-nav-link" href="{{ route('orders.create') }}">
                <span class="fa fa-cart-plus mx-2"></span> New Order
            </a>
        </li>
        <li class="c-sidebar-nav-item @if(Request::is('orders/all')) active-nav @endif">
            <a class="c-sidebar-nav-link" href="{{ route('orders', 'all') }}">
                <span class="fa fa-luggage-cart mx-2"></span> All Orders
            </a>
        </li>
        <li class="c-sidebar-nav-item @if(Request::is('orders/pending')) active-nav @endif">
            <a class="c-sidebar-nav-link" href="{{ route('orders', 'pending') }}">
                <span class="fa fa-plane-departure mx-2"></span> Pending Orders
            </a>
        </li>
        <li class="c-sidebar-nav-item @if(Request::is('orders/cancelled')) active-nav @endif"">
            <a class="c-sidebar-nav-link" href="{{ route('orders', 'cancelled') }}">
                <span class="fa fa-plane-slash mx-2"></span> Cancelled Orders
            </a>
        </li>
        <li class="c-sidebar-nav-item @if(Request::is('orders/delivered')) active-nav @endif"">
            <a class="c-sidebar-nav-link" href="{{ route('orders', 'delivered') }}">
                <span class="fa fa-plane-arrival mx-2"></span> Delivered Orders
            </a>
        </li>
    </ul>
</div>
<div class="c-wrapper c-fixed-components">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <ul class="c-header-nav d-md-down-none">
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="{{ route('home') }}">Dashboard</a></li>
            <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="{{ route('orders', 'All') }}">Orders</a></li>
        </ul>

        @yield('page_info')

    </header>

    <div class="c-body">

        <main class="c-main">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>

        <footer class="c-footer">
            <div><a href="#">SuperFreighters</a> &copy; {{ date('Y', strtotime(now())) }}</div>
        </footer>
    </div>
</div>
@yield('scripts')
<!-- CoreUI and necessary plugins-->
<script src="node_modules/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
<!--[if IE]><!-->
<script src="node_modules/@coreui/icons/js/svgxuse.min.js"></script>
<!--<![endif]-->
<!-- Plugins and scripts required by this view-->
<script src="node_modules/@coreui/chartjs/dist/js/coreui-chartjs.bundle.js"></script>
<script src="node_modules/@coreui/utils/dist/coreui-utils.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
