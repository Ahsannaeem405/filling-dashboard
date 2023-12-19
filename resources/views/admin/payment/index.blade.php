@extends('admin.layouts.master')
@section('title')
    <title>Payment</title>
@endsection
@section('payment')
    active
@endsection
@section('content')
    <style>
        .datatable-wraper {
            background: #10163a;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        table.dataTable thead tr {
            background-color: transparent;
        }

        label {
            color: white;
        }

        table.dataTable {
            border: none;
        }

        .dataTables_length select {
            border: 1px solid white;
            padding: 4px 3px !important;
            color: white;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #aaa;
            border-radius: 3px;
            padding: 5px;
            background-color: transparent;
            color: inherit;
            margin-left: 3px;
            outline: none;
        }

        .badge-success-alt {
            background-color: #d7f2c2;
            color: #7bd235;
        }

        .table a {
            color: #212529;
        }

        .btn-icon {
            padding: 0;
        }

        .avatar {
            width: 2.75rem;
            height: 2.75rem;
            line-height: 3rem;
            border-radius: 50%;
            display: inline-block;
            background: transparent;
            position: relative;
            text-align: center;
            color: #868e96;
            font-weight: 700;
            vertical-align: bottom;
            font-size: 1rem;
            margin-right: 10px !important;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .avatar-sm {
            width: 2.5rem;
            height: 2.5rem;
            font-size: 0.83333rem;
            line-height: 1.5;
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .btn {
            font-size: 0.9375rem;
            font-weight: 500;
            padding: 0.5rem 0.75rem;
        }

        .avatar-blue {
            background-color: #2a456a !important;
            color: #467fcf;
        }

        .avatar-pink {
            background-color: #fcd3e1;
            color: #f66d9b;
        }

        table.dataTable td {
            font-size: 12px !important;
        }

        .badge.badge-success.badge-success-alt {
            font-size: 12px;
        }

        /*  */
        .user-card-wraper {
            background: #10163a;
            border-radius: 10px;
            padding: 20px;
        }

        .card-main-content {

            display: flex;
            justify-content: space-between;
        }

        .card-main-content p {
            color: white;
            margin-bottom: 10px;
        }

        .card-main-content h2 {
            color: white;
            margin: 0px;
        }

        .line-div {
            border-right: 1px solid;
        }

        .icon-side span {
            padding: 7px 10px 5px;
            border-radius: 5px;
            display: inline-block;
        }

        .icon-side .span1 {
            background-color: #ffffff30;
        }

        .icon-side .span2 {
            background-color: #ffffff30;
        }

        .icon-side .span3 {
            background-color: #ffffff30;
        }

        .icon-side span .bxs-file:before {
            font-size: 25px;
            color: #bdbdbdd6;
        }

        .icon-side span .bxs-user-plus:before {
            font-size: 25px;
            color: #bdbdbdd6;
        }

        .icon-side span img {
            width: 27px;
        }

        .icon-side span .bx-user-check:before {
            font-size: 25px;
            color: #bdbdbdd6;
        }

        .bx-dots-vertical:before {
            content: "\ea0f";
            color: white;
        }

        select.status-selection {
            background: #10163a;
            color: white;
            padding: 7px 5px;
            border-radius: 4px;
            font-size: 11px;
            width: 100%;
        }

        option {
            background-color: #10163a !important;
        }

        table.dataTable thead .sorting:after {
            content: '\e842' !important;
            /* right: 0 !important;
                          left:unset !important; */
            left: -2px !important;
        }

        table.dataTable thead .sorting:before {
            content: '\e845' !important;
            /* right: 0 !important; */
            top: 10px !important;
            /* left:unset !important; */
            left: -2px !important;
            padding-right: 0 !important;
        }

        div.dataTables_wrapper {
            border-top: 1px solid rgba(34, 41, 47, 1);
        }

        table#example {
            border-top: 1px solid rgba(34, 41, 47, 1);
        }

        table.dataTable th,
        table.dataTable td {
            border-bottom: 1px solid rgba(34, 41, 47, 1) !important;
        }

        div#example_length {
            margin-bottom: 17px;
            width: 45%;
        }

        div#example_filter {
            margin-bottom: 17px;
        }

        a.paginate_button.current {
            background: #7367f0 !important;
        }

        a.paginate_button {
            background: #20295d !important;
            border-radius: 5px;
        }

        span.table-icon {
            display: inline-block;
            width: 25px;
            border-radius: 100px;
            display: flex;
            height: 25px;
            align-items: center;
            justify-content: center;
        }

        .icon-tr1 {
            background-color: #d3d3d37d;
        }

        .icon-tr2 {
            background-color: #37cbbd59;
        }

        .icon-tr2 .fa-ticket:before {
            color: #37cbc6;
        }

        /*  */
        .top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .dt-buttons {
            visibility: hidden;
        }

        .status-select {
            position: absolute;
            right: 80px;
            top: 34px;
            z-index: 9;
        }

        .dt-button {
            border-radius: 5px !important;
        }

        .bottom {
            margin-top: 10px;
        }

        th.sorting:before {
            margin-left: -10px !important
        }

        th.sorting:after {
            margin-left: -10px !important
        }

        .custom-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        .line-div3 {
            visibility: hidden;
        }

        @media screen and (max-device-width:300px),
        screen and (max-width:768px) {
            .line-div {
                display: none;
            }

            .top {
                display: grid;
                justify-items: start;
            }
        }

        @media screen and (max-device-width:768),
        screen and (max-width:991px) {
            .card-main-content {
                margin-bottom: 12px;
            }

            .status-select {
                right: 40px;
            }
        }
    </style>
    <div class="content-header row"></div>
    <div class="content-body">
        <div class="user-card-wraper">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="card-main-content">
                        <div class="content-side">
                            <h3>{{ $count }}</h3>
                            <p>Payments</p>

                        </div>
                        <div class="icon-side">
                            <span class='span1'><i class="bx bxs-file"></i></span>
                        </div>
                        <div class="line-div"></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card-main-content">
                        <div class="content-side">
                            <h3>{{ $paidAmount }}€</h3>
                            <p>Ausgezahlt</p>

                        </div>
                        <div class="icon-side">
                            <span class='span2'>
                                <img src="{{ asset('app-assets/images/logo/double.png') }}" alt="">
                            </span>
                        </div>
                        <div class="line-div"></div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card-main-content">
                        <div class="content-side">
                            <h3>{{ $unpaidAmount }}€</h3>
                            <p>Ausstehend</p>

                        </div>
                        <div class="icon-side">
                            <span class='span3'>
                                <img src="{{ asset('app-assets/images/logo/unavailable.png') }}" alt="">
                            </span>
                        </div>
                        <div class="line-div line-div3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="datatable-wraper">
            <div class='status-select'>
                <select class='status-selection' id="statusFilter">
                    <option selected>Select Status</option>
                    <option value="paid">Ausgezahlt</option>
                    <option value="reject">Abgelehnt</option>
                    <option value="pending">Ausstehend</option>
                </select>
            </div>
            <table id="example" class="table data-list-view dataTable no-footer dt-checkboxes-select" style="width:100%">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th><img style='width: 22px;' src="{{ asset('app-assets/images/logo/growth.svg') }}" alt="">
                        </th>
                        <th>CLIENT</th>
                        <th>TOTAL</th>
                        <th>ISSUED DATE</th>
                        <th>Payment Type</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payment as $payment)
                        <tr class="user-row" data-status="{{ strtolower($payment->status) }}">
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <span class='table-icon icon-tr1'>
                                    <img style='width: 19px;' src="{{ asset('app-assets/images/logo/ta-tick.png') }}"
                                        alt="">
                                </span>
                            </td>
                            <td>
                                <a href="#">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-blue mr-3">{{ substr($payment->client_name, 0, 1) }}</div>

                                        <div class="">
                                            <p class="font-weight-bold mb-0">{{ $payment->client_name }}</p>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td>{{ $payment->price }}€</td>
                            <td>{{ $payment->created_at->format('d M Y H:s') }}</td>
                            <td>{{ ucfirst($payment->payment_method) }}</td>
                            <td>
                                @if ($payment->status)
                                    <div class="badge badge-success badge-success-alt"
                                        style='@if ($payment->status === 'paid') background-color: #1d5541; color: #00ab00; 
                                            @elseif($payment->status === 'reject') background-color: #a72727; color: #f3aaaa;
                                            @elseif($payment->status === 'pending') background-color: #4c3918; color: #aab190; @endif'>
                                        @if ($payment->status === 'paid')
                                            Ausgezahlt
                                        @elseif($payment->status === 'reject')
                                            Abgelehnt
                                        @elseif($payment->status === 'pending')
                                            Ausstehend
                                        @endif
                                    </div>
                                @else
                                    <div class="badge badge-success badge-success-alt"
                                        style='background-color: #093e3c; color: #668f95;'>waiting for approval</div>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('chat.view', ['id' => $payment->id]) }}" style="color: white"><i
                                        class="bx bxs-envelope mr-1"></i></a>
                                <a class="open-modal-btn" id="{{ $payment->id }}" style="color: white" data-toggle="modal"
                                    data-target="#customModal">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <div class="dropdown" style='display:inline-block'>
                                    <button class="btn btn-sm btn-icon" type="button" id="dropdownMenuButton2"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical" data-toggle="tooltip" data-placement="top"
                                            title="Actions"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <a class="dropdown-item"
                                            href="{{ route('edit.payment', ['id' => $payment->id]) }}">
                                            Edit Status</a>
                                        <a class="dropdown-item text-danger" onclick="deleteAccount({{ $payment->id }})">
                                            Remove</a>
                                    </div>
                                    <form id="delete-form-{{ $payment->id }}"
                                        action="{{ route('delete.payment', ['id' => $payment->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
            <script src='https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js'></script>
            <script src='https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js'></script>
            <script>
                new DataTable('#example', {
                    dom: '<"top"lfB>rt<"bottom"ip><"clear">',
                    buttons: [{
                        extend: 'collection',
                        text: 'Export',
                        buttons: [
                            'copy',
                            'excel',
                            'csv',
                            'pdf',
                        ]
                    }],
                    language: {
                        searchPlaceholder: 'Search Invoice'
                    },
                    columnDefs: [{
                        targets: [0],
                        orderable: false
                    }],
                    order: []
                });
            </script>
            <script>
                $(document).ready(function() {
                    $('#statusFilter').change(function() {
                        var selectedStatus = $(this).val().toLowerCase();

                        $('.user-row').hide();

                        if (selectedStatus === 'select status') {
                            $('.user-row').show();
                        } else {
                            $('.user-row[data-status="' + selectedStatus + '"]').show();
                        }
                    });
                });
            </script>
        </div>

        <div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="customModalLabel">Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="top:10px; right:20px">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $('.open-modal-btn').on('click', function() {
                var id = $(this).attr('id');
                $.ajax({
                    url: "{{ route('payment.view') }}",
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $('.modal-body').empty().append(response.component);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
                $('#customModal').modal('show');
            });
        });
    </script>
@endsection
