<!-- Modal -->
<div class="modal fade" id="passcodeModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #fbc531; color:#fff;">
                <h5 class="modal-title" id="exampleModalLabel">NOTICE TO USER</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex align-items-center">
                    <img src="<?= base_url('assets/img/warning.gif')?>" alt="Warning-Img" width="60">
                    <div class="ms-2 mb-0"><b>REQUIRED PASSCODE</b><br>
                        <small style="font-size:11px; margin-top:-100px;">This process required passcode for security purposes only.</small>
                    </div>
                </div>
                <hr class="mt-0">
                <form id="registerAccount" method="POST">
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" name="fullname" placeholder="Enter your passcode ****" autocomplete="off" required>
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn btn-warning w-100 btn-rounded">SUBMIT</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="<?= base_url('assets/js/scripts.js') ?>"></script>
<script src="<?= base_url('assets/js/date-time.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.24/webcam.js"></script>

<script>
    // $(document).ready(function(){
    //     $('#passcodeModal').modal('show');
    // });
    $(function() {
        //PARK
        $("#birthday").datepicker({
            maxDate: "-1d",
            minDate: new Date(1900, 6, 12),
            changeMonth: true,
            changeYear: true,
            yearRange: "1950:+nn",
        }).on('change', function() {
            var age = getAge(this);
            var newAge = age + " years old";
            if (age < 13) {
                Swal.fire({
                    title: 'Opps!',
                    text: 'Sorry, we require 13 years old above on this adventure ',
                    icon: 'warning'
                });
                $(this).val('');
            } else {
                $('#age').val(newAge);
            }
        });

        //INFLATABLES
        $("#inflatables_birthday").datepicker({
            maxDate: "-1d",
            minDate: new Date(1900, 6, 12),
            changeMonth: true,
            changeYear: true,
            yearRange: "1950:+nn",
        }).on('change', function() {
            var age = getAge(this);
            var newAge = age + " years old";
            if (age < 18) {
                Swal.fire({
                    title: 'Opps!',
                    text: 'Sorry, We require 18 years old above as parent/guardian.',
                    icon: 'warning'
                });
                $(this).val('');
            } else {
                $('#age').val(newAge);
            }
        });

        // $("#kid_birthday").datepicker({
        //     maxDate: "-1d",
        //     minDate: new Date(1900, 6, 12),
        //     changeMonth: true,
        //     changeYear: true,
        //     yearRange: "1950:+nn",
        // }).on('change', function() {
        //     var age = getAge(this);
        //     var newAge = age + " years old";
        //     if (age > 12) {
        //         Swal.fire({
        //             title: 'Opps!',
        //             text: 'Sorry, We require 12 years old below only.',
        //             icon: 'warning'
        //         });
        //         $(this).val('');
        //         $('#kid_age').val('');
        //     } else {
        //         $('#kid_age').val(newAge);
        //     }
        // });

        $(document).on('focus', '.kid_birthday', function() {
            $(this).datepicker({
                maxDate: "-1d",
                minDate: new Date(1900, 6, 12),
                changeMonth: true,
                changeYear: true,
                yearRange: "1950:+nn",
            });
        });

        $(document).on('change', '#kid_birthday', function() {
            var age = getAge(this);
            var newAge = age + " years old";
            if (age > 12) {
                Swal.fire({
                    title: 'Warning!',
                    text: 'You are overage.',
                    icon: 'warning'
                });
                $(this).val('');
                $('#kid_age').val('');
            } else {
                $('#kid_age').val(newAge);
            }
        });

        $(document).on('change', '#kid_birthday2', function() {
            var age = getAge(this);
            var newAge = age + " years old";
            if (age > 12) {
                Swal.fire({
                    title: 'Warning!',
                    text: 'You are overage.',
                    icon: 'warning'
                });
                $(this).val('');
                $('#kid_age2').val('');
            } else {
                $('#kid_age2').val(newAge);
            }
        });

        $(document).on('change', '#kid_birthday3', function() {
            var age = getAge(this);
            var newAge = age + " years old";
            if (age > 12) {
                Swal.fire({
                    title: 'Warning!',
                    text: 'You are overage.',
                    icon: 'warning'
                });
                $(this).val('');
                $('#kid_age3').val('');
            } else {
                $('#kid_age3').val(newAge);
            }
        });

    });

    function getAge(dateVal) {
        var
            birthday = new Date(dateVal.value),
            today = new Date(),
            ageInMilliseconds = new Date(today - birthday),
            years = ageInMilliseconds / (24 * 60 * 60 * 1000 * 365.25)
        return Math.floor(years);

    }

    $(document).ready(function() {
        $(document).on('change', '#province_code', function() {
            var elem = $(this);
            var code = elem.val();
            var text = elem.find('option:selected').text();
            // console.log(code);
            $.post("/guestmonitoringsystem/home/get_municipal/", {
                code: code
            }, function(data) {
                $('#municipal_code').html(data);
                $('#province').val(text);
            }, "JSON");
        });

        $(document).on('change', '#municipal_code', function() {
            var elem = $(this);
            var code = elem.val();
            var text = elem.find('option:selected').text();
            console.log(code);
            $.post("/guestmonitoringsystem/home/get_barangay/", {
                code: code
            }, function(data) {
                $('#barangay_code').html(data);
                $('#municipal').val(text);
            }, "JSON");
        });

        $(document).on('change', '#barangay_code', function() {
            var elem = $(this);
            var code = elem.val();
            var text = elem.find('option:selected').text();
            $('#brgy').val(text);
        });
    });
</script>

</body>

</html>