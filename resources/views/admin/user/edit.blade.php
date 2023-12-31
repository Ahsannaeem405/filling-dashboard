@extends('admin.layouts.master')
@section('title')
    <title>Edit User</title>
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
                                        <input type="text" id="first-name-vertical" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$user->name) }}" name="name" placeholder="First Name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror    
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="telegram-id-vertical">Telegram</label>
                                        <input type="text" id="telegram-id-vertical" class="form-control @error('telegram') is-invalid @enderror" value="{{ old('telegram',$user->telegram) }}" name="telegram" placeholder="Telegram">
                                        @error('telegram')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="limit">Account Limit</label>
                                        <input type="text" min="0" maxlength="3" pattern="[0-9]{1,3}" id="limit" class="form-control @error('limit') is-invalid @enderror" value="{{ old('limit',$user->limit) }}" name="limit" placeholder="Set accounts limit in number">
                                        @error('limit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="rank">Set Rank</label>
                                        <select id="rank" name="rank" class="form-control @error('rank') is-invalid @enderror">
                                            <option value="beginner" @if(old('rank',$user->rank) === 'beginner') selected @endif>Beginner</option>
                                            <option value="advanced" @if(old('rank',$user->rank) === 'advanced') selected @endif>Advanced</option>
                                            <option value="pro" @if(old('rank',$user->rank) === 'pro') selected @endif>Pro</option>
                                            <option value="legend" @if(old('rank',$user->rank) === 'legend') selected @endif>Legend</option>
                                            <option value="vip" @if(old('rank',$user->rank) === 'vip') selected @endif>Vip</option>
                                        </select>
                                        {{-- <input type="text" min="0"  id="rank" class="form-control @error('rank') is-invalid @enderror" value="{{ old('rank',$user->rank) }}" name="rank" placeholder="Rank of user"> --}}
                                        @error('rank')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label>Status</label>
                                    <div class="form-group d-flex">
                                        <div class="form-check mr-3">
                                            <input class="form-check-input" type="radio" name="status" id="active" value="active" {{ old('status', $user->status) === 'active' ? 'checked' : '' }} style="cursor: pointer">
                                            <label class="form-check-label" for="active">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="inactive" value="in-active" {{ old('status', $user->status) === 'in-active' ? 'checked' : '' }} style="cursor: pointer">
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