<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quit Claim</title>
</head>
<style>
    .header {
        text-align: center;
    }
    .body {
        text-align: justify;
    }
    #guardian {
        width: 100%;
        border-collapse: collapse;
    }
    #guardian th, td {
        border: 1px solid black;
    }
</style>
<body>
    <div class="header">
        <img src="<?= base_url('assets/img/jacks.png')?>" width="150">
        <img src="<?= base_url('assets/img/logo/infla.png')?>" width="200">
        <img src="<?= base_url('assets/img/logo/par.png')?>" width="200">
    </div>
    <div class="header-title">
        <h3>GENERAL RULES AND REGULATIONS: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;QUITCLAIM AND WAIVER</h3>
    </div>
    <div class="body">
        <ul>
            <li>Customers with flu, cough, cold, skin conditions, or who are infected with other injuries or infectious diseases are asked to postpone their visit for everyone's safety. Jack's Adventure reserves the right to reject entrance for these reasons in the exercise of prudence.</li>
            <li>Customer ages 13y/o and above can access both Jack's Adventure Inflatable and Play Area. 12y/o and below can only access the inflatable with legal guardian who is eighteen (18) years old and above.</li>
            <li>Customers must follow all additional safety guidelines for both Jack's Adventure Inflatable and Play Area displayed.</li>
            <li>No food and drinks are allowed inside.</li>
            <li>Customers are requested to refrain from actions that might inconvenience other customers, such as loud and improper language or sleeping in the waiting area or inside the premises.</li>
            <li>Let us keep Jack's Adventure clean, and avoid spitting, peeing, or littering inside, we have available trash bins within the premises. Customers may use the mall's restroom when necessary.</li>
            <li>Any equipment, modules, toys or collaterals are for use within the play area only and may not be taken out of the play area.</li>
            <li>Our staff may require proof of age before entry, this includes government-issued IDs, school IDs, and PSA/NSO-certified birth certificates. Jack's Adventure may refuse entry for any misrepresentation of age.</li>
            <li>Customers are requested to follow all instructions and notices from our staff at all times for safety.</li>
            <li>All personal data and information are protected under the terms of the “Privacy and Data Protection Act”. Jack's Adventure / Tom's World Philippines may use these data to inform customers about additional benefits, news and promotions. The data collected will not be disclosed to third parties, unless legally required.</li>
            <li>While Jack's Adventure / Tom's World Philippines exercises due diligence to keep the premises of its facilities secure, everyone is enjoined to take care of their personal belongings while within the facility, Jack's Adventure / Tom's World Philippines shall not have any liability to the customer for any loss, damage, cost or expense in which the customer suffers or incurs arising from the customer use of its facilities unless the same is caused by gross negligence or willful misconduct of Jack's Adventure / Tom's World Philippines employees.</li>
        </ul>
        <hr>
        <p style="margin-top:-10px;">I accept and agree on the "Rules and Regulations" stated above:</p>
        <table id="guardian">
            <tr>
                <td colspan="2">Name/Guardian:</td>
                <td colspan="2">Contact:</td>
            </tr>
            <tr>
                <td>Age:</td>
                <td>Entry Time:</td>
                <td>Exit Time:</td>
                <td>Extension:</td>
            </tr>
        </table>
        <br>
        <table id="guardian">
            <tr>
                <th>Children's Name</th>
                <th>Age</th>
            </tr>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>