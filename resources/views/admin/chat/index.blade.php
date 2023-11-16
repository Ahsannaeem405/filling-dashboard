@extends('admin.layouts.master')
@section('title')
    <title>Admin</title>
@endsection
@section('content')
<style>
    /* .chat-application .sidebar-content{
        width: 260px;
        overflow: hidden;
    }
    .chat-application .sidebar-content .chat-user-list li .contact-info {
        width: calc(100vw - (100vw - 72%) - 1rem - 50px);
        margin-top: 0.3rem;
    }
    body .content-right{
        width: 100%;
    } */
    /* .chat-application .sidebar-content .chat-fixed-search,
    .chat-application .sidebar-content,
    .chat-application .sidebar-content .chat-user-list{
        width: 100% !important;
    } */
    html body .content.app-content .content-area-wrapper {
        height: calc(100% - 0rem);
    }
    .AcountsDetail {
        width: 40%;
        background-color: #262c49;
        padding: 12px;
        border-right: 1px solid #414561;
    }
    .AcountsDetail h3{
        color: #7367f0 !important;
        margin-bottom: 16px;
    }
    .AcountsDetail ul{
        padding: 0;
        margin: 0;
        list-style: none;
    }
    .AcountsDetail ul li.active{
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
    .AcountsDetail ul li span{
        background-color: #8a82dd75;
        padding: 9px;
        border-radius: 50%;
        color: #7367f0;
        font-weight: 700;
        font-size: 16px;
        margin-right: 5px;
    }
    /*  */
    .account-btn1{
        border:none;
        outline:none;
        color:white;
        background: #27ce72;
        border-radius:5px;
        padding:6px;
        font-size:11px;
        width:93px;
        margin-bottom:20px;
    }
    .account-btn2{
        border:none;
        outline:none;
        color:white;
        background: #7367f0;
        border-radius:5px;
        padding:6px;
        font-size:11px;
        width:85px;
        margin-bottom:20px;
    }
    .chat-btn{
        margin:10px 10px 10px;
    }
    .account-prof{
        padding:0px !important;
        background-color:transparent !important;
    }
    .account-prof p{
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
img.type-icon{
    width: 22px;
    right: 14%;
}
.chat-time-right p{
    text-align: right;
    margin-right: 60px;
    margin-bottom: 30px;
}
.chat-time-left p{
    text-align: left;
    margin-left: 60px;
    margin-bottom: 30px;
}
.send{
    display: flex;
    width: 25%;
    padding: 5px !important;
    align-items: center;
    justify-content: center;
    gap: 5px;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="content-area-wrapper mt-0">
            <div class="AcountsDetail">
                <h3>Accounts</h3>
                <button class='account-btn1'>Neuen Account hinzufugen</button>
                <button class='account-btn2'>Accounts aktualisieren</button>
                <ul>
                    <li class="list-style active"><img src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="">
                    <span class='account-prof'>
                        <p>Spielzeugauto Wie</p>
                        <p>75€ VB</p>

                    </span>
                </li>
                    <li class="list-style"><span>AH</span>test@gmail.com</li>
                </ul>
            </div>
            <div class="sidebar-left">
                <div class="sidebar">
                    <!-- User Chat profile area -->
                    {{-- <div class="chat-profile-sidebar">
                        <header class="chat-profile-header">
                            <span class="close-icon">
                                <i class="feather icon-x"></i>
                            </span>
                            <div class="header-profile-sidebar">
                                <div class="avatar">
                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="user_avatar" height="70" width="70">
                                    <span class="avatar-status-online avatar-status-lg"></span>
                                </div>
                                <h4 class="chat-user-name">John Doe</h4>
                            </div>
                        </header>
                        <div class="profile-sidebar-area">
                            <div class="scroll-area">
                                <h6>About</h6>
                                <div class="about-user">
                                    <fieldset class="mb-0">
                                        <textarea data-length="120" class="form-control char-textarea" id="textarea-counter" rows="5" placeholder="About User">Dessert chocolate cake lemon drops jujubes. Biscuit cupcake ice cream bear claw brownie brownie marshmallow.</textarea>
                                    </fieldset>
                                    <small class="counter-value float-right"><span class="char-count">108</span> / 120 </small>
                                </div>
                                <h6 class="mt-3">Status</h6>
                                <ul class="list-unstyled user-status mb-0">
                                    <li class="pb-50">
                                        <fieldset>
                                            <div class="vs-radio-con vs-radio-success">
                                                <input type="radio" name="userStatus" value="online" checked="checked">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="">Active</span>
                                            </div>
                                        </fieldset>
                                    </li>
                                    <li class="pb-50">
                                        <fieldset>
                                            <div class="vs-radio-con vs-radio-danger">
                                                <input type="radio" name="userStatus" value="busy">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="">Do Not Disturb</span>
                                            </div>
                                        </fieldset>
                                    </li>
                                    <li class="pb-50">
                                        <fieldset>
                                            <div class="vs-radio-con vs-radio-warning">
                                                <input type="radio" name="userStatus" value="away">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="">Away</span>
                                            </div>
                                        </fieldset>
                                    </li>
                                    <li class="pb-50">
                                        <fieldset>
                                            <div class="vs-radio-con vs-radio-secondary">
                                                <input type="radio" name="userStatus" value="offline">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="">Offline</span>
                                            </div>
                                        </fieldset>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                    <!--/ User Chat profile area -->
                    <!-- Chat Sidebar area -->
                    <div class="sidebar-content card">
                        <span class="sidebar-close-icon">
                            <i class="feather icon-x"></i>
                        </span>
                        <div class="chat-fixed-search">
                            <div class="d-flex align-items-center">
                                <div class="sidebar-profile-toggle position-relative d-inline-flex">
                                    <div class="avatar">
                                        <img src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="user_avatar" height="40" width="40">
                                        <span class="avatar-status-online"></span>
                                    </div>
                                    <div class="bullet-success bullet-sm position-absolute"></div>
                                </div>
                                <fieldset class="form-group position-relative has-icon-left mx-1 my-0 w-100">
                                    <input type="text" class="form-control round" id="chat-search" placeholder="Search or start a new chat">
                                    <div class="form-control-position">
                                        <i class="feather icon-search"></i>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div id="users-list" class="chat-user-list list-group position-relative">
                            <div style='display:flex; justify-content:space-between;'>
                            <h3 class="primary p-1 mb-0">Chats</h3>
                            <button class='account-btn2 chat-btn'>Accounts aktualisieren</button>
                            </div>
                            <ul class="chat-users-list-wrapper media-list">
                                <li>
                                    <div class="pr-1">
                                        <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                            <i></i>
                                        </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Susanne Ackermann</h5>
                                            <p class="truncate">Ich wurde gerne via</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25">14.11.23,17:35</span>
                                            <span class="badge badge-primary badge-pill float-right">3</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                        <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                            <i></i>
                                        </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Kristopher Candy</h5>
                                            <p class="truncate">Cake pie jelly jelly beans. Marzipan lemon drops halvah cake. Pudding cookie lemon drops icing</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25">14.11.23,11:35</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <h3 class="primary p-1 mb-0">Contacts</h3>
                            <ul class="chat-users-list-wrapper media-list">
                                <li>
                                    <div class="pr-1">
                                        <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                            <i></i>
                                        </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Sarah Woods</h5>
                                            <p class="truncate">Cake pie jelly jelly beans. Marzipan lemon drops halvah cake. Pudding cookie lemon drops icing.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                        <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                            <i></i>
                                        </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Jenny Perich</h5>
                                            <p class="truncate">Tart dragée carrot cake chocolate bar. Chocolate cake jelly beans caramels tootsie roll candy canes.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                        <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                            <i></i>
                                        </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Sarah Montgomery</h5>
                                            <p class="truncate">Tootsie roll sesame snaps biscuit icing jelly-o biscuit chupa chups powder.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                        <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('app-assets/images/portrait/small/avatar-s-9.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                            <i></i>
                                        </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Heather Howell</h5>
                                            <p class="truncate">Tart cookie dragée sesame snaps halvah. Fruitcake sugar plum gummies cheesecake toffee.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                        <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('app-assets/images/portrait/small/avatar-s-7.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                            <i></i>
                                        </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Kelly Reyes</h5>
                                            <p class="truncate">Wafer toffee tart jelly cake croissant chocolate bar cupcake donut. Fruitcake gingerbread tiramisu sweet jelly-o.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                        <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('app-assets/images/portrait/small/avatar-s-14.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                            <i></i>
                                        </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Vincent Nelson</h5>
                                            <p class="truncate">Toffee gummi bears sugar plum gummi bears chocolate bar donut. Pudding cookie lemon drops icing</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                        <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('app-assets/images/portrait/small/avatar-s-3.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                            <i></i>
                                        </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Elizabeth Elliott</h5>
                                            <p class="truncate">Candy canes ice cream jelly beans carrot cake chocolate bar pastry candy jelly-o.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="pr-1">
                                        <span class="avatar m-0 avatar-md"><img class="media-object rounded-circle" src="{{ asset('app-assets/images/portrait/small/avatar-s-7.jpg') }}" height="42" width="42" alt="Generic placeholder image">
                                            <i></i>
                                        </span>
                                    </div>
                                    <div class="user-chat-info">
                                        <div class="contact-info">
                                            <h5 class="font-weight-bold mb-0">Kristopher Candy</h5>
                                            <p class="truncate">Marzipan bonbon chocolate bar biscuit lemon drops muffin jelly-o sweet jujubes.</p>
                                        </div>
                                        <div class="contact-meta">
                                            <span class="float-right mb-25"></span>
                                        </div>
                                    </div>
                                </li>
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
                            <div class="start-chat-area">
                                <span class="mb-1 start-chat-icon feather icon-message-square"></span>
                                <h4 class="py-50 px-1 sidebar-toggle start-chat-text">Start Conversation</h4>
                            </div>
                            <div class="active-chat d-none">
                                <div class="chat_navbar">
                                    <header class="chat_header d-flex justify-content-between align-items-center p-1">
                                        <div class="vs-con-items d-flex align-items-center">
                                            <div class="sidebar-toggle d-block d-lg-none mr-1"><i class="feather icon-menu font-large-1"></i></div>
                                            <div class="avatar user-profile-toggle m-0 m-0 mr-1">
                                                <img src="{{ asset('app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="" height="40" width="40" />
                                                <span class="avatar-status-busy"></span>
                                            </div>
                                            <!-- <h6 class="mb-0">Felecia Rower</h6> -->
                                            <span class='account-prof'>
                                                <h6 class="mb-0">Spielzeugauto Wie</h6>
                                                <p>75€ VB</p>

                                            </span>
                                        </div>
                                       <div>
                                        <span class="favorite"><i class="feather icon-home font-medium-5"></i></span>
                                        <span class="favorite"><i class="feather icon-star font-medium-5"></i></span>
                                        <span class="favorite"><i class="feather icon-trash font-medium-5"></i></span>
                                       </div>
                                    </header>
                                </div>
                                <div class="user-chats">
                                    <div class="chats">
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>How can we help? We're here for you!</p>
                                                </div>

                                            </div>
                                            <div class="chat-time-right"><p>14.11.23,17:35</p></div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-7.jpg') }}" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Hey John, I am looking for the best admin template.</p>
                                                    <p>Could you please help me to find it out?</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>It should be Bootstrap 4 compatible.</p>
                                                </div>

                                            </div>
                                            <div class="chat-time-left"><p>14.11.23,17:35</p></div>
                                        </div>
                                        <div class="divider">
                                            <div class="divider-text">Yesterday</div>
                                        </div>
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Absolutely!</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>Vuexy admin is the responsive bootstrap 4 admin template.</p>
                                                </div>
                                            </div>
                                            <div class="chat-time-right"><p>14.11.23,17:35</p></div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-7.jpg') }}" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Looks clean and fresh UI.</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>It's perfect for my next project.</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>How can I purchase it?</p>
                                                </div>
                                            </div>
                                            <div class="chat-time-left"><p>14.11.23,17:35</p></div>
                                        </div>
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Thanks, from ThemeForest.</p>
                                                </div>

                                            </div>
                                            <div class="chat-time-right"><p>14.11.23,17:35</p></div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">
                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-7.jpg') }}" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>I will purchase it for sure.</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>Thanks.</p>
                                                </div>

                                            </div>
                                            <div class="chat-time-left"><p>14.11.23,17:35</p></div>
                                        </div>
                                        <div class="chat">
                                            <div class="chat-avatar">
                                                <a class="avatar m-0" data-toggle="tooltip" href="#" data-placement="right" title="" data-original-title="">
                                                    <img src="{{ asset('app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="avatar" height="40" width="40" />
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-content">
                                                    <p>Great, Feel free to get in touch on</p>
                                                </div>
                                                <div class="chat-content">
                                                    <p>https://pixinvent.ticksy.com/</p>
                                                </div>

                                            </div>
                                            <div class="chat-time-right"><p>14.11.23,17:35</p></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chat-app-form">
                                    <form class="chat-app-input d-flex justify-content-between position-relative" onsubmit="enter_chat();" action="javascript:void(0);">
                                       <div class='position-relative'style='width: 70%;'>
                                       <input type="text" class="form-control message mr-1 ml-50" id="iconLeft4-1" placeholder="Type your message">
                                        <i class="type-icon fa fa-image"></i>
                                        <img class='type-icon' src="{{ asset('app-assets/images/logo/face.png') }}" alt="user_avatar">
                                       </div>
                                        <button type="button" class="btn btn-primary send" onclick="enter_chat();"><i class="fa fa-paper-plane-o"></i> <span class="">Senden</span></button>
                                    </form>
                                </div>
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
                                        <img src="{{ asset('app-assets/images/portrait/small/avatar-s-1.jpg') }}" alt="user_avatar" height="70" width="70">
                                        <span class="avatar-status-busy avatar-status-lg"></span>
                                    </div>
                                    <h4 class="chat-user-name">Felecia Rower</h4>
                                </div>
                            </header>
                            <div class="user-profile-sidebar-area p-2">
                                <h6>About</h6>
                                <p>Toffee caramels jelly-o tart gummi bears cake I love ice cream lollipop. Sweet liquorice croissant candy danish dessert icing. Cake macaroon gingerbread toffee sweet.</p>
                            </div>
                        </div>
                        <!--/ User Chat profile right area -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
