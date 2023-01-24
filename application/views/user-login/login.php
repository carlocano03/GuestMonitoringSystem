<style>
    /* body {
        background-image: url("<?= base_url('assets/img/bg1.png')?>");
        background-size: cover;
        background-attachment:fixed;
    } */
</style>
<body>
    <main>
        <div class="container d-flex align-items-center min-vh-100">
            <div class="container login-section">
                <div class="row g-0">
                    <div class="col-md-7">
                        <div class="login-title">
                            <h5>Welcome Guest & Visitors!</h5>
                        </div>
                        <div class="title-footer">
                            <div class="row g-0">
                                <div class="col-md-3 p-3 text-center">
                                    <img src="<?= base_url('assets/img/qr-code.png')?>" style="width:130px;"/>
                                </div>
                                <div class="col-md-9 p-3">
                                    <img src="<?= base_url('assets/img/logoTW.png')?>"/>
                                    <div>
                                        <p class="mb-0" style="font-size: 20px;">A lifestyle of FUN cherished by Everyone</p>
                                        <a href="#">www.tomsworld.com</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="login-header">
                            <h5>Guest Monitoring System Web App</h5>
                        </div>
                        <div class="sub-header">
                            <h5>LOGIN FORM</h5>
                        </div>
                        <div class="row p-2">
                            <div class="col-9">
                                <p class="mb-1">Please select your login credentials</p>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1"
                                        autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm" for="btnradio1">Austin Land</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2"
                                        autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm" for="btnradio2">Austin House</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3"
                                        autocomplete="off">
                                    <label class="btn btn-outline-secondary btn-sm" for="btnradio3">Jack's
                                        Adventure</label>
                                </div>
                            </div>
                            <div class="col-3">
                                <img src="<?= base_url('assets/img/verified-account.png')?>" />
                            </div>
                        </div>
                        <div class="login-form">
                            <form method="POST">
                                <div class="form-group mb-4">
                                    <label>USERNAME</label>
                                    <input type="text" class="form-control"
                                        placeholder="Please Enter your Username here...">
                                </div>
                                <div class="form-group mb-4">
                                    <label>PASSWORD</label>
                                    <input type="password" class="form-control"
                                        placeholder="Please Enter your Password here...">
                                </div>
                                <div class="d-grid gap-2 col-12 mx-auto mb-2">
                                    <button class="btn-login" type="button">LOG IN</button>
                                </div>
                            </form>
                            <p class="mb-0">Forgot Password?</p>
                            <a href="">Click Here</a>
                            <div class="login-footer mt-4">
                                <p>For Software Assistance: <br>
                                   Antel Global - Toms World Head Office <br>
                                   <b>Integrated Technology & Services Department</b> <br>
                                   Software Development Team <br><br>

                                   
                                   <i class="bi bi-telephone me-2"></i>(02) 737-6212 / 0918-921-7348 <br>
                                   <i class="bi bi-envelope me-2"></i>Vhran.Guanio@tomsworld.com.ph <br>
                                   Ticketing System <br>
                                   <a href="#">123.456.789/ticketingSystem</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>