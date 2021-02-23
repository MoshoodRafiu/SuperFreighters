@extends('layout.base')

@section('page_info')
    <div class="c-subheader px-3">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ol>
    </div>
@endsection

@section('content')
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-gradient-primary">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">{{ $orders->count() }}</div>
                                    <div>Total Orders</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:50px;">
                                <canvas class="chart" id="card-chart1" height="50"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-gradient-success">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">{{ $orders->where('status', '=', 'delivered')->count() }}</div>
                                    <div>Delivered Orders</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:50px;">
                                <canvas class="chart" id="card-chart2" height="50"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-gradient-warning">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">{{ $orders->where('status', '=', 'pending')->count() }}</div>
                                    <div>Pending Orders</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3" style="height:50px;">
                                <canvas class="chart" id="card-chart3" height="50"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-gradient-danger">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">{{ $orders->where('status', '=', 'cancelled')->count() }}</div>
                                    <div>Cancelled Orders</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:50px;">
                                <canvas class="chart" id="card-chart4" height="50"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                </div>
            </div>
        </div>
    </main>
@endsection
