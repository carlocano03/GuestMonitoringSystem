<style>
    #tbl_inventory th,
    #tbl_inventory td {
        text-align: center;
        text-transform: uppercase;
    }

    #tbl_inventory td:nth-child(3),
    #tbl_inventory td:nth-child(4) {
        font-weight: bolder;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pb-3 main-section">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mt-2 text-white">Inventory Module</h2>
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
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#inventoryModal"><i class="bi bi-plus-square-fill me-2"></i>ADD INVENTORY</button>
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
                <table class="table table-bordered" width="100%" id="tbl_inventory">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descriptions</th>
                            <th>Quantity</th>
                            <th>Weekdays (Monday - Thursday)</th>
                            <th>Weekends & Holidays (Friday - Sunday)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>IN-001</td>
                            <td>Grip Socks (Kids)</td>
                            <td>10</td>
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
    <div class="modal fade" id="inventoryModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #6f42c1; color:#fff;">
                    <h5 class="modal-title" id="exampleModalLabel">RATES & PRICING</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <h4 class="fw-bold">INVENTORY MODULE</h4>
                        <hr class="mt-0">
                        <form id="addInventory" method="POST">
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="descriptions" placeholder="DESCRIPTIONS" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" class="form-control" name="qty" placeholder="QUANTITY" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" class="form-control" name="weekdays_price" placeholder="WEEKDAYS PRICE" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" class="form-control" name="weekends_price" placeholder="WEEKENDS & HOLIDAY PRICE" required>
                            </div>
                            <div class="form-group mb-3">
                                <button type="button" class="btn btn-secondary w-100 btn-rounded clear">CLEAR</button>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary w-100 btn-rounded">SUBMIT</button>
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
        var table_inventory = $('#tbl_inventory').DataTable({
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

        $(document).on('submit', '#addInventory', function(event){
            event.preventDefault();

            $.ajax({
                url: "<?= base_url('inventory/add_inventory')?>",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    if (data.success == 'Exist') {
                        Swal.fire('Warning!', 'Stocks already exists.', 'warning');
                    } else if (data.success == 'Success') {
                        Swal.fire('Thank you!', 'Stocks successfully added.', 'success');
                        table_inventory.draw();
                        $('#inventoryModal').modal('hide');
                        $('#addInventory').trigger('reset');
                    } else {
                        Swal.fire("Failed to add.", "Clicked button to  close!", "error");
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                }
            });
        });

        $(document).on('click', '.clear', function(){
            $('#addInventory').trigger('reset');
        });

    });
</script>