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
        <h2>Inventory Report</h2>
        <h5><?= date('D F j, Y h:i a')?></h5>
        <hr>
    </div>
    <div class="body">
        <table id="tbl_body" width="100%">
            <tr>
                <th>Descriptions</th>
                <th>Quantity</th>
                <th>Pricing</th>
            </tr>
            <tbody>
                <?php foreach($inventory as $list) : ?>
                    <tr>
                        <td><?= $list->descriptions;?></td>
                        <td><?= $list->quantity;?></td>
                        <td><?= $list->weekdays_price;?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>

    </div>
</body>
</html>