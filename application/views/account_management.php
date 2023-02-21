<style>
    #table-account th,
    #table-account td {
        text-align: center;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pb-3 main-section">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mt-2 text-white">Account Management</h2>
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
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                <i class="bi bi-menu-button-wide-fill me-2"></i>TOGGLE MENU
            </button>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%" style="vertical-align:middle;" id="table-account">
                    <thead class="text-uppercase">
                        <tr>
                            <th>Action</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Fullname</th>
                            <th>Branch/Store</th>
                            <!-- <th>Area</th> -->
                            <th>Date Created</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
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
            <div class="modal-header" style="background-color: #474787; color:#fff;">
                <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-person-plus-fill me-2"></i>Account Management</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registerAccount" method="POST">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="fullname" placeholder="Enter your fullname" autocomplete="off" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Enter your username" autocomplete="off" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Enter your email address" autocomplete="off" required>
                    </div>
                    <div class="form-group mb-3">
                        <select name="branch" class="form-select" required>
                            <option value="">Select Branch</option>
                            <option value="Branch 1">Branch 1</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#table-account').DataTable({
            language: {
                search: '',
                searchPlaceholder: "Search Here...",
                "info": "_START_-_END_ of _TOTAL_ entries",
                paginate: {
                    next: '<i class="fas fa-chevron-right"></i>',
                    previous: '<i class="fas fa-chevron-left"></i>'
                }
            },
            "ordering": false,
            "serverSide": true,
            "processing": true,
            "pageLength": 25,
            "deferRender": true,
            "ajax": {
                "url": "<?= base_url('main/getAccount') ?>",
                "type": "POST",
            },
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
    });
</script>