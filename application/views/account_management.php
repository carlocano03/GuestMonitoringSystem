<style>
    #table-account th,
    #table-account td {
        text-align: center;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pb-3 main-section" style="background: #8F3F96;">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mt-2 text-white">Account Management</h2>
                    <p class="text-green fw-bold mb-0">GUEST MONITORING SYSTEM</p>
                  
                </div>
                <div class="col-md-4 text-end">
                    <h2 class="mt-2 text-white"><span id="clock" class="fw-bold"></h2>
                    <h5 class="text-white"><span id="date" class="fw-bold"></span></h5>
                    <a href="<?= base_url('main/logout') ?>" class="btn-signout">SIGN OUT <i class="bi bi-box-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
        <div class="container-fluid px-4 mt-4">
            <!-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                <i class="bi bi-menu-button-wide-fill me-2"></i>TOGGLE MENU
            </button>
            <hr> -->
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" id="search_value" class="form-control form-control-sm" placeholder="Search Here...">
                </div>
                <div class="col-md-5">
                    <div class="row g-0">
                        <div class="col-sm-4 mb-2">
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#accountModal"><i class="bi bi-plus-square-fill me-2"></i>NEW ACCOUNT</button>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
            <button class="btn btn-dark btn-sm"><i class="bi bi-printer-fill me-2"></i>PRINT RECORDS</button>
            <button class="btn btn-info btn-sm"><i class="bi bi-download me-2"></i>EXPORT THIS FILE</button>
                        </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%" style="vertical-align:middle;" id="table-account">
                    <thead class="text-uppercase">
                        <tr>
                            <th>User ID</th>
                            <th>Username / Email</th>
                            <!-- <th>Password</th> -->
                            <th>Fullname</th>
                            <th>User Access Level</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- Main div -->

    </main>
    <footer class="py-3 text-white mt-auto" style="background: #8F3F96;">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-white">Copyright &copy; Jack's Adventure 2023</div>
            </div>
        </div>
    </footer>
</div>

</div>
<!-- End of layoutSidenav -->

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="bi bi-menu-button-wide-fill me-2"></i>Control Management</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="form-group mb-2">
            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#accountModal">
                <i class="bi bi-person-plus-fill me-2"></i>ADD NEW ACCOUNT
            </button>
        </div>
        <div class="form-group mb-2">
            <button class="btn btn-primary w-100"><i class="bi bi-person-fill-lock me-2"></i>MANAGE PERMISSION</button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="accountModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #6f42c1; color:#fff;">
                <h5 class="modal-title" id="exampleModalLabel">Account Creation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="fw-bold">CREATE NEW ACCOUNT</h4>
                <hr class="mt-0">
                <form id="registerAccount" method="POST">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="fullname" placeholder="ENTER YOUR NAME" autocomplete="off" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="USERNAME / EMAIL" autocomplete="off" required>
                    </div>
                    <!-- <div class="form-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="PASSWORD" autocomplete="off" required>
                    </div> -->
                    <div class="input-group input-group-sm mb-3" id="show_hide_password">
                        <input type="password" class="form-control" name="password" placeholder="PASSWORD" autocomplete="off" required>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm"><a href=""><i class="fas fa-eye" aria-hidden="true"></i></a></span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <select name="access_level" id="access_level" class="form-select" required>
                            <option value="">USER ACCESS LEVEL</option>
                            <option value="Administrator">ADMINISTRATOR</option>
                            <option value="User">USER</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" readonly class="form-control" id="pass_code" name="pass_code" placeholder="PASSCODE IF ADMINISTRATOR ACCESS LEVEL" autocomplete="off">
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn btn-secondary w-100 btn-rounded">CLEAR</button>
                    </div>
                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary w-100 btn-rounded">SUBMIT</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var table_account = $('#table-account').DataTable({
            language: {
                search: '',
                searchPlaceholder: "Search Here...",
                "info": "_START_-_END_ of _TOTAL_ entries",
                paginate: {
                    next: '<i class="fas fa-chevron-right"></i>',
                    previous: '<i class="fas fa-chevron-left"></i>'
                }
            },
            "searching": false,
            "ordering": false,
            "bLengthChange": false,
            "serverSide": true,
            "processing": true,
            "pageLength": 25,
            "deferRender": true,
            "ajax": {
                "url": "<?= base_url('main/getAccount') ?>",
                "type": "POST",
                "data": function(data) {
                    data.search_value = $('#search_value').val();
                }
            },
        });
        $('#search_value').on('input', function() {
            table_account.draw();
        });

        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fas fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fas fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fas fa-eye-slash");
                $('#show_hide_password i').addClass( "fas fa-eye" );
            }
        });

        $(document).on('change', '#access_level', function(){
            var access = $(this).val();
            switch (access) {
                case 'Administrator':
                    $('#pass_code').attr('readonly', false);
                    $('#pass_code').attr('required', true);
                    break;
            
                default:
                    $('#pass_code').attr('readonly', true);
                    $('#pass_code').attr('required', false);
                    break;
            }
        });

        $(document).on('submit', '#registerAccount', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            $.ajax({
                url: "<?= base_url() . 'user/account_register' ?>",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    if (data.message != '') {
                        Swal.fire('Warning!', 'Account already exist.', 'warning');
                    } else {
                        Swal.fire(
                            'Thank you!',
                            'Account successfully created.',
                            'success'
                        );
                        $('#accountModal').modal('hide');
                        $('#registerAccount').trigger('reset');
                        var table = $('#table_account').DataTable();
                        table.draw();
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                }
            });
        });

        $(document).on('click', '.account_activation', function() {
            var userID = $(this).attr('id');
            if ($(this).is(":checked")) {
                $.ajax({
                    url: "<?= base_url() . 'user/account_activated' ?>",
                    type: "POST",
                    data: {
                        userID: userID
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success == 'Success') {
                            Swal.fire('Thank you!', 'Account activated.', 'success');
                            table_account.draw();
                        } else {
                            Swal.fire("Error in updating", "Clicked button to close!", "error");
                        }
                    }
                });
            } else {
                $.ajax({
                    url: "<?= base_url() . 'user/account_deactivated' ?>",
                    type: "POST",
                    data: {
                        userID: userID
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success == 'Success') {
                            Swal.fire('Thank you!', 'Account deactivated.', 'success');
                            table_account.draw();
                        } else {
                            Swal.fire("Error in updating", "Clicked button to close!", "error");
                        }
                    }
                });
            }
        });

        $(document).on('click', '.remove_acct', function(){
            var userID = $(this).attr('id');
                Swal.fire({
                title: 'Warning! You are about to delete this record.',
                text: "Are you sure you want to continue? you can not revert this action.!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url() . 'user/delete_account' ?>",
                        type: "POST",
                        data: {
                            userID: userID
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.success == 'Success') {
                                Swal.fire('Thank you!', 'Account deleted successfully.', 'success');
                                table_account.draw();
                            } else {
                                Swal.fire("Failed to delete.", "Clicked button to close!", "error");
                            }
                        }
                    });
                }
            })
        });
    });

</script>