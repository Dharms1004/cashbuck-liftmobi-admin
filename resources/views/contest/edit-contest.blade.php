@extends('common.head')

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('common.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
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
                            <h1>Edit Contest</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Edit Contest</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-12">
                            <div class="card">
                               <div class="card-body">
                               <form name="userContestForm" id="userContestForm" action="{{route('update_contest', $contestData['CONTEST_ID'])}}" method="post" enctype="multipart/form-data">
                                     @csrf
                                     <div class="row">
                                        <div class="form-group col-md-4">
                                           <label>Contest Name: <span class="text-danger">*</span></label>
                                           <input type="text" name="contest_name" id="contest_name" class="form-control @error('contest_name') error @enderror"  placeholder="Contest Name" value="{{!empty($contestData)?$contestData->CONTEST_NAME:old('contest_name')}}">
                                           @error('contest_name') <label id="contest_name-error" class="error" for="contest_name">{{ $message }}</label> @enderror
                                        </div>
                                        <input type="hidden" name="contest_status" id="contest_status" value="{{ $contestData->CONTEST_STATUS }}">
                                        <div class="form-group col-md-4">
                                           <label>Contest Title: <span class="text-danger">*</span></label>
                                           <input type="text" class="form-control @error('contest_title') error @enderror" name="contest_title" id="contest_title" placeholder="Contest Title" value="{{!empty($contestData)?$contestData->CONTEST_TITLE:old('contest_title')}}">
                                           @error('contest_title') <label id="contest_title-error" class="error" for="contest_title">{{ $message }}</label> @enderror
                                        </div>
                                        <div class="form-group col-md-4">
                                           <label>Contest Description: </label>
                                           <input type="text" class="form-control @error('contest_description') error @enderror" name="contest_description" id="contest_description" placeholder="Contest Description" value="{{!empty($contestData)?$contestData->CONTEST_DESCRIPTION:old('contest_description')}}">
                                           @error('contest_description') <label id="contest_description-error" class="error" for="contest_description">{{ $message }}</label> @enderror
                                        </div>
                                     </div>
                                     <div class="row">
                                        {{-- <div class="form-group col-md-4">
                                           <label>Video Link: <span class="text-danger">*</span></label>
                                           <input type="text" name="contest_video_url" id="contest_video_url" class="form-control @error('contest_video_url') error @enderror" placeholder="Video Link" value="{{!empty($contestData)?$contestData->CONTEST_VIDEO_URL:old('contest_video_url')}}">
                                           @error('contest_video_url') <label id="contest_video_url-error" class="error" for="contest_video_url">{{ $message }}</label> @enderror
                                        </div> --}}
                                        <div class="form-group col-md-4">
                                           <label>Image: </label>
                                           <input type="file" class="form-control @error('contest_image_link') error @enderror" name="contest_image_link" id="contest_image_link"  value="{{!empty($contestData)?$contestData->CONTEST_IMAGE_LINK:old('contest_image_link')}}" accept="image/*">
                                           @error('contest_image_link') <label id="contest_image_link-error" class="error" for="contest_image_link">{{ $message }}</label> @enderror
                                        </div>
                                        {{-- <div class="form-group col-md-4">
                                           <label>Video Description: </label>
                                           <input type="text" class="form-control @error('contest_video_description') error @enderror" name="contest_video_description" id="contest_video_description" placeholder="Video Description" value="{{!empty($contestData)?$contestData->CONTEST_VIDEO_DESCRIPTION:old('contest_video_description')}}">
                                           @error('contest_video_description') <label id="contest_video_description-error" class="error" for="contest_video_description">{{ $message }}</label> @enderror
                                        </div> --}}
                                     </div>
                                     <div class="form-group">
                                        <label>Terms & Conditions: </label>
                                     <textarea class="form-control" rows="6" name="contest_terms_conditions" id="contest_terms_conditions" placeholder="Terms & Conditions">{{!empty($contestData)?$contestData->CONTEST_TERMS_CONDITIONS:old('contest_terms_conditions')}}</textarea>
                                     </div>
                                     <button type="submit" id="update_create_contest" class="btn btn-warning waves-effect waves-light ml-1"><i class="far fa-edit mr-1"></i> Update</button>

                                     {{-- <button type="button" class="btn btn-dark waves-effect waves-light ml-1">
                                     <i class="mdi mdi-replay mr-1"></i>Reset</button> --}}
                                     <a href="" class="btn btn-dark waves-effect waves-light ml-1"><i class="mdi mdi-replay mr-1"></i> Reset</a>
                                  </form>
                               </div>
                               <!-- end card-body-->
                            </div>
                         </div>
                        <!-- /.card -->
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
        $(function() {
            bsCustomFileInput.init();
        });

        $(document).ready(function() {
            var max_fields = 1000; //maximum input boxes allowed
            var wrapper = $("#wrap-input"); //Fields wrapper
            var add_button = $("#add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e) { //on add input button click

                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="input-group"><input name="Game_steps[]" type="text" class="form-control username" placeholder="Game Steps " aria-label="Recipient`s username" required><div class="input-group-append"></button><button type="button" class="btn btn-danger btn-xs waves-effect waves-light remove_field"><i class="fa fa-trash"></i> </button></div><div class="invalid-feedback">Username Not exist..</div></div>&nbsp');
                }
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                // alert('dsads');
                // e.preventDefault();
                $(this).parents('.input-group').remove();
                // $(this).parent().parent().remove();

            })
        });
        // alerts
        // $(function() {
        //     var Toast = Swal.mixin({
        //         toast: true,
        //         position: 'top-end',
        //         showConfirmButton: false,
        //         timer: 3000
        //     });

        //     toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        //     toastr.error('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
        // });
    </script>
    @if($errors->any())
    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            // toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
            toastr.error("{{ implode('', $errors->all()) }}.</br>");
        });
    </script>
    @elseif(!empty(session('success')))

    <script>
        $(function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });

            toastr.success("{{ session('success') }}")

        });
    </script>
    @endif
</body>

</html>
