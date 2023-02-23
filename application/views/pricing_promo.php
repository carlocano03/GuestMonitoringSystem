<style>
    #tbl_pricing th,
    #tbl_pricing td {
        text-align: center;
        text-transform: uppercase;
    }

    #tbl_pricing td:nth-child(3),
    #tbl_pricing td:nth-child(4) {
        font-weight: bolder;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pb-3 main-section">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mt-2 text-white">Pricing and Promo</h2>
                    <p class="text-yellow fw-bold mb-0">User Permission</p>
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
                    <input type="text" class="form-control form-control-sm" placeholder="Search Here...">
                </div>
                <div class="col-md-5">
                    <div class="row g-0">
                        <div class="col-sm-4 mb-2">
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#pricingModal"><i class="bi bi-plus-square-fill me-2"></i>ADD NEW ADMISSION</button>
                        </div>
                        <div class="col-sm-3 mb-2">
                            <button class="btn btn-primary btn-sm"><i class="bi bi-printer-fill me-2"></i>PRINT RECORDS</button>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary btn-sm"><i class="bi bi-download me-2"></i>EXPORT THIS FILE</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="tbl_pricing">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type of Admission</th>
                            <th>Weekdays (Monday - Thursday)</th>
                            <th>Weekends & Holidays (Friday - Sunday)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>One Hour (1 Hr)</td>
                            <td>250.00</td>
                            <td>300.00</td>
                            <td>
                                <button class="btn btn-primary btn-sm edit" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-danger btn-sm remove" title="Remove"><i class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Main div -->
    </main>

    <!-- Modal -->
    <div class="modal fade" id="pricingModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #6f42c1; color:#fff;">
                    <h5 class="modal-title" id="exampleModalLabel">RATES & PRICING</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <h4 class="fw-bold">ADDING NEW RECORD</h4>
                        <hr class="mt-0">
                        <form id="addPricing" method="POST">
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="admission_type" placeholder="ADMISSION TYPE" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="weekdays_price" placeholder="WEEKDAYS PRICE" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="weekends_price" placeholder="WEEKENDS & HOLIDAY PRICE" required>
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-secondary w-100 btn-rounded">CLEAR</button>
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-primary w-100 btn-rounded">SUBMIT</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>

    <footer class="py-3 text-white mt-auto" style="background: #474787;">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-white">Copyright &copy; Austin Land 2022</div>
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
        $('#tbl_pricing').DataTable({
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
        });

    });
</script>