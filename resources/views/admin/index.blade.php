@extends('admin.layouts.master')
@section('title')
    <title>Filling Dashboard</title>
@endsection
@section('/')
    active
@endsection
@section('content')
    <style>
        body.dark-layout .card {
            height: 100%;
            margin-bottom: 0px;
        }

        .ChatsCard .headingMain h4 {
            font-size: 28px;
            font-weight: 600;
        }

        .UncompletedChats,
        .CompletedChats,
        .EarningBox,
        .ProfitBox,
        .GebBox {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .UncompletedChats i,
        .EarningBox i {
            background-color: #7367f052;
            color: #7367f0 !important;
            font-size: 20px;
        }

        .CompletedChats i,
        .ProfitBox i {
            background-color: #37cbbd59;
            color: #37cbc6;
            font-size: 20px;
        }

        .GebBox i {
            background-color: #ea545566;
            color: #ea5455;
            font-size: 20px;
        }

        .UncompletedChats i,
        .CompletedChats i,
        .ProfitBox i,
        .EarningBox i,
        .GebBox i {
            padding: 6px 8px;
            border-radius: 4px;
            margin-right: 10px;
        }

        .UncompletedChats h6,
        .CompletedChats h6 {
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

        .LoginText_Wrap {
            overflow: hidden;
            padding-bottom: 15px;
        }

        .LoginText_Wrap .card-header h4 {}

        .LoginText_Wrap .card-header p,
        .LoginText_Wrap .card-header p span {
            font-size: 12px;
            color: #cccccc73;
        }

        .LoginText_Wrap .card-header p span {}

        .StepsCount_WrapCard .TopHeading {}

        .StepsCount_WrapCard .TopHeading h4 {}

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

        .StepsCount .col {}

        .StepsCount .col p {}

        .StepsCount .col p i {
            color: #7367f0;
        }

        .StepsCount .Beg_CS p span {
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

        .StepsCount .Adv_CS p span {
            background-color: #067e06;
        }

        .StepsCount .Pro_CS p span {
            background-color: #780378;
        }

        .StepsCount .Leg_CS p span {
            background-color: #bb0505;
        }

        .StepsCount .Vip_CS p span {
            background-color: #959505;
            color: yellow;
        }

        .StepsCount .col div {
            padding: 5px 0 0 13px;
        }

        .StepsCount .col div span {
            color: #7367f0;
            font-size: 10px;
            display: block;
        }

        .PriceTotal_WrapCard {}

        .PriceTotal_WrapCard .PriceTotal_Heading {}

        .PriceTotal_WrapCard .PriceTotal_Heading h4 {}

        .PriceTotal_WrapCard .PriceTotal_Heading p {}

        .PriceTotal_WrapCard .PriceTotal {}

        .PriceTotal_WrapCard .PriceTotal h3 {
            font-size: 28px;
            font-weight: 600;
        }

        .PriceTotal_WrapCard .PriceTotal h3 span {
            font-size: 10px;
            border-radius: 4px;
            padding: 4px;
            color: #00ab00;
            background-color: #1d5541;
            font-weight: 600;
        }

        .PriceTotal_WrapCard .PriceTotal p,
        .PriceTotal_WrapCard .PriceTotal_Heading p {
            font-size: 12px;
            color: #ffffffc7;
            margin: 0;
            line-height: 17px;
        }

        .progress-bar-warning .progress-bar {
            background-color: #43ffff;
        }

        .chart-info-flag img {
            width: 30px;
            border-radius: 50%;
            height: 30px;
        }

        i.bx.bx-dollar-sign {
            padding: 4px 13px 8px;
        }

        .weekday {
            display: flex;
            justify-content: space-between;
        }

        .weekday span {
            display: inline-block;
            width: 14%;
            font-size: 12px;
            text-align: center;
        }

        .highlight-color {
            color: #cccccc73 !important;
        }

        .content-body .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .content-body .message-box {
            position: absolute;
            background-color: #10163A;
            padding: 20px;
            border-radius: 6px;
            text-align: center;
            width: 80%;
            max-width: 100%;
            font-size: 17px;
            font-weight: 600;
            right: 20px;
        }

        .message-box p {
            margin: 0 !important;
        }

        .vertical-layout.vertical-menu-modern.menu-expanded .main-menu {
            z-index: 1050;
        }

        .dark-layout .header-navbar {
            z-index: 1000;
        }

        @media screen and (min-device-width:300px),
        screen and (max-width:768px) {
            .StepsCount {
                padding-top: 15px;
            }

            .StepsCount .col {
                margin-bottom: 12px;
            }

            .ChatsCard,
            .PriceTotal_WrapCard {
                height: auto !important;
            }
        }
        .avg-sessions{
            border: 1px solid #BABFC7;
            border-radius: 5px;
            margin: 0px;
        }
    </style>
    <div class="content-header row"></div>
    <div class="content-body">
        <section id="dashboard-analytics" class="dashboard">
            @if (Auth::user()->status == 'in-active')
                <div class="overlay">
                    <div class="message-box">
                        <p>Dein Konto wurde noch nicht freigegeben.</p>
                        <p>Bitte Gedulde dich etwas!</p>
                    </div>
                </div>
            @endif
            @if (Auth::user()->status == 'in-active')
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12 mb-2">
                        <div class="card LoginText_Wrap">
                            <div class="card-header" style="display: block; flex:unset">
                                <h4 class="">Hallo, $username</h4>
                                <div class="">
                                    <p class="m-0">Letzter Login : $lastlogin<span></span></p>
                                    <p class="m-0">Registriert seit : $registerdate <span></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-6 col-12 mb-2">
                        <div class="card StepsCount_WrapCard">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="TopHeading">
                                    <h4 class="m-0">Überblink Rang</h4>
                                    <p class="m-0">Aktueller Rang: Warte auf Friegabe</p>
                                </div>
                            </div>
                            <div class="card-content StepsCount">
                                <div class="col Beg_CS">
                                    <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>Beginner</span></p>
                                    <div class="">
                                        <span>0 €</span>
                                        <span>0% Einnahmen</span>
                                    </div>
                                </div>
                                <div class="col Adv_CS">
                                    <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>Advanced</span></p>
                                    <div class="">
                                        <span>0 €</span>
                                        <span>0% Einnahmen</span>
                                    </div>
                                </div>
                                <div class="col Pro_CS">
                                    <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>Pro</span></p>
                                    <div class="">
                                        <span>0 €</span>
                                        <span>0% Einnahmen</span>
                                    </div>
                                </div>
                                <div class="col Leg_CS">
                                    <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>Legend</span></p>
                                    <div class="">
                                        <span>0 €</span>
                                        <span>0% Einnahmen</span>
                                    </div>
                                </div>
                                <div class="col Vip_CS">
                                    <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>VIP</span></p>
                                    <div class="">
                                        <span>0 €</span>
                                        <span>0% Einnahmen</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Column Chart -->
                    <div class="col-lg-3 col-md-12">
                        <div class="card">
                            <div class="ChatsCard">
                                <div class="card-header">
                                    <h5 class="card-title">Chats</h5>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="headingMain">
                                            <h4>0</h4>
                                            <p class="m-0 highlight-color">Chats insgesamt</p>
                                        </div>
                                        <ul class="list-unstyled mt-3">
                                            <li class="UncompletedChats">
                                                <i class="fa fa-ticket"></i>
                                                <h6>Offene chats <span>0</span></h6>
                                            </li>
                                            <li class="CompletedChats">
                                                <i class="fa fa-ticke">
                                                    <img style='width: 20px;'
                                                        src="{{ asset('app-assets/images/logo/dash-tick.png') }}"
                                                        alt="">
                                                </i>
                                                <h6>Bearbeitete chats <span>0</span></h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="PriceTotal_WrapCard">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row pb-50">
                                            <div
                                                class="col-lg-6 col-12 d-flex justify-content-between flex-column order-lg-1 order-2 mt-lg-0 mt-2">
                                                <div class="PriceTotal_Heading">
                                                    <h4 class="text-bold-700 mb-25">Einnahmen</h4>
                                                    <p class="text-bold-500 mb-75 highlight-color">Weekly Earnings Overview</p>
                                                </div>
                                                <div class="PriceTotal">
                                                    <h3 class="">$0 <span>+0%</span></h3>
                                                    <p class="highlight-color">You informed of this week compared to last week
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="col-lg-6 col-12 d-flex justify-content-between flex-column text-right order-lg-2 order-1">
                                                <div id="avg-session-chart"></div>
                                                <div class="weekday">
                                                    <span>Mo</span>
                                                    <span>Tu</span>
                                                    <span>We</span>
                                                    <span>Th</span>
                                                    <span>Fr</span>
                                                    <span>Sa</span>
                                                    <span>Su</span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row avg-sessions pt-50">
                                            <div class="col-12 col-md-4 col-sm-6 mt-1 mb-1">
                                                <div class="EarningBox">
                                                    <i class="bx bx-dollar-sign">$</i>
                                                    <h6 class="text-bold-700 mb-0">Earning</h6>
                                                </div>
                                                <div class="TotalAmount">
                                                    <h4 class="text-bold-700 mb-0">$0</h4>
                                                </div>
                                                <div class="progress progress-bar-primary mt-25">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="50"
                                                        aria-valuemin="50" aria-valuemax="100" style="width:50%"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 col-sm-6 mt-1 mb-1">
                                                <div class="ProfitBox">
                                                    <i class="fa fa-ticke">
                                                        <img style='width: 20px;'
                                                            src="{{ asset('app-assets/images/logo/dash-tick.png') }}"
                                                            alt="">
                                                    </i>
                                                    <h6 class="text-bold-700 mb-0">Profit</h6>
                                                </div>
                                                <div class="TotalAmount">
                                                    <h4 class="text-bold-700 mb-0">$0</h4>
                                                </div>
                                                <div class="progress progress-bar-warning mt-25">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="60"
                                                        aria-valuemin="60" aria-valuemax="100" style="width:60%"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 col-sm-6 mt-1 mb-1">
                                                <div class="GebBox">
                                                    <i class="fa fa-ticket"></i>
                                                    <h6 class="text-bold-700 mb-0">Gebuhren</h6>
                                                </div>
                                                <div class="TotalAmount">
                                                    <h4 class="text-bold-700 mb-0">$0</h4>
                                                </div>
                                                <div class="progress progress-bar-danger mt-25">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                                        aria-valuemin="70" aria-valuemax="100" style="width:70%"></div>
                                                </div>
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
                            </div>
                            <div><span style='padding: 0 20px; color: #cccccc73'>Rangliste</span></div>
                            <div class="card-content">
                                <div class="card-body pt-2" style="position: relative;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12 mb-2">
                        <div class="card LoginText_Wrap">
                            <div class="card-header" style="display: block; flex:unset">
                                <h4 class="">Hallo, {{ Auth::user()->name }}</h4>
                                <div class="">
                                    <p class="m-0">Letzter Login : <span>{{ Auth::user()->last_login }}</span></p>
                                    <p class="m-0">Registriert seit :
                                        <span>{{ Auth::user()->created_at->format('d.m.Y, H:s') }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-6 col-12 mb-2">
                        <div class="card StepsCount_WrapCard">
                            <div class="card-header d-flex flex-column align-items-start pb-0">
                                <div class="TopHeading">
                                    <h4 class="m-0">Überblink Rang</h4>
                                    <p class="m-0">Aktueller Rang: {{ ucfirst(Auth::user()->rank) }}</p>
                                </div>
                            </div>
                            <div class="card-content StepsCount">
                                <div class="col Beg_CS">
                                    <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>Beginner</span></p>
                                    <div class="">
                                        <span>0 - 9.999 €</span>
                                        <span>40% Einnahmen</span>
                                    </div>
                                </div>
                                <div class="col Adv_CS">
                                    <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>Advanced</span></p>
                                    <div class="">
                                        <span>10.000 - 14.999 €</span>
                                        <span>45% Einnahmen</span>
                                    </div>
                                </div>
                                <div class="col Pro_CS">
                                    <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>Pro</span></p>
                                    <div class="">
                                        <span>15.000 - 24.999 €</span>
                                        <span>50% Einnahmen</span>
                                    </div>
                                </div>
                                <div class="col Leg_CS">
                                    <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>Legend</span></p>
                                    <div class="">
                                        <span>25.000 - 49.999 €</span>
                                        <span>55% Einnahmen</span>
                                    </div>
                                </div>
                                <div class="col Vip_CS">
                                    <p class="m-0"><i class="feather icon-arrow-up-left"></i><span>VIP</span></p>
                                    <div class="">
                                        <span>50.000 €</span>
                                        <span>60% Einnahmen</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Column Chart -->
                    <div class="col-lg-3 col-md-12">
                        <div class="card">
                            <div class="ChatsCard">
                                <div class="card-header">
                                    <h5 class="card-title">Chats</h5>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="headingMain">
                                            <h4>{{ $totalChat }}</h4>
                                            <p class="m-0 highlight-color">Chats insgesamt</p>
                                        </div>
                                        <ul class="list-unstyled mt-3">
                                            <li class="UncompletedChats">
                                                <i class="fa fa-ticket"></i>
                                                <h6>Offene chats <span>{{ $totalUnread }}</span></h6>
                                            </li>
                                            <li class="CompletedChats">
                                                <i class="fa fa-ticke">
                                                    <img style='width: 20px;'
                                                        src="{{ asset('app-assets/images/logo/dash-tick.png') }}"
                                                        alt="">
                                                </i>
                                                <h6>Bearbeitete chats <span>{{ $completeChat }}</span></h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="PriceTotal_WrapCard">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row pb-50">
                                            <div
                                                class="col-lg-6 col-12 d-flex justify-content-between flex-column order-lg-1 order-2 mt-lg-0 mt-2">
                                                <div class="PriceTotal_Heading">
                                                    <h4 class="text-bold-700 mb-25">Einnahmen</h4>
                                                    <p class="text-bold-500 mb-75 highlight-color">Weekly Earnings Overview</p>
                                                </div>
                                                <div class="PriceTotal">
                                                    <h3 class="">$468 <span>+ 4.2%</span></h3>
                                                    <p class="highlight-color">You informed of this week compared to last week
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="col-lg-6 col-12 d-flex justify-content-between flex-column text-right order-lg-2 order-1">
                                                <div id="avg-session-chart"></div>
                                                <div class="weekday">
                                                    <span>Mo</span>
                                                    <span>Tu</span>
                                                    <span>We</span>
                                                    <span>Th</span>
                                                    <span>Fr</span>
                                                    <span>Sa</span>
                                                    <span>Su</span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row avg-sessions pt-50">
                                            <div class="col-12 col-md-4 col-sm-6 mt-1 mb-1">
                                                <div class="EarningBox">
                                                    <i class="bx bx-dollar-sign">$</i>
                                                    <h6 class="text-bold-700 mb-0">Earning</h6>
                                                </div>
                                                <div class="TotalAmount">
                                                    <h4 class="text-bold-700 mb-0">$545.69</h4>
                                                </div>
                                                <div class="progress progress-bar-primary mt-25">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="50"
                                                        aria-valuemin="50" aria-valuemax="100" style="width:50%"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 col-sm-6 mt-1 mb-1">
                                                <div class="ProfitBox">
                                                    <i class="fa fa-ticke">
                                                        <img style='width: 20px;'
                                                            src="{{ asset('app-assets/images/logo/dash-tick.png') }}"
                                                            alt="">
                                                    </i>
                                                    <h6 class="text-bold-700 mb-0">Profit</h6>
                                                </div>
                                                <div class="TotalAmount">
                                                    <h4 class="text-bold-700 mb-0">$545.69</h4>
                                                </div>
                                                <div class="progress progress-bar-warning mt-25">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="60"
                                                        aria-valuemin="60" aria-valuemax="100" style="width:60%"></div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 col-sm-6 mt-1 mb-1">
                                                <div class="GebBox">
                                                    <i class="fa fa-ticket"></i>
                                                    <h6 class="text-bold-700 mb-0">Gebuhren</h6>
                                                </div>
                                                <div class="TotalAmount">
                                                    <h4 class="text-bold-700 mb-0">$545.69</h4>
                                                </div>
                                                <div class="progress progress-bar-danger mt-25">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                                        aria-valuemin="70" aria-valuemax="100" style="width:70%"></div>
                                                </div>
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
                            </div>
                            <div><span style='padding: 0 20px; color: #cccccc73'>Rangliste</span></div>
                            <div class="card-content">
                                <div class="card-body pt-2" style="position: relative;">
                                    @foreach ($users as $user)
                                        <div
                                            class="chart-info chart-info-flag d-flex justify-content-between align-items-center mb-1">
                                            <div class="series-info d-flex align-items-center">
                                                @if ($user->image)
                                                    <img src="{{ asset('app-assets/images/profile/' . $user->image) }}"
                                                        alt="">
                                                @else
                                                    <img src="{{ asset('app-assets/images/logo/logo-main.png') }}"
                                                        alt="">
                                                @endif
                                                <span class="text-bold-600 mx-50">{{ substr($user->name, 0, 13) }}</span>
                                            </div>
                                            <div class="series-result">
                                                <span>49.487€</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
        </section>
    </div>
@endsection
