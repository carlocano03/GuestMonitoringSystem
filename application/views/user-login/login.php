<style>
    body {
        background-image: url("<?= base_url('assets/img/bg-img.png') ?>");
        background-size: cover;
        background-attachment: fixed;
    }
</style>

<body>
    <main>
        <div class="container d-flex align-items-center justify-content-center min-vh-100">
            <div class="container login-section">
                <div class="login-header"></div>
                <div class="login-header-details text-center">
                    <p>
                        Toms World Philippines<br>
                        Integrated Technology & Services Department
                    </p>
                    <div>GUEST MONITORING SYSTEM</div>
                    <img src="<?= base_url('assets/img/logo/toms.png') ?>" alt="Toms-World">
                    <h5>ACCOUNT LOGIN</h5>
                </div>
                <div class="login-form text-center">
                    <form action="">
                        <div class="form-group mb-3">
                            <label for="username" class="fw-bold">USERNAME</label>
                            <input type="text" class="form-control" name="username" id="username">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="fw-bold">PASSWORD</label>
                            <input type="password" class="form-control" name="password" id="password">
                        </div>
                        <button type="submit">LOGIN</button>
                    </form>

                    <div class="login-footer text-start mt-3">
                        <p>
                            For software assistance, contact us<br>
                            Integrated Technology & Services Department - Head Office<br>
                            Email: vhran.guanio@tomsworld.com.ph<br>
                            (089) 6214
                        </p>
                        <div class="row g-0 d-flex align-items-center text-center">
                            <div class="col-md-6 col-lg-3 col-sm-6">
                                <img src="<?= base_url('assets/img/logo/jacks.png') ?>" alt="Jacks Adventure" width="100">
                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-6">
                                <img src="<?= base_url('assets/img/logo/austin_house.jpg') ?>" alt="Austin House" width="100">
                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-6">
                                <img src="<?= base_url('assets/img/logo/austin.png') ?>" alt="Austin Land" width="100">
                            </div>
                            <div class="col-md-6 col-lg-3 col-sm-6">
                                <img src="<?= base_url('assets/img/logo/adams.png') ?>" alt="Austin Land" width="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>