@extends('admin.layouts.master')
@section('title')
    <title>Profile</title>
@endsection
@section('content')
<style>
    span.fa.fa-fw.field-icon.toggle-password.fa-eye {
        float: right;
        margin-top: -28px;
        margin-right: 18px;
    }
    span.fa.fa-fw.field-icon.toggle-password.fa-eye-slash {
        float: right;
        margin-top: -28px;
        margin-right: 18px;
    }
    .invalid-feedback{
        color: rgb(199, 41, 41) !important;
    }
</style>
<div class="content-header row"></div>
<div class="content-body">
    <div class="col-md-6 col-12 m-auto">
        <div class="card" style="height: auto;">
            <div class="card-header">
                <h4 class="card-title">Edit Profile</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" action="{{ route('update.profile')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name</label>
                                        <input type="text" id="first-name-vertical" class="form-control" value="{{ $user->name }}" name="name" required placeholder="Enter Your Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Email</label>
                                        <input type="email" id="email-id-vertical" class="form-control" value="{{ $user->email }}" name="email" required placeholder="Enter Your Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="password">Old Password</label>
                                        <input id="oldpassword" type="password" class="form-control @error('oldpassword') is-invalid @enderror" name="oldpassword" autocomplete="new-password" >
                                        <span toggle="#oldpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        @error('oldpassword')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="new-password">New Password</label>
                                        <input id="newpassword" type="password" class="form-control @error('newpassword') is-invalid @enderror" name="newpassword" autocomplete="new-password">
                                        <span toggle="#newpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        @error('newpassword')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="newpassword_confirmation">Confirm Password</label>
                                        <input id="newpassword_confirmation" type="password" class="form-control @error('newpassword_confirmation') is-invalid @enderror" name="newpassword_confirmation" autocomplete="new-password">
                                        <span toggle="#newpassword_confirmation" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        @error('newpassword_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="profile_image">Profile Image</label>
                                        <input type="file" id="profile_image"  name="profile_image" accept="image/*" onchange="showImagePreview()">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Update</button>
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
