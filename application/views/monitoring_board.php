<style>
    #tbl_monitoring th,
    #tbl_monitoring td {
        text-align: center;
    }

    #tbl_monitoring th:nth-child(4) {
        background: var(--bs-purple);
        color: #fff;
    }
    #tbl_monitoring th:nth-child(5){
        background: var(--bs-purple);
        color: #fff;
    }
    #tbl_monitoring th:nth-child(6){
        background: var(--bs-red);
        color: #fff;
    }

    #tbl_monitoring td:nth-child(13),
    #tbl_monitoring th:nth-child(13) {
        display: none;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pb-3 main-section" style="background: #8F3F96;">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mt-2 text-white">Guest Monitoring Board</h2>
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
                <div class="col-sm-3">
                    <select name="sort_by_time" id="sort_by_time" class="form-select form-select-sm">
                        <option value="">Sort by Remaining Minutes</option>
                        <option value="5">Less than 5 minutes</option>
                        <option value="15">Less than 15 minutes</option>
                        <option value="Open">More than 15 minutes</option>
                    </select>
                </div>
            </div><br>
            <div class="col-sm-4">
            <button class="btn btn-dark btn-sm" id="print_records"><i class="bi bi-printer-fill me-2"></i>PRINT RECORDS</button>
            <button class="btn btn-info btn-sm" id="export_file"><i class="bi bi-download me-2"></i>EXPORT THIS FILE</button>
                        </div>
            <div class="box-section mt-2">
                <div class="table-responsive">
                    <table class="table table-bordered text-uppercase" width="100%" id="tbl_monitoring">
                        <thead>
                            <tr>
                                <th>ACTION</th>
                                <th>SERIAL #</th>
                                <th>DATE</th>
                                <th>PACKAGE</th>
                                <th>CATEGORY</th>
                                <th>TIME IN</th>
                                <th>TIME OUT</th>
                                <th>EXTEND TIME</th>
                                <th>REMAINING TIME</th>
                                <th>GUEST / KIDS NAME</th>
                                <th>PARENT / GUARDIAN</th>
                                <th>CONTACT #</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <hr>
                <ol class="breadcrumb text-black">
                    <li class="breadcrumb-item">Red - 5 Minutes or Less</li>
                    <li class="breadcrumb-item">Yellow - Less than 15 Minutes</li>
                    <li class="breadcrumb-item">Orange - Less than 30 Minutes</li>
                    <li class="breadcrumb-item">Green - Unlimited Time</li>
                </ol>
                  
                    <div>
                    
                    
                </div>
            </div>
        </div>
        <!-- Main div -->
    </main>

    <!-- Modal -->
    <div class="modal fade" id="viewModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #8E3C95; color:#fff;">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-file-earmark-text-fill me-2"></i>PACKAGE INFORMATION</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   
                    <div class="box-header text-white parent_info_view" style="background: #8F3F96;">
                        PARENT / GUARDIAN INFORMATION
                    </div>
                    <div id="parent_info_view"></div>
                    
                    <div class="box-header children_info_view">
                        CHILD / KIDS INFORMATION
                    </div>
                    <div id="children_info_view"></div>
                    

                    <div id="time_info_view"></div>
                
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="boardModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #8E3C95; color:#fff;">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-file-earmark-text-fill me-2"></i>PACKAGE INFORMATION</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   
                    <div class="box-header text-white parent_info" style="background: #8F3F96;">
                        PARENT / GUARDIAN INFORMATION
                    </div>
                    <div id="parent_info"></div>
                    
                    <div class="box-header children_info">
                        CHILD / KIDS INFORMATION
                    </div>
                    <div id="children_info"></div>
                    

                    <div id="time_info"></div>
                
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
                        <div class="box-header text-white" id="parent_box" style="background: #8F3F96;">
                            PARENT / GUARDIAN INFORMATION
                        </div>
                        <div id="parent_guardian_data"></div>
                        <div class="box-header" id="children_box">
                            CHILD / KIDS INFORMATION
                        </div>
                        <div id="checkout_data"></div>
                        <!-- <hr> -->
                    
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
        // Update remaining time every second
        setInterval(function() {
            $('.remaining-time').each(function() {
                // Retrieve remaining time from data attribute
                var remaining_time = $(this).data('remaining-time');
                
                // Subtract one second from remaining time
                remaining_time -= 1;
                
                // If remaining time is negative, set it to zero
                if (remaining_time < 0) {
                    remaining_time = 0;
                }
                
                // Format remaining time as HH:MM:SS
                var hours = Math.floor(remaining_time / 3600);
                var minutes = Math.floor((remaining_time % 3600) / 60);
                var seconds = remaining_time % 60;
                var remaining_time_formatted = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);
                
                // Update displayed countdown
                $(this).html(remaining_time_formatted);
                
                // Update remaining time data attribute
                $(this).data('remaining-time', remaining_time);
            });
        }, 1000); // Update every second

        $('#loading').show();
        setTimeout(function() {
            $('#loading').hide();
        }, 2000);
        var tbl_monitoring = $('#tbl_monitoring').DataTable({
            "fnRowCallback": function(nRow, aData, iDisplayIndex, asd) {
                if (aData[12] == 'Red') { // less than 5 minutes
                    $('td', nRow).css('background-color', 'rgba(249, 187, 191, 0.8)');
                } else if (aData[12] == 'Yellow') { // less than 15 minutes
                    $('td', nRow).css('background-color', 'rgba(252, 241, 136, 0.8)');
                } else if (aData[12] == 'Orange') { // less than 30 minutes
                    $('td', nRow).css('background-color', 'rgba(252, 203, 136, 0.8)');
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
            "searching": false,
            "ordering": false,
            "bLengthChange": false,
            "serverSide": true,
            "processing": true,
            "pageLength": 25,
            "deferRender": true,
            "ajax": {
                "url": "<?= base_url('time_monitoring/getTimeMonitoring') ?>",
                "type": "POST",
                "data": function(data) {
                    data.search_value = $('#search_value').val();
                    data.package = $('#sort_by_package').val();
                    data.sort = $('#sort_by_time').val();
                }
            },
        });
        $('#search_value').on('input', function() {
            tbl_monitoring.draw();
        });
        $('#sort_by_package').on('change', function() {
            tbl_monitoring.draw();
        });
        $('#sort_by_time').on('change', function() {
            tbl_monitoring.draw();
        });

        $(document).on('click', '.extend', function(){
            var serial_no = $(this).attr('id');
            var child_id = $(this).data('child');
            var service = $(this).data('service');
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
                url: "<?= base_url('time_monitoring/get_guest_data')?>",
                method: "POST",
                data: {
                    serial_no: serial_no,
                    service: service,
                    child_id: child_id
                },
                dataType: "json",
                success: function(data) {
                    $('#children_info').html(data.children_info);
                    $('#parent_info').html(data.parent_guardian);
                    $('#time_info').html(data.time_info);
                    $('#boardModal').modal('show');
                }
            });
        });

        $(document).on('click', '.view', function(){
            var serial_no = $(this).attr('id');
            var child_id = $(this).data('child');
            var service = $(this).data('service');
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
                url: "<?= base_url('time_monitoring/get_guest_data_view')?>",
                method: "POST",
                data: {
                    serial_no: serial_no,
                    service: service,
                    child_id: child_id
                },
                dataType: "json",
                success: function(data) {
                    $('#children_info_view').html(data.children_info);
                    $('#parent_info_view').html(data.parent_guardian);
                    $('#time_info_view').html(data.time_info);
                    $('#viewModal').modal('show');
                }
            });
        });

        $(document).on('click', '.checkout', function(){
            var serial_no = $(this).attr('id');
            var child_id = $(this).data('child');
            var service = $(this).data('service');
            switch (service) {
                case 'INFLATABLES':
                     $('#children_box').show(200);
                     $('#parent_box').text('PARENT / GUARDIAN INFORMATION');
                    break;
            
                case 'PARK':
                    $('#children_box').hide(200);
                    $('#parent_box').text('GUEST INFORMATION');
                    break;
            }
            $.ajax({
                url: "<?= base_url('time_monitoring/get_checkout')?>",
                method: "POST",
                data: {
                    serial_no: serial_no,
                    service: service,
                    child_id: child_id
                },
                dataType: "json",
                success: function(data) {
                    $('#checkout_data').html(data.checkout);
                    $('#parent_guardian_data').html(data.parent_guardian);
                    $('#checkoutModal').modal('show');
                }
            });
        });

        $(document).on('click', '#print_records', function() {
            var url = "<?= base_url('time_monitoring/print_records');?>";
            window.open(url, 'targetWindow','resizable=yes,width=1000,height=1000');
        });

        $(document).on('click', '#export_file', function() {
            var url = "<?= base_url('time_monitoring/export_time_monitoring');?>";
            window.location.href = url;
        });

        //INFLATABLES CHECKOUT
        $(document).on('click', '.checkout_guest', function() {
            var slip_no = $(this).attr('id');
            var child_id = $(this).data('child');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to checkout this children",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('time_monitoring/checkout_guest')?>",
                        method: "POST",
                        data: {
                            slip_no: slip_no,
                            child_id: child_id,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.message == 'Success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank you',
                                    text: 'Checkout successfully',
                                });
                                $('#checkoutModal').modal('hide');
                                $('#boardModal').modal('hide');
                                $('#viewModal').modal('hide');
                                tbl_monitoring.draw();
                            } else {
                                wal.fire('Warning!', 'Failed to checkout.', 'warning');
                            }
                        }
                    });
                }
            })
        });

        //PARK
        $(document).on('click', '.checkout_guest_park', function() {
            var slip_no = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to checkout this guest",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('time_monitoring/checkout_guest_park')?>",
                        method: "POST",
                        data: {
                            slip_no: slip_no,
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.message == 'Success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thank you',
                                    text: 'Checkout successfully',
                                });
                                $('#checkoutModal').modal('hide');
                                $('#checkoutModal').modal('hide');
                                $('#boardModal').modal('hide');
                                $('#viewModal').modal('hide');
                                tbl_monitoring.draw();
                            } else {
                                Swal.fire('Warning!', 'Failed to checkout.', 'warning');
                            }
                        }
                    });
                }
            })
        });

        $(document).on('change', '#rates_extension', function() {
            var pricing_id = $(this).val();
            $.ajax({
                url: "<?= base_url('main/get_pricing')?>",
                method: "POST",
                data: {
                    pricing_id: pricing_id
                },
                success: function(data) { 
                    if (Object.keys(data).length > 0) {
                        $('#package_price_amt').val(data.weekdays_price == null ? '' : data.weekdays_price);
                        var admission_type = data.admission_type == null ? '' : data.admission_type;
                        var time_admission = data.time_admission == null ? '' : data.time_admission;
                        $('#package_type').val(admission_type + (time_admission ? ' - ' + time_admission : ''));
                    }
                }
            })
        });

        $(document).on('click', '.extend_guest', function() {
            var guest_id = $(this).data('guest');
            var serial_no = $(this).data('serial_no');
            var price = $(this).data('price');
            var details = $(this).data('details');
            var pricing = $(this).data('pricing');
            var extend = $(this).data('extend');
            var service = $(this).data('service');
            var time_id = $(this).data('time_id');
            var rate_extension = $('#rates_extension').val();

            var package_price = $('#package_price_amt').val();
            var package_type = $('#package_type').val();

            var total_price = 0;
            var qty = 0;
            total_price = price;

            if (rate_extension != '') {
                Swal.fire({
                title: 'Are you sure?',
                text: "You want to extend this guest.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('time_monitoring/extend_guest')?>",
                        method: "POST",
                        data: {
                            guest_id: guest_id,
                            serial_no: serial_no,
                            price: price,
                            //details: details,
                            pricing: pricing,
                            service: service,
                            // total_price: total_price,
                            // qty: qty,
                            time_id: time_id,

                            rate_extension: rate_extension,
                            package_price: package_price,
                            package_type: package_type,
                        },
                        dataType: "json",
                        success: function (data) {
                            if (data.message == 'Success') {
                                alert('Success');
                            } else {
                                alert('Failed');
                            }
                            
                            // var url = "<?= base_url('sales_invoice/extended?transaction=')?>" + serial_no;
                            // window.open(url, 'targetWindow','resizable=yes,width=1000,height=1000');
                        }
                    });
                }
            })
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Ooopss...',
                    text: 'Please select time extension.',
                });
            }

        });

    });
</script>