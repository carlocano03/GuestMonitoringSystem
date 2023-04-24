<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Slip</title>
</head>
<style>
    body {
        color: #2d3436;
        font-family: 'courier';
    }
    .header {
        text-align: center;
        font-size: 12px;
    }
    .body span {
        font-size: 11px;
    }
</style>
<body>
    <div class="header">
        <span>JACK'S ADVENTURE</span><br>
        <span>SM GRAND CENTRAL</span>
    </div>
    <hr>
    <div class="body">
        <span>DATE:</span><br>
        <span><?= isset($transaction->date_created) ? date('F j, Y', strtotime($transaction->date_created)) : ''?></span><br>
        <span><?= isset($transaction->date_created) ? date('h:i A', strtotime($transaction->date_created)) : ''?></span>

        <br><br>
        <span>FULLNAME:</span><br>
        <span>
            <?= isset($transaction->guest_lname) ? strtoupper($transaction->guest_lname) : ''?>, 
            <?= isset($transaction->guest_fname) ? strtoupper($transaction->guest_fname) : ''?> 
            <?= isset($transaction->guest_mname) ? strtoupper($transaction->guest_mname[0]) : ''?>.
        </span>

        <div>---------------------</div>
        <span>REGISTRATION NO.</span><br>
        <span style="font-size: 15px; font-weight: bold;"><?= isset($transaction->guest_slip_no) ? strtoupper($transaction->guest_slip_no) : ''?></span>
        <div>---------------------</div>
    </div>
    <div class="footer" style="font-size: 7px; text-align: center;">
    This is a computer-generated report. Date & Time Printed <?= date('F j, Y h:i A')?>
    </div>
</body>
</html>