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
                            <h1>Withdraw List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Withdraw List</li>
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
                                                <th>Sl No.</th>
                                                <th>Select</th>
                                                <th>Name</th>
                                                <th>Balance Type</th>
                                                <th>Status</th>
                                                <th>Type</th>
                                                <th>Payout Coin</th>
                                                <th>Payout Email</th>
                                                <th>Pay Mode</th>
                                                <th>Date</th>
                                                <th>Internal Refference No</th>
                                                <th>Payout No</th>
                                                <th>Current Tot Bal</th>
                                                <th>Closing Tot Bal</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($withdrawatas))
                                            @foreach($withdrawatas as $withdrawata)
                                            <tr>
                                                <td>{{ $loop->iteration }} </td>
                                                @if($withdrawata->TRANSACTION_STATUS_NAME == "Withdraw Pending")
                                                <td class="td-refNoCheckBoxSelect">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input class="checkbox" value="{{ $withdrawata->INTERNAL_REFERENCE_NO }}" id="refNoCheckBoxSelect" name="refNoCheckBoxSelect" type="checkbox" id="checkboxPrimary1">
                                                            <label for="checkboxPrimary1">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                @elseif($withdrawata->TRANSACTION_STATUS_NAME == "Withdraw Success")
                                                <td class="td-refNoCheckBoxSelect">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="checkbox" disabled>
                                                            <label for="checkboxPrimary1">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                                @endif
                                                <td>{{ $withdrawata->SOCIAL_NAME }}</td>
                                                <td>{{ $withdrawata->BALANCE_TYPE }}</td>

                                                @if($withdrawata->TRANSACTION_STATUS_NAME == "Withdraw Success")
                                                <td><button class="btn btn-block btn-success btn-sm">Success</button></td>
                                                @elseif($withdrawata->TRANSACTION_STATUS_NAME == "Withdraw Pending")
                                                <td><button class="btn btn-block btn-warning btn-sm">Pending</button></td>
                                                @else
                                                <td>Null</td>
                                                @endif
                                                <td>{{ $withdrawata->TRANSACTION_TYPE_NAME }}</td>
                                                <td>{{ $withdrawata->PAYOUT_COIN }}</td>
                                                <td>{{ $withdrawata->PAYOUT_EMIAL }}</td>
                                                <td>{{ $withdrawata->PAY_MODE }}</td>
                                                <td>{{ $withdrawata->TRANSACTION_DATE }}</td>
                                                <td>{{ $withdrawata->INTERNAL_REFERENCE_NO }}</td>
                                                <td>{{ $withdrawata->PAYOUT_NUMBER }}</td>
                                                <td>{{ $withdrawata->CURRENT_TOT_BALANCE }}</td>
                                                <td>{{ $withdrawata->CLOSING_TOT_BALANCE }}</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"></div>
                                        <div class="col-sm-12 col-md-6">

                                            {{ $withdrawatas->render("pagination::default") }}
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        <button style="display:none" type="submit" id="withdraw_approve" class="btn btn-info">Approve</button>
                                        <button style="display:none"  id="withdraw_approve_loader" class="btn btn-info">Processing..</button>
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
