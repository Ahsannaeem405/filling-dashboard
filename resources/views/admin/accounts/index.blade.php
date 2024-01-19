@extends('admin.layouts.master')
@section('title')
    <title>Account</title>
@endsection
@section('content')
    <style>
        .datatable-wraper {
            background: #10163a;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
            color: white;
            border: 1px solid #10163a;
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
            background-color: #c8d9f1;
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
        .card-main-content {
            background: #10163a;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            border-radius: 10px;
        }

        .avatar-blue {
            background-color: #c8d9f1;
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
        .card-main-content {
            background: #10163a;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            border-radius: 10px;

        }

        .card-main-content p {
            color: white;
            margin-bottom: 10px;
        }

        .card-main-content h2 {
            color: white;
            margin: 0px;
        }

        .icon-side span {
            padding: 10px 10px 5px;
            border-radius: 5px;
            display: inline-block;
        }

        .icon-side .span1 {
            background-color: #7367f052;
            color: #7367f0;
        }

        .icon-side .span2 {
            background-color: #84684dcc;
        }

        .icon-side .span3 {
            background-color: #1d5541;
        }

        .icon-side .span4 {
            background: #ea545566;
            padding: 6px;
        }

        .icon-side span .bxs-user:before {
            font-size: 25px;
            color: #7f73ffd6;
        }

        .icon-side .span4 .bxs-user:before {
            font-size: 25px;
            color: #ea5455;
        }

        .icon-side span .bxs-user-plus:before {
            font-size: 25px;
            color: #FF9F43;
        }

        .icon-side span .bx-user-check:before {
            font-size: 25px;
            color: #00ab00;
        }

        .bx-dots-vertical:before {
            content: "\ea0f";
            color: white;
        }

        select.status-selection {
            background: #10163a;
            color: white;
            padding: 10px 5px;
            width: 300px;
            margin-bottom: 50px;
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
            margin-bottom: 15px;
            width: 50%;
        }

        div#example_filter {
            margin-bottom: 15px;
        }

        a.paginate_button.current {
            background: #7367f0 !important;
        }

        a.paginate_button {
            background: #20295d !important;
            border-radius: 5px;
        }

        /*  */
        .top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        body.dark-layout .dataTables_wrapper .dt-buttons .buttons-copy,
        body.dark-layout .dataTables_wrapper .dt-buttons .buttons-excel {
            background-color: transparent !important;
        }

        .table-plus-btn {
            background: #7367f0 !important;
            font-weight: 600;
        }
        .file{
            background: green !important;
            font-weight: 600;
        }
        .dt-button span{
            color: white !important;
        }
        .icons{
            color: white;
            font-size: 16px;
            margin: 5px;
        }
        .dt-button{
            border-radius: 5px !important;
        }
        .bottom{
            margin-top: 10px;
        }
        th.sorting:before{
            margin-left: -10px !important
        }
        th.sorting:after{
            margin-left: -10px !important
        }
    </style>
    <div class="content-header row"></div>
    <div class="datatable-wraper">
        <h1 class="mb-2">Accounts List</h1>
        <table id="example" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Mail</th>
                    <th>User ID</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accounts as $account)
                <tr>
                    <td>
                        <a href="#">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-blue mr-3">{!! strtoupper(substr($account->description,0,2))  !!}
                                </div>
                                <div class="">
                                    <?php
                                        $string = $account->description;
                                        $parts = explode(':', $string);
                                        $email = $parts[0]; 
                                    ?>
                                    <p class="font-weight-bold mb-0">{{ substr($email,0,30) }}</p>
                                </div>
                            </div>
                        </a>
                    </td>
                    <td>{{ $account->account_id }}</td>
                    <td>
                        <a class="icons" style="color: white" href="{{ route('edit.accounts', ['id' => $account->id]) }}"><i class="bx bxs-edit"> </i></a>
                        <a class="icons"><i class="bx bxs-trash" onclick="deleteAccount({{ $account->id }})"></i></a> 
                        <form id="delete-form-{{ $account->id }}"
                            action="{{ route('delete.accounts', ['id' => $account->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form id="importForm" method="post" action="{{ route('import.accounts') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" id="fileInput" name="file" accept=".txt" style="display:none;">
        </form>

        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src='https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js'></script>
        <script src='https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js'></script>
        <script>
            new DataTable('#example', {
                dom: '<"top"lfB>rt<"bottom"ip><"clear">',
                buttons: [{
                        text: '+ Create Account',
                        className: 'table-plus-btn',
                        action: function(e, dt, button, config) {
                            window.location.href = '{{ route("create.accounts") }}';
                        }
                    },
                    {
                        text: '+ Import Account',
                        className: 'file',
                        action: function(e, dt, button, config) {
                            
                        }
                    },
                ],
                language: {
                    searchPlaceholder: 'search...'
                },
                columnDefs: [
                    { targets: [0], orderable: false } 
                ],
                order: []
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function () {
              $(".file").on("click", function () {
                $("#fileInput").click();
              });
          
              $("#fileInput").on("change", function () {
                $("#importForm").submit();
              });
            });
          </script>
    </div>
@endsection
