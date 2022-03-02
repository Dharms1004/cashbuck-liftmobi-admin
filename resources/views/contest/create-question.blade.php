@include('common.head')

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('common.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
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
                           <h1>Create Question</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Create Question</li>
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
                            <div class="card">
                                <div class="card-body">
                                    <form id="create_questions" name="create_questions" action="{{ route('insert_ques') }}" method="post">
                                       @csrf()
                                       <div class="row">
                                          <div class="form-group col-md-6">
                                             <label>Select Contest: <span class="text-danger">*</span></label>
                                             <select name="contest_name" id="contest_name" class="customselect @error('contest_name') error @enderror" data-plugin="customselect" onchange="contesttitle();">
                                                @if($contestname)
                                                   <option data-default-selected="" value="">Select Contest Name</option>
                                                   @foreach($contestname as $key=>$value)
                                                   <option data-default-selected="" value="{{ $value->CONTEST_ID }}" {{ (old('contest_name')== $value->CONTEST_ID)?'selected':''}}>{{ $value->CONTEST_NAME }}</option>
                                                   @endforeach
                                                @endif
                                             </select>
                                             @error('contest_name') <label id="contest_name-error" class="error" for="contest_name">{{ $message }}</label> @enderror
                                             <div class="spinner-grow spinner-grow-sm m-2" id="titleloader" role="status" style="display:none"></div>
                                          </div>

                                          <div class="form-group col-md-6">
                                             <label>Contest Title: <span class="text-danger">*</span></label>
                                             <input type="text" class="form-control @error('contest_title') error @enderror" name="contest_title" id="contest_title" placeholder="Contest Title" value="{{ old('contest_title') }}" readonly>
                                             @error('contest_title') <label id="contest_title-error" class="error" for="contest_title">{{ $message }}</label> @enderror
                                          </div>
                                       </div>

                                       <div class="row">

                                          <div class="form-group col-md-12">
                                             <label>Question 1: <span class="text-danger">*</span></label>
                                             <textarea class="form-control @error("ques1.QUESTION") error @enderror" name="ques1[QUESTION]" id="ques1" placeholder="Question 1">{{ old("ques1.QUESTION") }}</textarea>
                                             @error("ques1.QUESTION") <label id="ques1.QUESTION-error" class="error" for="ques1.QUESTION">{{ $message }}</label> @enderror
                                          </div>

                                          <div class="form-group col-md-3">
                                             <label>Option A: <span class="text-danger">*</span></label>
                                             <input type="text" name="ques1[OPTION_A]" id="ques1_option_A" class="form-control @error("ques1.OPTION_A") error @enderror"  placeholder="Option A" value="{{ old("ques1.OPTION_A") }}">
                                             @error("ques1.OPTION_A") <label id="ques1.OPTION_A-error" class="error" for="ques1.OPTION_A">{{ $message }}</label> @enderror
                                          </div>

                                          <div class="form-group col-md-3">
                                             <label>Option B: <span class="text-danger">*</span></label>
                                             <input type="text" name="ques1[OPTION_B]" id="ques2_option_b" class="form-control @error("ques1.OPTION_B") error @enderror"  placeholder="Option B" value="{{ old("ques1.OPTION_B") }}">
                                             @error("ques1.OPTION_B") <label id="ques1.OPTION_B-error" class="error" for="ques1.OPTION_B">{{ $message }}</label> @enderror
                                          </div>

                                          <div class="form-group col-md-3">
                                             <label>Option C: <span class="text-danger">*</span></label>
                                             <input type="text" name="ques1[OPTION_C]" id="ques1_option_c" class="form-control @error("ques1.OPTION_C") error @enderror"  placeholder="Option C" value="{{ old("ques1.OPTION_C") }}">
                                             @error("ques1.OPTION_C") <label id="ques1.OPTION_C-error" class="error" for="ques1.OPTION_C">{{ $message }}</label> @enderror
                                          </div>

                                          <div class="form-group col-md-3">
                                             <label>Option D: <span class="text-danger">*</span></label>
                                             <input type="text" name="ques1[OPTION_D]" id="ques1_option_D" class="form-control @error("ques1.OPTION_D") error @enderror"  placeholder="Option D" value="{{ old("ques1.OPTION_D") }}">
                                             @error("ques1.OPTION_D") <label id="ques1.OPTION_D-error" class="error" for="ques1.OPTION_D">{{ $message }}</label> @enderror
                                          </div>

                                       </div>
                                       <div class="row">
                                          <div class="form-group col-md-12">
                                             <label>Question 2: <span class="text-danger">*</span></label>
                                             <textarea class="form-control @error("ques2.QUESTION") error @enderror" name="ques2[QUESTION]" id="ques2" placeholder="Question 2">{{ old("ques2.QUESTION") }}</textarea>
                                             @error("ques2.QUESTION") <label id="ques2.QUESTION-error" class="error" for="ques2.QUESTION">{{ $message }}</label> @enderror
                                          </div>
                                          <div class="form-group col-md-3">
                                             <label>Option A: <span class="text-danger">*</span></label>
                                             <input type="text" name="ques2[OPTION_A]" id="ques2_option_A" class="form-control @error("ques2.OPTION_A") error @enderror"  placeholder="Option A" value="{{ old("ques2.OPTION_A") }}">
                                             @error("ques2.OPTION_A") <label id="ques2.OPTION_A-error" class="error" for="ques2.OPTION_A">{{ $message }}</label> @enderror
                                          </div>
                                          <div class="form-group col-md-3">
                                             <label>Option B: <span class="text-danger">*</span></label>
                                             <input type="text" name="ques2[OPTION_B]" id="ques2_option_B" class="form-control @error("ques2.OPTION_B") error @enderror"  placeholder="Option B" value="{{ old("ques2.OPTION_B") }}">
                                             @error("ques2.OPTION_B") <label id="ques2.OPTION_B-error" class="error" for="ques2.OPTION_B">{{ $message }}</label> @enderror
                                          </div>
                                          <div class="form-group col-md-3">
                                             <label>Option C: <span class="text-danger">*</span></label>
                                             <input type="text" name="ques2[OPTION_C]" id="ques2_option_C" class="form-control @error("ques2.OPTION_C") error @enderror"  placeholder="Option C" value="{{ old("ques2.OPTION_C") }}">
                                             @error("ques2.OPTION_C") <label id="ques2.OPTION_C-error" class="error" for="ques2.OPTION_C">{{ $message }}</label> @enderror
                                          </div>
                                          <div class="form-group col-md-3">
                                             <label>Option D: <span class="text-danger">*</span></label>
                                             <input type="text" name="ques2[OPTION_D]" id="ques2_option_D" class="form-control @error("ques2.OPTION_D") error @enderror"  placeholder="Option D" value="{{ old("ques2.OPTION_D") }}">
                                             @error("ques2.OPTION_D") <label id="ques2.OPTION_D-error" class="error" for="ques2.OPTION_D">{{ $message }}</label> @enderror
                                          </div>
                                       </div>
                                       <div class="row mb-2">
                                          <div class="form-group col-md-12">
                                             <label>Question 3: <span class="text-danger">*</span></label>
                                             <textarea class="form-control @error("ques3.QUESTION") error @enderror" name="ques3[QUESTION]" id="ques3" placeholder="Question 3">{{ old("ques3.QUESTION") }}</textarea>
                                             @error("ques3.QUESTION") <label id="ques3.QUESTION-error" class="error" for="ques3.QUESTION">{{ $message }}</label> @enderror
                                          </div>
                                          <div class="form-group col-md-3">
                                             <label>Option A: <span class="text-danger">*</span></label>
                                             <input type="text" name="ques3[OPTION_A]" id="ques3_option_A" class="form-control @error("ques3.OPTION_A") error @enderror"  placeholder="Option A" value="{{ old("ques3.OPTION_A") }}">
                                             @error("ques3.OPTION_A") <label id="ques3.OPTION_A-error" class="error" for="ques3.OPTION_A">{{ $message }}</label> @enderror
                                          </div>
                                          <div class="form-group col-md-3">
                                             <label>Option B: <span class="text-danger">*</span></label>
                                             <input type="text" name="ques3[OPTION_B]" id="ques3_option_b" class="form-control @error("ques3.OPTION_B") error @enderror"  placeholder="Option B" value="{{ old("ques3.OPTION_B") }}">
                                             @error("ques3.OPTION_B") <label id="ques3.OPTION_B-error" class="error" for="ques3.OPTION_B">{{ $message }}</label> @enderror
                                          </div>
                                          <div class="form-group col-md-3">
                                             <label>Option C: <span class="text-danger">*</span></label>
                                             <input type="text" name="ques3[OPTION_C]" id="ques3_option_c" class="form-control @error("ques3.OPTION_C") error @enderror"  placeholder="Option C" value="{{ old("ques3.OPTION_C") }}">
                                             @error("ques3.OPTION_C") <label id="ques3.OPTION_C-error" class="error" for="ques3.OPTION_C">{{ $message }}</label> @enderror
                                          </div>
                                          <div class="form-group col-md-3">
                                             <label>Option D: <span class="text-danger">*</span></label>
                                             <input type="text" name="ques3[OPTION_D]" id="option_d" class="form-control @error("ques3.OPTION_D") error @enderror"  placeholder="Option D" value="{{ old("ques3.OPTION_D") }}">
                                             @error("ques3.OPTION_D") <label id="ques3.OPTION_D-error" class="error" for="ques3.OPTION_D">{{ $message }}</label> @enderror
                                          </div>
                                       </div>
                                       <button type="submit" id="submit_create_questions" class="btn btn-success waves-effect waves-light"
                                       name="create_questions"><i class="fa fa-save mr-1"></i> Save</button>

                                       <button type="reset" class="btn btn-secondary waves-effect waves-light"><i class="fas fa-eraser mr-1"></i> Clear</button>
                                    </form>
                                 </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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
    <script src="{!! asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') !!}"></script>
    <!-- bs-custom-file-input -->
    <script src="{!! asset('dist/js/adminlte.min.js') !!}"></script>
    <!-- AdminLTE App -->

    <!-- AdminLTE for demo purposes -->
    <script src="{!! asset('dist/js/demo.js') !!}"></script>
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{!! asset('plugins/toastr/toastr.min.js') !!}"></script>

    <!-- Page specific script -->
    <script>



            function contesttitle() {
                // alert("Hello moto");return false;
                var add_event_url = "{{ url('/getContestTitle') }}";
                document.getElementById('titleloader').style.display = "block";
                var contestName = document.getElementById("contest_name").value;
                $.ajax({
                    url: add_event_url,
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        CONTEST_ID: contestName
                    },
                    success: function(response) {
                        document.getElementById('titleloader').style.display = "none";
                        if (response.status == 200) {
                            if (response.data) {
                                $('#contest_title').val(response.data.CONTEST_TITLE);
                            } else {
                                $('#contest_title').val('');
                            }

                        }
                    }
                })
            }

        $(document).ready(function() {

            $('#create_questions').validate({
                rules: {
                    contest_name: 'required',
                    contest_title: 'required',
                    "ques1[QUESTION]": 'required',
                    "ques1[OPTION_A]": 'required',
                    "ques1[OPTION_B]": 'required',
                    "ques1[OPTION_C]": 'required',
                    "ques1[OPTION_D]": 'required',
                    "ques2[QUESTION]": 'required',
                    "ques2[OPTION_A]": 'required',
                    "ques2[OPTION_B]": 'required',
                    "ques2[OPTION_C]": 'required',
                    "ques2[OPTION_D]": 'required',
                    "ques3[QUESTION]": 'required',
                    "ques3[OPTION_A]": 'required',
                    "ques3[OPTION_B]": 'required',
                    "ques3[OPTION_C]": 'required',
                    "ques3[OPTION_D]": 'required'
                }
            });



            $("#create_questions").submit(function(e) {
                if ($('#create_questions').valid()) {
                    $("#submit_create_questions").prop("disabled", true);
                    return true;
                }
            });
        });


    </script>
</body>

</html>
