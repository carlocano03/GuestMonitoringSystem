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
            </div>
            <form method="POST" id="registerGuest" enctype="multipart/form-data">
                <input type="hidden" id="serial_no" name="serial_no" value="<?= $serial?>">
                <input type="hidden" name="guest_id" id="guest_id">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <div class="box-section mb-3">
                        <div class="box-header">
                            GUEST REGISTRATION MODULE
                        </div>
                        <div class="fw-bold"><small>PARENTS / GUARDIAN DETAILS</small></div>
                        <hr class="mt-0">
                        <div class="form-group mb-2">
                            <input type="text" name="serialno" id="f_name" class="form-control text-uppercase" placeholder="Enter Serial No.">
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
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    I hereby acknowledge and accept the <a href="#">"Waiver and Quitclaim"</a> and agree to <a href="#">Data Privacy Act of 2012</a>
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
                            <select name="pricing_id" id="pricing_id" class="form-select text-uppercase">
                                <option value="">Select Time</option>
                                <?php foreach($pricing as $row) : ?>
                                    <option value="<?= $row->pricing_id?>"><?= $row->admission_type?></option>
                                <?php endforeach;?>
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
                        </div>                        <div class="form-group mb-2">
                            <input type="text" name="child_fname" id="child_fname" class="form-control text-uppercase" placeholder="Enter First Name (Juan)">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="child_lname" id="child_lname" class="form-control text-uppercase" placeholder="Enter Last Name (Bonifacio)">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="child_mname" id="child_mname" class="form-control text-uppercase" placeholder="Enter Middle Name (Cruz)">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="child_bday" id="child_bday" class="form-control text-uppercase" placeholder="Birthday (dd/mm/yyyy)" onfocus="(this.type='date')" onfocusout="(this.type='text')">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="child_age" id="child_age" class="form-control text-uppercase" placeholder="Age">
                        </div>
                        
                        <div class="form-group mb-2">
                            <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#cameraModalChild"><i class="bi bi-camera-fill me-2"></i>CAPTURE IMAGE</button>
                        </div>
                        <div class="form-group mb-2 camera_child">
                            <div id="results_child">
                                <img style="width: 200px;" class="after_capture_frame_child" src="image_placeholder.jpg" />
                            </div>
                            <input type="hidden" name="captured_image_data_child" id="captured_image_data_child">
                            
                        </div>
                        <button class="btn btn-primary btn-sm" id="add_children"><i class="bi bi-plus-circle me-2"></i>Add More</button>
                        <button class="btn btn-danger btn-sm" id="remove"><i class="bi bi-x-circle me-2"></i>Remove</button><br>

                                        <hr>
                        
                        <div class="fw-bold"><small>OTHERS</small></div>
                        <div class="form-group mb-2">
                            <input type="text" name="child_guardian" id="child_guardian" class="form-control text-uppercase" placeholder="Name of Additional Guardian">
                        </div>
                        <div class="form-group mb-2">
                            <button type="button" class="btn btn-success fw-bold w-100 add_inventory"><i class="bi bi-plus-square me-2"></i>ADD TO CART</button>
                        </div>
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
                            <button type="button" class="btn btn-success fw-bold w-100 add_inventory"><i class="bi bi-plus-square me-2"></i>ADD CART</button>
                        </div>
                        <hr>
                        <div class="fw-bold mt-3"><small>INVENTORY CART</small></div>
                        <div class="table-responsive mt-0">
                            <table class="table table-bordered table-striped" width="100%" style="vertical-align:middle;" id="table_inventory">
                                <thead>
                                    <tr>
                                        <th style="display:none;"></th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Amount</th>
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
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="fw-bold mt-3"><small>SALES INVOICE</small></div>
                        <p>
                        Date: Tue, 4 April 2023<br>
                        Jack's Adventure - SM Grand Central<br>
                        <hr>   </p>

                        <table class="table table-bordered table-striped" width="100%" style="vertical-align:middle;" id="sales_invoice">
                                <thead>
                                    <tr>
                                        <th style="display:none;"></th>
                                        <th>Items</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                         <th>Total Amount</th>
                                         <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="display:none;" id="row1">
                                        <td>PP One Hour</td>
                                        <td>150</td>
                                        <td>3</td>
                                        <td>Amount + Qty</td>
                                        <td>Discounted / Free </td>
                                        <td>Remove / Edit</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            Discount
                            <h3><b>Total Amount: PHP 0,000.00</b></h3>
                                              <hr>
                        <div class="form-group mb-2">
                            <button type="reset" class="btn btn-secondary btn-lg w-100">CLEAR</button>
                                </div>
                            <div class="form-group mb-2">
                            <button type="submit" class="btn btn-success btn-lg w-100">PROCESS PAYMENT</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end of row -->
        </div>
        <!-- Main div -->
    </main>

    <!-- Modal -->
    <div class="modal fade" id="cameraModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-camera-fill me-2"></i>Live Camera</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="my_camera" class="pre_capture_frame mx-auto" ></div>
		            <!-- <input type="hidden" name="captured_image_data" id="captured_image_data"> -->
		            <br>
		            <input type="button" class="btn btn-success btn-lg w-100" value="CAPTURE" onClick="take_snapshot()">	
                </div>
                <hr>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="cameraModalChild" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-camera-fill me-2"></i>Live Camera</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="my_camera_child" class="pre_capture_frame_child mx-auto" ></div>
		            <!-- <input type="hidden" name="captured_image_data_child" id="captured_image_data_child"> -->
		            <br>
		            <input type="button" class="btn btn-success btn-lg w-100" value="CAPTURE" onClick="take_snapshot_child()">	
                </div>
                <hr>
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

    //Camera for Children
    Webcam.set({
	    width: 360,
	    height: 287,
	    image_format: 'jpeg',
	    jpeg_quality: 90
	});	 
	Webcam.attach('#my_camera_child');
	
	function take_snapshot_child() {
	 // play sound effect
	 //shutter.play();
	 // take snapshot and get image data
        $('.camera_child').show(200);
	    Webcam.snap( function(data_uri) {
	 // display results in page
            document.getElementById('results_child').innerHTML = 
            '<img class="after_capture_frame_child" src="'+data_uri+'"/>';
            $("#captured_image_data_child").val(data_uri);
	    });	 
	}


    var present_provcode;
    var present_muncode;
    var present_brgycode;
    $(document).ready(function() {
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

                            //Package Details
                            $("#package").val(data.service == null ? '' : data.service).trigger('change');
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

            if (qty == '') {
                Swal.fire('Warning!', 'Please input valid quantity.', 'warning');
            } else {
                $('#table_inventory tbody').append(
                    '<tr class="row2">' +
                        '<td style="display:none;">'+inv_id+'</td>' +
                        '<td>'+type+'</td>' +
                        '<td>'+price+'</td>' +
                        '<td>'+qty+'</td>' +
                        '<td>'+amt+'</td>' +
                        '<td><span class="remove_row">Remove</span></td>' +
                    '</tr>'
                );
            }
        });
        $('#table_inventory tbody').on('click', '.remove_row', function() {
            $(this).closest('tr').remove(); // Remove the parent row
        });

        $(document).on('submit', '#registerGuest', function(event){
            event.preventDefault();
            var table_data = [];
            var serial_no = $('#serial_no').val();
            var guest_id = $('#guest_id').val();

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
                                'price': $(tr).find('td:eq(2)').text(),
                                'qty': $(tr).find('td:eq(3)').text(),
                                'total_amt': $(tr).find('td:eq(4)').text(),
                            };
                            table_data.push(sub);
                        });
                        var data = {'data_table': table_data, serial_no: serial_no, guest_id: guest_id};
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
                        alert('Success');
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
        });
    });
</script>