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
$cardID = $_POST['cardID'];
$cardID = clean($cardID);
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
$query = "SELECT first_name, last_name FROM user_accounts WHERE card_id = '$cardID'";
if ($stmt = $con->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($first_name, $last_name );
    while ($stmt->fetch()) {
        //do nothing
    }
    $stmt->close();
}
$queryUpdate = "UPDATE user_accounts SET check_in = '0' WHERE card_id = '$cardID'";
if ($stmt = $con->prepare($queryUpdate)) {
    $stmt->execute();
    $stmt->bind_result($check_in);
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
    header('Location: logout.html'); //redirect URL
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
                                /*echo "Welcome, " . $first_name . " " . $last_name;
                                
                                 */
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
            <h1><font color="white">Thank You...</font></h1>
            <script>
			window.setTimeout(function(){
				// redirect back to home page
				window.location.href = "index.html";
			}, 5000);
			</script>
        </div>
    </div>
</div>
</body>
</html>
