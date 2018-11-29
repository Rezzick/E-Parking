<?php
session_start();
/**
 * Created by PhpStorm.
 * User: cooten
 * Date: 9/4/2018
 * Time: 1:07 PM
 */

function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

    return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

//receive card number from main page
$utcID = $_POST['utcID'];
$lastname = $_POST['lastname'];
$cardID = clean($utcID);
$lastname = clean($lastname);
//Connect to DB
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="dbpassword";
$dbname="eParking";
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

//run query
$query = "SELECT first_name, last_name FROM user_accounts WHERE utc_id = '$cardID' AND last_name = '$lastname'";
if ($stmt = $con->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name );
    while ($stmt->fetch()) {
        //do nothing
    }
    $stmt->close();
}

$_SESSION['user'] = $first_name . " " . $last_name;
if(isset($_SESSION['user']) && $_SESSION['user'] != " " && $_SESSION['user'] != "")
{
    //do nothing
} else{
    header('Location: mobileIndex.html'); //redirect URL
}

//lot1
$query2 = "SELECT COUNT(space_num) FROM parking_lot_1 WHERE vacant = 1";
if ($stmt = $con->prepare($query2)) {
    $stmt->execute();
    $stmt->bind_result($numAvailableLot1 );
    while ($stmt->fetch()) {
        //do nothing
    }
    $stmt->close();
}
//Lot2
$query3 = "SELECT COUNT(space_num) FROM parking_lot_2 WHERE vacant = 1";
if ($stmt = $con->prepare($query3)) {
    $stmt->execute();
    $stmt->bind_result($numAvailableLot2 );
    while ($stmt->fetch()) {
        //do nothing
    }
    $stmt->close();
}
//Lot3
$query4 = "SELECT COUNT(space_num) FROM parking_lot_3 WHERE vacant = 1";
if ($stmt = $con->prepare($query4)) {
    $stmt->execute();
    $stmt->bind_result($numAvailableLot3 );
    while ($stmt->fetch()) {
        //do nothing
    }
    $stmt->close();
}

//close connection to DB
$con->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <div class="container">
        <img src="header.PNG">
        <div class="bottom-right"><?php
            if ($first_name !='' && $last_name != '') {
                echo "Welcome, " . $first_name . " " . $last_name;
            } ?>
        </div>

    </div>
    <meta charset="UTF-8">
    <title>ePark</title>
    <link href="style.css" rel="stylesheet">
    <style>
        html {
            padding-top: 0px;
            max-width: 100%;
            overflow-x: hidden;
            overflow-y: hidden;
        }

        body {
            text-align: center;
            margin: 0 !important;
            padding: 0 !important;
            background: url(background.png) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            max-width: 100%;
            overflow-x: hidden;
            overflow-y: hidden;
        }

        body:after {
            content: "";
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.1);
            pointer-events: none;
        }

        p {

            color: white;
            font-weight: bolder;
            font-size: larger;
        }

        .outer {
            display: table;
            position: absolute;
            height: 100%;
            width: 100%;
        }

        .middle {
            display: table-cell;
            vertical-align: middle;
        }

        .inner {
            margin-left: auto;
            margin-right: auto;
            width: 400px;
            /*whatever width you want*/
        }
        .container {
            position: relative;
            text-align: center;
            color: white;
        }

        .bottom-right {
            position: absolute;
            bottom: 8px;
            right: 16px;
        }

    </style>
</head>
<body>
<div class="outer">
    <div class="middle">
        <div class="inner">
            <p style="font-size: 30px;" class="navbar-brand">Lots with available spots:</p>
            <p>Please select a lot.</p>
            <!-- INCLUDE CONTENT HERE -->
            <?php
            if ($numAvailableLot1 != 0) {
                echo "<table style=\"display: inline-block;\" onmouseover=\"this.style.background='#f4f8ff';\" onmouseout=\"this.style.background='transparent'; this.style.border='1px white';\" onclick=\"location.href='lot1.php'\"><tr><th><b><p>Parking Lot 1</p></b></b></th></tr><tr><td><p>$numAvailableLot1 spots available</p></td></tr></table>&ensp;";

            }

            if ($numAvailableLot2 != 0) {
                echo "<table style=\"display: inline-block;\" onmouseover=\"this.style.background='#f4f8ff';\" onmouseout=\"this.style.background='transparent';\" onclick=\"location.href='lot2.php'\"><tr><th><b><p>Parking Lot 2</p></b></b></th></tr><tr><td><p>$numAvailableLot2 spots available</p></td></tr></table>&ensp;";

            }
            if ($numAvailableLot3 != 0) {
                echo "<table style=\"display: inline-block;\" onmouseover=\"this.style.background='#f4f8ff';\" onmouseout=\"this.style.background='transparent';\" onclick=\"location.href='lot3.php'\"><tr><th><b><p>Parking Lot 3</p></b></b></th></tr><tr><td><p>$numAvailableLot3 spots available</p></td></tr></table>&ensp;";

            }

            ?>
        </div>
    </div>
</div>
</body>
</html>
