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
                            <h1>Coverted Offer List</h1>
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
                                                <th>Offer Name</th>
                                                <th>Click Id</th>
                                                <th>Converted On</th>
                                                <th>Offer Amount</th>
                                                <th>Converted By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($offerConvertData))
                                            @foreach($offerConvertData as $convertedOffer)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                <td>{{ $convertedOffer->OFFER_NAME }}</td>
                                                <td>{{ $convertedOffer->CLICK_ID }}</td>
                                                <td>{{ $convertedOffer->CLICKED_ON }}</td>
                                                <td>{{ $convertedOffer->OFFER_AMOUNT }}</td>
                                                <td>{{ $convertedOffer->USER_NAME ?? "N\A" }}</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"></div>
                                        <div class="col-sm-12 col-md-6">

                                            {{ $offerConvertData->render("pagination::default") }}
                                        </div>

                                    </div>
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
            jQuery('#withdraw_approve').click(function(e) {
                $('#withdraw_approve').hide();
                $('#withdraw_approve_loader').show();

                e.preventDefault();
                var tableData = getRefNoAndWoffValueFromTable();
                //    $.ajaxSetup({
                //       headers: {
                //           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                //       }
                //   });
                jQuery.ajax({
                    url: "{{ url('/witdrawApprove') }}",
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        tableData: tableData,

                    },
                    success: function(result) {
                        location.reload();
                    }
                });
            });
        });

        //if selected any checkbox then action button will show
        $(document).on('change', '.checkbox', function(e) {
            var len = $(document).find(".td-refNoCheckBoxSelect input:checked").length;
            if (len > 0) {
                $('#withdraw_approve').show();
            }
            if (len <= 0) {
                $('#withdraw_approve').hide();
            }
        });

        function getRefNoAndWoffValueFromTable() {
            var arr = [];
            $("input[name='refNoCheckBoxSelect']:checked").each(function() {
                var tempObj = {};
                var _el_tr = $(this).closest('tr');
                tempObj.refNo = $(this).val();
                tempObj.wo = _el_tr.find(".td-woff").find("input").prop("checked");
                tempObj.cs = _el_tr.find(".comment-status").find("input").val();
                tempObj.checkedBox = $(this).prop("checked");
                // tempObj.srno =srNO_val;
                arr.push(tempObj);
            });
            return arr;
        }
    </script>
</body>

</html>
