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
                    <form class="form form-vertical" method="post" action="{{ route('store.setting') }}">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Access Token API Url</label>
                                        <input type="text" name="accessToken_api" class="form-control" placeholder="Set Access Token API Url" value="{{ isset($setting) ? $setting->accessToken_api : '' }}">
                                    </div>
                                </div>
                                                               
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Get Users API Url</label>
                                        <input type="text" name="getUser_api" class="form-control" placeholder="Set Get Users API Url" value="{{ isset($setting) ? $setting->getUser_api : '' }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Get User Conversation API Url</label>
                                        <input type="text" name="getUserConv_api" class="form-control" placeholder="Set Get User Conversation API Url" value="{{ isset($setting) ? $setting->getUserConv_api : '' }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Get User Conversation Messages API Url</label>
                                        <input type="text" name="getUserConvMsg_api" class="form-control" placeholder="Set Get User Conversation Messages API Url" value="{{ isset($setting) ? $setting->getUserConvMsg_api : '' }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Post Messages API Url</label>
                                        <input type="text" name="postMsg_api" class="form-control" placeholder="Set Post Messages API Url" value="{{ isset($setting) ? $setting->postMsg_api : '' }}">
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