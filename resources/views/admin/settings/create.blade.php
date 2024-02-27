{{-- <form class="form form-vertical" method="post" action="{{ route('store.setting') }}" required>
    @csrf
        <div class="d-flex">
                    <div class="col-md-6">
                        <div class="card" style="height: auto;">
                            <div class="card-header">
                                <h4 class="card-title">Access Token</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="text" name="accessToken_api" class="form-control"
                                                        placeholder="Access Token API Url"
                                                        value="{{ isset($setting) ? $setting->accessToken_api : '' }}" required>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <textarea name="accessToken_header_api" class="form-control" rows="5" placeholder="Access Token Header" required>{{ isset($setting) ? $setting->accessToken_header_api : '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card" style="height: auto;">
                            <div class="card-header">
                                <h4 class="card-title">User Detail</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="text" name="getUser_api" class="form-control"
                                                        placeholder="Get Users API Url"
                                                        value="{{ isset($setting) ? $setting->getUser_api : '' }}" required>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <textarea name="getUser_header_api" class="form-control" rows="5" placeholder="Get Users Header" required>{{ isset($setting) ? $setting->getUser_header_api : '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-12 m-auto">
                    <div class="card" style="height: auto;">
                        <div class="card-header">
                            <h4 class="card-title">Conversations</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="text" name="getUserConv_api" class="form-control"
                                                        placeholder="Get User MessageBox API Url"
                                                        value="{{ isset($setting) ? $setting->getUserConv_api : '' }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="text" name="getUserConvMsg_api" class="form-control"
                                                        placeholder="Get User Conversation Messages API Url"
                                                        value="{{ isset($setting) ? $setting->getUserConvMsg_api : '' }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input disabled type="text" name="getUserConvImage_api" class="form-control"
                                                        placeholder="Get User Conversation Images API Url"
                                                        value="{{ isset($setting) ? $setting->getUserConvImg_api : '' }}">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="text" name="postMsg_api" class="form-control"
                                                        placeholder="Post Messages API Url"
                                                        value="{{ isset($setting) ? $setting->postMsg_api : '' }}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input type="text" name="delete_api" class="form-control"
                                                        placeholder="Delete Conversation API Url"
                                                        value="{{ isset($setting) ? $setting->delete_api : '' }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <textarea name="image_header_api" id="" class="form-control mt-2" rows="7"
                                                        placeholder="Get User Conversation Images Header" required>{{ isset($setting) ? $setting->image_header_api : '' }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mt-2">
                                            <button type="submit"
                                                class="btn btn-primary ml-1 mb-1 waves-effect waves-light">Set</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</form> --}}

@extends('admin.layouts.master')
@section('title')
    <title>Setting</title>
@endsection
@section('content')
    <style>
        .form-group {
            margin-bottom: 8px !important;
        }
    </style>
    <div class="content-header row"></div>
    <form id="myform" class="form form-vertical" method="post" action="{{ route('store.setting') }}" required>
        @csrf
        <div class="d-flex">
            <div class="col-md-12">
                <div class="card" style="height: auto;">
                    <div class="card-header">
                        <h4 class="card-title">Create Host</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5>Recieve Messages email configuration</h5>
                                        <div class="form-group">
                                            <input type="text" name="get_host" class="form-control mb-1"
                                                placeholder="Reciever Host" value="" required>
                                            <input type="text" name="get_port" class="form-control mb-1"
                                                placeholder="Reciever Port" value="" required>
                                            <input type="text" name="get_encryption" class="form-control mb-1"
                                                placeholder="Reciever Encryption" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5>Send Messages email configuration</h5>
                                        <div class="form-group">
                                            <input type="text" name="smtp_host" class="form-control mb-1"
                                                placeholder="Smtp Host" value="" required>
                                            <input type="text" name="smtp_port" class="form-control mb-1"
                                                placeholder="Smtp Port" value="" required>
                                            <input type="text" name="smtp_encryption" class="form-control mb-1"
                                                placeholder="Smtp Encryption" value="" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" name="host" class="form-control mb-1"
                                                placeholder="Host" value="" required>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary ml-1 mb-1 waves-effect waves-light">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
@endsection
