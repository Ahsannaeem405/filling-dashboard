@extends('admin.layouts.master')
@section('title')
    <title>Admin</title>
@endsection
@section('content')
<style>

    .datatable-wraper {
    background: #0c0d15bd;
    padding: 20px;
    border-radius: 10px;
    margin-top: 30px;
    color: white;
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
    .user-card-wraper{
        background: #0c0d15bd;
        border-radius:10px;
        padding:20px;
    }
    .card-main-content{

      display:flex;
      justify-content:space-between;
    }
    .card-main-content p{
      color:white;
      margin-bottom:10px;
    }
    .card-main-content h2{
      color:white;
      margin:0px;
    }
.line-div{
    border-right:1px solid;
}
.icon-side span {
      padding: 10px 10px 5px;
    border-radius: 5px;
    display:inline-block;
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
.icon-side span .bxs-user:before{
    font-size: 25px;
    color:#bdbdbdd6;
}
.icon-side span .bxs-user-plus:before{
    font-size: 25px;
    color:#bdbdbdd6;
}
.icon-side span .bx-user-check:before {
    font-size: 25px;
    color:#bdbdbdd6;
}
.bx-dots-vertical:before {
    content: "\ea0f";
    color: white;
}
select.status-selection {
    background: #0c0d15bd;
    color: white;
    padding: 10px 5px;
    width: 300px;
    margin-bottom: 50px;
}
option{
  background-color:#0c0d15bd !important;
}
table.dataTable thead .sorting:after{
  content:'\e842' !important;
  right: 0 !important;
  left:unset !important;
}
table.dataTable thead .sorting:before{
  content:'\e845' !important;
  right: 0 !important;
    top: 10px !important;
    left:unset !important;
    padding-right: 0 !important;
}
div.dataTables_wrapper {
    border-top: 1px solid rgba(34, 41, 47, 1);
}
table#example {
    border-top: 1px solid rgba(34, 41, 47, 1);
}
table.dataTable th, table.dataTable td {
    border-bottom: 1px solid rgba(34, 41, 47, 1) !important;
}
div#example_length {
    margin-bottom: 17px;
}
a.paginate_button.current {
    background: #7367f0 !important;
}
a.paginate_button {
    background: #3535359c !important;
    border-radius:5px;
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
.icon-tr1{
    background-color: #d3d3d37d;
}
.icon-tr2{
   background-color: #37cbbd59;
}
.icon-tr2 .fa-ticket:before {
    color: #37cbc6;
}
</style>
    <div class="content-header row"></div>
    <div class="content-body">
      <div class="user-card-wraper">
        <div class="row">
          <div class="col-md-6 col-lg-3">
            <div class="card-main-content">
              <div class="content-side">
                <p>Register User</p>
                <h2>21449</h2>
              </div>
              <div class="icon-side">
              <span class='span1'><i class="bx bxs-user"></i></span>
              </div>
              <div class="line-div"></div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card-main-content">
              <div class="content-side">
                <p>Register User</p>
                <h2>21449</h2>
              </div>
              <div class="icon-side">
              <span class='span2'><i class="bx bxs-user-plus"></i></span>
              </div>
              <div class="line-div"></div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card-main-content">
              <div class="content-side">
                <p>Register User</p>
                <h2>21449</h2>
              </div>
              <div class="icon-side">
              <span class='span3'><i class="bx bx-user-check"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
<div class="datatable-wraper">
  <div>
    <h3>Suchfilter</h3>
    <select class='status-selection'>
  <option selected>Select Status</option>
  <option value="1">Active</option>
  <option value="2">pending</option>
</select>
  </div>
<table id="example" class="display nowrap" style="width:100%">
<thead>
          <tr>
          <th>#ID</th>
          <th><i class="fa fa-ticket"></i></th>
            <th>CLIENT</th>
            <th>TOTAL</th>
            <th>ISSUED DATE</th>
            <th>BALANCE</th>
            <th>ACTIONS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
                #5059
            </td>
            <td>
                <span class='table-icon icon-tr1'>
                <i class="fa fa-ticket"></i>
                </span>
            </td>
            <td>
              <a href="#">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-blue mr-3">EB</div>

                  <div class="">
                    <p class="font-weight-bold mb-0">Ethan Black</p>
                    <p class="text-muted mb-0">ethan-black@example.com</p>
                  </div>
                </div>
              </a>
            </td>
            <td>3077$</td>
            <td>09 May 2020</td>
            <td>
            <div class="badge badge-success badge-success-alt" style='background-color: #1d5541; color: #00ab00;'>Paid</div>
            </td>
            <td>
            <i class="bx bxs-envelope mr-1"></i>
            <!-- <i class="bx bxs-eye"></i> -->
            <i class="fa fa-eye"></i>
              <div class="dropdown" style='display:inline-block'>
                <button class="btn btn-sm btn-icon" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical" data-toggle="tooltip" data-placement="top"
                        title="Actions"></i>
                    </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <a class="dropdown-item" href="#"> Edit Profile</a>
                  <a class="dropdown-item text-danger" href="#"> Remove</a>
                </div>
              </div>
            </td>
          </tr>
          <tr>
            <td>
                #5059
            </td>
            <td>
                <span class='table-icon icon-tr2'>
                <i class="fa fa-ticket"></i>
                </span>
            </td>
            <td>
              <a href="#">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-blue mr-3">EB</div>

                  <div class="">
                    <p class="font-weight-bold mb-0">Ethan Black</p>
                    <p class="text-muted mb-0">ethan-black@example.com</p>
                  </div>
                </div>
              </a>
            </td>
            <td>3077$</td>
            <td>09 May 2020</td>
            <td>
            <div class="badge badge-success badge-success-alt" style='background-color: #1d5541; color: #00ab00;'>Paid</div>
            </td>
            <td>
            <i class="bx bxs-envelope mr-1"></i>
            <!-- <i class="bx bxs-eye"></i> -->
            <i class="fa fa-eye"></i>
              <div class="dropdown" style='display:inline-block'>
                <button class="btn btn-sm btn-icon" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical" data-toggle="tooltip" data-placement="top"
                        title="Actions"></i>
                    </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <a class="dropdown-item" href="#"> Edit Profile</a>
                  <a class="dropdown-item text-danger" href="#"> Remove</a>
                </div>
              </div>
            </td>
          </tr>

        </tbody>
      </table>


    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src='https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js'></script>
    <script>
        new DataTable('#example', {
          language: {
            searchPlaceholder: 'search...'
        },


        });
    </script>
</div>
    </div>
@endsection
