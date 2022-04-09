@include('common.head')

<style>

.w-5{
    display: none;
}

</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('common.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Cashbuck</span>
            </a>

            <!-- Sidebar -->
            @include('common.sidebar')
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>User List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">User List</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Search User</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- form start -->
                                    <form method="POST" action="{{ route('user-list') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Start From</label>
                                                <input type="date" name="start_from" value="@if(!empty(old('start_from'))) {{ date("YYYY-dd-mm", strtotime(old('start_from'))) }}@else{{!empty($params->STARTS_FROM)?date_format(date_create($params->STARTS_FROM),"Y-m-d"):''}}@endif" class="form-control" i placeholder="Start from">
                                            </div>
                                        </div>
                                        <div class="col-md-5"> 
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Ends On</label>
                                                <input type="date" name="ends_on" value="@if(!empty(old('ends_on'))) {{ date("YYYY-dd-mm", strtotime(old('ends_on'))) }}@else{{!empty($params->ENDS_ON)?date_format(date_create($params->ENDS_ON),"Y-m-d"):''}}@endif" class="form-control" i placeholder="Ends On">
                                            </div>
                                        </div>
                                        <!-- <div class="card-footer"> -->
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        <!-- </div> -->
                                    </form>
                                </div>
                            </div>
                            <!-- /.card -->
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S No.</th>
                                                <th>Phone</th>
                                                <th>Social Email</th>
                                                <th>Device Type</th>
                                                <th>Device Name</th>
                                                <th>Social Type</th>
                                                <th>Profile Pic</th>
                                                <th>Add Id</th>
                                                <th>Ref Id</th>
                                                <th>Ref Code</th>
                                                <th>State</th>
                                                <th>Date</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        @if(isset($userDatas) && !empty($userDatas))
                                        <tbody>
                                            @foreach($userDatas as $userData)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $userData->PHONE }}</td>
                                                <td>{{ $userData->SOCIAL_EMAIL }}</td>
                                                <td>{{ $userData->DEVICE_TYPE }}</td>
                                                <td>{{ $userData->DEVICE_NAME }}</td>
                                                <td>{{ $userData->SOCIAL_TYPE }}</td>
                                                <td><img style="height:50px; width:100px" src="{{url('images/thumb/'.$userData->PROFILE_PIC)}}"></td>
                                                <td>{{ $userData->ADVERTISING_ID }}</td>
                                                <td>{{ $userData->REFFER_ID }}</td>
                                                <td>{{ $userData->REFFER_CODE }}</td>
                                                <td>{{ $userData->STATE }}</td>
                                                <td>{{ $userData->CREATED_AT }}</td>
                                                <td><a data-toggle="modal" data-user-id="{{ $userData->USER_ID }}" data-target="#modal-default" class="user-details btn btn-app">
                                                        <i class="fas fa-users"></i> Details
                                                    </a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        @endif
                                    </table>
                                    <div>
                                    </div>
                                        @if(isset($userDatas) && !empty($userDatas))
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6"></div>
                                                <div class="col-sm-12 col-md-6">
                                                    {{ $userDatas->render("pagination::default") }}
                                                </div>
                                            </div>
                                        @endif
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <div class="modal fade show" id="modal-default" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">User Details</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" id="prof_pic" alt="User profile picture">
                                </div>

                                <h3 id="soicial_name" class="profile-username text-center"></h3>

                                <p class="text-muted text-center" id="occupation"></p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <a id="balance" class="float-right"></a>
                                        <spam id="balance_type"></spam>
                                    </li>
                                    <!-- <li class="list-group-item">
                                        <b>Following</b> <a class="float-right">543</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Friends</b> <a class="float-right">13,287</a>
                                    </li> -->
                                </ul>

                                <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </div>
                <div id="modal-loader" class="overlay">
                    <i class="fas fa-2x fa-sync fa-spin"></i>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        @include('common.footer')


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->

    <script src="{!! asset('plugins/jquery/jquery.min.js') !!}"></script>
    <!-- Bootstrap 4 -->

    <script src="{!! asset('plugins/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{!! asset('plugins/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') !!}"></script>
    <script src="{!! asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') !!}"></script>
    <script src="{!! asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') !!}"></script>
    <script src="{!! asset('plugins/jszip/jszip.min.js') !!}"></script>
    <script src="{!! asset('plugins/pdfmake/pdfmake.min.js') !!}"></script>
    <script src="{!! asset('plugins/pdfmake/vfs_fonts.js') !!}"></script>
    <script src="{!! asset('plugins/datatables-buttons/js/buttons.html5.min.js') !!}"></script>
    <script src="{!! asset('plugins/datatables-buttons/js/buttons.print.min.js') !!}"></script>
    <script src="{!! asset('plugins/datatables-buttons/js/buttons.colVis.min.js') !!}"></script>
    <script src="{!! asset('dist/js/adminlte.min.js') !!}"></script>
    <script src="{!! asset('dist/js/demo.js') !!}"></script>

    <script>
        $(function() {
            $("#example1").DataTable({

                "scrollX": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            // $('#example2').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": false,
            //     "ordering": true,
            //     "info": true,
            //     "autoWidth": false,
            //     "responsive": true,
            // });
        });


        jQuery(document).ready(function() {
            jQuery('.user-details').click(function(e) {
                e.preventDefault();
                $("#soicial_name").html("");
                $("#occupation").html("");
                $("#prof_pic").attr("src", "");
                $("#balance").html("");
                $("#balance_type").html("");
                var userId = $(this).attr("data-user-id");
                //    $.ajaxSetup({
                //       headers: {
                //           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                //       }
                //   });
                jQuery.ajax({
                    url: "{{ url('/getUserDetails') }}",
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        userId: userId,

                    },
                    success: function(result) {
                        $("#soicial_name").html(result.SOCIAL_NAME);
                        $("#occupation").html(result.OCCUPATION);
                        $("#prof_pic").attr("src", result.PROFILE_PIC);
                        $("#balance").html(result.BALANCE);
                        $("#balance_type").html(result.BALANCE_TYPE);
                        $("#modal-loader").hide();

                        //location.reload();
                    }
                });
            });
        });
    </script>
</body>

</html>
