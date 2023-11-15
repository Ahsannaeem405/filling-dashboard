@extends('admin.layouts.master')
@section('title')
    <title>Admin</title>
@endsection
@section('content')
<style>
    .ChatsCard .headingMain h4{
        font-size: 28px;
        font-weight: 600;
    }
    .UncompletedChats,
    .CompletedChats{
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    .UncompletedChats i {
        background-color: #7367f052;
        color: #7367f0 !important;
        font-size: 20px;
    }
    .UncompletedChats i,
    .CompletedChats i {
        padding: 6px 8px;
        border-radius: 4px;
        margin-right: 10px;
    }
    .UncompletedChats h6,
    .CompletedChats h6{
        font-weight: 600;
        font-size: 16px;
    }
    .UncompletedChats h6 span, 
    .CompletedChats h6 span {
        display: block;
        font-size: 12px;
        color: #cccccc73;
        padding-top: 4px;
        font-weight: normal;
    }
    .CompletedChats i {
        background-color: #37cb4d59;
        color: #37cb4d;
        font-size: 20px;
    }

    .LoginText_Wrap{
        overflow: hidden;
        padding-bottom: 15px;
    }
    .LoginText_Wrap .card-header h4{
        
    }
    .LoginText_Wrap .card-header p,
    .LoginText_Wrap .card-header p span{
        font-size: 12px;
        color: #cccccc73;
    }
    .LoginText_Wrap .card-header p span{

    }

    .StepsCount_WrapCard .TopHeading{

    }
    .StepsCount_WrapCard .TopHeading h4{
        
    }
    .StepsCount_WrapCard .TopHeading p {
        font-size: 12px;
        color: #cccccc73;
    }
    .StepsCount {
        position: relative;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        padding: 10px 0 14px;
        margin-top: 1.3rem;
    }
    .StepsCount::before {
        content: '';
        position: absolute;
        width: 96%;
        height: 5px;
        background-color: #7367f0;
        margin: 0 auto;
        left: 0;
        right: 0;
        border-radius: 2px;
    }
    .StepsCount .col{
        
    }
    .StepsCount .col p{
        
    }
    .StepsCount .col p i{
        color: #7367f0;
    }
    .StepsCount .Beg_CS p span{
        background-color: #ffffff47;
    }
    .StepsCount .Beg_CS p span,
    .StepsCount .Adv_CS p span,
    .StepsCount .Pro_CS p span,
    .StepsCount .Leg_CS p span,
    .StepsCount .Vip_CS p span {
        font-size: 10px;
        border-radius: 4px;
        padding: 4px;
        color: #ccc;
    }
    .StepsCount .Adv_CS p span{
        background-color: #067e06;
    }
    .StepsCount .Pro_CS p span{
        background-color: #780378;
    }
    .StepsCount .Leg_CS p span{
        background-color: #bb0505;
    }
    .StepsCount .Vip_CS p span {
        background-color: #959505;
        color: yellow;
    }
    .StepsCount .col div{
        padding: 5px 0 0 13px;
    }
    .StepsCount .col div span {
        color: #7367f0;
        font-size: 10px;
        display: block;
    }

    .PriceTotal_WrapCard{

    }
    .PriceTotal_WrapCard .PriceTotal_Heading{

    }
    .PriceTotal_WrapCard .PriceTotal_Heading h4{

    }
    .PriceTotal_WrapCard .PriceTotal_Heading p{

    }
    .PriceTotal_WrapCard .PriceTotal{
        
    }
    .PriceTotal_WrapCard .PriceTotal h3{
        font-size: 28px;
        font-weight: 600;
    }
    .PriceTotal_WrapCard .PriceTotal h3 span{
        font-size: 10px;
        border-radius: 4px;
        padding: 4px;
        color: #00ab00;
        background-color: #1d5541;
        font-weight: 600;
    }
    .PriceTotal_WrapCard .PriceTotal p,
    .PriceTotal_WrapCard .PriceTotal_Heading p{
        font-size: 12px;
        color: #ffffffc7;
        margin: 0;
        line-height: 17px;
    }
</style>
    <div class="content-header row"></div>
    <div class="content-body">
        <!-- Dashboard Analytics Start -->
        <section id="dashboard-analytics">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card LoginText_Wrap">
                        <div class="card-header">
                            <h4 class="">92.6k</h4>
                            <div class="">
                                <p class="m-0">Letzter : <span>$lastlogin</span></p>
                                <p class="m-0">Register : <span>$registerdate</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-6 col-12">
                    <div class="card StepsCount_WrapCard">
                        <div class="card-header d-flex flex-column align-items-start pb-0">
                            <div class="TopHeading">
                                <h4 class="m-0">Uberblink Rang</h4>
                                <p class="m-0">Lorem ipsum dolor sit amet consectetur</p>
                            </div>
                        </div>
                        <div class="card-content StepsCount">
                            <div class="col Beg_CS">
                                <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>Beginner</span></p>
                                <div class="">
                                    <span>0-3.499</span>
                                    <span>40% Einnahem</span>
                                </div>
                            </div>
                            <div class="col Adv_CS">
                                <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>Advanced</span></p>
                                <div class="">
                                    <span>0-3.499</span>
                                    <span>40% Einnahem</span>
                                </div>
                            </div>
                            <div class="col Pro_CS">
                                <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>Pro</span></p>
                                <div class="">
                                    <span>0-3.499</span>
                                    <span>40% Einnahem</span>
                                </div>
                            </div>
                            <div class="col Leg_CS">
                                <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>Legend</span></p>
                                <div class="">
                                    <span>0-3.499</span>
                                    <span>40% Einnahem</span>
                                </div>
                            </div>
                            <div class="col Vip_CS">
                                <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>VIP</span></p>
                                <div class="">
                                    <span>0-3.499</span>
                                    <span>40% Einnahem</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Column Chart -->
                <div class="col-lg-3 col-md-12">
                    <div class="card ChatsCard">
                        <div class="card-header">
                            <h5 class="card-title">Chats</h5>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="headingMain">
                                    <h4>$totalchat</h4>
                                    <p class="m-0">Chats insgesamt</p>
                                </div>
                                <ul class="list-unstyled mt-3">
                                    <li class="UncompletedChats">
                                        <i class="fa fa-ticket"></i>
                                        <h6>Offene chats <span>$uncompletedchats</span></h6>
                                    </li>
                                    <li class="CompletedChats">
                                        <i class="fa fa-ticket"></i>
                                        <h6>Bearbeitete chats <span>$completedchats</span></h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="card PriceTotal_WrapCard">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row pb-50">
                                    <div class="col-lg-6 col-12 d-flex justify-content-between flex-column order-lg-1 order-2 mt-lg-0 mt-2">
                                        <div class="PriceTotal_Heading">
                                            <h4 class="text-bold-700 mb-25">Einnahmen</h4>
                                            <p class="text-bold-500 mb-75">Weekly Earnings Overview</p>
                                        </div>
                                        <div class="PriceTotal">
                                            <h3 class="">$468 <span>+ 4.2%</span></h3>
                                            <p>You informed of this week compared to last week</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 d-flex justify-content-between flex-column text-right order-lg-2 order-1">
                                        <div id="avg-session-chart"></div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row avg-sessions pt-50">
                                    <div class="col-4">
                                        <div class="">
                                            <p class="mb-0">Earning</p>
                                        </div>
                                        <div class="progress progress-bar-primary mt-25">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="50" aria-valuemax="100" style="width:50%"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0">Profit: 100K</p>
                                        <div class="progress progress-bar-warning mt-25">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="60" aria-valuemax="100" style="width:60%"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <p class="mb-0">Gebuhren: 90%</p>
                                        <div class="progress progress-bar-danger mt-25">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="70" aria-valuemax="100" style="width:70%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Global Ranking</h4>
                            <span>Rangliste</span>
                        </div>
                        <div class="card-content">
                            <div class="card-body pt-2" style="position: relative;">
                                <div class="chart-info d-flex justify-content-between mb-1">
                                    <div class="series-info d-flex align-items-center">
                                        <i class="feather icon-monitor font-medium-2 text-primary"></i>
                                        <span class="text-bold-600 mx-50">User 1</span>
                                    </div>
                                    <div class="series-result">
                                        <span>49,478$</span>
                                    </div>
                                </div>
                                <div class="chart-info d-flex justify-content-between mb-1">
                                    <div class="series-info d-flex align-items-center">
                                        <i class="feather icon-tablet font-medium-2 text-warning"></i>
                                        <span class="text-bold-600 mx-50">User 2</span>
                                    </div>
                                    <div class="series-result">
                                        <span>34.9%</span>
                                    </div>
                                </div>
                                <div class="chart-info d-flex justify-content-between mb-50">
                                    <div class="series-info d-flex align-items-center">
                                        <i class="feather icon-tablet font-medium-2 text-danger"></i>
                                        <span class="text-bold-600 mx-50">User 3</span>
                                    </div>
                                    <div class="series-result">
                                        <span>26.05%</span>
                                    </div>
                                </div>
                                <div class="chart-info d-flex justify-content-between mb-1">
                                    <div class="series-info d-flex align-items-center">
                                        <i class="feather icon-tablet font-medium-2 text-warning"></i>
                                        <span class="text-bold-600 mx-50">User 2</span>
                                    </div>
                                    <div class="series-result">
                                        <span>34.9%</span>
                                    </div>
                                </div>
                                <div class="chart-info d-flex justify-content-between mb-50">
                                    <div class="series-info d-flex align-items-center">
                                        <i class="feather icon-tablet font-medium-2 text-danger"></i>
                                        <span class="text-bold-600 mx-50">User 3</span>
                                    </div>
                                    <div class="series-result">
                                        <span>26.05%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Bar Chart -->
        </section>
        <!-- Dashboard Analytics end -->
    </div>
@endsection
