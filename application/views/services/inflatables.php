<body onload="startTime()">
    <main>
        <div class="container">
            <a href="<?= base_url('home/services') ?>">
                <p class="mt-2 fw-bold">
                    < Go Back</p>
            </a>
        </div>
        <div class="container">

            <div class="float">
                <p class="float">
                    <img src="<?= base_url('assets/img/arrow-down.gif'); ?>" alt="" width="100"><br>
                    SLIDE DOWN<br>
                    TO CONTINUE<br>
                </p>
            </div>

            <div class="img-holder text-center">
                <img class="img-icon" src="<?= base_url('assets/img/logo/inflatables.png'); ?>" alt="Park" style="margin-bottom: -10px;">
                <div class="text-header">
                    <div id="clock" class="mt-0"></div>
                    <div id="date"></div>
                    <div>Store Abcd</div>
                    <div>SM Megamall - Ground Floor</div>
                </div>
            </div>

            <div class="reg-section">
                <div class="header-section text-center">
                    <h5 class="mb-0">PRE-REGISTRATION FORM</h5>
                    <p>Tired waiting in line, for your convenience fill up your</p>
                </div>
                <div class="reg-form text-center">
                    <form id="registerInflatables" method="POST" class="needs-validation" novalidate>
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
                            <select name="relationship" id="relationship" class="form-select text-uppercase" required>
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
                            <div class="invalid-feedback text-start">
                                Please select relationship.
                            </div>
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
                            <input type="text" class="form-control text-uppercase" name="street" id="street" placeholder="Enter House No. Street" required autocomplete="off">
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
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required autocomplete="off">
                            <div class="invalid-feedback text-start">
                                Please input your email address.
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control text-uppercase" name="inflatables_birthday" id="inflatables_birthday" placeholder="Enter Birthday" required autocomplete="off">
                            <div class="invalid-feedback text-start">
                                Please input your birthday.
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control text-uppercase" name="age" id="age" placeholder="Enter Age" readonly required>
                        </div>

                        <div class="sub-header-section text-center">
                            <h5 class="mb-0">KIDS / CHILDREN INFORMATION</h5>
                        </div>
                        <!-- <div class="reg-form text-center"> -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3 text-start">
                                    <button class="btn btn-primary btn-sm" id="add_children"><i class="bi bi-plus-circle me-2"></i>Add More</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <span><b>Total Children:</b> <span class="badge bg-danger" id="count">1</span></span>
                            </div>
                        </div>
                        <div class="children-item">
                            <div class="children-data">
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control text-uppercase" name="kid_fname[]" id="kid_fname" placeholder="Enter First Name (Juan)" required autocomplete="off">
                                    <div class="invalid-feedback text-start">
                                        Please input kid firstname.
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control text-uppercase" name="kid_lname[]" id="kid_lname" placeholder="Enter Last Name (Bonifacion, Jr.)" required autocomplete="off">
                                    <div class="invalid-feedback text-start">
                                        Please input kid lastname.
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control text-uppercase" name="kid_mname[]" id="kid_mname" placeholder="Enter Middle Name (Cruz)" required autocomplete="off">
                                    <div class="invalid-feedback text-start">
                                        Please input kid middlename.
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control text-uppercase" name="kid_suffix[]" id="kid_suffix" placeholder="Enter Suffix (Jr. Sr. III)" autocomplete="off">
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control text-uppercase kid_birthday" name="kid_birthday[]" id="kid_birthday" placeholder="Enter Birthday" required autocomplete="off">
                                    <div class="invalid-feedback text-start">
                                        Please input kid birthday.
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" class="form-control text-uppercase" name="kid_age[]" id="kid_age" placeholder="Enter Age" readonly>
                                </div>
                                <div class="form-group mb-3 text-start">
                                    <button class="btn btn-danger btn-sm" id="remove"><i class="bi bi-x-circle me-2"></i>Remove</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-check text-start mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="waiver_check">
                            <label class="form-check-label" for="waiver_check">
                                I hereby acknowledge and accept the <a href="">"Waiver and Quitclaim"</a> and agree to <a href="">Data Privacy Act of 2012</a>
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
                    <h2 class="text-green">REGISTRATION SUCCESSFULLY</h2>
                    <p>Print / Capture your Registration No. Present this information to Jack's Adventure Staff Personnel.<br>
                        <b>Registration Date:</b> <span id="date_reg"></span>
                    </p>
                    <hr>
                    <h5 class="text-green">REGISTRATION NO.</h5>
                    <h4 id="reg_no"></h4>
                    <button class="btn btn-primary w-100 mb-3">PRINT</button>
                    <div class="text-center">
                        <img src="<?= base_url('assets/img/jacks-loading.gif') ?>" alt="" width="200">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_modal">Close</button>
                </div>
            </div>
        </div>
    </div>

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
            var clicks = 1;
            $(document).on('click', '#add_children', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();

                if (clicks < 3) {
                    clicks++;
                    $('.children-item').append(`
                        <div class="children-data">
                        <hr>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control text-uppercase" name="kid_fname[]" id="kid_fname" placeholder="Enter First Name (Juan)" required autocomplete="off">
                                <div class="invalid-feedback text-start">
                                    Please input kid firstname.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control text-uppercase" name="kid_lname[]" id="kid_lname" placeholder="Enter Last Name (Bonifacion, Jr.)" required autocomplete="off">
                                <div class="invalid-feedback text-start">
                                    Please input kid lastname.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control text-uppercase" name="kid_mname[]" id="kid_mname" placeholder="Enter Middle Name (Cruz)" required autocomplete="off">
                                <div class="invalid-feedback text-start">
                                    Please input kid middlename.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control text-uppercase" name="kid_suffix[]" id="kid_suffix" placeholder="Enter Suffix (Jr. Sr. III)" autocomplete="off">
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control text-uppercase kid_birthday" name="kid_birthday[]" id="kid_birthday` + clicks + `" placeholder="Enter Birthday" required autocomplete="off">
                                <div class="invalid-feedback text-start">
                                    Please input kid birthday.
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control text-uppercase" name="kid_age[]" id="kid_age` + clicks + `" placeholder="Enter Age" readonly>
                            </div>
                            <div class="form-group mb-3 text-start">
                                <button class="btn btn-danger btn-sm" id="remove"><i class="bi bi-x-circle me-2"></i>Remove</button>
                            </div>
                        </div>
                    `);
                    $('#count').text(clicks);
                } else {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'You reach the limit of children.',
                        icon: 'warning'
                    });
                    $('#add_children').attr("disabled", true);
                }
            });

            $(document).on('click', '#remove', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();

                if (clicks > 0) {
                    clicks--;
                    let row_item = $(this).parent().parent();
                    $(row_item).remove();
                    $('#count').text(clicks);
                    $('#add_children').attr("disabled", false);
                }
            });

            $(document).on('submit', '#registerInflatables', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                if ($('#waiver_check').prop('checked')) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to continue this registration",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Proceed'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "<?= base_url('home/registerInflatables') ?>",
                                method: "POST",
                                // data: $(this).serialize(),
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
                                        //     title: 'Thank You!',
                                        //     text: 'Successfully submitted',
                                        //     icon: 'success'
                                        // });
                                        // setTimeout(function() {
                                        //     window.location.href = "<?= base_url('home') ?>";
                                        // }, 2000);
                                        $('#registerInflatables').trigger('reset');
                                    }
                                },
                                complete: function() {
                                    $('#loading').hide();
                                },
                                error: function() {
                                    $('#loading').hide();
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Something went wrong. Please contact the system administrator.',
                                        icon: 'error'
                                    });
                                }
                            });
                        }
                    })
                } else {
                    Swal.fire({
                        title: 'Terms and Conditions!',
                        text: 'Please check the terms and conditions before you proceed.',
                        icon: 'warning'
                    });
                }
            });

            $(document).on('click', '.close_modal', function() {
                window.location.href = "<?= base_url('home') ?>";
            });
        });
    </script>