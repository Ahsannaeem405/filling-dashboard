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

    /*  */
    .card-main-content{
      background: #0c0d15bd;
      padding:20px;
      display:flex;
      justify-content:space-between;
      border-radius:10px;

    }
    .card-main-content p{
      color:white;
      margin-bottom:10px;
    }
    .card-main-content h2{
      color:white;
      margin:0px;
    }
    .icon-side span {
      padding: 15px 10px 5px;
    background: #9a91fb;
    border-radius: 5px;
}
.icon-side span .bxs-user:before,
.icon-side span .bxs-user-plus:before,
.icon-side span .bx-user-check:before {
    font-size: 25px;
    color:#7f73ffd6;
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
              <span><i class="bx bxs-user"></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card-main-content">
              <div class="content-side">
                <p>Register User</p>
                <h2>21449</h2>
              </div>
              <div class="icon-side">
              <span><i class="bx bxs-user-plus"></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card-main-content">
              <div class="content-side">
                <p>Register User</p>
                <h2>21449</h2>
              </div>
              <div class="icon-side">
              <span><i class="bx bx-user-check"></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="card-main-content">
              <div class="content-side">
                <p>Register User</p>
                <h2>21449</h2>
              </div>
              <div class="icon-side">
              <span><i class="bx bxs-user"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
<div class="datatable-wraper">
  <div>
    <label for="">Suchfilter</label> <br>
    <select class='status-selection'>
  <option selected>Select Status</option>
  <option value="1">Active</option>
  <option value="2">pending</option>
</select>
  </div>
<table id="example" class="display nowrap" style="width:100%">
<thead>
          <tr>
            <th>USER</th>
            <th>RANG</th>
            <th>PRICE</th>
            <th>STATUS</th>
            <th>ACTIONS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
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
            <td>RPO</td>
            <td>3.541$</td>
            <td>
              <div class="badge badge-success badge-success-alt">active</div>
            </td>
            <td>
            <i class="bx bxs-edit mr-2"></i>
            <i class="bx bxs-trash mr-2"></i>
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
              <a href="#">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-pink mr-3">JR</div>

                  <div class="">
                    <p class="font-weight-bold mb-0">Julie Richards</p>
                    <p class="text-muted mb-0">julie_89@example.com</p>
                  </div>
                </div>
              </a>
            </td>
            <td>VIP</td>
            <td>2.054$</td>
            <td>
              <div class="badge badge-success badge-success-alt">active</div>
            </td>
            <td>
            <i class="bx bxs-edit mr-2"></i>
            <i class="bx bxs-trash mr-2"></i>
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
            <td>RPO</td>
            <td>3.541$</td>
            <td>
              <div class="badge badge-success badge-success-alt">active</div>
            </td>
            <td>
            <i class="bx bxs-edit mr-2"></i>
            <i class="bx bxs-trash mr-2"></i>
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
              <a href="#">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-pink mr-3">JR</div>

                  <div class="">
                    <p class="font-weight-bold mb-0">Julie Richards</p>
                    <p class="text-muted mb-0">julie_89@example.com</p>
                  </div>
                </div>
              </a>
            </td>
            <td>VIP</td>
            <td>2.054$</td>
            <td>
              <div class="badge badge-success badge-success-alt">active</div>
            </td>
            <td>
            <i class="bx bxs-edit mr-2"></i>
            <i class="bx bxs-trash mr-2"></i>
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
            <td>RPO</td>
            <td>3.541$</td>
            <td>
              <div class="badge badge-success badge-success-alt">active</div>
            </td>
            <td>
            <i class="bx bxs-edit mr-2"></i>
            <i class="bx bxs-trash mr-2"></i>
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
              <a href="#">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-pink mr-3">JR</div>

                  <div class="">
                    <p class="font-weight-bold mb-0">Julie Richards</p>
                    <p class="text-muted mb-0">julie_89@example.com</p>
                  </div>
                </div>
              </a>
            </td>
            <td>VIP</td>
            <td>2.054$</td>
            <td>
              <div class="badge badge-success badge-success-alt">active</div>
            </td>
            <td>
            <i class="bx bxs-edit mr-2"></i>
            <i class="bx bxs-trash mr-2"></i>
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
            <td>RPO</td>
            <td>3.541$</td>
            <td>
              <div class="badge badge-success badge-success-alt">active</div>
            </td>
            <td>
            <i class="bx bxs-edit mr-2"></i>
            <i class="bx bxs-trash mr-2"></i>
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
              <a href="#">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-pink mr-3">JR</div>

                  <div class="">
                    <p class="font-weight-bold mb-0">Julie Richards</p>
                    <p class="text-muted mb-0">julie_89@example.com</p>
                  </div>
                </div>
              </a>
            </td>
            <td>VIP</td>
            <td>2.054$</td>
            <td>
              <div class="badge badge-success badge-success-alt">active</div>
            </td>
            <td>
            <i class="bx bxs-edit mr-2"></i>
            <i class="bx bxs-trash mr-2"></i>
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
            <td>RPO</td>
            <td>3.541$</td>
            <td>
              <div class="badge badge-success badge-success-alt">active</div>
            </td>
            <td>
            <i class="bx bxs-edit mr-2"></i>
            <i class="bx bxs-trash mr-2"></i>
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
              <a href="#">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-pink mr-3">JR</div>

                  <div class="">
                    <p class="font-weight-bold mb-0">Julie Richards</p>
                    <p class="text-muted mb-0">julie_89@example.com</p>
                  </div>
                </div>
              </a>
            </td>
            <td>VIP</td>
            <td>2.054$</td>
            <td>
              <div class="badge badge-success badge-success-alt">active</div>
            </td>
            <td>
            <i class="bx bxs-edit mr-2"></i>
            <i class="bx bxs-trash mr-2"></i>
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
            <td>RPO</td>
            <td>3.541$</td>
            <td>
              <div class="badge badge-success badge-success-alt">active</div>
            </td>
            <td>
            <i class="bx bxs-edit mr-2"></i>
            <i class="bx bxs-trash mr-2"></i>
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
              <a href="#">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-pink mr-3">JR</div>

                  <div class="">
                    <p class="font-weight-bold mb-0">Julie Richards</p>
                    <p class="text-muted mb-0">julie_89@example.com</p>
                  </div>
                </div>
              </a>
            </td>
            <td>VIP</td>
            <td>2.054$</td>
            <td>
              <div class="badge badge-success badge-success-alt">active</div>
            </td>
            <td>
            <i class="bx bxs-edit mr-2"></i>
            <i class="bx bxs-trash mr-2"></i>
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
