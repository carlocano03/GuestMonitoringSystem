<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Monitoring</title>
</head>
<style>
    body {
        color: #2d3436;
        font-family: 'courier';
    }
    .header {
        text-align: center;
    }
    #tbl_body {
        border-collapse: collapse;
    }
    #tbl_body th, td{
        border: 1px solid #b2bec3;
        font-size: 9px;
        text-align: center;
    }
    #tbl_body th {
        background: #8F3F96;
        color: #fff;
    }
</style>
<body>
    <div class="header">
        <img src="<?= base_url('assets/img/jacks.png')?>" alt="Header-Img" width="200">
        <h2>Pricing & Promo</h2>
        <h5><?= date('D F j, Y h:i a')?></h5>
        <hr>
    </div>
    <div class="body">
        <table id="tbl_body" width="100%">
            <tr>
                <th>Type of Admission</th>
                <th>Time</th>
                <th>Pricing</th>
                <th>Package</th>
            </tr>
            <tbody>
                <?php foreach($pricing as $list) : ?>
                    <tr>
                        <td><?= $list->admission_type;?></td>
                        <td><?= $list->time_admission;?></td>
                        <td><?= $list->weekdays_price;?></td>
                        <td><?= $list->package;?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>

    </div>
</body>
</html>