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
                        <div class="col-sm-3">
                            @if(!empty($type) && $type =="edit")
                            <h1>Edit Popup</h1>
                            @else
                            <h1>Create Popup</h1>
                            @endif

                        </div>
                        <div class="col-sm-9">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                @if(!empty($type) && $type =="edit")
                                <li class="breadcrumb-item active">Edit Popup</li>
                                @else
                                <li class="breadcrumb-item active">Create Popup</li>
                                @endif

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
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">

                                    @if(!empty($type) && $type =="edit")
                                    <h3 class="card-title">Edit Popup</h3>
                                    @else
                                    <h3 class="card-title">Create Popup</h3>
                                    @endif

                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" action="{{ route('createPopup') }}" enctype="multipart/form-data">
                                    @csrf
                                    @if(!empty($type))
                                    <input type="hidden" name="editType" value="{{ !empty($type) ? $type : ''  }}">
                                    <input type="hidden" name="id" value="{{ !empty($gameData->ID) ? $gameData->ID : ''  }}">
                                    @endif
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Heading</label>
                                            <input type="text" name="name" value="@if(!empty(old('name'))) {{ old('name') }} @else {{ !empty($gameData->HEADING) ? $gameData->HEADING : ''  }} @endif" class="form-control" i placeholder="Banner Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Message</label>
                                            <input type="text" name="message" value="@if(!empty(old('name'))) {{ old('name') }} @else {{ !empty($gameData->MESSAGE) ? $gameData->MESSAGE : ''  }} @endif" class="form-control" i placeholder="Banner Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Action Url</label>
                                            <input type="text" name="url" value="@if(!empty(old('url'))) {{ old('url') }} @else{{ !empty($gameData->ACTION_URL) ? $gameData->ACTION_URL : ''  }} @endif" class="form-control" i placeholder="Game Amount">
                                        </div>

                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                                <option selected="selected" data-select2-id="14">Select</option>
                                                <option value="1" {{ !empty(old('status')) ? old('status') == 1 ? "selected" : ''  : ''  }} {{ !empty($gameData->STATUS) ? $gameData->STATUS == 1 ? "selected" : ''  : ''  }}>Active</option>
                                                <option value="2" {{ !empty(old('status')) ? old('status') == 2 ? "selected" : ''  : ''  }} {{ !empty($gameData->STATUS) ? $gameData->STATUS == 2 ? "selected" : ''  : ''  }}>Inactive</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Show Button</label>
                                            <select name="is_botton" class="form-control select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                                <option selected="selected" data-select2-id="14">Select</option>
                                                <option value="1" {{ !empty(old('is_botton')) ? old('is_botton') == 1 ? "selected" : ''  : ''  }} {{ !empty($gameData->IS_BUTTON) ? $gameData->IS_BUTTON == 1 ? "selected" : ''  : ''  }}>Yes</option>
                                                <option value="2" {{ !empty(old('is_botton')) ? old('is_botton') == 2 ? "selected" : ''  : ''  }} {{ !empty($gameData->IS_BUTTON) ? $gameData->IS_BUTTON == 2 ? "selected" : ''  : ''  }}>No</option>


                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputFile">Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" accept="image/*" name="image" value="{{ old('image') }} {{ !empty($gameData->THUMBNAIL) ? $gameData->THUMBNAIL : ''  }}" class="custom-file-input">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                            @if(!empty($gameData->THUMBNAIL))
                                            <img style="height:50px; width:100px" src="{{url('images/games/'.$gameData->THUMBNAIL)}}">
                                            @endif
                                        </div>
                                    </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>


                            </form>
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
