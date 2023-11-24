@extends('admin.layouts.master')
@section('title')
    <title>Create Account</title>
@endsection
@section('content')
<style>
    .invalid-feedback{
        color: rgb(199, 41, 41) !important;
    }
</style>
<div class="content-header row"></div>
<div class="content-body">
    <div class="col-md-6 col-12 m-auto">
        <div class="card" style="height: auto;">
            <div class="card-header">
                <h4 class="card-title">Create Account</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" method="post" action="{{ route('store.accounts') }}">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Input String</label>
                                        <textarea name="description" class="form-control  @error('description') is-invalid @enderror" rows="10" placeholder="Enter String"></textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>                                                               
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Create</button>
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