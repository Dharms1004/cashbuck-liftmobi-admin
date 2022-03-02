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
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
                            <h1>Questions List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Questions List</li>
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
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-10">
                                            <h3 class="card-title">All Questions List</h3>
                                        </div>
                                        <div class="col-2">
                                            <a href="{{route('create_questions')}}" class="btn btn-success">Add Question</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Contest Name</th>
                                                <th>Questions</th>
                                                <th>Options</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($search_questions))
                                            @foreach($search_questions as $search_question)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $search_question->CONTEST_NAME }}</td>
                                                <td>{{ $search_question->QUESTION }}</td>
                                                <td>{{ $search_question->OPTION_A .', '.$search_question->OPTION_B.', '.$search_question->OPTION_C.', '.$search_question->OPTION_D}}</td>
                                                <td><label class="switches"><input type="checkbox" id="changestatus" name="changestatus" onclick="return changeStatus({{ $search_question->QUESTION_ID }},{{ $search_question->QUESTION_STATUS }},{{  $search_question->CONTEST_ID }});" {{ $search_question->QUESTION_STATUS ==1?'checked':'' }}><span class="slider round"></span></label></td>
                                                <td>
                                                    <a href="#"  class="action-icon font-18 tooltips" data-toggle="modal" data-target="#setuserflagpopup" onclick="checkContest({{ $search_question->QUESTION_ID }});"><i class="fa-eye fa"></i> <span class="tooltiptext">View</span></a>

                                                    <a href="#" data-toggle="modal" data-target="#editfrompopup"  class="action-icon font-18 tooltips" onclick="editQuestion({{ $search_question->QUESTION_ID }});"><i class="fa-edit fa"></i> <span class="tooltiptext">Edit</span></a>
                                                </td>
                                                {{-- @if($search_question->CONTEST_STATUS == 1)
                                                    <td><button type="button" data-offer-id="{{ $search_question->CONTEST_ID }}" class="btn btn-block btn-success btn-sm">Active</button></td>
                                                @elseif($search_question->CONTEST_STATUS == 2)
                                                    <td><button type="button" data-offer-id="{{ $search_question->CONTEST_ID }}" class="btn btn-block btn-danger btn-sm">Inactive</button></td>
                                                @elseif($search_question->CONTEST_STATUS == 3)
                                                    <td><button type="button" class="btn btn-block btn-danger btn-sm">Deleted</button></td>
                                                @else
                                                    <td>Null</td>
                                                @endif --}}
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
                        <h5 class="card-title mb-0 text-white font-18">View Contest Name's Question #</h5>
                        </div>
                        <div class="card-body">
                        <div id="managecontestdata" class="loader d-flex justify-content-center hv_center">
                            <div class="spinner-border" role="status"></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-6 mb-1"><strong class="font-15">Contest Title:</strong> <span id="contest_title_view"></span></div>
                            <div class="col-md-6 mb-1"><strong class="font-15">Contest Name:</strong> <span id="contest_name_view"></span></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-12 mb-1">
                                <strong class="font-15 d-block">Questions:</strong>
                                <p class="mb-0" id="question"></p>
                            </div>
                            <div class="col-md-6 mb-1"><strong class="font-15">Option A:</strong> <span id="option_a"></span></div>
                            <div class="col-md-6 mb-1"><strong class="font-15">Option B:</strong> <span id="option_b"></span></div>
                            <div class="col-md-6 mb-1"><strong class="font-15">Option C:</strong> <span id="option_c"></span></div>
                            <div class="col-md-6 mb-1"><strong class="font-15">Option D:</strong> <span id="option_d"></span></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-4 mb-1"><strong class="font-15">Status:</strong> <span id="ques_status"></span></div>
                            <div class="col-md-4 mb-1"><strong class="font-15">Added By:</strong> <span id="added_by"></span></div>
                            <div class="col-md-4 mb-1"><strong class="font-15">On:</strong> <span id="created_date"></span></div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editfrompopup">
            <div class="modal-dialog modal-lg">
                <div class="modal-content bg-transparent shadow-none">
                    <div class="card">
                        <div class="card-header bg-dark py-3 text-white">
                        <div class="card-widgets">
                            <a href="#" data-dismiss="modal">
                            <i class="mdi mdi-close"></i>
                            </a>
                        </div>
                        <h5 class="card-title mb-0 text-white font-18">Edit Questions</h5>
                        </div>
                        <div class="card-body">
                        <form name="edit_question" id="edit_question" method="post">
                            <div id="managecontestdata" class="loader d-flex justify-content-center hv_center">
                                <div class="spinner-border" role="status"></div>
                            </div>
                            <input type="hidden" name="edit_question_id" id="edit_question_id" value="">
                            <div class="row mb-1">
                                <div class="col-md-6 mb-1"><strong class="font-15">Contest Title:</strong> <span id="contest_title_edit"></span></div>
                                <div class="col-md-6 mb-1"><strong class="font-15">Contest Name:</strong> <span id="contest_name_edit"></span></div>
                            </div>
                            <div class="row mb-1">
                                <div class="form-group col-md-12">
                                    <label>Question: <span class="text-danger">*</span></label>
                                    <textarea class="form-control"  placeholder="Question 2" name="question_edit" id="question_edit"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Option A: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="option_a_edit" id="option_a_edit" placeholder="Option A" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Option B: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="option_b_edit" id="option_b_edit"  placeholder="Option B" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Option C: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="option_c_edit" id="option_c_edit" placeholder="Option C" value="">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Option D: <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="option_d_edit" id="option_d_edit" placeholder="Option D" value="">
                                </div>
                            </div>
                            <button type="submit" id="update_question" onclick="updateQuestion();" class="btn btn-warning waves-effect waves-light"><i class="far fa-edit mr-1"></i> Update</button>
                            <button type="reset" id="reset_edit_form" class="btn btn-dark waves-effect waves-light ml-1"
                            ><i class="mdi mdi-replay mr-1"></i>Reset</button>
                        </form>
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
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });


        jQuery(document).ready(function(){
            jQuery('.btn-block').click(function(e){
               e.preventDefault();
               var offer_id=$(this).attr("data-offer-id");
               jQuery.ajax({
                //   url: "{{ url('/updateGameStatus') }}",
                  method: 'post',
                  data: {
                    "_token": "{{ csrf_token() }}",
                    id: offer_id,

                  },
                  success: function(result){
                    location.reload();
                  }});
            });

        });

        function checkContest(question_id) {
            var add_event_url = "{{ url('/getQuestionModelData') }}";
            $('#managecontestdata, #managecontestdata div').show().css({ 'z-index': 99 });
            $.ajax({
                url: add_event_url,
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    QUESTION_ID: question_id
                },
                success: function(response) {
                    $('#managecontestdata, #managecontestdata div').hide().css({ 'z-index': -1 });
                    if (response.status == 200) {
                        $('#contest_title_view').html(response.data.CONTEST_TITLE);
                        $('#contest_name_view').html(response.data.CONTEST_NAME);
                        $('#question').html(response.data.QUESTION);
                        $('#option_a').html(response.data.OPTION_A);
                        $('#option_b').html(response.data.OPTION_B);
                        $('#option_c').html(response.data.OPTION_C);
                        $('#option_d').html(response.data.OPTION_D);
                        $('#ques_status').html(response.data.QUESTION_STATUS == 1 ? 'Active' : 'Inactive');
                        $('#added_by').html(response.data.CREATED_BY);
                        $('#created_date').html(response.data.CREATED_ON);
                    }
                }
            })
        }

        function editQuestion(question_id) {
            var add_event_url = "{{ url('/getQuestionModelData') }}";
            $('#managecontestdata, #managecontestdata div').show().css({ 'z-index': 99 });
            $.ajax({
                // url: {{ url('/getQuestionModelData') }},
                url: add_event_url,
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    QUESTION_ID: question_id
                },
                success: function(response) {
                    $('#managecontestdata, #managecontestdata div').hide().css({ 'z-index': -1 });
                    if (response.status == 200) {
                        $('#edit_question_id').val(response.data.QUESTION_ID);
                        $('#contest_title_edit').html(response.data.CONTEST_TITLE);
                        $('#contest_name_edit').html(response.data.CONTEST_NAME);
                        $('#question_edit').html(response.data.QUESTION);
                        $('#option_a_edit').val(response.data.OPTION_A);
                        $('#option_b_edit').val(response.data.OPTION_B);
                        $('#option_c_edit').val(response.data.OPTION_C);
                        $('#option_d_edit').val(response.data.OPTION_D);
                    }
                }
            })
        }

        function changeStatus(QUESTION_ID, status_id, contest_id) {
            var add_event_url = "{{ url('/updateQuesStatus') }}";
            var status = (status_id == 1) ? 0 : 1;
            $.ajax({
                url: add_event_url,
                type: "post",
                data: {
                    "_token": "{{ csrf_token() }}",
                    QUESTION_ID: QUESTION_ID,
                    status: status,
                    CONTEST_ID: contest_id
                },
                success: function(response) {
                    if (response.status == 200) {
                        $.NotificationApp.send("Success", "Status Change Successfully", 'top-right', '#5ba035', 'success');
                    } else {
                        $.NotificationApp.send("error", "Status updation failed", 'top-right', '#FF9494', 'error');
                    }
                }
            })
        }

        $(document).ready(function(){
            function updateQuestion() {
                $('#edit_question').on('submit', function(e) {
                    var add_event_url = "{{ url('/updatequestion') }}";
                    if ($('#edit_question').valid()) {
                        e.preventDefault();
                        $("#update_question").prop("disabled", true);
                        $.ajax({
                            type: 'post',
                            url: add_event_url,
                            data: $('#edit_question').serialize(),
                            success: function(response) {
                                if (response.status == 200) {
                                    $('#editfrompopup').modal('hide');
                                    $("#search_question_form").submit();
                                    // $.NotificationApp.send("Success", "Update Successfully", 'top-right', '#5ba035', 'success');
                                } else {
                                    $("#update_question").prop("disabled", false);
                                    // $.NotificationApp.send("error", "Updation failed", 'top-right', '#FF9494', 'error');
                                }
                            }
                        });
                    }
                });
            }
            $('#edit_question').validate({
                rules: {
                    question_edit: 'required',
                    option_a_edit: 'required',
                    option_b_edit: 'required',
                    option_c_edit: 'required',
                    option_d_edit: 'required'
                }

            });
        });
    </script>
</body>

</html>
