<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <link rel="stylesheet" href="{{ asset('app-assets/css/fonts.css') }}" type="text/css">
    <title>Login Page</title>
    {{-- <link rel="apple-touch-icon" href="{{asset('assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/images/ico/favicon.ico"> --}}
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <!-- BEGIN: Vendor CSS-->
    <!-- END: Vendor CSS-->
    <!-- END: Custom CSS-->
<style>
    @font-face {
    font-family: 'Poppins-Bold';
    src: url('../fonts/poppins/Poppins-Bold.ttf');
}
@font-face {
    font-family: 'Poppins-SemiBold';
    src: url('../fonts/poppins/Poppins-SemiBold.ttf');
}
@font-face {
    font-family: 'Poppins-Medium';
    src: url('../fonts/poppins/Poppins-Medium.ttf');
}
@font-face {
    font-family: 'Poppins-Regular';
    src: url('../fonts/poppins/Poppins-Regular.ttf');
}
@font-face {
    font-family: 'Poppins-Light';
    src: url('../fonts/poppins/Poppins-Light.ttf');
}

h1, h2, h3, h4{
    font-family: 'Poppins-Bold';
}
h5, h6 ,button,label{
    font-family: 'Poppins-Regular';
}
p, span, a{
    font-family: 'Poppins-Light';
}
    body{
        background: #26293c;
    }
.card.form-card {
    width: 300px;
    background: #303348;
    padding: 40px;
    box-shadow: 1px 1px 15px 0px rgba(0, 0, 0, 0.1);
}
.login-tittle {
    color: white;
    text-align: center;
    margin-top: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
}
.login-tittle  img{
    width:30px;
}
.login-para{
    color:white;
    margin-top:0px;
}
.form-label-group{
    position: relative;
}
.form-card .form-label-group label{
    color:white;
}
.form-card .form-label-group input{
    color: #fff;
    font-size: 16px;
    border: none;
    outline: none;
    margin-bottom: 20px;
    background-color: transparent;
    font-style: normal;
    line-height: normal;
    padding: 10px 20px;
    border: 1px solid #929292;
    width: 88%;
    border-radius:10px;
}
.form-label-group a{
    text-decoration:none;
    color: #7867ed;
}
.chckbox-cont {
    color: #8E8E8E;
    font-size: 15px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    display: flex;
    gap: 10px;
}
.submit-form {
    display: flex;
    width: 300px;
    margin: auto;
    margin-top: 10px;
    padding: 15px 0px;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 10px;
    color: white;
    text-align: center;
    font-size: 14px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    border-radius: 10px;
    background: #7867ed;
    border: none;
    outline: none;
}
.create-acnt{
    color:white;
    text-align:center;
    margin-top:20px;
    font-family: 'Poppins-Regular';
}
.create-acnt a{
    color:#7867ed;
    text-decoration:none;
}
.form-card-wraper{
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;

}
.wraped-div{
    position: relative;
    z-index: 9;
}
.before-div {
    position: absolute;
    width: 180px;
    height: 150px;
    background: #2d2e4a;
    border-radius: 10px;
    top: -40px;
    left: -40px;
    border-radius:5px;
    z-index: -1;
}
.after-div {
    position: absolute;
    border: 1px dotted #2d2e4a;
    border-radius: 5px;
    bottom: -50px;
    right: -50px;
    z-index: -1;
}
.after-inner{
    width:100px;
    height:100px;
    margin:20px;
    background:#2d2e4a;
    border-radius:5px;
}
.form-control-position.pass-icon {
    position: absolute;
    right: 10px;
    top: 36px;
    color: white;
}
</style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body>
    <!-- BEGIN: Content-->
    <div class="">
        <div class="">

            <div class="">
                <section class="">
                    <div class="">
                        <div class="">
                            <div class="">
                                {{-- <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                    <img src="{{asset('assets/images/pages/login.png')}}" alt="branding logo">
                                </div> --}}
                                <div class="form-card-wraper">
                                    <div class="wraped-div">
                                    <div class="before-div"></div>
                                    <div class="card form-card">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h4 class="login-tittle"><img src="{{asset('app-assets/images/logo/logo-main.png')}}" alt="">NullzFilling</h4>
                                            </div>
                                        </div>
                                        <h3 style='margin:0;color:white;'> Willkommen! </h3>
                                        <p class="login-para">
                                         Bitte logge dich ein fur die Millionen</p>
                                        <div class="">
                                            <div class="">
                                                <form action="">
                                                    <div class="form-label-group">
                                                    <label for="user-name">Benutzername</label>
                                                        <input type="text" class="form-control" id="user-name" required>
                                                        <div class="form-control-position">
                                                        </div>

                                                    </div>

                                                    <div class="form-label-group">
                                                    <div style='display:flex;justify-content:space-between;align-items:center;'>
                                                    <label for="user-password">Passwort</label>
                                                    <span><a href="#">Passwort vergessen?</a></span>
                                                    </div>
                                                        <input type="password" class="form-control" id="user-password" required>
                                                        <div class="form-control-position pass-icon">
                                                            <i class="fa fa-eye-slash"></i>
                                                        </div>

                                                    </div>
                                                    <div class="chckbox-cont">
                                                <input type="checkbox">Angemeldet bleiben
                                            </div>

                                                    <button type="submit" class="submit-form">Anmelden</button>
                                                    <div class='create-acnt'>
                                                        Neuer Filler ?
                                                    <a href="{{url('register')}}" class="btn btn-outline-primary float-left btn-inline">Registriere dich</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="after-div">
                                        <div class="after-inner">

                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('assets/js/core/app.js')}}"></script>
    <script src="{{asset('assets/js/scripts/components.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
