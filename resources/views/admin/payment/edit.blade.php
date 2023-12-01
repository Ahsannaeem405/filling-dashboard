@extends('admin.layouts.master')
@section('title')
    <title>Edit Account</title>
@endsection
@section('content')
    <style>
        .invalid-feedback {
            color: rgb(199, 41, 41) !important;
        }
    </style>
    <div class="content-header row"></div>
    <div class="content-body">
        <div class="col-md-6 col-12 m-auto">
            <div class="card" style="height: auto;">
                <div class="card-header">
                    <h4 class="card-title">Edit Payment</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-vertical" method="post"
                            action="{{ route('update.payment', ['id' => $payment->id]) }}">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Update Status</label>
                                            <div class="form-group d-flex">
                                                <div class="form-check mr-3">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="paid" value="paid"
                                                        {{ old('status', $payment->status) === 'paid' ? 'checked' : '' }}
                                                        style="cursor: pointer">
                                                    <label class="form-check-label" for="paid">
                                                        Paid
                                                    </label>
                                                </div>
                                                <div class="form-check mr-3">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="unpaid" value="unpaid"
                                                        {{ old('status', $payment->status) === 'unpaid' ? 'checked' : '' }}
                                                        style="cursor: pointer">
                                                    <label class="form-check-label" for="unpaid">
                                                        Unpaid
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="pending" value="pending"
                                                        {{ old('status', $payment->status) === 'pending' ? 'checked' : '' }}
                                                        style="cursor: pointer">
                                                    <label class="form-check-label" for="pending">
                                                        Pending
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Update</button>
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
