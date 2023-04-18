<style>
    #tbl_sales th,
    #tbl_sales td {
        text-align: center;
        text-transform: uppercase;
    }

    #tbl_sales th:nth-child(7) {
        background: var(--bs-lightgreen);
        color: #fff;
    }
    #tbl_sales th:nth-child(8) {
        background: var(--bs-red);
        color: #fff;
    }

    #tbl_sales th:nth-child(12),
    #tbl_sales td:nth-child(12) {
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
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select name="sort_by" id="sort_by" class="form-select form-select-sm">
                                <option value="">Sort by</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" name="dt_from" id="dt_from" placeholder="Date From">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control form-control-sm" name="dt_to" id="dt_to" placeholder="Date To">
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="row g-0">
                        <div class="col-sm-3 mb-2">
                            <button class="btn btn-dark btn-sm">PRINT RECORDS</button>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-info btn-sm">EXPORT THIS FILE</button>
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
                            <th>Rem. Time</th>
                            <th>TIME IN</th>
                            <th>TIME OUT</th>
                            <th>Guest name</th>
                            <th>Parent / Guardian</th>
                            <th>Qty</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td>
                                <button class="btn btn-secondary btn-sm view" title="View"><i class="bi bi-eye-fill"></i></button>
                                <button class="btn btn-primary btn-sm print" title="Print"><i class="bi bi-printer-fill"></i></button>
                                <button class="btn btn-danger btn-sm void" title="Void"><i class="bi bi-x-square-fill"></i></button>
                            </td>
                            <td>J23-001</td>
                            <td>1234</td>
                            <td>01-23-23</td>
                            <td>Inflatables</td>
                            <td>05:10</td>
                            <td>01:18PM</td>
                            <td>2:18PM</td>
                            <td>Juan Dela Cruz</td>
                            <td>Ibarra</td>
                            <td>1</td>
                            <td>150.00</td>
                        </tr> -->
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
                    <div class="text-end">
                        <small>February 15, 2023 11:38AM</small>
                    </div>
                    <div class="d-flex align-items-center">
                        <img class="box-img" src="<?= base_url('assets/img/avatar.png');?>" alt="Profile-Pic">
                        <div class="ms-3">
                            <h5 class="mb-0">Serial Number:</h5>
                            <h4 class="mb-0"><b>5 012345 6789000</b></h4>
                            <h5 class="mb-0">Guest / Kids Name</h5>
                            <h4 class="mb-0 text-muted">Juan Dela Cruz Gomez</h4>
                            <b class="mb-0 text-muted">12 years old</b>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                        <label>Package:</label>
                        <h5 style="color:#8E3C95;">1 Hour - Inflatables</h5>
                    </div>
                    <div class="form-group">
                        <label>Remaining Time (HH:MM:SS):</label>
                        <h5 style="color:#d63031;">0:2:30</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time In:</label>
                                <h5 style="color:#8E3C95;">10:40 AM</h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time Out:</label>
                                <h5 style="color:#8E3C95;">11:40 AM</h5>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Inventory Socks:</label>
                        <h5><b>2 Grip Socks</b></h5>
                    </div>
                    <div class="form-group">
                        <label>Extension (if any):</label>
                        <h5><b>1 Hour - Inflatables</b></h5>
                    </div>
                    
                    <div class="text-center">
                        <label>Total Amount</label>
                        <h4>P 350.<small>00</small></h4>
                    </div>
                    <div class="mx-auto">
                        <button class="btn btn-danger w-100 btn-rounded">VOID THIS TRANSACTION</button>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="checkoutModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #d63031; color:#fff;">
                    <h5 class="modal-title" id="exampleModalLabel">WARNING NOTICE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center">
                        <img src="<?= base_url('assets/img/warning.gif')?>" alt="Warning-Img" width="60">
                        <h3 class="ms-2" style="color: #d63031"><b>TIMES IS UP</b></h3>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-3">
                            <img class="box-img" src="<?= base_url('assets/img/avatar.png');?>" alt="Profile-Pic">
                        </div>
                        <div class="col-5">
                            <div class="mb-0">Serial Number:</div>
                            <div class="mb-0"><b>5 012345 6789000 / INFLATABLES</b></div>
                            <div class="mb-0">Guest / Kids Name</div>
                            <div class="mb-0 text-muted">Juan Dela Cruz Gomez</div>
                            <b class="mb-0 text-muted">12 years old</b>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-primary btn-rounded mt-3 mb-3 w-100">EXTEND TIME</button>
                            <button class="btn btn-danger btn-rounded w-100">CHECK OUT</button>
                        </div>

                        <hr>
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
                },
                "dataSrc": function(json) {
                    $('#total_amount').text('₱ ' + json.totalAmount);
                    $('#total_inv').text('₱ ' + json.totalInv);
                    $('#total_sales').text('₱ ' + json.totalSales);
                    $('#no_transaction').text(json.no_transaction);
                return json.data;
                }
            },
        });

        // var total = 0;
        // tbl_sales.column(11).data().each(function(amount) {
        //     total += parseFloat(amount);
        // });
        // console.log(total);

        $(document).on('click', '.void', function(){
            $('#transactionModal').modal('show');
        });

        $(document).on('click', '.view', function(){
            $('#boardModal').modal('show');
        });

        $(document).on('click', '.checkout', function(){
            $('#checkoutModal').modal('show');
        });
    });
</script>