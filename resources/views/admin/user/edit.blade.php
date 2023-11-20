@extends('admin.layouts.master')
@section('title')
    <title>Edit User</title>
@endsection
@section('content')
<div class="content-header row"></div>
<div class="content-body">
    <div class="col-md-6 col-12 m-auto">
        <div class="card" style="height: auto;">
            <div class="card-header">
                <h4 class="card-title">Edit User Account</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-vertical" method="post" action="{{ route('update',['id' => $user->id]) }}">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Name</label>
                                        <input type="text" id="first-name-vertical" class="form-control" value="{{ old('name',$user->name) }}" name="name" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Email</label>
                                        <input type="email" id="email-id-vertical" class="form-control" value="{{ old('email',$user->email) }}" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label>Status</label>
                                    <div class="form-group d-flex">
                                        <div class="form-check mr-3">
                                            <input class="form-check-input" type="radio" name="status" id="active" value="active" {{ old('status', $user->status) === 'active' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="active">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="inactive" value="in-active" {{ old('status', $user->status) === 'in-active' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inactive">
                                                In-Active
                                            </label>
                                        </div>
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