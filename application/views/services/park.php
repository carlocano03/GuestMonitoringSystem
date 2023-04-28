<style>
    .select2-selection__rendered {
      line-height: 36px !important;
    }

    .select2-selection {
      height: 38px !important;
      text-align: left !important;
    }
</style>
<body onload="startTime()">
    <main>
    <div class="container">
            <BR>
            <a href="<?= base_url('home/services') ?>">
            <button style="border-radius:100px;" class="btn btn-warning fw-bold">GO BACK</button>
            </a>
        </div>
        <div class="container">

            <div class="float">
                <p class="float">
                    <img src="<?= base_url('assets/img/arrow-down.gif'); ?>" alt="" width="100"><br>
                    SLIDE UP<br>
                    TO CONTINUE<br>
                </p>
            </div>

            <div class="img-holder text-center">
                <img class="img-icon" src="<?= base_url('assets/img/logo/par.png'); ?>" alt="Park" style="margin-bottom: -20px;">
                <div class="text-header">
                    <div id="clock" class="mt-0"></div>
                    <div id="date"></div>
                   
                </div>
            </div>

            <div class="reg-section">
                <div class="header-section text-center">
                    <h5 class="mb-0">PRE-REGISTRATION FORM</h5>
                    <p>Tired waiting in line, for your convenience fill up your details.<br>
                </p>
                </div>
                <div class="reg-form text-center">
                    <form id="registerPark" method="POST" class="needs-validation" novalidate>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control text-uppercase" name="fname" id="fname" placeholder="Enter First Name (Juan)" required autocomplete="off">
                            <div class="invalid-feedback text-start">
                                Please input your firstname.
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control text-uppercase" name="lname" id="lname" placeholder="Enter Last Name (Bonifacion, Jr.)" required autocomplete="off">
                            <div class="invalid-feedback text-start">
                                Please input your lastname.
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control text-uppercase" name="mname" id="mname" placeholder="Enter Middle Name (Cruz)" required autocomplete="off">
                            <div class="invalid-feedback text-start">
                                Please input your middlename.
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control text-uppercase" name="suffix" id="suffix" placeholder="Enter Suffix (Jr. Sr. III)" autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control text-uppercase" name="birthday" id="birthday" placeholder="Enter Birthday" required autocomplete="off">
                            <div class="invalid-feedback text-start">
                                Please input your birthday.
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control text-uppercase" name="age" id="age" placeholder="Enter Age" readonly required>
                        </div>
                        <div class="alert alert-secondary p-1 text-start">Complete Address</div>
                        <div class="form-group mb-3">
                            <select name="province_code" id="province_code" class="form-select text-uppercase" required>
                                <option value="">Select Province</option>
                                <?php foreach ($province as $pval) { ?>
                                    <option value="<?= $pval->code ?>"><?= strtoupper($pval->name) ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback text-start">
                                Please select your province.
                            </div>
                            <input type="hidden" name="province" id="province">
                        </div>
                        <div class="form-group mb-3">
                            <select name="municipal_code" id="municipal_code" class="form-select text-uppercase" required>
                                <option value="">Select Municipality</option>
                            </select>
                            <div class="invalid-feedback text-start">
                                Please select your municipality.
                            </div>
                            <input type="hidden" name="municipal" id="municipal">
                        </div>
                        <div class="form-group mb-3">
                            <select name="barangay_code" id="barangay_code" class="form-select text-uppercase" required>
                                <option value="">Select Barangay</option>
                            </select>
                            <div class="invalid-feedback text-start">
                                Please select your barangay.
                            </div>
                            <input type="hidden" name="brgy" id="brgy">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control text-uppercase" name="street" id="street" placeholder="Enter House No. Street"  autocomplete="off">
                            <div class="invalid-feedback text-start">
                                Please input your street.
                            </div>
                        </div>
                        <hr>
                        <div class="form-group mb-3">
                            <input type="number" class="form-control" name="contact_no" id="contact_no" placeholder="Contact Number" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" autocomplete="off">
                            <div class="invalid-feedback text-start">
                                Please input your contact no.
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address"  autocomplete="off">
                            <div class="invalid-feedback text-start">
                                Please input your email address.
                            </div>
                        </div>
                        <div class="form-check text-start mb-3">
                            <input class="form-check-input" type="checkbox" id="waiver_check" required>
                            <label class="form-check-label" for="waiver_check">
                                I hereby acknowledge and accept the <a href="#quitClaimModal" data-bs-toggle="modal">"Waiver and Quitclaim"</a> and agree to <a href="#dataPrivacyModal" data-bs-toggle="modal">Data Privacy Act of 2012</a>
                            </label>
                        </div>
                        <button class="save_record" type="submit">SAVED RECORD</button>
                    </form>
                </div>
            </div>
            <hr>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="modalSuccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h2 class="text-green">REGISTRATION SUCCESSFULLY!</h2>
                    <hr>
                    <p>Direction:<br>
                    Print / Capture your Registration No.<br>
                    Present this information to Jack's Adventure Staff Personnel.<br>
                       
                    </p>
                    <hr>
                    <b>Registration Date:</b> <span id="date_reg"></span>
                    <h5 class="text-green">REGISTRATION NO.</h5>
                    <h4 id="reg_no"></h4>
                    <button class="btn btn-primary w-100 mb-3" id="print_slip">PRINT</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('popup/quitclaim.php');?>
    <?php $this->load->view('popup/data_privacy.php');?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
        $(document).ready(function() {
            $('#province_code').select2();
            $('#municipal_code').select2();
            $('#barangay_code').select2();

            $(document).on('submit', '#registerPark', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                if ($('#waiver_check').prop('checked')) {
                    Swal.fire({
                        title: 'Hi, Adventurer!',
                        text: "Do you want to continue this registration",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Proceed'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "<?= base_url('home/registerPark') ?>",
                                method: "POST",
                                data: new FormData(this),
                                contentType: false,
                                processData: false,
                                dataType: "json",
                                beforeSend: function() {
                                    $('#loading').show();
                                },
                                success: function(data) {
                                    if (data.message == 'Success') {
                                        $('#modalSuccess').modal('show');
                                        $('#date_reg').html(data.date_reg);
                                        $('#reg_no').html(data.reg_no);
                                        // Swal.fire({
                                        //     title: 'Thank you! Adventurer!',
                                        //     text: 'You have successfully submitted your registration.',
                                        //     icon: 'success'
                                        // });
                                        // setTimeout(function() {
                                        //     window.location.href = "<?= base_url('home') ?>";
                                        // }, 2000);
                                        $('#registerPark').trigger('reset');
                                    }
                                },
                                complete: function() {
                                    $('#loading').hide();
                                },
                                error: function() {
                                    $('#loading').hide();
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Something went wrong. Please contact your system administrator.',
                                        icon: 'error'
                                    });
                                }
                            });
                        }
                    })
                } else {
                    Swal.fire({
                        title: 'Opps!',
                        text: 'Please check the terms and conditions before you proceed.',
                        icon: 'warning'
                    });
                }
            });

            $(document).on('click', '.close_modal', function(){
                window.location.href = "<?= base_url('home')?>";
            });

            $(document).on('click', '#print_slip', function() {
                var reg_no = $('#reg_no').text();
                var url = "<?= base_url('home/slip?registration=')?>" + reg_no;
                window.open(url, 'targetWindow','resizable=yes,width=1000,height=1000');
            });
        });
    </script>