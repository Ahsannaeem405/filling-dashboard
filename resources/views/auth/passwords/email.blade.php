<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <link rel="stylesheet" href="{{ asset('app-assets/css/fonts.css') }}" type="text/css">
    <title>Forget Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
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

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Poppins-Bold';
        }

        h5,
        h6,
        button,
        label {
            font-family: 'Poppins-Regular';
        }

        p,
        span,
        a {
            font-family: 'Poppins-Light';
        }

        body {
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

        .login-tittle img {
            width: 30px;
        }

        .login-para {
            color: white;
            margin-top: 0px;
            font-size: 12px;
        }

        .form-card-wraper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;

        }

        .wraped-div {
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
            border-radius: 5px;
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

        .after-inner {
            width: 100px;
            height: 100px;
            margin: 20px;
            background: #2d2e4a;
            border-radius: 5px;
        }

        a {
            color: #7867ed;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
        .form-label-group {
            position: relative;
        }

        .form-card .form-label-group label {
            color: white;
        }

        .form-card .form-label-group input {
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
            border-radius: 10px;
        }

        .form-label-group a {
            text-decoration: none;
            color: #7867ed;
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
            margin-bottom: 20px;
            cursor: pointer;
        }
        .invalid-feedback{
            color: rgb(199, 41, 41);
        }
        .alert-success{
            color: green;
        }
    </style>
</head>

<body>
    <div class="">
        <div class="">
            <div class="">
                <section class="">
                    <div class="">
                        <div class="">
                            <div class="">
                                <div class="form-card-wraper">
                                    <div class="wraped-div">
                                        <div class="before-div"></div>
                                        <div class="card form-card">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2 class="login-tittle"><img
                                                            src="{{ asset('app-assets/images/logo/Logo-main.png') }}"
                                                            alt="">NullzFilling</h2>
                                                </div>
                                            </div>
                                            <h3 style='margin:0;color:white;'> Passwort vergessen? </h3>
                                            <p class="login-para">
                                                Melde dich bitte mit deinem Telegram Konto, dass du bei der
                                                Registrierung angegeben hast, bei
                                                @NULLZFINLLING</p>
                                                {{-- <form method="POST" action="{{ route('password.email') }}">
                                                    @csrf
                                                    <div class="form-label-group">
                                                        <label for="email">Benutzeremail</label>
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            @if (session('status'))
                                                                <span class="alert alert-success" role="alert">
                                                                    {{ session('status') }}
                                                                </span>
                                                            @endif
                                                        <div class="form-control-position">
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="submit-form">Schicken</button>
                                                </form>    --}}
                                                <div style='text-align:center;'><a href="{{ route('login') }}"><span
                                                        style='font-size:20px;'>
                                                        < Zuruck zum Login</a></div>
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

    <script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('assets/js/core/app.js') }}"></script>
    <script src="{{ asset('assets/js/scripts/components.js') }}"></script>

</body>

</html>
