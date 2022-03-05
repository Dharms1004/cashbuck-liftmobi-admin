@include('common.head')

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
                            <h1>Offer List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Offer List</li>
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
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S No.</th>
                                                <th>Offer Id</th>
                                                <th>Type</th>
                                                <th>Display Type</th>
                                                <th>Ctegory</th>
                                                <th>Name</th>
                                                <th>Details</th>
                                                <th>Steps</th>
                                                <th>Amount</th>
                                                <th>Package</th>
                                                <th>Thumbnail</th>
                                                <th>Banner</th>
                                                <th>Url</th>
                                                <th>Os</th>
                                                <th>Origin</th>
                                                <th>Cap</th>
                                                <th>Fallback</th>
                                                <th>Start</th>
                                                <th>End</th>
                                                <th>Status</th>
                                                <th>Off App</th>
                                                <th>Instruction</th>
                                                <th>Date</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($promodatas))
                                            @foreach($promodatas as $promodata)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $promodata->OFFER_ID }} </td>
                                                @if($promodata->OFFER_TYPE == 1)
                                                <td>Install</td>
                                                @elseif($promodata->OFFER_TYPE == 2)
                                                <td>Register</td>
                                                @elseif($promodata->OFFER_TYPE == 3)
                                                <td>Subscription</td>
                                                @elseif($promodata->OFFER_TYPE == 4)
                                                <td>View</td>
                                                @else
                                                <td>Null</td>
                                                @endif

                                                @if($promodata->OFFER_DISPLAY_TYPE == 1)
                                                <td>All</td>
                                                @elseif($promodata->OFFER_DISPLAY_TYPE == 2)
                                                <td>Recomended</td>
                                                @elseif($promodata->OFFER_DISPLAY_TYPE == 3)
                                                <td>Hot</td>
                                                @elseif($promodata->OFFER_DISPLAY_TYPE == 4)
                                                <td>Special</td>
                                                @elseif($promodata->OFFER_DISPLAY_TYPE == 4)
                                                <td>Oth</td>
                                                @else
                                                <td>Null</td>
                                                @endif

                                                @if($promodata->OFFER_CATEGORY == 1)
                                                <td>CPI</td>
                                                @elseif($promodata->OFFER_CATEGORY == 2)
                                                <td>SALE</td>
                                                @elseif($promodata->OFFER_CATEGORY == 3)
                                                <td>SURVEY</td>
                                                @else
                                                <td>Null</td>
                                                @endif

                                                <td>{{ $promodata->OFFER_NAME }}</td>
                                                <td>{{ $promodata->OFFER_DETAILS }}</td>
                                                <td>{{ $promodata->OFFER_STEPS }}</td>
                                                <td>{{ $promodata->OFFER_AMOUNT }}</td>
                                                <td>{{ $promodata->OFFER_PACKAGE }}</td>
                                                <td><img style="height:50px; width:100px" src="{{url('images/thumb/'.$promodata->OFFER_THUMBNAIL)}}"></td>
                                                <td><img style="height:50px; width:100px" src="{{url('images/banner/'.$promodata->OFFER_BANNER)}}"></td>
                                                <td>{{ $promodata->OFFER_URL }}</td>

                                                @if($promodata->OFFER_OS == 1)
                                                <td>Android</td>
                                                @elseif($promodata->OFFER_OS == 2)
                                                <td>Ios</td>
                                                @elseif($promodata->OFFER_OS == 3)
                                                <td>Web</td>
                                                @else
                                                <td>Null</td>
                                                @endif

                                                @if($promodata->OFFER_ORIGIN == 1)
                                                <td>All</td>
                                                @elseif($promodata->OFFER_ORIGIN == 2)
                                                <td>India</td>
                                                @elseif($promodata->OFFER_ORIGIN == 3)
                                                <td>Internal</td>
                                                @else
                                                <td>Null</td>
                                                @endif



                                                <td>{{ $promodata->CAP }}</td>
                                                <td>{{ $promodata->FALLBACK_URL }}</td>
                                                <td>{{ $promodata->STARTS_FROM }}</td>
                                                <td>{{ $promodata->ENDS_ON }}</td>

                                                @if($promodata->STATUS == 1)
                                                <td><button type="button" data-offer-id="{{ $promodata->OFFER_ID }}" class="btn btn-block btn-success btn-sm">Active</button></td>
                                                @elseif($promodata->STATUS == 2)
                                                <td><button type="button" data-offer-id="{{ $promodata->OFFER_ID }}" class="btn btn-block btn-danger btn-sm">Inactive</button></td>
                                                @elseif($promodata->STATUS == 3)
                                                <td><button type="button" class="btn btn-block btn-danger btn-sm">Deleted</button></td>
                                                @else
                                                <td>Null</td>
                                                @endif

                                                @if($promodata->OFFER_APP == 1)
                                                <td>All</td>
                                                @elseif($promodata->OFFER_APP == 2)
                                                <td>Domain</td>
                                                @else
                                                <td>Null</td>
                                                @endif
                                                <td>{{ $promodata->OFFER_INSTRUCTIONS }}</td>
                                                <td>{{ $promodata->CREATED_AT }}</td>
                                                <td><a href="{{ route('createOffer') }}?type=edit&offerId={{ $promodata->OFFER_ID }}" class="btn btn-app"><i class="fas fa-edit"></i> Edit</a></td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6">

                                    {{ $promodatas->render("pagination::default") }}
                                </div>

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
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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


        jQuery(document).ready(function(){
            jQuery('.btn-block').click(function(e){
               e.preventDefault();
               var offer_id=$(this).attr("data-offer-id");
            //    $.ajaxSetup({
            //       headers: {
            //           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            //       }
            //   });
               jQuery.ajax({
                  url: "{{ url('/updateOfferStatus') }}",
                  method: 'post',
                  data: {
                    "_token": "{{ csrf_token() }}",
                    offer_id: offer_id,

                  },
                  success: function(result){
                    location.reload();
                  }});
               });
            });
    </script>
</body>

</html>
