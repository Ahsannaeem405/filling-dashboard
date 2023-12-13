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
            height: calc(100% - 2rem);
            overflow: hidden;
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
            height: calc(var(--vh, 1vh) * 100 - 20.8rem) !important;
        }

        .content-right {
            width: calc(100vw - (100vw - 100%) - 0px) !important;
            float: right;
        }

        .fa-arrow-left {
            color: white;
            cursor: pointer;
            font-size: 22px;
        }

        .time-right {
            font-size: 12px;
            margin-top: 12px;
            position: absolute;
        }

        .time-left {
            font-size: 12px;
            margin-top: 12px;
            position: absolute;
            right: 95px
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
                                                    <span class="initials buyerInitials">{{ $data['buyerInitials'] }}</span>
                                                </div>
                                                <span class='account-prof'>
                                                    <h6 class="mb-0 buyerName" data-conv-id="{{ $data['id'] }}"
                                                        data-id="{{ $account->id }}">{{ $data['buyerName'] }}</h6>
                                                    <p><span class="price">{{ $account->adPrice }}</span> € VB</p>
                                                </span>
                                            </div>
                                            <a href="{{ route('payment') }}"><i class="fa fa-arrow-left"></i></a>
                                        </header>
                                    </div>
                                    <div class="user-chats">
                                        <div class="chats append-chat">
                                            @php
                                                use Carbon\Carbon;
                                            @endphp
                                            @foreach ($data['messages'] as $message)
                                                @if (!empty($message['textShort']))
                                                    @if (isset($message['boundness']) && $message['boundness'] === 'OUTBOUND')
                                                        @php
                                                            $carbonDate = Carbon::parse($message['receivedDate']);
                                                        @endphp
                                                        <div class="chat">
                                                            <div class="chat-avatar">
                                                                <a class="avatar m-0" data-toggle="tooltip" href="#"
                                                                    data-placement="right" title=""
                                                                    data-original-title="">
                                                                    <span
                                                                        class="initials">{{ $data['sellerInitials'] }}</span>
                                                                </a>
                                                            </div>
                                                            <div class="chat-body">
                                                                <div class="chat-content">
                                                                    @if (!empty($message['attachments']))
                                                                        @php
                                                                            $url = $message['attachments'][0]['url'];
                                                                            $id = $account->id;
                                                                            $src = showImage($url, $id);
                                                                        @endphp
                                                                        <img src="{{ $src }}" width="185px"
                                                                            class="selected-image">
                                                                        <p>{{ $message['textShort'] }}</p>
                                                                    @else
                                                                        <p>{{ $message['textShort'] }}</p>
                                                                    @endif
                                                                    <p>
                                                                        <span
                                                                            class="time-left">{{ $carbonDate->format('d.m.y, H.i') }}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif(isset($message['boundness']) && $message['boundness'] === 'INBOUND')
                                                        @php
                                                            $carbonDate = Carbon::parse($message['receivedDate']);
                                                        @endphp
                                                        <div class="chat chat-left">
                                                            <div class="chat-avatar">
                                                                <a class="avatar m-0" data-toggle="tooltip" href="#"
                                                                    data-placement="left" title=""
                                                                    data-original-title="">
                                                                    <span
                                                                        class="initials">{{ $data['buyerInitials'] }}</span>
                                                                </a>
                                                            </div>
                                                            <div class="chat-body">
                                                                <div class="chat-content">
                                                                    @if (!empty($message['attachments']))
                                                                        @php
                                                                            $url = $message['attachments'][0]['url'];
                                                                            $id = $account->id;
                                                                            $src = showImage($url, $id);
                                                                        @endphp
                                                                        <img src="{{ $src }}" width="185px"
                                                                            class="selected-image">
                                                                        <p>{{ $message['textShort'] }}</p>
                                                                    @else
                                                                        <p>{{ $message['textShort'] }}</p>
                                                                    @endif
                                                                    <p>
                                                                        <span
                                                                            class="time-right">{{ $carbonDate->format('d.m.y, H.i') }}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif(isset($message['paymentAndShippingMessageType']))
                                                        @php
                                                            $carbonDate = Carbon::parse($message['receivedDate']);
                                                        @endphp
                                                        <div class="chat chat-left">
                                                            <div class="chat-avatar">
                                                                <a class="avatar m-0" data-toggle="tooltip" href="#"
                                                                    data-placement="left" title=""
                                                                    data-original-title="">
                                                                    <span class="initials"
                                                                        style="font-size: 13px">Offer</span>
                                                                </a>
                                                            </div>
                                                            <div class="chat-body">
                                                                <div class="chat-content">
                                                                    <p>Title: {{ $message['title'] }}</p>
                                                                    <p>{{ isset($message['itemPriceInEuroCent']) ? 'Price: ' . $message['itemPriceInEuroCent'] / 100 . '€' : '' }}
                                                                    </p>
                                                                    <p>
                                                                        <span
                                                                            class="time-right">{{ $carbonDate->format('d.m.y, H.i') }}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
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
