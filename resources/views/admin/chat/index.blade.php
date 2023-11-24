@extends('admin.layouts.master')
@section('title')
    <title>Chat</title>
@endsection
@section('chat')
    active
@endsection
@section('content')
    <style>
        .chat-application .sidebar-content{
            height: calc(var(--vh, 1vh) * 100 - 8rem) !important; 
        }
        .chat-application .chat-app-window .start-chat-area{
            height: calc(var(--vh, 1vh) * 100 - 8rem) !important; 
        } 
        .chat-application .chat-app-window .user-chats{
            height: calc(var(--vh, 1vh) * 100 - 18rem) !important;
        }
        html body .content.app-content .content-area-wrapper {
            height: calc(100% - 0rem);
        }
        .scrol-custom::-webkit-scrollbar {
            width: 6px; 
        }
        .scrol-custom::-webkit-scrollbar-track {
            background-color: transparent; 
        }
        .scrol-custom::-webkit-scrollbar-thumb {
            background-color: #999; 
            border-radius: 8px;
        }
        .scrol-custom{
            height: calc(var(--vh, 1vh) * 100 - 13rem);
            overflow: auto;
        }
        .AcountsDetail {
            width: 40%;
            background-color: #262c49;
            padding: 12px;
            border-right: 1px solid #414561;
        }

        .AcountsDetail h3 {
            color: #7367f0 !important;
            margin-bottom: 16px;
        }

        .AcountsDetail ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .AcountsDetail ul li.active {
            background-color: #7367f0;
        }

        .AcountsDetail ul li {
            border-radius: 5px;
            padding: 4px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: inherit;
            color: #fff;
        }

        .AcountsDetail ul li img {
            border-radius: 50%;
            width: 40px;
            margin-right: 6px;
        }

        .AcountsDetail ul li span {
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
        .list-style{
            cursor: pointer;
        }
        /*  */
        .account-btn1 {
            border: none;
            outline: none;
            color: white;
            background: #27ce72;
            border-radius: 5px;
            padding: 6px;
            font-size: 11px;
            width: 96px;
            margin-bottom: 20px;
        }

        .account-btn2 {
            border: none;
            outline: none;
            color: white;
            background: #7367f0;
            border-radius: 5px;
            padding: 6px;
            font-size: 11px;
            width: 85px;
            margin-bottom: 20px;
        }

        .chat-btn {
            margin: 10px 10px 10px;
        }

        .account-prof {
            padding: 0px !important;
            background-color: transparent !important;
        }

        .account-prof p {
            margin: 0;
            font-size: 12px;
        }

        .fa-image:before {
            content: "\f03e";
            font-size: 20px;
            color: #C2C6DC;
        }

        .type-icon {
            position: absolute;
            right: 3%;
            top: 10px;
        }

        img.type-icon {
            width: 22px;
            right: 14%;
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

        .send {
            display: flex;
            width: 25%;
            padding: 5px !important;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        .initials{
            background-color: #8a82dd75;
            padding: 11px;
            border-radius: 50%;
            color: #7367f0;
            font-weight: 700;
            font-size: 16px;
            margin-right: 0px;
        } 
    </style>
    <div class="row">
        <div class="col-md-12">
            <div class="content-area-wrapper mt-0">
                <div class="AcountsDetail">
                    <h3>Accounts</h3>
                    @if (Auth::user()->role == 'user')
                        <a href="{{ route('assign') }}"> <button class='account-btn1'>Neuen Account hinzufugen</button></a>
                        <button class='account-btn2'>Accounts aktualisieren</button>
                    @endif
                    <div class="scrol-custom">
                        <ul>
                            @if(isset($accounts))
                                @foreach ($accounts as $account)
                                    <li class="list-style" data-refresh="{{ $account->refreshToken }}" data-user-id="{{ $account->account_id }}" data-id="{{ $account->id }}">
                                        <span class="initials mr-1">{!! strtoupper(substr($account->description,0,2))  !!}</span>
                                        <?php
                                            $string = $account->description;
                                            $parts = explode(':', $string);
                                            $email = $parts[0]; 
                                        ?>
                                        {{ $email }}
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>                        
                </div>
                <div class="sidebar-left">
                    <div class="sidebar">
                        <!-- Chat Sidebar area -->
                        <div class="sidebar-content card">
                            <span class="sidebar-close-icon">
                                <i class="feather icon-x"></i>
                            </span>
                            <div class="chat-fixed-search">
                                <div class="d-flex align-items-center">
                                    <div class="sidebar-profile-toggle position-relative d-inline-flex">
                                        <div class=" profile-avatar">
                                
                                        </div>
                                        <div class="bullet-success bullet-sm position-absolute"></div>
                                    </div>
                                    <fieldset class="form-group position-relative has-icon-left mx-1 my-0 w-100">
                                        <input type="text" class="form-control round" id="chat-search"
                                            placeholder="Search or start a new chat">
                                        <div class="form-control-position">
                                            <i class="feather icon-search"></i>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div id="users-list" class="chat-user-list list-group position-relative">
                                <div style='display:flex; justify-content:space-between; align-items:center;'>
                                    <h3 class="primary p-1 mb-0">Chats</h3>
                                    <button class='account-btn2 chat-btn'>Accounts aktualisieren</button>
                                </div>
                                <ul class="chat-users-list-wrapper media-list">
                                    
                                </ul>
                            </div>
                        </div>
                        <!--/ Chat Sidebar area -->

                    </div>
                </div>
                <div class="content-right">
                    <div class="content-wrapper">
                        <div class="content-header row">
                        </div>
                        <div class="content-body">
                            <div class="chat-overlay"></div>
                            <section class="chat-app-window">
                                <div class="start-chat-area" data-conv-id="" data-user-id="" data-refresh-token="">
                                    <span class="mb-1 start-chat-icon feather icon-message-square"></span>
                                    <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4>
                                </div>
                                <div class="active-chat">
                                
                                </div> 
                            </section>
                            <!-- User Chat profile right area -->
                            <div class="user-profile-sidebar">
                                <header class="user-profile-header">
                                    <span class="close-icon">
                                        <i class="feather icon-x"></i>
                                    </span>
                                    <div class="header-profile-sidebar">
                                        <div class="avatar">
                                            <span class="logo initials"></span>
                                        </div>
                                        <h4 class="chat-user-name name"></h4>
                                    </div>
                                </header>
                                <div class="user-profile-sidebar-area p-2">
                                    
                                </div>
                            </div>
                            <!--/ User Chat profile right area -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.list-style').on('click', function() {
                var spanValue = $(this).find('span').text();
                var refreshToken = $(this).attr('data-refresh');
                var id = $(this).attr('data-id');
                var user_id = $(this).attr('data-user-id');
                
                $.ajax({
                    type: 'get',
                    url: '{{ route('conversation') }}',
                    data: {
                        id: id,
                        user_id: user_id,
                        refreshToken: refreshToken
                    },
                    success: function(response) {
                        $('.start-chat-area').removeClass('d-none');
                        $('.active-chat').addClass('d-none');
                        $('.media-list').empty().append(response.component);
                        $('.profile-avatar').text(spanValue).addClass('initials');
                    },
                    error: function(error) {
                        // Handle errors if the AJAX request fails
                        console.error(error);
                    }
                });
            });

            $(document).on('click', '.messages', function() {

                var user_id = $(this).attr('data-user-id');
                var conv_id = $(this).attr('data-conv-id');
                var refreshToken = $(this).attr('data-refresh-token');
                $.ajax({
                    type: 'get',
                    url: '{{ route('messages') }}',
                    data: {
                        user_id: user_id,
                        conv_id: conv_id,
                        refreshToken: refreshToken,
                    },
                    success: function(response) {
                        $('.active-chat').removeClass('d-none');
                        $('.start-chat-area').addClass('d-none');
                        $('.active-chat').empty().append(response.component);
                        $('.logo').text(response.logo);
                        $('.name').text(response.name);
                        $('.start-chat-area').attr('data-conv-id', response.conv_id);
                        $('.start-chat-area').attr('data-user-id', response.user_id);
                        $('.start-chat-area').attr('data-refresh-token', response.refreshToken);
                    },
                    error: function(error) {
                        
                        console.error(error);
                    }
                });
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function(){
            function refresh() {
                if ($('.start-chat-area').hasClass('d-none')) {
                    var user_id = $('.start-chat-area').attr('data-user-id');
                    var conv_id = $('.start-chat-area').attr('data-conv-id');
                    var refreshToken = $('.start-chat-area').attr('data-refresh-token');

                    $.ajax({
                        type: 'get',
                        url: '{{ route('messages') }}',
                        data: {
                            user_id: user_id,
                            conv_id: conv_id,
                            refreshToken: refreshToken,
                        },
                        success: function(response) {
                            // $('.active-chat').removeClass('d-none');
                            // $('.start-chat-area').addClass('d-none');
                            $('.active-chat').empty().append(response.component);
                            // $('.logo').text(response.logo);
                            // $('.name').text(response.name);
                            // $('.start-chat-area').attr('data-conv-id', response.conv_id);
                            // $('.start-chat-area').attr('data-user-id', response.user_id);
                            // $('.start-chat-area').attr('data-refresh-token', response.refreshToken);
                        },
                        error: function(error) {
                            
                            console.error(error);
                        }
                    });
                }
            }
            setInterval(refresh, 10000);
        })
    </script> --}}
@endsection
