<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Transaction Slip</title>
</head>
<style>
    body {
        color: #2d3436;
        font-family: 'courier';
    }
    .header {
        text-align: center;
    }
    .header h5 {
        margin-top: 5px;
        margin-bottom: 2px;
    }
    .header small {
        font-size: 10px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    #tbl_body th, td{
        /* border: 1px solid #b2bec3; */
        font-size: 9px;
        text-align: left;
    }
    .footer {
        text-align: right;
        font-size: 10px;
        font-weight: bold;
    }
</style>
<body>
    <div class="header">
        <img src="<?= base_url('assets/img/jacks.png')?>" alt="Img" width="70">
        <h5>Transaction Slip</h5>
        <small><?= date('D, F j, Y', strtotime($transaction_date->date_transaction))?></small>
        <hr>
        <h5>TRANSACTION NO.: <?= isset($discount->transaction_no) ? $discount->transaction_no : '';?></h5>
        <hr>
    </div>
    <div class="body">
        <table id="tbl_body" width="100%">
            <tr>
                <th style="width: 100px;">Items</th>
                <th style="text-align: center">Amount</th>
                <th style="text-align: center">Qty</th>
                <th style="text-align: center">Total</th>
            </tr>
            <tbody>
                <?php foreach($sales as $row) :?>
                    <tr>
                        <td style="width: 100px;"><?= $row->details?></td>
                        <td style="text-align: center"><?= number_format($row->price, 2)?></td>
                        <td style="text-align: center"><?= $row->qty?></td>
                        <td style="text-align: center"><?= number_format($row->total_amt, 2)?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <hr>
    <div class="footer">
        <div>Remarks: <?= isset($discount->discount_remarks) ? $discount->discount_remarks : '';?></div>
        <div>Discount: -<?= isset($discount->discount_amt) ? number_format($discount->discount_amt, 2) : '';?></div>
        <?php
            $total_sales = 0;
            $total_sales = $total - $discount->discount_amt;
        ?>
        <div>Sub-Total: <?= isset($total) ? number_format($total, 2) : '0.00';?></div>
        <div>Total: <?= isset($total_sales) ? number_format($total_sales, 2) : '0.00';?></div>
    </div>
</body>
</html>