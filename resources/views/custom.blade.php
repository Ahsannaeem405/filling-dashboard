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
                                                <div class="sidebar-toggle d-block d-lg-none mr-1"><i
                                                        class="feather icon-menu font-large-1"></i></div>
                                                <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                                    <span class="initials buyerInitials">A</span>
                                                </div>
                                                <span class='account-prof'>
                                                    <h6 class="mb-0 buyerName">Afaq</h6>
                                                    <p><span class="price">2200</span> € VB</p>

                                                </span>
                                            </div>
                                            
                                        </header>
                                    </div>
                                    <div class="user-chats">
                                        <div class="chats append-chat">
                                          
                                              <div class="chat">
                                                  <div class="chat-avatar">
                                                      <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title=""
                                                          data-original-title="">
                                                          <span class="initials">A</span>
                                                      </a>
                                                  </div>
                                                  <div class="chat-body">
                                                      <div class="chat-content">
                                                          <p>hello hea jda b aida sajdas dsajdias asjasd a saba abdiaa abaja</p>
                                                          <p>
                                                              <span class="time-left">22-10-2029</span>
                                                          </p>
                                                      </div>
                                                  </div>
                                              </div>
                                          
                                              <div class="chat chat-left">
                                                  <div class="chat-avatar">
                                                      <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title=""
                                                          data-original-title="">
                                                          <span class="initials">B</span>
                                                      </a>
                                                  </div>
                                                  <div class="chat-body">
                                                      <div class="chat-content">
                                                          <p>hello hea jda b aida sajdas dsajdias asjasd a saba abdiaa abaja</p>
                                                          <p>
                                                              <span class="time-right">22-10-2029</span>
                                                          </p>
                                                      </div>
                                                  </div>
                                              </div>
                                          {{-- @endif
                                      @endforeach --}}
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
