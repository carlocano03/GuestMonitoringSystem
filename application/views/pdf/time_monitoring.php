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
        <h2>TIME MONITORING REPORTS</h2>
        <h5><?= date('D F j, Y h:i a')?></h5>
        <hr>
    </div>
    <div class="body">
        <table id="tbl_body" width="100%">
            <tr>
                <th>Serial No.</th>
                <th>Date</th>
                <th>Package</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Remaining Time</th>
                <th>Guest/Kids Name</th>
                <th>Parent/Guardian</th>
                <th>Contact No.</th>
                <th>Service</th>
            </tr>
            <tbody>
                <?php foreach($time_report as $list) : ?>
                    <tr>
                        <td><?= $list->slip_app_no;?></td>
                        <td style="width: 100px;"><?= date('M j, Y', strtotime($list->date_added));?></td>
                        <td style="width: 150px;"><?= $list->admission_type;?></td>
                        <td><?= date('g:i a', strtotime($list->time_in));?></td>
                        <td><?= date('g:i a', strtotime($list->time_out));?></td>

                        <?php
                            // Calculate remaining time in seconds
                            if (date('Y-m-d', strtotime($list->date_added)) == date('Y-m-d')) {
                                $remaining_time = strtotime($list->time_out) - time();
                            } else {
                                $remaining_time = 0;
                            }
                            // Format remaining time as HH:MM:SS
                            $remaining_time_formatted = sprintf('%02d:%02d:%02d', ($remaining_time / 3600), ($remaining_time / 60 % 60), ($remaining_time % 60));
                        ?>

                        <td>
                            <span class="remaining-time" data-remaining-time="<?= $remaining_time;?>"><?= $remaining_time_formatted;?></span>
                        </td>
                        <?php
                            if ($list->service == 'INFLATABLES') {
                                $children = $this->db
                                    ->select("CONCAT(child_fname, ' ', child_lname) AS children")
                                    ->from('guest_children')
                                    ->where('parent_id', $list->guest_id)
                                    ->get()
                                    ->result_array();
                                $children_names = "";
                                foreach ($children as $child) {
                                    $children_names .= $child['children'] . "<br>";
                                }
                                $kids = ucwords($children_names);
                            } else {
                                $kids = $list->guest_fname. ' ' .$list->guest_lname;
                            }
                        ?>
                        <td><?= ucwords($kids)?></td>
                        <td><?= ucwords($list->guest_fname);?> <?= ucwords($list->guest_lname);?></td>
                        <td><?= $list->contact_no;?></td>
                        <td><?= $list->service;?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</body>
</html>