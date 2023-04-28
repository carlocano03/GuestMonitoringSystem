<style>
    #table-guest th,
    #table-guest td,
    #table_inventory th,
    #table_inventory td {
        text-align: center;
    }

    #table-guest th:nth-child(3),
    #table_inventory th:nth-child(3) {
        background: var(--bs-yellow);
        color: #2d3436;
    }

    .select2-selection__rendered {
      line-height: 36px !important;
    }

    .select2-selection {
      height: 38px !important;
    }

</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pb-3 main-section" style="background: #8F3F96;">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mt-2 text-white">Main Dashboard</h2>
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
                <div class="col-4">
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" name="search_value" id="search_value" placeholder="Search Pre-Registration No. or Name here...">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group mb-2">
                        <a href="<?= base_url('home/services')?>" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-plus-square-fill me-2"></i>PRE-REGISTRATION</a>
                    </div>
                </div>
            </div>
            <form method="POST" id="registerGuest" enctype="multipart/form-data">
                <input type="hidden" id="serial_no" name="serial_no" value="<?= $serial?>">
                <input type="hidden" name="guest_id" id="guest_id">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <div class="box-section mb-3">
                        <div class="box-header" style="background-color:#ffcc00;">
                            GUEST REGISTRATION MODULE
                        </div>
                        <div class="fw-bold"><small>PARENTS / GUARDIAN DETAILS</small></div>
                        <hr class="mt-0">
                        <div class="form-group mb-2">
                            <input type="text" name="serialno" id="serialno" class="form-control text-uppercase" placeholder="Enter Serial No." required>
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="f_name" id="f_name" class="form-control text-uppercase" placeholder="Enter First Name (Juan)">
                        </div>
                        <div class="row g-1">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <input type="text" name="m_name" id="m_name" class="form-control text-uppercase" placeholder="Enter Middle Name (Cruz)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <input type="text" name="l_name" id="l_name" class="form-control text-uppercase" placeholder="Enter Last Name (Bonifacio)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <input type="text" name="suffix" id="suffix" class="form-control text-uppercase" placeholder="Suffix (Jr. Sr. III)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <select name="relationship" id="relationship" class="form-select text-uppercase">
                                        <option value="">Relationship</option>
                                        <option value="Mother">Mother</option>
                                        <option value="Father">Father</option>
                                        <option value="Brother">Brother</option>
                                        <option value="Sister">Sister</option>
                                        <option value="Grandmother">Grandmother</option>
                                        <option value="Grandfather">Grandfather</option>
                                        <option value="Auntie">Auntie</option>
                                        <option value="Uncle">Uncle</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <select name="province" id="province" class="form-select text-uppercase">
                                <option value="">Select Province</option>
                            </select>
                            <input type="hidden" id="province_name" name="province_name">
                        </div>
                        <div class="form-group mb-2">
                            <select name="municipality" id="municipality" class="form-select text-uppercase">
                                <option value="">Select Municipality</option>
                            </select>
                            <input type="hidden" id="municipality_name" name="municipality_name">
                        </div>
                        <div class="form-group mb-2">
                            <select name="barangay" id="barangay" class="form-select text-uppercase">
                                <option value="">Select Barangay</option>
                            </select>
                            <input type="hidden" id="barangay_name" name="barangay_name">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="street" id="street" class="form-control text-uppercase" placeholder="House No. / Bldg No. / Street">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="contact" id="contact" class="form-control" placeholder="Contact Number / Details">
                        </div>
                        <div class="form-group mb-2">
                            <input type="email" name="email_add" id="email_add" class="form-control" placeholder="Email Address" required>
                        </div>
                        <hr>
                        <div class="form-group mb-2">
                            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#cameraModal"><i class="bi bi-camera-fill me-2"></i>CAPTURE IMAGE</button>
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#signatureModal"><i class="bi bi-pen-fill me-2"></i>E-SIGNATURE</button>
                        </div>
                        <hr>
                        <div class="form-group mb-2 camera">
                            <div id="results">
                                <img style="width: 200px;" class="after_capture_frame" src="image_placeholder.jpg" />
                            </div>
                            <input type="hidden" name="captured_image_data" id="captured_image_data">
                        </div>
                        
                        <div class="row g-1">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <input type="text" name="bag_no" id="bag_no" class="form-control text-uppercase" placeholder="BAG Number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                 <input type="text" name="shoe_box" id="shoe_box" class="form-control text-uppercase" placeholder="Shoe Box Number">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="agreement">
                                <label class="form-check-label" for="flexCheckDefault">
                                    I hereby acknowledge and accept the <a href="#quitClaimModal" data-bs-toggle="modal">"Waiver and Quitclaim"</a> and agree to <a href="#dataPrivacyModal" data-bs-toggle="modal">Data Privacy Act of 2012</a>
                                </label>
                            </div>
                            <hr>

                            <div class="fw-bold"><small>Prepared by</small></div>

                        <div class="form-group mb-2">
                            <input type="text" name="service_crew" id="service_crew" class="form-control text-uppercase" value="<?= $_SESSION['loggedIn']['fullname'];?>" placeholder="GUEST / SERVICE CREW (Created By)" readonly>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box-section mb-3">
                    <div class="box-header">
                         PRICING AND PACKAGE DETAILS
                        </div>
                        <div class="form-group mb-2">
                            <select name="package" id="package" class="form-select text-uppercase">
                                <option value="">Select Package</option>
                                <option value="INFLATABLES">INFLATABLES</option>
                                <option value="PARK">PARK</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <select name="pricing_id" id="pricing_id" class="form-select text-uppercase" required>
                                <option value="">Select Time</option>
                                <!-- <?php foreach($pricing as $row) : ?>
                                    <option value="<?= $row->pricing_id?>"><?= $row->admission_type?></option>
                                <?php endforeach;?> -->
                            </select>
                        </div>
                        <!-- <div class="form-group mb-2">
                            <select name="category" id="category" class="form-select text-uppercase">
                                <option value="">Select Category</option>
                            </select>
                        </div> -->
                        <div class="child-info">
                            <div class="box-header">
                                CHILD / KIDS INFORMATION
                            </div>

                            <div id="kids_info">

                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <input type="hidden" id="child_count">
                            <input type="hidden" id="package_price_amt">
                            <input type="hidden" id="package_total_amt">
                            <input type="hidden" id="package_type">
                        </div>
                        <div class="form-group mb-2">
                            <button type="button" class="btn btn-success fw-bold w-100 add_guest"><i class="bi bi-plus-square me-2"></i>ADD TO CART</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box-section">
                    <div class="box-header">
                         (+) ADD INVENTORY DETAILS
                        </div>
                        <div class="form-group mb-2">
                            <select name="inventory" id="inventory" class="form-select text-uppercase">
                                <option value="">Socks Type</option>
                                <?php foreach($stocks as $row) : ?>
                                    <option value="<?= $row->inv_id?>"><?= $row->descriptions?> - <?= $row->quantity?> Pairs</option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="quantity" id="quantity" class="form-control text-uppercase" placeholder="Quantity">
                            <input type="hidden" name="price" id="price">
                            <input type="hidden" name="stocks" id="stocks">
                            <input type="hidden" name="total_amount" id="total_amount">
                            <input type="hidden" name="type" id="type">
                        </div>
                        <div class="form-group mb-2">
                            <button type="button" class="btn btn-success fw-bold w-100 add_inventory"><i class="bi bi-plus-square me-2"></i>ADD TO CART</button>
                        </div>
                        <hr>
                        <div class="fw-bold mt-3"><small>SALES INVOICE</small></div>
                        <p>
                        Date: <?= date('D, d F Y')?><br>
                        Jack's Adventure - SM Grand Central<br> 
                        <hr>   </p>

                        <table class="table table-bordered table-striped" width="100%" style="vertical-align:middle;" id="table_inventory">
                                <thead>
                                    <tr>
                                        <th style="display:none;"></th>
                                        <th style="display:none;"></th>
                                        <th>Items</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Total Amount</th>
                                        <!-- <th>Remarks</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="display:none;" id="row1">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <!-- <td></td> -->
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>

                            <table style="display:none;" class="table table-bordered table-striped" width="100%" style="vertical-align:middle;" id="table_children">
                                <thead>
                                    <tr>
                                        <th>Children ID</th>
                                        <th>Parent ID</th>
                                        <th>Registration No</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="add_discount">
                                <label class="form-check-label text-danger" for="add_discount" style="margin-top: 1px; font-weight: bold;">
                                    Add Discount
                                </label>
                            </div>
                            <div class="form-group discount_added">
                                <label class="text-muted">Total Discount:</label><span class="ms-2 fw-bold" id="discount"></span>
                            </div>
                            <div class="form-group discount_added">
                                <label class="text-muted">Remarks:</label><span class="ms-2 fw-bold" id="discount_remarks"></span>
                            </div>
                            <hr>
                            <h3><b>Total Amount: PHP <span id="amount"></span></b></h3>
                            <input type="hidden" id="amt_total">
                            <input type="hidden" id="discount_checked" value="0">
                            <input type="hidden" id="remarks_discount">
                        <hr>
                        <div class="form-group mb-2">
                            <button type="reset" class="btn btn-secondary btn-lg w-100">CLEAR</button>
                                </div>
                            <div class="form-group mb-2">
                            <button type="submit" class="btn btn-success btn-lg w-100" id="process_payment">PROCESS PAYMENT</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end of row -->
        </div>
        <!-- Main div -->
    </main>

    <?php $this->load->view('popup/quitclaim.php');?>
    <?php $this->load->view('popup/data_privacy.php');?>
    
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
<?php $this->load->view('webcam/camera_modal');?>
<?php $this->load->view('modal/dashboard_modal.php');?>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Camera for Guardian/Parent
    $('.camera').hide();
    $('.camera_child').hide();
	Webcam.set({
	    width: 360,
	    height: 287,
	    image_format: 'jpeg',
	    jpeg_quality: 90
	});	 
	Webcam.attach('#my_camera');
	
	function take_snapshot() {
	 // play sound effect
	 //shutter.play();
	 // take snapshot and get image data
        $('.camera').show(200);
	    Webcam.snap( function(data_uri) {
	 // display results in page
            document.getElementById('results').innerHTML = 
            '<img class="after_capture_frame" src="'+data_uri+'"/>';
            $("#captured_image_data").val(data_uri);
	    });	 
	}

    function get_child(slip_no) 
    {
        var table_children = $('#table_children').DataTable({
            language: {
                search: '',
                searchPlaceholder: "Search Here...",
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><br>Loading... ',
                // paginate: {
                //     next: '<i class="fas fa-chevron-right"></i>',
                //     previous: '<i class="fas fa-chevron-left"></i>'
                // }
            },
            "ordering": false,
            "info": false,
            "searching": false,
            "serverSide": true,
            "processing": true,
            "bDestroy": true,
            "bPaginate": false,
            "bLengthChange": false,
            "ajax": {
                "url": "<?= base_url('main/get_child/') ?>" + slip_no,
                "type": "POST",
            },
        });
    }

    var present_provcode;
    var present_muncode;
    var present_brgycode;
    $(document).ready(function() {
        $('.discount_added').hide();
        $('#process_payment').attr('disabled', true);
        $('#add_discount').attr('disabled', true);
        $('#province').select2();
        $('#municipality').select2();
        $('#barangay').select2();

        $('#loading').show();
        setTimeout(function() {
            $('#loading').hide();
        }, 2000);
        $('#table-guest').DataTable({
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

        $.getJSON('/guestmonitoringsystem/main/getProvince', function(options) {
            $.each(options, function(index, option) {
                $('#province').append($('<option>', {
                    value: option.code,
                    text: option.name.toUpperCase()
                }));
            });
        });

        $(document).on('change', '#province', function(){
            if (present_provcode) {
                var codes = present_provcode;
            } else {
                var codes = $(this).val();
            }
            var subss = codes.substring(0, 4);
            // console.log(subss);
            console.log(codes);
            $.ajax({
                url: "<?= base_url('main/psgc_munc')?>",
                method: "POST",
                dataType: "json",
                data: {
                    codes: subss
                },
                success: function(data) {
                    var options = '<option value="">Select Municipal</option>';
                    $.each(data.data, function(index, item) {
                        options += '<option value="' + item.code + '">' + item.name
                            .toUpperCase() + '</option>';
                    });
                    $("#municipality").html(options);
                    $("#province_name").val($("#province").find("option:selected")
                        .text());
                    if (present_muncode) {
                        var mun_code = present_muncode;
                        $("#municipality").val(mun_code).change();
                    }
                }
            });
        });

        $(document).on('change', '#municipality', function() {
            if (present_muncode) {
                var codes = present_muncode;
            } else {
                var codes = $(this).val();
            }
            var subss = codes.substring(0, 6);
            // console.log(subss);
            $.ajax({
                url: "<?= base_url('main/psgc_brgy')?>",
                method: "POST",
                data: {
                    codes: subss
                },
                success: function(data) {
                    var options = '<option value="">Select Barangay</option>';
                    $.each(data.data, function(index, item) {
                        options += '<option value="' + item.code + '">' + item.name
                            .toUpperCase() + '</option>';
                    });
                    $("#barangay").html(options);
                    $("#municipality_name").val($("#municipality").find("option:selected")
                        .text());
                    if (present_brgycode) {
                        var brgy_code = present_brgycode;
                        $("#barangay").val(brgy_code).change();
                    }
                }
            });
        });

        $("#search_value").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "<?= base_url('main/search') ?>",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function (event, ui) {
                $('#search_value').val(ui.item.label);

                var slip_no = ui.item.slip_no;
                var parent_id = ui.item.parent_id;
                
                $.ajax({
                    url: "<?= base_url('main/getGuestData')?>",
                    method: "POST",
                    data: {
                        slip_no: slip_no, 
                        parent_id: parent_id
                    },
                    // dataType: "json",
                    success: function(data) {
                        if (Object.keys(data).length > 0) {
                            $('#guest_id').val(data.guest_id == null ? '' : data.guest_id);
                            $('#f_name').val(data.guest_fname == null ? '' : data.guest_fname);
                            $('#l_name').val(data.guest_lname == null ? '' : data.guest_lname);
                            $('#m_name').val(data.guest_mname == null ? '' : data.guest_mname);
                            $("#relationship").val(data.relationship == null ? '' : data.relationship).trigger('change');
                            $('#street').val(data.house_street == null ? '' : data.house_street);
                            $('#contact').val(data.contact_no == null ? '' : data.contact_no);
                            $('#email_add').val(data.email_address == null ? '' : data.email_address);
                            present_provcode = data.province_code;
                            $('#province').val(data.province_code).trigger('change');
                            $('#province_name').val(data.province);
                            present_muncode = data.municipal_code;
                            $('#municipality').val(data.municipal_code).trigger('change');
                            present_brgycode = data.brgy_code;
                            $('#municipality_name').val(data.municipal);
                            get_child(slip_no);
                            //Package Details
                            $("#package").val(data.service == null ? '' : data.service).trigger('change');
                            $.ajax({
                                url: "<?= base_url() . 'main/getGuestChildren' ?>",
                                method: "POST",
                                data: {
                                    slip_no: slip_no, 
                                    parent_id: parent_id
                                },
                                dataType: "json",
                                success: function(data) {
                                    $('#kids_info').html(data.childrenData);
                                    $('#child_count').val(data.childCount + 1);
                                }
                            });


                        }
                    }
                });
            }
        });
        
        $(document).on('change', '#package', function(){
            var service = $(this).val();
            
            switch (service) {
                case 'PARK':
                    $('.child-info').hide(200);
                    break;
            
                default:
                    $('.child-info').show(200);
                    break;
            }
        });

        $(document).on('change', '#inventory', function(){
            var inv_id = $(this).val();
            $.ajax({
                url: "<?= base_url('main/get_inv')?>",
                method: "POST",
                data: {
                    inv_id: inv_id
                },
                success: function(data) { 
                    if (Object.keys(data).length > 0) {
                        $('#price').val(data.weekdays_price == null ? '' : data.weekdays_price);
                        $('#stocks').val(data.quantity == null ? '' : data.quantity);
                        $('#type').val(data.descriptions == null ? '' : data.descriptions);
                    }
                }
            })
        });

        $(document).on('change', '#pricing_id', function() {
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
                        $('#package_type').val(data.admission_type == null ? '' : data.admission_type);
                    }
                }
            })
        });

        $(document).on('click', '.add_guest', function() {
            var package_amt = $('#package_price_amt').val();
            var input1 = parseFloat($('#child_count').val());
            var input2 = parseFloat($('#package_price_amt').val());
            var sum = input1 * input2;
            var totalSum = 0;

            var guestQty = $('#child_count').val();
            var admission = $('#package_type').val();

            if (package_amt == '') {
                Swal.fire('Warning!', 'No time selected.', 'warning');
            } else {
                $('#table_inventory tbody').append(
                    '<tr class="row2">' +
                        '<td style="display:none;"></td>' +
                        '<td style="display:none;"></td>' +
                        '<td>'+admission+'</td>' +
                        '<td>'+input2+'</td>' +
                        '<td>'+guestQty+'</td>' +
                        '<td>'+sum.toFixed(2)+'</td>' +
                        // '<td></td>' +
                        '<td><span class="remove_row">Remove</span></td>' +
                    '</tr>'
                );
                $('#table_inventory tbody tr.row2').each(function() {
                    var sumCell = $(this).find('td:eq(5)');
                    var sumValue = parseFloat(sumCell.text());
                    totalSum += sumValue;
                });
                $('#amount').text(totalSum.toLocaleString('en-US', {maximumFractionDigits: 2}))
                $('#process_payment').attr('disabled', false);
                $('#add_discount').attr('disabled', false);
            }
        });

        $(document).on('keyup', '#quantity', function(){
            var input1 = parseFloat($('#quantity').val());
            var input2 = parseFloat($('#price').val());
            var sum = input1 * input2;
            
            if (input1 == '') {
                $('#total_amount').val('0');
            } else {
                $('#total_amount').val(sum.toFixed(2));
            }
        });

        $(document).on('click', '.add_inventory', function(){
            var qty = $('#quantity').val();
            var stocks = $('#stocks').val();
            var price = $('#price').val();
            var amt = $('#total_amount').val();
            var type = $('#type').val();
            var inv_id = $('#inventory').val();
            var totalSum = 0;
            if (qty == '') {
                Swal.fire('Warning!', 'Please input valid quantity.', 'warning');
            } else {
                $('#table_inventory tbody').append(
                    '<tr class="row2">' +
                        '<td style="display:none;">'+inv_id+'</td>' +
                        '<td style="display:none;">INV</td>' +
                        '<td>'+type+'</td>' +
                        '<td>'+price+'</td>' +
                        '<td>'+qty+'</td>' +
                        '<td>'+amt+'</td>' +
                        // '<td></td>' +
                        '<td><span class="remove_row">Remove</span></td>' +
                    '</tr>'
                );
            }
            $('#table_inventory tbody tr.row2').each(function() {
                var sumCell = $(this).find('td:eq(5)');
                var sumValue = parseFloat(sumCell.text());
                totalSum += sumValue;
            });
            $('#amount').text(totalSum.toLocaleString('en-US', {maximumFractionDigits: 2}))
        });
        $('#table_inventory tbody').on('click', '.remove_row', function() {
            var totalSum = 0;
            $(this).closest('tr').remove(); // Remove the parent row
            $('#table_inventory tbody tr.row2').each(function() {
                var sumCell = $(this).find('td:eq(5)');
                var sumValue = parseFloat(sumCell.text());
                totalSum += sumValue;
            });
            $('#amount').text(totalSum.toLocaleString('en-US', {maximumFractionDigits: 2}))
        });

        $(document).on('submit', '#registerGuest', function(event){
            event.preventDefault();
            var table_data = [];
            var serial_no = $('#serialno').val();
            var guest_id = $('#guest_id').val();
            var amt_total = $('#amt_total').val();
            var discount_check = $('#discount_checked').val();
            var discount_remarks = $('#remarks_discount').val();
            var pricing_id = $('#pricing_id').val();
            var package = $('#package').val();

            switch (package) {
                case 'INFLATABLES':
                    if ($('#agreement').is(':checked')) {
                        $.ajax({
                            url: "<?= base_url('main/register_guest')?>",
                            method: "POST",
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {
                                if (data.message == 'Success') {
                                    $('#table_inventory .row2').each(function(row,tr){
                                        var sub = {
                                            'type_id': $(tr).find('td:eq(0)').text(),
                                            'details': $(tr).find('td:eq(2)').text(),
                                            'price': $(tr).find('td:eq(3)').text(),
                                            'qty': $(tr).find('td:eq(4)').text(),
                                            'total_amt': $(tr).find('td:eq(5)').text(),
                                        };
                                        table_data.push(sub);
                                    });
                                    var data = {
                                        'data_table': table_data, 
                                        serial_no: serial_no, 
                                        guest_id: guest_id,
                                        amt_total: amt_total, 
                                        discount_check: discount_check, 
                                        discount_remarks: discount_remarks
                                    };
                                    $.ajax({
                                        url: "<?= base_url('main/consumable_tocks')?>",
                                        method: "POST",
                                        data: data,
                                        dataType: "json",
                                        success: function(data) {
                                            if (data.message == 'Success') {
                                                console.log(data);
                                            }
                                        }
                                    });

                                    var data = $('#table_children').DataTable().rows().data().toArray(); 
                                    var pricing = $('#pricing_id').val();
                                    var box_no = $('#shoe_box').val();
                                    var bag_no = $('#bag_no').val();
                                    var service_crew = $('#service_crew').val();
                                    var serial = $('#serialno').val();
                                    $.ajax({
                                        url: '<?= base_url('main/save_time_management'); ?>',
                                        method: 'POST',
                                        data: {
                                            data: data,
                                            pricing_id: pricing,
                                            box_no: box_no,
                                            bag_no: bag_no,
                                            service_crew: service_crew,
                                            serial_no: serial,
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            if (response.success) {
                                                console.log(response.success);
                                            }
                                        }
                                    });

                                    // alert('Success');
                                    var url = "<?= base_url('sales_invoice?transaction=')?>" + serial_no;
                                    window.open(url, 'targetWindow','resizable=yes,width=1000,height=1000');

                                    var quit_claim = "<?= base_url('main/quit_claim?registration=')?>" + serial_no;
                                    window.open(quit_claim, '_blank');
                                    location.reload();
                                    $('registerGuest').trigger('reset');
                                } else {
                                    alert('Failed to save');
                                }
                            },
                            error: function() {
                                alert('Failed');
                            }
                        });
                    } else {
                        Swal.fire('Warning!', 'Please accept the agreement.', 'warning');
                    }
                    break;
            
                case 'PARK':
                    if ($('#agreement').is(':checked')) {
                        $.ajax({
                            url: "<?= base_url('main/register_guest')?>",
                            method: "POST",
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
                            dataType: "json",
                            success: function(data) {
                                if (data.message == 'Success') {
                                    $('#table_inventory .row2').each(function(row,tr){
                                        var sub = {
                                            'type_id': $(tr).find('td:eq(0)').text(),
                                            'details': $(tr).find('td:eq(2)').text(),
                                            'price': $(tr).find('td:eq(3)').text(),
                                            'qty': $(tr).find('td:eq(4)').text(),
                                            'total_amt': $(tr).find('td:eq(5)').text(),
                                        };
                                        table_data.push(sub);
                                    });
                                    var data = {
                                        'data_table': table_data, 
                                        serial_no: serial_no, 
                                        guest_id: guest_id,
                                        amt_total: amt_total, 
                                        discount_check: discount_check, 
                                        discount_remarks: discount_remarks
                                    };
                                    $.ajax({
                                        url: "<?= base_url('main/consumable_tocks')?>",
                                        method: "POST",
                                        data: data,
                                        dataType: "json",
                                        success: function(data) {
                                            if (data.message == 'Success') {
                                                console.log(data);
                                            }
                                        }
                                    });

                                    // alert('Success');
                                    var url = "<?= base_url('sales_invoice?transaction=')?>" + serial_no;
                                    window.open(url, 'targetWindow','resizable=yes,width=1000,height=1000');
                                    location.reload();
                                    $('registerGuest').trigger('reset');
                                } else {
                                    alert('Failed to save');
                                }
                            },
                            error: function() {
                                alert('Failed');
                            }
                        });
                    } else {
                        Swal.fire('Warning!', 'Please accept the agreement.', 'warning');
                    }
                    break;
            }
            
        });

        $(document).on('click', '#add_discount', function() {
            if ($(this).is(':checked')) {
                $('#discountModal').modal('show');
                $('#discount_checked').val(1);
            } else {
                $('#discountModal').modal('hide');
                $('#discount').text('');
                $('#discount_remarks').text('');
                $('.discount_added').hide(200);
                $('#discount_checked').val(0);
                var totalSum = 0;
                $('#table_inventory tbody tr.row2').each(function() {
                    var sumCell = $(this).find('td:eq(5)');
                    var sumValue = parseFloat(sumCell.text());
                    totalSum += sumValue;
                });
                $('#amount').text(totalSum.toLocaleString('en-US', {maximumFractionDigits: 2}))
                $('#amt_total').val(totalSum);
            } 
        });

        $(document).on('change', '#package', function() {
            var package = $(this).val();

            $.ajax({
                url: "<?php echo base_url(); ?>main/get_package_details",
                method: "POST",
                data: {
                    package: package
                },
                success: function(data) {
                    $('#pricing_id').html(data);
                }
            });
        });
        
    });
</script>