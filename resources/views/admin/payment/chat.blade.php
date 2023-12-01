@extends('admin.layouts.master')

@section('title')
    <title>Chat</title>
@endsection

@section('chat')
    active
@endsection

@section('content')
    <style>
        html body .content.app-content .content-area-wrapper {
            height: calc(100% - 0rem);
        }

        .chat-time-right p {
            text-align: right;
            margin-right: 60px;
            margin-bottom: 30px;
        }

        .chat-time-left p {
            text-align: left;
            margin-left: 60px;
            margin-bottom: 30px;
        }

        .initials {
            background-color: #8a82dd75;
            padding: 11px 15px;
            border-radius: 50%;
            color: #7367f0;
            font-weight: 700;
            width: 40px;
            font-size: 16px;
            height: 40px;
            margin-right: 0px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .time-right {
            font-size: 12px;
            margin-top: 11px;
            position: absolute;
        }

        .time-left {
            font-size: 12px;
            margin-top: 11px;
            position: absolute;
            right: 95px
        }

        .time-left-append {
            font-size: 12px;
            margin-top: 43px;
            position: absolute;
            right: 95px;
        }

        .chat-application .chat-app-window .user-chats {
            height: calc(var(--vh, 1vh) * 100 - 18.8rem) !important;
        }
        .content-right {
            width: calc(100vw - (100vw - 100%) - 0px) !important;
            float: right;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="content-area-wrapper mt-0">
                <div class="content-right">
                    <div class="content-wrapper">
                        <div class="content-header row">
                        </div>
                        <div class="content-body">
                            <div class="chat-overlay"></div>
                            <section class="chat-app-window">
                                <div class="active-chat">
                                    <div class="chat_navbar">
                                        <header class="chat_header d-flex justify-content-between align-items-center p-1">
                                            <div class="vs-con-items d-flex align-items-center">
                                                <div class="sidebar-toggle d-block d-lg-none mr-1">
                                                    <i class="feather icon-menu font-large-1"></i>
                                                </div>
                                                <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                                    <span
                                                        class="initials buyerInitials">{{ substr($payment->client_name, 0, 1) }}</span>
                                                </div>
                                                <span class='account-prof'>
                                                    <h6 class="mb-0 buyerName">{{ $payment->client_name }}</h6>
                                                    <p><span class="price">{{ $payment->price }}</span> € VB</p>
                                                </span>
                                            </div>
                                        </header>
                                    </div>
                                    <div class="user-chats">
                                        <div class="chats append-chat">
                                            @foreach ($chatMessages as $chat)
                                                @php
                                                    $carbonDate = \Carbon\Carbon::parse($chat['receivedDate']);
                                                @endphp

                                                @if ($chat['boundness'] === 'OUTBOUND')
                                                    <div class="chat">
                                                        <div class="chat-avatar">
                                                            <a class="avatar m-0" data-toggle="tooltip" href="#"
                                                                data-placement="right" title=""
                                                                data-original-title="">
                                                                <span
                                                                    class="initials">{{ substr($payment->seller_name, 0, 1) }}</span>
                                                            </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                                <p>{{ $chat['textShort'] }}</p>
                                                                <p>
                                                                    <span
                                                                        class="time-left">{{ $carbonDate->format('d.m.y, H.i') }}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($chat['boundness'] === 'INBOUND')
                                                    <div class="chat chat-left">
                                                        <div class="chat-avatar">
                                                            <a class="avatar m-0" data-toggle="tooltip" href="#"
                                                                data-placement="left" title="" data-original-title="">
                                                                <span
                                                                    class="initials">{{ substr($payment->client_name, 0, 1) }}</span>
                                                            </a>
                                                        </div>
                                                        <div class="chat-body">
                                                            <div class="chat-content">
                                                                <p>{{ $chat['textShort'] }}</p>
                                                                <p>
                                                                    <span
                                                                        class="time-right">{{ $carbonDate->format('d.m.y, H.i') }}</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
