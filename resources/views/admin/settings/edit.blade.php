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
    <form id="myform" class="form form-vertical" method="post" action="{{ route('update.host',['id' => $setting->id]) }}" required>
        @csrf
        <div class="d-flex">
            <div class="col-md-12">
                <div class="card" style="height: auto;">
                    <div class="card-header">
                        <h4 class="card-title">Edit Host</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h5>Recieve Messages email configuration</h5>
                                        <div class="form-group">
                                            <input type="text" name="get_host" class="form-control mb-1"
                                                placeholder="Reciever Host" value="{{ $setting->get_host }}" required>
                                            <input type="text" name="get_port" class="form-control mb-1"
                                                placeholder="Reciever Port" value="{{ $setting->get_port }}" required>
                                            <input type="text" name="get_encryption" class="form-control mb-1"
                                                placeholder="Reciever Encryption" value="{{ $setting->get_encryption }}" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5>Send Messages email configuration</h5>
                                        <div class="form-group">
                                            <input type="text" name="smtp_host" class="form-control mb-1"
                                                placeholder="Smtp Host" value="{{ $setting->smtp_host }}" required>
                                            <input type="text" name="smtp_port" class="form-control mb-1"
                                                placeholder="Smtp Port" value="{{ $setting->smtp_port }}" required>
                                            <input type="text" name="smtp_encryption" class="form-control mb-1"
                                                placeholder="Smtp Encryption" value="{{ $setting->smtp_encryption }}" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" name="host" class="form-control mb-1"
                                                placeholder="Host" value="{{ $setting->host }}" required>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary ml-1 mb-1 waves-effect waves-light">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
