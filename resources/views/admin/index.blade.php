@extends('admin.layouts.master')
@section('title')
    <title>Admin</title>
@endsection
@section('content')
    <div class="content-header row"></div>
    <div class="content-body">
        <!-- Dashboard Analytics Start -->
        <section id="dashboard-analytics">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-column align-items-start pb-0">
                            <div class="avatar bg-rgba-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-users text-primary font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700 mt-1 mb-25">92.6k</h2>
                            <p class="mb-0">Subscribers Gained</p>
                        </div>
                        <div class="card-content">
                            <div id="subscribe-gain-chart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex flex-column align-items-start pb-0">
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-package text-warning font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="text-bold-700 mt-1 mb-25">97.5K</h2>
                            <p class="mb-0">Orders Received</p>
                        </div>
                        <div class="card-content">
                            <div id="orders-received-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Column Chart -->
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Payment Detail</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div id="column-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Problems Detail</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div id="Problem-detail"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bar Chart -->
            <div class="row">
                <div class="col-12">
                    <div class="card" style="background-color: #f7f7f7;">
                        <div class="card-header">
                            <h4 class="card-title">Bar Chart</h4>
                        </div>
                        <div class="card-content" style="color: #fff !important;">
                            <div class="card-body">
                                <div id="bar-chart" class="height-400"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Client Retention</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div id="client-retention-chart">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Dashboard Analytics end -->
    </div>
@endsection
