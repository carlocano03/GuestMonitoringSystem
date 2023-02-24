<style>
    #signature {
        background: #fff;
        height: 100px;
        border-radius: 5px;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pb-3 main-section">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mt-2 text-white">Customer & Guest Registration</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-white">Customer & Guest Registration</li>
                        <li class="breadcrumb-item text-yellow">Payment Details</li>
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
            <div class="row">
                <div class="col-md-8 mb-3">
                    <div class="card card-info">
                        <div class="card-body">
                            <h4>Customer & Guest Information</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="<?= base_url('assets/img/avatar-new.png') ?>" style="width:100px;" alt="Avatar Image">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <small class="fw-bold text-ube mb-0" style="font-size: 12px;">SN: 1234567890</small>
                                            <h5 class="fw-bold mb-0">Alison Fajardo</h5>
                                            <div style="font-size: 10px;" class="fw-bold text-ube">
                                                <span>5 years old</span><br>
                                                <span>0931-106-2880</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="<?= base_url('assets/img/avatar-new.png') ?>" style="width:100px;" alt="Avatar Image">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <small class="fw-bold text-ube mb-0" style="font-size: 12px;">SN: 1234567890</small>
                                            <h5 class="fw-bold mb-0">Elorde Borja</h5>
                                            <div style="font-size: 10px;" class="fw-bold text-ube">
                                                <span>5 years old</span><br>
                                                <span>0931-106-2880</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="mt-3">Child Count:</h4>
                                    <h2 class="text-danger">2</h2>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="<?= base_url('assets/img/avatar-new.png') ?>" style="width:100px;" alt="Avatar Image">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <small class="fw-bold text-ube mb-0" style="font-size: 12px;">SN: 1234567890</small>
                                            <h5 class="fw-bold mb-0">Mrs. Miriam Borja</h5>
                                            <div style="font-size: 10px;" class="fw-bold text-ube">
                                                <span>Parent / Guardian</span><br>
                                                <span>0931-106-2880</span><br>
                                                <span>miriamborja@gmail.com</span><br>
                                                <span>Purok Onse, Ortigas, Pasig City, Metro Manila PH</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5>Consent & Other Details</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Picture / Image Capture
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Parent Signature
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Waiver & Quitclaim Form
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I agree to the terms & conditions
                                        </label>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-ube btn-sm"><i class="bi bi-pencil-square me-2"></i>EDIT DETAILS</button>
                                        <button class="btn btn-leche btn-sm"><i class="bi bi-folder-plus me-2"></i>ADD INVENTORY</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-bold">Parent / Guardian Signature</label>
                                    <div id="signature">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-info mb-3">
                        <div class="card-package mt-3">
                            <h4 class="card-title ms-3">PACKAGE DETAILS</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-details">
                                <h5 class="fs-6 mb-3"><i class="fas fa-calendar-alt me-2"></i>DATE: SEPTEMBER 25, 2022 - SUNDAY</h5>
                                <div class="d-flex justify-content-start mb-3">
                                    <h5 class="fs-6 me-2"><i class="far fa-clock me-1"></i>Start Time: <span class="start">1:24 PM</span></h5>
                                    <h5 class="fs-6"><i class="far fa-clock me-1"></i>End Time: <span class="end">2:24 PM</span></h5>
                                </div>
                                <hr class="mb-2">
                                <table width="100%">
                                    <tr>
                                        <td class="fw-bold">Package:</td>
                                        <td>1 Hour</td>
                                    </tr>
                                    <tr>
                                        <td>Amount:</td>
                                        <td>60.00</td>
                                    </tr>
                                    <tr>
                                        <td>Head Count: <b>2</b></td>
                                        <td><b>120.00</b></td>
                                    </tr>
                                </table>
                                <hr class="mt-0 mb-1">
                                <table width="100%">
                                    <tr>
                                        <td class="fw-bold">Others</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Socks (Pair):</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>1 - adult</td>
                                        <td class="fw-bold">50.00</td>
                                    </tr>
                                    <tr>
                                        <td>1 - child</td>
                                        <td class="fw-bold">100.00</td>
                                    </tr>
                                </table>
                                <hr class="mt-0 mb-1">
                                <table width="100%">
                                    <tr>
                                        <td class="fw-bold">Overtime:</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Additional Amount:</td>
                                        <td></td>
                                    </tr>
                                </table>
                                <hr class="mt-1 mb-1">
                                <div class="d-flex justify-content-end mt-5">
                                    <h5 class="me-5">Total:</h5>
                                    <h5 class="text-danger me-1">250.00</h5><b>PHP</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn-package-primary">PROCESS <span>PAYMENT & PRINT</span></button>
                    <button class="btn-package-secondary">SAVE & EXIT</button>
                </div>
                <hr>

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