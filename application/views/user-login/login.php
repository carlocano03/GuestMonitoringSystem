<style>
    body {
        
        background-size: cover;
        background-attachment: fixed;
    }
</style>

<body>
    <main>
        <div class="container d-flex align-items-center justify-content-center min-vh-100">
            <div class="container login-section">
                <div class="login-header" style="background: #99cc00;"></div>
                <div class="login-header-details text-center">
               
                   
                    <img src="<?= base_url('assets/img/logo/jacks.png') ?>" alt="Jacks Adventure">
                    <h5 style="color:#8F3F96;">ACCOUNT LOGIN</h5>
                    <div style="color: #93C106;">JACK'S ADVENTURE GUEST MONITORING SYSTEM</div>
                    </div>
                <div class="login-form text-center">
                    <div class="message"></div>
                    <form id="loginAccount" method="POST">
                        <div class="form-group mb-3">
                            <label for="username" class="fw-bold">USERNAME</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="fw-bold">PASSWORD</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <button type="submit"  style="background:#8F3F96;">LET'S GO!</button>
                    </form>

                    <div class="login-footer text-start mt-3">
                        <p>
                            For software assistance, contact us<br>
                            Information Technology & Services Department - Head Office<br>
                          
                            (02) 6373-76200 loc.6214<br>
<!--
                            For User Manual Guide, please click download<br>
                            <a href="#" >Download User Manual Guide</a>-->
                        </p>
                        <div class="row g-0 d-flex align-items-center text-center">
                            <div class="col-md-6 col-lg-3 col-sm-6">
                                <img src="<?= base_url('assets/img/logo/toms.png') ?>" alt="Jacks Adventure" width="100">
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

    <script>
        $(document).ready(function() {
            $(document).on('submit', '#loginAccount', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();

                $.ajax({
                    url: "<?= base_url() . 'user/login_process' ?>",
                    method: "POST",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.error != '') {
                            $('.message').html(data.error);
                            setTimeout(function() {
                                $('.message').html('');
                            }, 3000)
                        } else {
                            $('.message').html(data.success);
                            setTimeout(function() {
                                $('#message').html('');
                                window.location.href = "<?= base_url() . 'main' ?>";
                            }, 3000);
                        }
                    }
                });
            });
        });
    </script>