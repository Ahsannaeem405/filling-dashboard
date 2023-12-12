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
                    <h4 class="card-title">Update Status</h4>
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
                                                        Ausgezahlt
                                                    </label>
                                                </div>
                                                <div class="form-check mr-3">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="reject" value="reject"
                                                        {{ old('status', $payment->status) === 'reject' ? 'checked' : '' }}
                                                        style="cursor: pointer">
                                                    <label class="form-check-label" for="reject">
                                                        Abgelehnt
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        id="pending" value="pending"
                                                        {{ old('status', $payment->status) === 'pending' ? 'checked' : '' }}
                                                        style="cursor: pointer">
                                                    <label class="form-check-label" for="pending">
                                                        Ausstehend
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12" id="pendingField" style="display: none;">
                                        <div class="form-group">
                                            <label>Reason for Ausstehend</label>
                                            <input type="text" name="pendingReason" class="form-control" value="{{ old('pendingReason', ($payment->status === 'pending') ? $payment->reason : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-12" id="rejectField" style="display: none;">
                                        <div class="form-group">
                                            <label>Reason for Abgelehnt</label>
                                            <input type="text" name="rejectReason" class="form-control" value="{{ old('rejectReason', ($payment->status === 'reject') ? $payment->reason : '') }}">
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
    <script>
        $(document).ready(function () {
                var val = $('input[name="status"]:checked').val();
                if (val === 'pending') {
                    $('#rejectField').hide();
                    $('#pendingField').show();
                } else if (val === 'reject') {
                    $('#pendingField').hide();
                    $('#rejectField').show();
                }else{
                    $('#rejectField').hide();
                    $('#pendingField').hide();  
                }
            $('input[name="status"]').change(function () {
                if ($(this).val() === 'pending') {
                    $('#rejectField').hide();
                    $('#pendingField').show();
                } else if ($(this).val() === 'reject') {
                    $('#pendingField').hide();
                    $('#rejectField').show();
                }else{
                    $('#rejectField').hide();
                    $('#pendingField').hide();  
                }
            });
        });
    </script>
@endsection
