@extends('admin.layouts.master')
@section('title')
    <title>Admin | User/create</title>
@endsection
@section('content')
<div class="content-header row"></div>
<div class="content-body">
    <div class="col-md-6 col-12 m-auto">
        <div class="card" style="height: auto;">
            <div class="card-header">
                <h4 class="card-title">New Account</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{url('user/account-detail')}}">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name</label>
                                        <input type="text" id="first-name-vertical" class="form-control" name="fname" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Email</label>
                                        <input type="email" id="email-id-vertical" class="form-control" name="email-id" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="password-vertical">Password</label>
                                        <input type="password" id="password-vertical" class="form-control" name="contact" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <fieldset class="checkbox">
                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                            <input type="checkbox">
                                            <span class="vs-checkbox">
                                                <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                </span>
                                            </span>
                                            <span class="">Disable incoming mails for chats</span>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Login</button>
                                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
