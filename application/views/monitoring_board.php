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

    #tbl_monitoring td:nth-child(11),
    #tbl_monitoring th:nth-child(11) {
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
                    <select name="sort_by" id="sort_by" class="form-select form-select-sm">
                        <option value="">Sort By Package All</option>
                        <option value="">Inflatables</option>
                        <option value="">Play</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <select name="sort_by" id="sort_by" class="form-select form-select-sm">
                        <option value="">Sort by Remaining Minutes</option>
                    </select>
                </div>
            </div><br>
            <div class="col-sm-4">
            <button class="btn btn-dark btn-sm"><i class="bi bi-printer-fill me-2"></i>PRINT RECORDS</button>
            <button class="btn btn-info btn-sm"><i class="bi bi-download me-2"></i>EXPORT THIS FILE</button>
                        </div>
            <div class="box-section mt-2">
                <div class="table-responsive">
                    <table class="table table-bordered text-uppercase" width="100%" id="tbl_monitoring">
                        <thead>
                            <tr>
                                <th>SERIAL #</th>
                                <th>DATE</th>
                                <th>PACKAGE</th>
                                <th>TIME IN</th>
                                <th>TIME OUT</th>
                                <th>REM. TIME (HH:MM:SS)</th>
                                <th>GUEST / KIDS NAME</th>
                                <th>PARENT / GUARDIAN</th>
                                <th>CONTACT #</th>
                                <th>ACTION</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td>1234</td>
                                <td>Feburary 15, 2023</td>
                                <td>1 Hour</td>
                                <td>10:30 AM</td>
                                <td>11:30 AM</td>
                                <td>0:2:30</td>
                                <td>JUAN DELA CRUZ</td>
                                <td>PARENT 101</td>
                                <td>0933-123-5678</td>
                                <td>
                                    <button class="btn btn-info btn-sm checkout" title="Check Out"><i class="bi bi-box-arrow-right"></i></button>
                                    <button class="btn btn-success btn-sm extend" title="Extend"><i class="bi bi-check2-square"></i></button>
                                    <button class="btn btn-secondary btn-sm view" title="View"><i class="bi bi-eye-fill"></i></button>
                                </td>
                            </tr> -->
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
    <div class="modal fade" id="boardModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #8E3C95; color:#fff;">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-file-earmark-text-fill me-2"></i>PACKAGE INFORMATION</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   
                    <div class="d-flex align-items-center">
                        <img class="box-img" src="<?= base_url('assets/img/avatar.png');?>" alt="Profile-Pic">
                        <div class="ms-3">
                            <h5 class="mb-0">Serial Number:</h5>
                            <h4 class="mb-0"><b style="color:#8E3C95;">5 012345 6789000</b></h4>
                           
                            <h4 class="mb-0 text-muted">Juan Dela Cruz Gomez</h4>
                            <b class="mb-0 text-muted">12 years old</b>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                        <label>Package:</label>
                        <h5>1 Hour - Inflatables</h5>
                    </div>
                    <div class="form-group">
                        <label>Remaining Time (HH:MM:SS):</label>
                        <h5 style="color:#d63031;">0:2:30</h5>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time In:</label>
                                <h5>10:40 AM</h5>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Time Out:</label>
                                <h5>11:40 AM</h5>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                      <h5>Extend Time Remaining</h5>
                      <h5 style="color:#d63031;">0:2:30</h5>
                    </div>
                
                    <div class="form-group">
                        <label><b>Time Extension Policy:</b></label>
                        <p style="text-align: justify; color:#666363;">
                            <small>Guest are given at least 5 minutes alloted time to extend respective package / Promo.
                            After the given time system will no longer allowed to use extension time priviledges.
                            </small>
                        </p>
                    </div>
                    <hr>
                    <div class="form-group mb-2">
                        <select name="package" id="package" class="form-select">
                            <option value="">Select Package</option>
                            <option value="PARK">PARK</option>
                            <option value="INFLATABLES">INFLATABLES</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <label>Total Amount</label>
                        <h4>P 350.<small>00</small></h4>
                    </div>
                    <div class="mx-auto">
                        <button class="btn btn-success w-100 mb-3 btn-rounded">EXTEND TIME</button>
                        <button class="btn btn-danger w-100 btn-rounded">CHECK OUT</button>
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
                if (aData[10] == 'Red') { // less than 5 minutes
                    $('td', nRow).css('background-color', 'rgba(249, 187, 191, 0.8)');
                } else if (aData[10] == 'Yellow') { // less than 15 minutes
                    $('td', nRow).css('background-color', 'rgba(252, 241, 136, 0.8)');
                } else if (aData[10] == 'Orange') { // less than 30 minutes
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
                }
            },
        });
        $('#search_value').on('input', function() {
            tbl_monitoring.draw();
        });

        $(document).on('click', '.extend', function(){
            $('#boardModal').modal('show');
        });

        $(document).on('click', '.view', function(){
            $('#boardModal').modal('show');
        });

        $(document).on('click', '.checkout', function(){
            $('#checkoutModal').modal('show');
        });
    });
</script>