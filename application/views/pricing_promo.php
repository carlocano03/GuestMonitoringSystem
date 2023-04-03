<style>
    #tbl_pricing th,
    #tbl_pricing td {
        text-align: center;
        text-transform: uppercase;
    }

    #tbl_pricing td:nth-child(4),
    #tbl_pricing td:nth-child(5) {
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
                    <input type="text" class="form-control form-control-sm" id="search_value" placeholder="Search Here...">
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
                            <th>Time</th>
                            <th>Weekdays (Monday - Thursday)</th>
                            <th>Weekends & Holidays (Friday - Sunday)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td>1</td>
                            <td>One Hour (1 Hr)</td>
                            <td>250.00</td>
                            <td>300.00</td>
                            <td>
                                <button class="btn btn-primary btn-sm edit" title="Edit"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-danger btn-sm remove" title="Remove"><i class="bi bi-trash-fill"></i></button>
                            </td>
                        </tr> -->
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
                                <input type="number" class="form-control" name="time" placeholder="TIME" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="weekdays_price" placeholder="WEEKDAYS PRICE" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="weekends_price" placeholder="WEEKENDS & HOLIDAY PRICE" required>
                            </div>
                            <div class="form-group mb-3">
                                <button type="button" class="btn btn-secondary w-100 btn-rounded">CLEAR</button>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary w-100 btn-rounded">SUBMIT</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="pricingUpdateModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #6f42c1; color:#fff;">
                    <h5 class="modal-title" id="exampleModalLabel">RATES & PRICING</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                        <h4 class="fw-bold">ADDING NEW RECORD</h4>
                        <hr class="mt-0">
                        <form id="updatePricing" method="POST">
                            <input type="hidden" name="pricing_id" id="pricing_id">
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="admission_type" id="admission_type" placeholder="ADMISSION TYPE" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="number" class="form-control" name="time" id="time" placeholder="TIME" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="weekdays_price" id="weekdays_price" placeholder="WEEKDAYS PRICE" required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" name="weekends_price" id="weekends_price" placeholder="WEEKENDS & HOLIDAY PRICE" required>
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
        var table_pricing = $('#tbl_pricing').DataTable({
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
                "url": "<?= base_url('pricing/get_pricing') ?>",
                "type": "POST",
                "data": function(data) {
                    data.search_value = $('#search_value').val();
                }
            },
        });
        $('#search_value').on('input', function() {
            table_pricing.draw();
        });

        $(document).on('submit', '#addPricing', function(event){
            event.preventDefault();

            $.ajax({
                url: "<?= base_url('pricing/add_pricing')?>",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    if (data.success == 'Exist') {
                        Swal.fire('Warning!', 'Pricing & promo already exists.', 'warning');
                    } else if (data.success == 'Success') {
                        Swal.fire('Thank you!', 'Pricing & promo successfully added.', 'success');
                        table_pricing.draw();
                        $('#pricingModal').modal('hide');
                        $('#addPricing').trigger('reset');
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
            $('#addPricing').trigger('reset');
        });

        $(document).on('click', '.edit_pricing', function(){
            var pricing_id = $(this).attr('id');
            $.ajax({
                    url: "<?= base_url('pricing/get_pricing_data')?>",
                    method: "POST",
                    data: {
                        pricing_id: pricing_id, 
                    },
                    success: function(data) { 
                        $('#pricingUpdateModal').modal('show');
                        if (Object.keys(data).length > 0) {
                            $('#pricing_id').val(data.pricing_id == null ? '' : data.pricing_id);
                            $('#admission_type').val(data.admission_type == null ? '' : data.admission_type);
                            $('#time').val(data.time_admission == null ? '' : data.time_admission);
                            $('#weekdays_price').val(data.weekdays_price == null ? '' : data.weekdays_price);
                            $('#weekends_price').val(data.weekends_price == null ? '' : data.weekends_price);
                        }
                    }
            });
        });

        $(document).on('submit', '#updatePricing', function(event){
            event.preventDefault();

            $.ajax({
                url: "<?= base_url('pricing/update_pricing')?>",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    if (data.success == 'Success') {
                        Swal.fire('Thank you!', 'Pricing & promo successfully updated.', 'success');
                        table_pricing.draw();
                        $('#pricingUpdateModal').modal('hide');
                        $('#updatePricing').trigger('reset');
                    } else {
                        Swal.fire("Failed to add.", "Clicked button to  close!", "error");
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                }
            });
        });

        $(document).on('click', '.remove_pricing', function(){
            var pricing_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('pricing/delete_pricing')?>",
                        method: "POST",
                        data: {
                            pricing_id: pricing_id
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.success == 'Success') {
                                Swal.fire('Thank you!', 'Pricing & promo successfully deleted.', 'success');
                                table_pricing.draw();
                            } else {
                                Swal.fire("Failed to add.", "Clicked button to  close!", "error");
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                        }
                    });
                }
            })
        });

    });
</script>