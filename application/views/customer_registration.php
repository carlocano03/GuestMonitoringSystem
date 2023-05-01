<style>
    #tbl_customer th,
    #tbl_customer td {
        text-align: center;
    }

</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pb-3 main-section" style="background: #8F3F96;">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mt-2 text-white">Customer & Guest Registration</h2>
                    <p class="text-green fw-bold mb-0">User Permission</p>
                    <ol class="breadcrumb text-white">
                        <li class="breadcrumb-item">Dashboard Modules</li>
                        <li class="breadcrumb-item">GM Board</li>
                        <li class="breadcrumb-item">TM Analytics</li>
                        <li class="breadcrumb-item">Customer Registration</li>
                    </ol>
                </div>
                <div class="col-md-4 text-end">
                    <h2 class="mt-2 text-white"><span id="clock" class="fw-bold"></h2>
                    <h5 class="text-white"><span id="date" class="fw-bold"></span></h5>
                    <a href="<?= base_url('main/logout') ?>" class="btn-signout">SIGN OUT <i class="bi bi-box-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 mt-4">
            <div class="row g-1">
                <div class="col-sm-3">
                    <input type="text" name="search_value" id="search_value" class="form-control form-control-sm" placeholder="Search Here...">
                </div>
                <div class="col-sm-3">
                    <select name="sort_by_package" id="sort_by_package" class="form-select form-select-sm">
                        <option value="">Sort By Package All</option>
                        <option value="INFLATABLES">Inflatables</option>
                        <option value="PARK">Play Park</option>
                    </select>
                </div>
            </div><br>
            <div class="col-sm-4">
            <button class="btn btn-dark btn-sm" id="print_records"><i class="bi bi-printer-fill me-2"></i>PRINT RECORDS</button>
            <button class="btn btn-info btn-sm" id="export_file"><i class="bi bi-download me-2"></i>EXPORT THIS FILE</button>
                        </div>
            <div class="box-section mt-2">
                <div class="table-responsive">
                    <table class="table table-bordered text-uppercase" width="100%" id="tbl_customer">
                        <thead>
                            <tr>
                                <th>ACTION</th>
                                <th>KID'S FULL NAME</th>
                                <th>GUARDIAN FULL NAME</th>
                                <th>RELATIONSHIP</th>
                                <th>ADDRESS</th>
                                <th>CONTACT NUMBER</th>
                                <th>AGE</th>
                                <th>BIRTHDAY</th>
                                <th>ADMISSION COUNT</th>
                                <th>REMARKS</th>
                                <th>SERVICE</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <hr>
                <div>
                </div>
            </div>
        </div>
        <!-- Main div -->
    </main>

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
        var tbl_customer = $('#tbl_customer').DataTable({
            language: {
                search: '',
                searchPlaceholder: "Search Here...",
                "info": "_START_-_END_ of _TOTAL_ entries",
                paginate: {
                    next: '<i class="fas fa-chevron-right"></i>',
                    previous: '<i class="fas fa-chevron-left"></i>'
                }
            },
            "searching": false,
            "ordering": false,
            "bLengthChange": false,
            "serverSide": true,
            "processing": true,
            "pageLength": 25,
            "deferRender": true,
            "ajax": {
                "url": "<?= base_url('customer/get_customer') ?>",
                "type": "POST",
                // "data": function(data) {
                //     data.search_value = $('#search_value').val();
                //     data.package = $('#sort_by_package').val();
                // }
            },
        });
        $('#search_value').on('input', function() {
            tbl_customer.draw();
        });
        $('#sort_by_package').on('change', function() {
            tbl_customer.draw();
        });


    });
</script>