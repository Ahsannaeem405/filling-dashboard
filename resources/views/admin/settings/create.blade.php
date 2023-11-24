@extends('admin.layouts.master')
@section('title')
    <title>Setting</title>
@endsection
@section('content')
<div class="content-header row"></div>
<div class="content-body">
    <div class="col-md-6 col-12 m-auto">
        <div class="card" style="height: auto;">
            <div class="card-header">
                <h4 class="card-title">Set Chat API Url</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" method="post" action="{{ route('store.setting') }}">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Site Url</label>
                                        <input type="text" name="url" class="form-control" value="{{ isset($setting) ? $setting->site_url : '' }}">
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