<style>
    #tbl_sales th,
    #tbl_sales td {
        text-align: center;
        text-transform: uppercase;
    }

    #tbl_sales th:nth-child(6) {
        background: var(--bs-lightgreen);
        color: #fff;
    }
    #tbl_sales th:nth-child(7) {
        background: var(--bs-red);
        color: #fff;
    }

    #tbl_sales th:nth-child(11),
    #tbl_sales td:nth-child(11),
    #tbl_sales th:nth-child(12),
    #tbl_sales td:nth-child(12),
    #tbl_sales th:nth-child(13),
    #tbl_sales td:nth-child(13) {
        background: var(--bs-yellow);
        color: #2d3436;
    }

</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pb-3 main-section" style="background: #8F3F96;">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mt-2 text-white">Sales & Transaction</h2>
                    <p class="text-green fw-bold mb-0">User Permission</p>
                    <ol class="breadcrumb text-white">
                        <li class="breadcrumb-item">Dashboard Modules</li>
                        <li class="breadcrumb-item">GM Board</li>
                        <li class="breadcrumb-item">TM Analytics</li>
                        <li class="breadcrumb-item">Customer Registration</li>
                    </ol>
                </div>
                <div class="col-md-4 text-end">
                    <h2 class="mt-2 text-yellow"><span id="clock" class="fw-bold"></h2>
                    <h5 class="text-white"><span id="date" class="fw-bold"></span></h5>
                    <a href="<?= base_url('main/logout') ?>" class="btn-signout">SIGN OUT <i class="bi bi-box-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 mt-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" id="search_value" class="form-control form-control-sm" placeholder="Search Here(Serial, Name, Parent)">
                </div>
                <div class="col-md-4">
                    <div class="row g-1">
                        <div class="col-sm-6">
                            <select name="filter_by" id="filter_by" class="form-select form-select-sm">
                                <option value="">Filter by</option>
                                <option value="INFLATABLES">Inflatables</option>
                                <option value="PARK">Park</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select name="sort_by" id="sort_by" class="form-select form-select-sm">
                                <option value="">Sort by</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group input-group-sm mb-3">
                                <label class="input-group-text">From</label>
                                <input type="date" class="form-control form-control-sm" id="dt_from">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group input-group-sm mb-3">
                                <label class="input-group-text">To</label>
                                <input type="date" class="form-control form-control-sm" id="dt_to">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row g-0">
                        <div class="col-sm-3 mb-2">
                            <button class="btn btn-dark btn-sm" id="print_reports">PRINT RECORDS</button>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-info btn-sm" id="export_files">EXPORT THIS FILE</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered TEXT-UPPERCASE" width="100%" id="tbl_sales">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Transaction #</th>
                            <th>Serial #</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>TIME IN</th>
                            <th>TIME OUT</th>
                            <!-- <th>Guest name</th> -->
                            <th>Status</th>
                            <th>Parent / Guardian</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>Inventory</th>
                            <th>Discount</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <hr>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="fw-bold text-center">
                        Total Number of Transaction
                        <h1><b id="no_transaction"></b></h1>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                           
                            <div class="text-end">
                            Sales:
                                <b id="total_amount"></b>
                            </div>
  
                            <div class="text-end">
                            Inventory Sales:
                                <b id="total_inv"></b>
                            </div>

                            <div class="text-end">
                            Discount:
                                <b id="total_discount"></b>
                            </div>

                            <hr class="mt-0 mb-2">
                            <b>Total Sales:</b>
                            <span class="ms-3 ps-3"><b id="total_sales"></b></span>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Main div -->
    </main>

    <!-- Modal -->
    <div class="modal fade" id="transactionModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #8E3C95; color:#fff;">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-file-earmark-text-fill me-2"></i>TRANSACTION FORMS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="trans_no">
                    <div class="text-end">
                        <small id="date_added"></small>
                    </div>
                    <div class="box-header text-white parent_info" style="background: #8F3F96;">
                        PARENT / GUARDIAN INFORMATION
                    </div>
                    <div id="parent_info"></div>
                    
                    <div class="box-header children_info">
                        CHILD / KIDS INFORMATION
                    </div>
                    <div id="children_info"></div>
                    

                    <div id="time_info"></div>
                    
                    <hr>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal -->
    <div class="modal fade" id="viewModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #8E3C95; color:#fff;">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-file-earmark-text-fill me-2"></i>VIEW TRANSACTION</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-end">
                        <small id="date_data"></small>
                    </div>
                    <div class="box-header text-white parent_data" style="background: #8F3F96;">
                        PARENT / GUARDIAN INFORMATION
                    </div>
                    <div id="parent_data"></div>
                    
                    <div class="box-header children_data">
                        CHILD / KIDS INFORMATION
                    </div>
                    <div id="children_data"></div>
                    
                    <div id="time_data"></div>
                    
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="voidModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #8E3C95; color:#fff;">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-file-earmark-text-fill me-2"></i>VOID TRANSACTION</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="background-color: #8E3C95; color:#fff;">
                    <input type="password" class="form-control" id="passcode" placeholder="ENTER YOUR PASSCODE">
                    <input type="hidden" id="transaction_no">
                    <div class="mt-2">
                        <button class="btn btn-danger btn-sm w-100" id="void_trans">VOID TRANSACTION</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="py-3 text-white mt-auto" style="background: #8F3F96;">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
            <div class="text-white">Copyright &copy; Jacks Adventure  2023</div>
            </div>
        </div>
    </footer>
</div>

</div>
<!-- End of layoutSidenav -->

<script>
    $(document).ready(function() {
        $('#loading').show();
        setTimeout(function() {
            $('#loading').hide();
        }, 2000);
        var tbl_sales = $('#tbl_sales').DataTable({
            "fnRowCallback": function(nRow, aData, iDisplayIndex, asd) {
                if (aData[13] == 'Voided') { // less than 5 minutes
                    $('td', nRow).css('background-color', 'rgba(249, 187, 191, 0.8)');
                }
            },
            language: {
                search: '',
                searchPlaceholder: "Search Here...",
                "info": "_START_-_END_ of _TOTAL_ entries",
                paginate: {
                    next: '<i class="fas fa-chevron-right"></i>',
                    previous: '<i class="fas fa-chevron-left"></i>'
                }
            },
            "info": false,
            "searching": false,
            "ordering": false,
            "bLengthChange": false,
            "serverSide": true,
            "processing": true,
            "pageLength": 25,
            "deferRender": true,
            "ajax": {
                "url": "<?= base_url('transaction/get_sales') ?>",
                "type": "POST",
                "data": function(data) {
                    data.search_value = $('#search_value').val();
                    data.filter_by = $('#filter_by').val();
                    data.from = $('#dt_from').val();
                    data.to = $('#dt_to').val();
                },
                "dataSrc": function(json) {
                    $('#total_amount').text('₱ ' + json.totalAmount);
                    $('#total_inv').text('₱ ' + json.totalInv);
                    $('#total_sales').text('₱ ' + json.totalSales);
                    $('#total_discount').text('₱ -' + json.total_discount);
                    $('#no_transaction').text(json.no_transaction);
                return json.data;
                }
            },
        });
        $('#search_value').on('input', function() {
            tbl_sales.draw();
        });
        $('#filter_by').on('change', function () {
            tbl_sales.draw();
        });
        $('#dt_from').on('change', function() {
            if ($('#dt_from').val() > $('#dt_to').val() && $('#dt_to').val() != '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Date Range,Please Check the date. Thank you!',
                });
                $('#dt_from').val('');
            } else {
                tbl_sales.draw();
            }
        });
        $('#dt_to').on('change', function() {
            if ($('#dt_to').val() < $('#dt_from').val()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Date Range,Please Check the date. Thank you!',
                });
                $('#dt_to').val('');
            } else {
                tbl_sales.draw();
            }
        });

        // var total = 0;
        // tbl_sales.column(11).data().each(function(amount) {
        //     total += parseFloat(amount);
        // });
        // console.log(total);

        $(document).on('click', '.void', function(){
            var serial_no = $(this).attr('id');
            var service = $(this).data('service');
            var trans_no = $(this).data('trans');
            switch (service) {
                case 'INFLATABLES':
                     $('.children_info').show(200);
                     $('.parent_info').text('PARENT / GUARDIAN INFORMATION');
                    break;
            
                case 'PARK':
                    $('.children_info').hide(200);
                    $('.parent_info').text('GUEST INFORMATION');
                    break;
            }
            $.ajax({
                url: "<?= base_url('transaction/get_guest_data')?>",
                method: "POST",
                data: {
                    serial_no: serial_no,
                    service: service
                },
                dataType: "json",
                success: function(data) {
                    $('#children_info').html(data.children_info);
                    $('#parent_info').html(data.parent_guardian);
                    $('#time_info').html(data.time_info);
                    $('#date_added').html(data.date_added);
                    $('#transactionModal').modal('show');
                    $('#trans_no').val(trans_no);
                }
            });
        });

        $(document).on('click', '.view', function(){
            var serial_no = $(this).attr('id');
            var service = $(this).data('service');
            var con_id = $(this).data('con_id');
            switch (service) {
                case 'INFLATABLES':
                     $('.children_info').show(200);
                     $('.parent_info').text('PARENT / GUARDIAN INFORMATION');
                    break;
            
                case 'PARK':
                    $('.children_info').hide(200);
                    $('.parent_info').text('GUEST INFORMATION');
                    break;
            }
            $.ajax({
                url: "<?= base_url('transaction/get_guest_info')?>",
                method: "POST",
                data: {
                    serial_no: serial_no,
                    service: service,
                    con_id: con_id
                },
                dataType: "json",
                success: function(data) {
                    $('#children_data').html(data.children_info);
                    $('#parent_data').html(data.parent_guardian);
                    $('#time_data').html(data.time_info);
                    $('#date_data').html(data.date_added);
                    $('#viewModal').modal('show');
                }
            });
        });

        $(document).on('click', '.print', function(){
            var serial_no = $(this).attr('id');
            var url = "<?= base_url('sales_invoice?transaction=')?>" + serial_no;
            window.open(url, 'targetWindow','resizable=yes,width=1000,height=1000');
        });

        $(document).on('click', '#print_reports', function() {
            var dt_from = $('#dt_from').val();
            var dt_to = $('#dt_to').val();
            var url = "<?= base_url('transaction/sales_report/');?>" + dt_from + '/' + dt_to ;
            window.open(url, 'targetWindow','resizable=yes,width=1000,height=1000');
        });

        $(document).on('click', '#export_files', function() {
            var url = "<?= base_url('time_monitoring/export_time_monitoring');?>";
            window.location.href = url;
        });

        $(document).on('click', '.void_trans', function() {
            var trans_no = $('#trans_no').val();
            $('#transaction_no').val(trans_no);
            $('#voidModal').modal('show');

            // Swal.fire({
            //     title: 'Are you sure?',
            //     text: "You want to void this transaction!",
            //     icon: 'question',
            //     showCancelButton: true,
            //     confirmButtonColor: '#3085d6',
            //     cancelButtonColor: '#d33',
            //     confirmButtonText: 'Yes'
            // }).then((result) => {
            //     if (result.isConfirmed) {
            //         $.ajax({
            //             url: "<?= base_url('transaction/void_trans')?>",
            //             method: "POST",
            //             data: {
            //                 trans_no: trans_no
            //             },
            //             dataType: "json",
            //             success: function(data) {
            //                 if (data.message == 'Success') {
            //                     Swal.fire(
            //                         'Thank you!',
            //                         'Void successfully.',
            //                         'success'
            //                     );
            //                 } else {
            //                     Swal.fire(
            //                         'Warning!',
            //                         'Failed to void.',
            //                         'warning'
            //                     );
            //                 }
            //             }
            //         });
            //     }
            // })
        });

        $(document).on('click', '#void_trans', function() {
            var trans_no = $('#transaction_no').val();
            var passcode = $('#passcode').val();
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to void this transaction!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('transaction/void_trans')?>",
                        method: "POST",
                        data: {
                            trans_no: trans_no,
                            passcode: passcode
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.message == 'Success') {
                                Swal.fire(
                                    'Thank you!',
                                    'Void successfully.',
                                    'success'
                                );
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            } else {
                                Swal.fire(
                                    'Warning!',
                                    'Failed to void. Check your password.',
                                    'warning'
                                );
                            }
                        }
                    });
                }
            })
        });
    });
</script>