<?php
session_start();
/**
* Created by PhpStorm.
* User: cooten
* Date: 9/17/2018
* Time: 1:23 PM
*/
if(isset($_SESSION['user']) && $_SESSION['user'] != " " && $_SESSION['user'] != "")
{
//Task to do
} else{
header('Location: index.html'); //redirect URL
}

$host = "127.0.0.1";
$port = 3306;
$socket = "";
$user = "root";
$password = "dbpassword";
$dbname = "eParking";
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();
$query = "SELECT vacant FROM eParking.parking_lot_2";
$results = array();


if ($stmt = $con->prepare($query)) {
    $stmt->execute();
    $stmt->bind_result($vacant);
    while ($stmt->fetch()) {
        //printf("%s\n", $vacant);
        $results[] = $vacant;
    }
    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <img src="header.PNG">
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

        table, th, td {
            border: 2px solid white;
            text-align: center;
            color: white;
        }


    </style>

</head>
<body>
<center><br>
    <p>
        Lot 2 <br>
        Please park in any of the available spots.
    </p>
    <table class="myformat" style="height: 386px;" width="629">
        <tbody>
        <tr>
            <td id="1" onclick="content(this)" style="width: 52px;">1</td>
            <td id="2" onclick="content(this)" style="width: 52px;">2</td>
            <td id="3" onclick="content(this)" style="width: 52px;">3</td>
            <td id="4" onclick="content(this)" style="width: 52px;">4</td>
            <td id="5" onclick="content(this)" style="width: 52px;">5</td>
            <td id="6" onclick="content(this)" style="width: 52px;">6</td>
            <td id="7" onclick="content(this)" style="width: 52px;">7</td>
            <td id="8" onclick="content(this)" style="width: 52.8px;">8</td>
            <td id="9" onclick="content(this)" style="width: 52.8px;">9</td>
            <td id="10" onclick="content(this)" style="width: 52.8px;">10</td>
            <td id="11" onclick="content(this)" style="width: 52.8px;">11</td>
            <td id="12" onclick="content(this)" style="width: 52.8px;">12</td>
        </tr>
        <tr>
            <td style="width: 628px; background-color: white;" colspan="12">&nbsp;</td>
        </tr>
        <tr>
            <td id="13" onclick="content(this)" style="width: 52px;">13</td>
            <td id="14" onclick="content(this)" style="width: 52px;">14</td>
            <td id="15" onclick="content(this)" style="width: 52px;">15</td>
            <td id="16" onclick="content(this)" style="width: 52px;">16</td>
            <td id="17" onclick="content(this)" style="width: 52px;">17</td>
            <td id="18" onclick="content(this)" style="width: 52px;">18</td>
            <td id="19" onclick="content(this)" style="width: 52px;">19</td>
            <td id="20" onclick="content(this)" style="width: 52.8px;">20</td>
            <td id="21" onclick="content(this)" style="width: 52.8px;">21</td>
            <td id="22" onclick="content(this)" style="width: 52.8px;">22</td>
            <td id="23" onclick="content(this)" style="width: 52.8px;">23</td>
            <td id="24" onclick="content(this)" style="width: 52.8px;">24</td>
        </tr>
        <tr>
            <td id="25" onclick="content(this)" style="width: 52px;">25</td>
            <td id="26" onclick="content(this)" style="width: 52px;">26</td>
            <td id="27" onclick="content(this)" style="width: 52px;">27</td>
            <td id="28" onclick="content(this)" style="width: 52px;">28</td>
            <td id="29" onclick="content(this)" style="width: 52px;">29</td>
            <td id="30" onclick="content(this)" style="width: 52px;">30</td>
            <td id="31" onclick="content(this)" style="width: 52px;">31</td>
            <td id="32" onclick="content(this)" style="width: 52.8px;">32</td>
            <td id="33" onclick="content(this)" style="width: 52.8px;">33</td>
            <td id="34" onclick="content(this)" style="width: 52.8px;">34</td>
            <td id="35" onclick="content(this)" style="width: 52.8px;">35</td>
            <td id="36" onclick="content(this)" style="width: 52.8px;">36</td>
        </tr>
        <tr>
            <td style="width: 628px; background-color: white;" colspan="12">&nbsp;</td>
        </tr>
        <tr>
            <td id="37" onclick="content(this)" style="width: 52px;">37</td>
            <td id="38" onclick="content(this)" style="width: 52px;">38</td>
            <td id="39" onclick="content(this)" style="width: 52px;">39</td>
            <td id="40" onclick="content(this)" style="width: 52px;">40</td>
            <td id="41" onclick="content(this)" style="width: 52px;">41</td>
            <td id="42" onclick="content(this)" style="width: 52px;">42</td>
            <td id="43" onclick="content(this)" style="width: 52px;">43</td>
            <td id="44" onclick="content(this)" style="width: 52.8px;">44</td>
            <td id="45" onclick="content(this)" style="width: 52.8px;">45</td>
            <td id="46" onclick="content(this)" style="width: 52.8px;">46</td>
            <td id="47" onclick="content(this)" style="width: 52.8px;">47</td>
            <td id="48" onclick="content(this)" style="width: 52.8px;">48</td>
        </tr>
        </tbody>
    </table>

    <script>
        function displayFromDB() {
            var myVariable = <?php echo(json_encode($results)); ?>;
            var length = myVariable.length;
            for (var i = 0; i < length; i++) {
                if (myVariable[i] == 1) {
                    document.getElementById(i + 1).style.backgroundColor = "green";
                } else if (myVariable[i] == 0) {
                    document.getElementById(i + 1).style.backgroundColor = "red";
                }
            }
        }

        window.onload = displayFromDB;
    </script>

</center>
</body>
