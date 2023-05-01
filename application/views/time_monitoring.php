<style>
    body {
        background-image: url("<?= base_url('assets/img/bgbg.jpg') ?>");
        background-size: cover;
        background-attachment: fixed;
    }
    /* .header {
        background: var(--bs-exodus);
        padding: 10px;
    } */
    h1 {
        font-size: 62px;
    }
    .card-header {
        padding: 5px 5px 0px 10px;
        color: #fff;
    }
</style>

<body onload="startTime()">
    <main>
        <div class="container">
            <div class="header">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <img src="<?= base_url('assets/img/jacks.png')?>" width="210">
                    </div>
                    <div class="col-md-5">
                        <h1 class="text-white" style="margin-bottom: -20px;">PLAY TIME BOARD</h1>
                        <h5 class="mt-2 text-white"><span id="date" class="fw-bold"></span> <span id="clock" class="fw-bold"></h5>
                    </div>
                    <div class="col-md-4">
                        <div style="margin-bottom: -20px;" class="d-flex align-items-center justify-content-center">
                            <img src="<?= base_url('assets/img/logo/infla.png')?>" width="300"> 
                            <span style="font-size: 40px; font-weight: bold; color: #fff;" id="inflatables">0</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="<?= base_url('assets/img/logo/par.png')?>" width="300"> 
                            <span style="font-size: 40px; font-weight: bold; color: #fff;" id="park">0</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="text-white text-center">Players with LESS THAN 5 minutes left</h3>
                        <hr style="height:5px; background: #222f3e;">
                        
                        <div id="playerBoard1"></div>
                        
                        
                    </div>
                    <div class="col-md-4">
                        <h3 class="text-white text-center">Players with LESS THAN15 minutes left</h3>
                        <hr style="height:5px; background: #222f3e;">

                        <div id="playerBoard2"></div>

                    </div>
                    <div class="col-md-4">
                        <h3 class="text-white text-center">Players with MORE THAN 15 minutes left</h3>
                        <hr style="height:5px; background: #222f3e;">

                        <div id="playerBoard3"></div>

                    </div>
                    
                </div>
            </div>
        </div>
    </main>

    <script>
        function countGuest(load = '')
        {
            $.ajax({
                url: "<?= base_url('main/get_countGuest')?>",
                method: "POST",
                data: {
                    load: load
                },
                dataType: "json",
                success: function(data) {
                    $('#inflatables').html(data.count_inflatables);
                    $('#park').html(data.count_park)
                }
            });
        }

        function getGuest(load = '')
        {
            $.ajax({
                url: "<?= base_url('main/getGuest')?>",
                method: "POST",
                data: {
                    load: load
                },
                dataType: "json",
                success: function(data) {
                    $('#playerBoard1').html(data.playerBoard1);
                    $('#playerBoard2').html(data.playerBoard2);
                    $('#playerBoard3').html(data.playerBoard3);
                }
            });
        }

        $(document).ready(function() {
            // Update remaining time every second
            setInterval(function() {
                $('.remaining-time').each(function() {
                    // Retrieve remaining time from data attribute
                    var remaining_time = $(this).data('remaining-time');
                    
                    // Subtract one second from remaining time
                    remaining_time -= 1;
                    
                    // If remaining time is negative, set it to zero
                    if (remaining_time < 0) {
                        remaining_time = 0;
                    }
                    
                    // Format remaining time as HH:MM:SS
                    var hours = Math.floor(remaining_time / 3600);
                    var minutes = Math.floor((remaining_time % 3600) / 60);
                    var seconds = remaining_time % 60;
                    var remaining_time_formatted = ('0' + hours).slice(-2) + ':' + ('0' + minutes).slice(-2) + ':' + ('0' + seconds).slice(-2);
                    
                    // Update displayed countdown
                    $(this).html(remaining_time_formatted);
                    
                    // Update remaining time data attribute
                    $(this).data('remaining-time', remaining_time);
                });
            }, 1000); // Update every second

            getGuest();
            countGuest();
            setInterval(function() {
                countGuest();
                getGuest();
            }, 5000);
        });
    </script>