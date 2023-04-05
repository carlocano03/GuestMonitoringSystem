<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pb-3 main-section">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mt-2 text-white">Customer & Guest Registration</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-white">Customer & Guest Registration</li>
                        <li class="breadcrumb-item text-yellow">Add Records</li>
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
            <div class="row g-2">
                <div class="col-md-5">
                    <div class="card card-info mb-3">
                        <div class="card-package mt-3">
                            <h4 class="card-title ms-3">ENTRANCE APPLICATION</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" name="serial_no" placeholder="Serial Number (Auto Generate)">
                            </div>
                            <small class="fw-bold">GUARDIAN DETAILS</small>
                            <hr class="mt-0 mb-2">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control" name="f_name" placeholder="Enter First Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control" name="m_name" placeholder="Enter Middle Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control" name="l_name" placeholder="Enter Last Name">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <select name="relationship" class="form-select">
                                            <option value="">Relationship</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control" name="address" placeholder="Address">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control" name="contact" placeholder="Contact No / Details">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <input type="email" class="form-control" name="email" placeholder="Email Address">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group mb-2">
                                        <input type="file" class="form-control" name="inFile">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-2">
                                        <button class="btn btn-leche">CAPTURE IMAGE</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control" name="created_by" placeholder="Guest / Service Crew: (Created by)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control" name="bag_no" placeholder="BAG Number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control" name="shoe_box" placeholder="Shoe Box Number">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I hereby acknowledge and accept the "Waiver and Quitclaim"
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card card-info mb-3">
                        <div class="card-body">
                            <p class="fw-bold mb-0">KIDS / CHILD DETAILS</p>
                            <div class="row g-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="child_fname" placeholder="Enter First Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="child_mname" placeholder="Enter Middle Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="child_lname" placeholder="Enter Last Name">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="bday" placeholder="Birthday">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="age" placeholder="Age">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button class="btn btn-leche w-100">CAPTURE IMAGE</button>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-0">
                            <p class="fw-bold mb-0">PACKAGE DETAILS</p>
                            <div class="row g-2">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <select name="package" class="form-select">
                                            <option value="">Playtime</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="package_details" class="form-select">
                                            <option value="">Platinum</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <button class="btn btn-ube w-100"><i class="bi bi-plus-circle-fill me-2"></i>ADD</button>
                                    </div>
                                </div>
                                <label class="fw-bold mb-0">INVENTORY DETAILS</label>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inventory" placeholder="Socks">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-ube w-100"><i class="bi bi-plus-circle-fill me-2"></i>ADD</button>
                                    </div>
                                </div>
                                <label class="fw-bold mb-0">OTHERS</label>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="inventory" placeholder="Socks">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button class="btn btn-ube w-100"><i class="bi bi-plus-circle-fill me-2"></i>ADD</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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