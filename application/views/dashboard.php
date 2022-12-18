<style>
    #table-guest th,
    #table-guest td {
        text-align: center;
    }
    #table-guest th:nth-child(3) {
        background: #00b894;
    }
    #table-guest th:nth-child(4) {
        background: #b71540;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 main-section">
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
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" name="search_value" id="search_value"
                            placeholder="Search Here...">
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <select class="form-select" name="sort_by" id="sort_by">
                                <option value="">Sort By</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 mb-2">
                        <button class="btn btn-ube">GUEST REGISTRATION</button>
                    </div>
                    <div class="col-6 mb-3">
                        <button class="btn btn-leche">VIEW ALL CHECK OUT</button>
                    </div>

                    <div class="details-body">
                        <h3 class="text-ube">Counter Breakdown: 5</h3>
                        <div class="counter d-flex align-items-center mb-2">
                            <div class="counter-danger me-2"></div><span class="counter-danger-text">5 Minutes
                                Left</span>
                        </div>
                        <div class="counter d-flex align-items-center mb-2">
                            <div class="counter-success me-2"></div><span class="counter-text">15 Minutes Left</span>
                        </div>
                        <div class="counter d-flex align-items-center mb-2">
                            <div class="counter-primary me-2"></div><span class="counter-text">30 Minutes Left</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="card card-danger mb-4 guest">
                                <div class="card-body p-2">
                                    <img src="assets/img/avatar.png" alt="Avatar Image" class="card-avatar me-3">
                                    <div class="card-text">
                                        <h5>Guest A</h5>
                                        <h5>Time Left: 2:31</h5>
                                        <span class="btn-checkout me-1" title="Checkout"><i
                                                class="fas fa-check-square me-1"></i>CHECK OUT</span>
                                        <span class="btn-extend ms-1" title="Extend"><i
                                                class="fas fa-clock me-1"></i>EXTEND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="card card-danger mb-4 guest">
                                <div class="card-body p-2">
                                    <img src="assets/img/avatar.png" alt="Avatar Image" class="card-avatar me-3">
                                    <div class="card-text">
                                        <h5>Guest B</h5>
                                        <h5>Time Left: 2:31</h5>
                                        <span class="btn-checkout me-1" title="Checkout"><i
                                                class="fas fa-check-square me-1"></i>CHECK OUT</span>
                                        <span class="btn-extend ms-1" title="Extend"><i
                                                class="fas fa-clock me-1"></i>EXTEND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="card card-success mb-4 guest">
                                <div class="card-body p-2">
                                    <img src="assets/img/avatar.png" alt="Avatar Image" class="card-avatar me-3">
                                    <div class="card-text">
                                        <h5>Guest C</h5>
                                        <h5>Time Left: 2:31</h5>
                                        <span class="btn-checkout me-1" title="Checkout"><i
                                                class="fas fa-check-square me-1"></i>CHECK OUT</span>
                                        <span class="btn-extend ms-1" title="Extend"><i
                                                class="fas fa-clock me-1"></i>EXTEND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="card card-success mb-4 guest">
                                <div class="card-body p-2">
                                    <img src="assets/img/avatar.png" alt="Avatar Image" class="card-avatar me-3">
                                    <div class="card-text">
                                        <h5>Guest D</h5>
                                        <h5>Time Left: 2:31</h5>
                                        <span class="btn-checkout me-1" title="Checkout"><i
                                                class="fas fa-check-square me-1"></i>CHECK OUT</span>
                                        <span class="btn-extend ms-1" title="Extend"><i
                                                class="fas fa-clock me-1"></i>EXTEND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6 mb-3">
                            <div class="card card-primary guest">
                                <div class="card-body p-2">
                                    <img src="assets/img/avatar.png" alt="Avatar Image" class="card-avatar me-3">
                                    <div class="card-text">
                                        <h5>Guest D</h5>
                                        <h5>Time Left: 2:31</h5>
                                        <span class="btn-checkout me-1" title="Checkout"><i
                                                class="fas fa-check-square me-1"></i>CHECK OUT</span>
                                        <span class="btn-extend ms-1" title="Extend"><i
                                                class="fas fa-clock me-1"></i>EXTEND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of row -->

            <div class="table-holder">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%" style="vertical-align:middle;"
                        id="table-guest">
                        <thead class="text-uppercase">
                            <tr>
                                <th>Action</th>
                                <th>Serial No.</th>
                                <th>Date</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Guest Name</th>
                                <th>Parent / Guardian</th>
                                <th>Contact #</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <hr>
                <div class="text-end">
                    <button class="btn btn-ube btn-sm"><i class="bi bi-printer-fill me-2"></i>PRINT REPORTS</button>
                </div>
            </div>

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