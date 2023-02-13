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

<script>
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
            if (age < 10) {
                Swal.fire({
                    title: 'Warning!',
                    text: 'You are underage.',
                    icon: 'warning'
                });
                $(this).val('');
            } else {
                $('#age').val(newAge);
            }
        });

        //INFLATABLES
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
            $('#kid_age').val(newAge);
            // if (age < 10) {
            //     Swal.fire({
            //         title: 'Warning!',
            //         text: 'You are underage.',
            //         icon: 'warning'
            //     });
            //     $(this).val('');
            // } else {
            //     $('#age').val(newAge);
            // }
        });

        $(document).on('change', '#kid_birthday2', function() {
            var age = getAge(this);
            var newAge = age + " years old";
            $('#kid_age2').val(newAge);
            // if (age < 10) {
            //     Swal.fire({
            //         title: 'Warning!',
            //         text: 'You are underage.',
            //         icon: 'warning'
            //     });
            //     $(this).val('');
            // } else {
            //     $('#age').val(newAge);
            // }
        });

        $(document).on('change', '#kid_birthday3', function() {
            var age = getAge(this);
            var newAge = age + " years old";
            $('#kid_age3').val(newAge);
            // if (age < 10) {
            //     Swal.fire({
            //         title: 'Warning!',
            //         text: 'You are underage.',
            //         icon: 'warning'
            //     });
            //     $(this).val('');
            // } else {
            //     $('#age').val(newAge);
            // }
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
        //     $('#kid_age').val(newAge);
        //     // if (age < 10) {
        //     //     Swal.fire({
        //     //         title: 'Warning!',
        //     //         text: 'You are underage.',
        //     //         icon: 'warning'
        //     //     });
        //     //     $(this).val('');
        //     // } else {
        //     //     $('#age').val(newAge);
        //     // }
        // });
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