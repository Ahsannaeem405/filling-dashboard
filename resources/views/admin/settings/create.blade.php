@extends('admin.layouts.master')
@section('title')
    <title>Setting</title>
@endsection
@section('content')
<div class="content-header row"></div>
<div class="content-body">
    <div class="col-md-9 col-12 m-auto">
        <div class="card" style="height: auto;">
            <div class="card-header">
                <h4 class="card-title">Set Chat API Urls</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" method="post" action="{{ route('store.setting') }}" required>
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Access Token API Url</label>
                                        <input type="text" name="accessToken_api" class="form-control" placeholder="Set Access Token API Url" value="{{ isset($setting) ? $setting->accessToken_api : '' }}" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Access Token Header</label>
                                        <input type="text" name="accessToken_header_api" class="form-control" placeholder="Set Access Token Header" value="{{ isset($setting) ? $setting->accessToken_header_api : '' }}" required>
                                    </div>
                                </div>
                                                               
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Get Users API Url</label>
                                        <input type="text" name="getUser_api" class="form-control" placeholder="Set Get Users API Url" value="{{ isset($setting) ? $setting->getUser_api : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Get Users Header</label>
                                        <input type="text" name="getUser_header_api" class="form-control" placeholder="Set Get Users Header" value="{{ isset($setting) ? $setting->getUser_header_api : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Get User Conversation API Url</label>
                                        <input type="text" name="getUserConv_api" class="form-control" placeholder="Set Get_User Conversation API Url" value="{{ isset($setting) ? $setting->getUserConv_api : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Get User Conversation Messages API Url</label>
                                        <input type="text" name="getUserConvMsg_api" class="form-control" placeholder="Set Get_User Conversation Messages API Url" value="{{ isset($setting) ? $setting->getUserConvMsg_api : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Get User Conversation Images API Url</label>
                                        <input disabled type="text" name="getUserConvImage_api" class="form-control" placeholder="Set Get_User Conversation Images API Url" value="{{ isset($setting) ? $setting->getUserConvImg_api : '' }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Get User Conversation Images Header</label>
                                        <input type="text" name="image_header_api" class="form-control" placeholder="Set Get_User Conversation Images Header" value="{{ isset($setting) ? $setting->image_header_api : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Post Messages API Url</label>
                                        <input type="text" name="postMsg_api" class="form-control" placeholder="Set Post Messages API Url" value="{{ isset($setting) ? $setting->postMsg_api : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Delete Conversation API Url</label>
                                        <input type="text" name="delete_api" class="form-control" placeholder="Set Delete Conversation Messages API Url" value="{{ isset($setting) ? $setting->delete_api : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Set</button>
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