<style>
    #tbl_pricing th,
    #tbl_pricing td {
        text-align: center;
        text-transform: uppercase;
    }

    #tbl_pricing td:nth-child(4),
    #tbl_pricing td:nth-child(5) {
        font-weight: bolder;
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4 pb-3 main-section" style="background: #8F3F96;">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mt-2 text-white">History Logs</h2>
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
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="tbl_pricing">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Activity</th>
                            <th>User</th>
                            <th>Date Transaction</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($history_logs as $row) : ?>
                            <tr>
                                <td><?= $row->logs_id;?></td>
                                <td><?= $row->transacation;?></td>
                                <td><?= $row->user;?></td>
                                <td><?= date('F j, Y h:i A', strtotime($row->date_added));?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Main div -->
    </main>

    <footer class="py-3 text-white mt-auto" style="background: #8F3F96;">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
            <div class="text-white">Copyright &copy; Jacks Adventure  2023</div>
            </div>
        </div>
    </footer>
</div>

</div>
<!-- End of layoutSidenav -->

<script>
    $(document).ready(function() {
        $('#loading').show();
        setTimeout(function() {
            $('#loading').hide();
        }, 2000);
        var table_pricing = $('#tbl_pricing').DataTable({
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
            //"searching": false,
            // "bLengthChange": false,
            // "serverSide": true,
            // "processing": true,
            // "pageLength": 25,
            // "deferRender": true,
            // "ajax": {
            //     "url": "<?= base_url('pricing/get_pricing') ?>",
            //     "type": "POST",
            //     "data": function(data) {
            //         data.search_value = $('#search_value').val();
            //         data.filter_by = $('#filter_by').val();
            //     }
            // },
        });
    });
</script>