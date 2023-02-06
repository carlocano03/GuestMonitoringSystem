<style>
    #table-guest th,
    #table-guest td,
    #table-inventory th,
    #table-inventory td {
        text-align: center;
    }

    #table-guest th:nth-child(3),
    #table-inventory th:nth-child(3) {
        background: var(--bs-yellow);
        color: #2d3436;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pb-3 main-section">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mt-2 text-white">Main Dashboard</h2>
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
                    <a href="" class="btn-signout">SIGN OUT <i class="bi bi-box-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 mt-4">
            <div class="row">
                <div class="col-md-7">
                    <div class="row g-1">
                        <div class="col-7">
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" name="search_value" id="search_value" placeholder="Search Pre-Registration No. / Name / Here...">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group mb-2">
                                <button class="btn btn-primary"><i class="bi bi-search me-2"></i>SEARCH</button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="box-section">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped text-uppercase" width="100%" style="vertical-align:middle;" id="table-guest">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th>SERIAL NO.</th>
                                        <th>DATE</th>
                                        <th>PLAY CATEGORY</th>
                                        <th>KIDS/CHILDS NAME</th>
                                        <th>PARENT/GUARDIAN</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>12345</td>
                                        <td>JAN. 24, 2023</td>
                                        <td>Park</td>
                                        <td>Juan Dela Cruz</td>
                                        <td>N/A</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm"><i class="bi bi-check2-square me-1"></i>REGISTER NOW</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mb-5">
                    <div class="box-section mb-3">
                        <div class="box-header">
                            ENTRANCE APPLICATION
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="serial_no" id="serial_no" class="form-control" placeholder="Serial Number (Auto Generate)">
                        </div>
                        <div class="fw-bold"><small>GURDIAN DETAILS</small></div>
                        <hr class="mt-0">
                        <div class="form-group mb-2">
                            <input type="text" name="f_name" id="f_name" class="form-control" placeholder="Enter First Name (Juan)">
                        </div>
                        <div class="row g-1">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <input type="text" name="m_name" id="m_name" class="form-control" placeholder="Enter Middle Name (Cruz)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <input type="text" name="l_name" id="l_name" class="form-control" placeholder="Enter Last Name (Bonifacio)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <input type="text" name="suffix" id="suffix" class="form-control" placeholder="Suffix (Jr. Sr. III)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <select name="relationship" id="relationship" class="form-select">
                                        <option value="">Relationship</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <select name="province" id="province" class="form-select">
                                <option value="">Select Province</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <select name="municipality" id="municipality" class="form-select">
                                <option value="">Select Municipality</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <select name="barangay" id="barangay" class="form-select">
                                <option value="">Select Barangay</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="street" id="street" class="form-control" placeholder="House No. / Bldg No. / Street">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="contact" id="contact" class="form-control" placeholder="Contact Number / Details">
                        </div>
                        <div class="form-group mb-2">
                            <input type="email" name="email_add" id="email_add" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="row g-1">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <input type="file" name="image" id="image" class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <button class="btn btn-primary"><i class="bi bi-camera-fill me-2"></i>CAPTURE IMAGE</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="service_crew" id="service_crew" class="form-control" placeholder="GUEST / SERVICE CREW (Created By)">
                        </div>
                        <div class="row g-1">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <input type="text" name="bag_no" id="bag_no" class="form-control" placeholder="BAG Number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <input type="text" name="shoe_box" id="shoe_box" class="form-control" placeholder="Shoe Box Number">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    I hereby acknowledge and accept the "Waiver and Quitclaim" and agree to <a href="">Data Privacy Act of 2012</a>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="box-section mb-3">
                        <div class="fw-bold"><small>PACKAGE DETAILS</small></div>
                        <div class="form-group mb-2">
                            <select name="package" id="package" class="form-select">
                                <option value="">Select Package</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <select name="time" id="time" class="form-select">
                                <option value="">Select Time</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <select name="category" id="category" class="form-select">
                                <option value="">Select Category</option>
                            </select>
                        </div>
                        <div class="fw-bold"><small>KIDS / CHILD INFORMATION</small></div>
                        <div class="form-group mb-2">
                            <input type="text" name="child_fname" id="child_fname" class="form-control" placeholder="Enter First Name (Juan)">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="child_lname" id="child_lname" class="form-control" placeholder="Enter Last Name (Bonifacio)">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="child_mname" id="child_mname" class="form-control" placeholder="Enter Middle Name (Cruz)">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="child_bday" id="child_bday" class="form-control" placeholder="Birthday (dd/mm/yyyy)" onfocus="(this.type='date')" onfocusout="(this.type='text')">
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="child_age" id="child_age" class="form-control" placeholder="Age">
                        </div>
                        <div class="row g-1">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <input type="file" name="child_image" id="child_image" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <button class="btn btn-primary"><i class="bi bi-camera-fill me-2"></i>CAPTURE IMAGE</button>
                                </div>
                            </div>
                        </div>
                        <div class="fw-bold"><small>OTHERS</small></div>
                        <div class="form-group mb-2">
                            <input type="text" name="child_guardian" id="child_guardian" class="form-control" placeholder="Name of Additional Guardian">
                        </div>
                        <div class="form-group mb-2">
                            <button class="btn btn-primary btn-lg w-100 mt-3">NEXT</button>
                        </div>
                    </div>

                    <div class="box-section">
                        <div class="fw-bold"><small>INVENTORY</small></div>
                        <div class="form-group mb-2">
                            <select name="category" id="category" class="form-select">
                                <option value="">Socks Type</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Quantity">
                        </div>
                        <div class="form-group mb-2">
                            <button class="btn btn-warning fw-bold w-100"><i class="bi bi-plus-square me-2"></i>ADD</button>
                        </div>
                        <div class="fw-bold mt-3"><small>INVENTORY DETAILS</small></div>
                        <div class="table-responsive mt-0">
                            <table class="table table-bordered table-striped" width="100%" style="vertical-align:middle;" id="table-inventory">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                        <div class="form-group mb-2">
                            <button class="btn btn-primary btn-lg w-100">NEXT</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of row -->
        </div>
        <!-- Main div -->

    </main>
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
    });
</script>