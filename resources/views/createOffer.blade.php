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
                            @if(!empty($type) && $type =="edit")
                            <h1>Edit Offer</h1>
                            @else
                            <h1>Create Offer</h1>
                            @endif

                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                @if(!empty($type) && $type =="edit")
                                <li class="breadcrumb-item active">Edit Offer</li>
                                @else
                                <li class="breadcrumb-item active">Create Offer</li>
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
                                    <h3 class="card-title">Edit Offer</h3>
                                    @else
                                    <h3 class="card-title">Create Offer</h3>
                                    @endif

                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="POST" action="{{ route('createOffer') }}" enctype="multipart/form-data">
                                    @csrf
                                    @if(!empty($type))
                                    <input type="hidden" name="editType" value="{{ !empty($type) ? $type : ''  }}">
                                    <input type="hidden" name="offerId" value="{{ !empty($offerData->OFFER_ID) ? $offerData->OFFER_ID : ''  }}">
                                    @endif
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Offer Type</label>
                                            <select name="offer_type" class="form-control select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                                <option selected="selected" data-select2-id="14">Select</option>
                                                <option value="1" {{ !empty(old('offer_type')) ? old('offer_type') == 1 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_TYPE) ? $offerData->OFFER_TYPE == 1 ? "selected" : ''  : ''  }}>Install</option>
                                                <option value="2" {{ !empty(old('offer_type')) ? old('offer_type') == 2 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_TYPE) ? $offerData->OFFER_TYPE == 2 ? "selected" : ''  : ''  }}>Register</option>
                                                <option value="3" {{ !empty(old('offer_type')) ? old('offer_type') == 3 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_TYPE) ? $offerData->OFFER_TYPE == 3 ? "selected" : ''  : ''  }}>Subscripption</option>
                                                <option value="4" {{ !empty(old('offer_type')) ? old('offer_type') == 4 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_TYPE) ? $offerData->OFFER_TYPE == 4 ? "selected" : ''  : ''  }}>View</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Offer Display Type</label>
                                            <select name="offer_dis_type" class="form-control select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                                <option selected="selected" data-select2-id="14">Select</option>
                                                <option value="1" {{ !empty(old('offer_dis_type')) ? old('offer_dis_type') == 1 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_DISPLAY_TYPE) ? $offerData->OFFER_DISPLAY_TYPE == 1 ? "selected" : ''  : ''  }}>All</option>
                                                <option value="2" {{ !empty(old('offer_dis_type')) ? old('offer_dis_type') == 2 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_DISPLAY_TYPE) ? $offerData->OFFER_DISPLAY_TYPE == 2 ? "selected" : ''  : ''  }}>Recomended</option>
                                                <option value="3" {{ !empty(old('offer_dis_type')) ? old('offer_dis_type') == 3 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_DISPLAY_TYPE) ? $offerData->OFFER_DISPLAY_TYPE == 3 ? "selected" : ''  : ''  }}>Hot</option>
                                                <option value="4" {{ !empty(old('offer_dis_type')) ? old('offer_dis_type') == 4 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_DISPLAY_TYPE) ? $offerData->OFFER_DISPLAY_TYPE == 4 ? "selected" : ''  : ''  }}>Special</option>
                                                <option value="5" {{ !empty(old('offer_dis_type')) ? old('offer_dis_type') == 5 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_DISPLAY_TYPE) ? $offerData->OFFER_DISPLAY_TYPE == 5 ? "selected" : ''  : ''  }}>Other</option>
                                                <option value="6" {{ !empty(old('offer_dis_type')) ? old('offer_dis_type') == 5 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_DISPLAY_TYPE) ? $offerData->OFFER_DISPLAY_TYPE == 6 ? "selected" : ''  : ''  }}>Sale</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Offer Category</label>
                                            <select name="offer_cat" class="form-control select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                                <option selected="selected" data-select2-id="14">Select</option>
                                                <option value="1" {{ !empty(old('offer_cat')) ? old('offer_cat') == 1 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_CATEGORY) ? $offerData->OFFER_CATEGORY == 1 ? "selected" : ''  : ''  }}>Cpi</option>
                                                <option value="2" {{ !empty(old('offer_cat')) ? old('offer_cat') == 2 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_CATEGORY) ? $offerData->OFFER_CATEGORY == 2 ? "selected" : ''  : ''  }}>Sale</option>
                                                <option value="3" {{ !empty(old('offer_cat')) ? old('offer_cat') == 3 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_CATEGORY) ? $offerData->OFFER_CATEGORY == 3 ? "selected" : ''  : ''  }}>Survey</option>
                                                <option value="4" {{ !empty(old('offer_cat')) ? old('offer_cat') == 4 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_CATEGORY) ? $offerData->OFFER_CATEGORY == 4 ? "selected" : ''  : ''  }}>Cps</option>
                                                <option value="5" {{ !empty(old('offer_cat')) ? old('offer_cat') == 5 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_CATEGORY) ? $offerData->OFFER_CATEGORY == 5 ? "selected" : ''  : ''  }}>Cpl</option>

                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Offer Name</label>
                                            <input type="text" name="offer_name" value="@if(!empty(old('offer_name'))) {{ old('offer_name') }} @else {{ !empty($offerData->OFFER_NAME) ? $offerData->OFFER_NAME : ''  }} @endif" class="form-control" i placeholder="Offer Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Offer Details</label>
                                            <input type="text" name="offer_details" value=" @if(!empty(old('offer_details'))) {{ old('offer_details') }} @else {{ !empty($offerData->OFFER_DETAILS) ? $offerData->OFFER_DETAILS : ''  }} @endif" class="form-control" i placeholder="Offer Details">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Offer Amount</label>
                                            <input type="text" name="offer_amount" value="@if(!empty(old('offer_amount'))) {{ old('offer_amount') }} @else{{ !empty($offerData->OFFER_AMOUNT) ? $offerData->OFFER_AMOUNT : ''  }} @endif" class="form-control" i placeholder="Offer Amount">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Offer Package</label>
                                            <input type="text" name="offer_package" value="@if(!empty(old('offer_package')))  {{ old('offer_package') }} @else {{ !empty($offerData->OFFER_PACKAGE) ? $offerData->OFFER_PACKAGE : ''  }} @endif" class="form-control" i placeholder="Offer Package">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Offer Thumbnail</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" accept="image/*" name="offer_thumb" value="{{ old('offer_thumb') }} {{ !empty($offerData->OFFER_THUMBNAIL) ? $offerData->OFFER_THUMBNAIL : ''  }}" class="custom-file-input">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                            @if(!empty($offerData->OFFER_BANNER))
                                            <img style="height:50px; width:100px" src="{{url('images/thumb/'.$offerData->OFFER_THUMBNAIL)}}">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">Offer Banner</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" accept="image/*" name="offer_banner" value="{{ old('offer_banner') }} {{ !empty($offerData->OFFER_BANNER) ? $offerData->OFFER_BANNER : ''  }}" class="custom-file-input">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                            @if(!empty($offerData->OFFER_BANNER))
                                            <img style="height:50px; width:100px" src="{{url('images/banner/'.$offerData->OFFER_BANNER)}}">
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Offer Url</label>
                                            <input type="text" name="offer_url" value="@if(!empty(old('offer_url')))  {{ old('offer_url') }} @else {{ !empty($offerData->OFFER_URL) ? $offerData->OFFER_URL : ''  }} @endif" class="form-control" i placeholder="Offer Url">
                                        </div>
                                        <div class="form-group">
                                            <label>Offer Os</label>
                                            <select name="offer_os" class="form-control select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                                <option selected="selected" data-select2-id="14">Select</option>
                                                <option value="1" {{ !empty(old('offer_os')) ? old('offer_os') == 1 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_OS) ? $offerData->OFFER_OS == 1 ? "selected" : ''  : ''  }}>Android</option>
                                                <option value="2" {{ !empty(old('offer_os')) ? old('offer_os') == 2 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_OS) ? $offerData->OFFER_OS == 2 ? "selected" : ''  : ''  }}>Ios</option>
                                                <option value="3" {{ !empty(old('offer_os')) ? old('offer_os') == 3 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_OS) ? $offerData->OFFER_OS == 3 ? "selected" : ''  : ''  }}>Web</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Offer Origin</label>
                                            <select name="offer_origin" class="form-control select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                                <option selected="selected" data-select2-id="14">Select</option>
                                                <option value="1" {{ !empty(old('offer_origin')) ? old('offer_origin') == 1 ? "selected" : ''  : ''  }} {{ !empty($offerData->	OFFER_ORIGIN) ? $offerData->OFFER_ORIGIN == 1 ? "selected" : ''  : ''  }}>All</option>
                                                <option value="2" {{ !empty(old('offer_origin')) ? old('offer_origin') == 2 ? "selected" : ''  : ''  }} {{ !empty($offerData->	OFFER_ORIGIN) ? $offerData->OFFER_ORIGIN == 2 ? "selected" : ''  : ''  }}>India</option>
                                                <option value="3" {{ !empty(old('offer_origin')) ? old('offer_origin') == 3 ? "selected" : ''  : ''  }} {{ !empty($offerData->	OFFER_ORIGIN) ? $offerData->OFFER_ORIGIN == 3 ? "selected" : ''  : ''  }}>Internal</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Offer Cap</label>
                                            <input type="text" name="offer_cap" value=" @if(!empty(old('offer_package'))) {{ old('offer_cap') }} @else {{ !empty($offerData->CAP) ? $offerData->CAP : ''  }} @endif" class="form-control" i placeholder="Offer Cap">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Offer Max Cap</label>
                                            <input type="text" name="offer_max_cap" value=" @if(!empty(old('offer_max_cap'))) {{ old('offer_max_cap') }} @else {{ !empty($offerData->MAX_CAP) ? $offerData->MAX_CAP : ''  }} @endif" class="form-control" i placeholder="Offer max Cap">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fall Back Url</label>
                                            <input type="text" name="fall_url" value="@if(!empty(old('fall_url')))  {{ old('fall_url') }} @else {{ !empty($offerData->FALLBACK_URL) ? $offerData->FALLBACK_URL : ''  }} @endif" class="form-control" i placeholder="Fall Back Url">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Start From</label>
                                            <input type="date" name="start_from" value="@if(!empty(old('start_from'))) {{ date("YYYY-dd-mm", strtotime(old('start_from'))) }}@else{{!empty($offerData->STARTS_FROM)?date_format(date_create($offerData->STARTS_FROM),"Y-m-d"):''}}@endif" class="form-control" i placeholder="Start from">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Ends On</label>
                                            <input type="date" name="ends_on" value="@if(!empty(old('ends_on'))) {{ date("YYYY-dd-mm", strtotime(old('ends_on'))) }}@else{{!empty($offerData->ENDS_ON)?date_format(date_create($offerData->ENDS_ON),"Y-m-d"):''}}@endif" class="form-control" i placeholder="Ends On">
                                        </div>
                                        <!-- <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                        </div> -->
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                                <option selected="selected" data-select2-id="14">Select</option>
                                                <option value="1" {{ !empty(old('status')) ? old('status') == 1 ? "selected" : ''  : ''  }} {{ !empty($offerData->STATUS) ? $offerData->STATUS == 1 ? "selected" : ''  : ''  }}>Active</option>
                                                <option value="2" {{ !empty(old('status')) ? old('status') == 2 ? "selected" : ''  : ''  }} {{ !empty($offerData->STATUS) ? $offerData->STATUS == 2 ? "selected" : ''  : ''  }}>Inactive</option>
                                                <option value="3" {{ !empty(old('status')) ? old('status') == 3 ? "selected" : ''  : ''  }} {{ !empty($offerData->STATUS) ? $offerData->STATUS == 3 ? "selected" : ''  : ''  }}>Deleted</option>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Offer App</label>
                                            <select name="offer_app" class="form-control select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                                <option selected="selected" data-select2-id="14">Select</option>
                                                <option value="1" {{ !empty(old('offer_app')) ? old('offer_app') == 1 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_APP) ? $offerData->OFFER_APP == 1 ? "selected" : ''  : ''  }}>All</option>
                                                <option value="2" {{ !empty(old('offer_app')) ? old('offer_app') == 2 ? "selected" : ''  : ''  }} {{ !empty($offerData->OFFER_APP) ? $offerData->OFFER_APP == 2 ? "selected" : ''  : ''  }}>Domain</option>


                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Audience Gender</label>
                                            <select name="aud_gen" class="form-control select2 select2-danger select2-hidden-accessible" data-dropdown-css-class="select2-danger" style="width: 100%;" data-select2-id="12" tabindex="-1" aria-hidden="true">
                                                <option selected="selected" data-select2-id="14">Select</option>
                                                <option value="1" {{ !empty(old('aud_gen')) ? old('aud_gen') == 1 ? "selected" : ''  : ''  }} {{ !empty($offerData->TAR_AUDIENCE) ? $offerData->TAR_AUDIENCE == 1 ? "selected" : ''  : ''  }}>All</option>
                                                <option value="2" {{ !empty(old('aud_gen')) ? old('aud_gen') == 2 ? "selected" : ''  : ''  }} {{ !empty($offerData->TAR_AUDIENCE) ? $offerData->TAR_AUDIENCE == 2 ? "selected" : ''  : ''  }}>Male</option>
                                                <option value="3" {{ !empty(old('aud_gen')) ? old('aud_gen') == 2 ? "selected" : ''  : ''  }} {{ !empty($offerData->TAR_AUDIENCE) ? $offerData->TAR_AUDIENCE == 3 ? "selected" : ''  : ''  }}>Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Offer State</label>
                                            <input type="text" name="offer_state" value="@if(!empty(old('offer_state')))  {{ old('offer_state') }} @else {{ !empty($offerData->TAR_STATE) ? $offerData->TAR_STATE : ''  }} @endif" class="form-control" i placeholder="State to be target">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Offer Instruction</label>
                                            <input type="text" name="offer_ins" value="@if(!empty(old('offer_ins')))  {{ old('offer_ins') }} @else {{ !empty($offerData->OFFER_INSTRUCTIONS) ? $offerData->OFFER_INSTRUCTIONS : ''  }} @endif" class="form-control" i placeholder="Offer Instruction">
                                        </div>
                                        <div class="form-group" id="wrap-input">
                                            <label for="example-select">Offer Steps</label>
                                            @if(!empty($offerData->OFFER_STEPS))
                                            @foreach(json_decode($offerData->OFFER_STEPS) as $offerSteps)
                                            <div class="input-group "><input name="offer_steps[]" type="text" class="form-control username" value="{{ str_replace('offerSteps":"', '',$offerSteps->offerSteps) }}" placeholder="Ex. Steps@#100" aria-label="Offer Steps" required>
                                                <div class="input-group-append"><button type="button" id="add_field_button" class="btn btn-blue btn-xs waves-effect waves-light mr-1"><i class="fa fa-plus"></i> </button>
                                                </div>
                                            </div>&nbsp
                                            @endforeach
                                            @else
                                            <div class="input-group "><input name="offer_steps[]" type="text" class="form-control username" value="" placeholder="Ex. Steps@#100" aria-label="Offer Steps" required>
                                                <div class="input-group-append"><button type="button" id="add_field_button" class="btn btn-blue btn-xs waves-effect waves-light mr-1"><i class="fa fa-plus"></i> </button>
                                                </div>

                                            </div>&nbsp
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
                    $(wrapper).append('<div class="input-group"><input name="offer_steps[]" type="text" class="form-control username" placeholder="Offer Steps " aria-label="Recipient`s username" required><div class="input-group-append"></button><button type="button" class="btn btn-danger btn-xs waves-effect waves-light remove_field"><i class="fa fa-trash"></i> </button></div><div class="invalid-feedback">Username Not exist..</div></div>&nbsp');
                }
            });

            $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                // alert('dsads');
                // e.preventDefault();
                $(this).parents('.input-group').remove();
                // $(this).parent().parent().remove();

            })
        });
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
