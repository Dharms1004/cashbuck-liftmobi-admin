@include('common.head')

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('common.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{!! asset('dist/img/AdminLTELogo.png') !!}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">LiftCash</span>
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
                            <h1>Contest List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Contest List</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-10">
                                            <h3 class="card-title">All Contest list</h3>
                                        </div>
                                        <div class="col-2">
                                            <a href="{{route('createcontest')}}" class="btn btn-success">Add Contest</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                {{-- <th>Video Link</th> --}}
                                                <th>Thumbnail</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($contestDatas))
                                            @foreach($contestDatas as $contestData)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $contestData->CONTEST_NAME }}</td>
                                                <td>{{ $contestData->CONTEST_TITLE }}</td>
                                                <td>{{ $contestData->CONTEST_DESCRIPTION }}</td>
                                                <td><a href="{{ $contestData->CONTEST_IMAGE_LINK }}" class="image-popup" title="{{ $contestData->CONTEST_NAME }}"><img src="{{url('images/contest/'.$contestData->CONTEST_IMAGE_LINK)}}" width="70" class="img-fluid"  alt="work-thumbnail"/></a></td>
                                                <td><?php if($contestData->CONTEST_STATUS ==1){ ?>
                                                    <span class="badge bg-soft-success text-success shadow-none" style="cursor: pointer;" onclick="return changeStatus({{$contestData['CONTEST_ID']}},`Are you sure want to Inactive this contest?`,0);">Active</span>
                                                    <?php }else{ ?>
                                                       <span class="badge bg-soft-danger text-danger shadow-none" style="cursor: pointer;" onclick="return changeStatus({{$contestData['CONTEST_ID']}},`Are you sure want to Active this contest?`,1);">Inactive</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a href="#"  class="action-icon font-18 tooltips" data-toggle="modal" data-target="#setuserflagpopup" onclick="checkContest({{$contestData['CONTEST_ID']}});"><i class="fa-eye fa"></i> <span class="tooltiptext">View</span></a>
                                                    <a href="{{ route('edit_contest', $contestData->CONTEST_ID) }}" class="action-icon font-18 tooltips"><i class="fa-edit fa"></i> <span class="tooltiptext">Edit</span></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>

                                    </table>

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

        <div class="modal fade" id="setuserflagpopup">
            <div class="modal-dialog modal-lg">
               <div class="modal-content bg-transparent shadow-none">
                  <div class="card">
                     <div class="card-header bg-dark py-3 text-white">
                        <div class="card-widgets">
                           <a href="#" data-dismiss="modal">
                           <i class="mdi mdi-close"></i>
                           </a>
                        </div>
                        <h5 class="card-title mb-0 text-white font-18">View Contest Name</h5>
                     </div>
                     <div class="card-body">
                        <table class="border-0 w-100 mytabless">
                           <div id="managecontestdata" class="loader d-flex justify-content-center hv_center">
                              <div class="spinner-border" role="status"></div>
                          </div>
                           <tr>
                              <td width="35%"> <strong class="font-15">Contest Title:</strong></td>
                              <td width="65%" id="model_contest_title"></td>
                           </tr>
                           <tr>
                              <td width="35%"> <strong class="font-15">Contest Description:</strong></td>
                              <td width="65%" id="model_contest_desc"></td>
                           </tr>
                           <tr>
                              <td colspan="2">
                                 <strong class="font-15 mb-2 d-block">Terms & Conditions::</strong>
                                 <div class="textcft">
                                    <ul id="model_term_cond1"></ul>
                                 </div>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
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

    <script type="text/javascript">
        $(function() {
            $("#example1").DataTable({
                "scrollX": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });


        jQuery(document).ready(function(){
            jQuery('.btn-block').click(function(e){
               e.preventDefault();
               var contest_id = $(this).attr("data-offer-id");
               var STATUS = $(this).attr("data-offer-status");
               jQuery.ajax({
                  url: "{{ url('/updateStatus') }}",
                  method: 'get',
                  data: {
                    "_token": "{{ csrf_token() }}",
                    CONTEST_ID: contest_id,
                    STATUS: STATUS,

                  },
                  success: function(result){
                    location.reload();
                  }});
            });

        });

        function changeStatus(contest_id, msg, status_id) {
            var add_event_url = "{{ url('/updateStatus') }}";
            $.ajax({
                url: add_event_url,
                type: "get",
                data: {
                    CONTEST_ID: contest_id,
                    STATUS: status_id
                },
                success: function(response) {
                    if (response.status == 200) {
                        location.reload();
                    }
                }
            })
        }


        function checkContest(contest_id) {
            var add_event_url = "{{ url('/getContestModelData') }}";
            $('#managecontestdata, #managecontestdata div').show();
            $("#model_term_cond1").html("");
            $.ajax({
                url: add_event_url,
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    CONTEST_ID: contest_id
                },
                success: function(response) {
                    //$('#managecontestdata, #managecontestdata div').hide().css({ 'z-index': -1 });
                    $('#managecontestdata, #managecontestdata div').hide();
                    if (response.status == 200) {
                        $('#model_contest_title').html(response.data.CONTEST_TITLE);
                        $('#model_contest_desc').html(response.data.CONTEST_DESCRIPTION);
                        // $('#model_video_link').html(response.data.CONTEST_VIDEO_URL);
                        //$("#model_video_link").attr("href", response.data.CONTEST_VIDEO_URL);
                        $("#model_video_link").attr("src", response.data.CONTEST_VIDEO_URL);
                        $('#model_video_desc').html(response.data.CONTEST_VIDEO_DESCRIPTION);
                        var term = response.data.CONTEST_TERMS_CONDITIONS.split('.');
                        $.each(term, function(key, value) {
                            $("#model_term_cond1").append(`<li>${value}</li>`);
                        });
                    }
                }
            })
        }

    </script>
</body>

</html>
