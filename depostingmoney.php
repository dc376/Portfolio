<!DOCTYPE html>
<html>
<head>
<title>Kehoe's Bros Betting</title>
<style>
body {margin: 0;}
#css1{
    background-color: black;
    background-position: right bottom;
    background-repeat: repeat;
    padding: .5px;
    }
.topnav{
    overflow: hidden;
    background-color:black;
    }
.topnav a{
    float: center;
    display: inline;
    color: white;
/*    text-align: center;*/
    padding: 5px 10px;
    text-decoration: none;
    font-size: 10px;
    }
.topnav a:hover{
    background-color: lightblue;
    color: black;
}
.topnav a.active{
    background-color: #ee2211;
    color: red;
}   
.box1{
    position: relative;
    margin: auto;
    float: center;
    width: 400px;
    border: 2px solid;
    font-family:"georgia";
    height: 120px;
    background-color: black;
    color: black;
    text-align: left;
    padding-left: .5cm;
    padding-top: .05cm;
    padding-bottom: .8cm;
    background-color: black| transparent;
    background: rgba(225, 225, 225, .59);
}    
</style>
</head>

<style>
    { margin: 0; padding: 0; }
    html {
        background: url('https://i.pinimg.com/originals/2c/ba/0c/2cba0cb95b6bfdad2a7699490309d8ff.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>

<body>
<div id = "css1">
<center>
<h3><font face="georgia" size="5" color="white">Kehoe's Bros Betting</font></h3>
    <div class="topnav" id="firstTopNav">
        <a href="pickaSport.php">HOME</a>
        <a href="deposit.php">DEPOSIT</a>
        <a href="about.php">ABOUT</a>
<!--        <a href="compareResults.php">RESULTS</a>-->
    </div>
</center>
</div>
</body>


<style>
    { margin: 0; padding: 0; }
    html {
        background: url('https://d2v9y0dukr6mq2.cloudfront.net/video/thumbnail/VYJZA0Avg/rack-focus-of-stadium-lights-in-front-of-a-dark-blue-sky-light-stadium-at-night-baseball-and-hockey-there-is-a-rain-or-snow-military-security-lighting-towers-patrol-in-prison_h9xhm5hjle_thumbnail-full01.png') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>

<body>
<?php
include "database.php";
session_start();
$con = Connect();
$getUserBalance = "SELECT balance AS var FROM users WHERE screenname = 'dc376'";
$userBalanceQuery = mysqli_query($con, $getUserBalance);
$balanceResult = $userBalanceQuery->fetch_object()->var;

// echo "current balance: " . $balanceResult;

$deposit = $_GET['amount'];
$_SESSION['amount'] = $deposit;

$deposit = $deposit + $balanceResult;
$newBalance = "UPDATE users set balance = '$deposit' where screenname = 'dc376'";

$success = $con->query($newBalance);
?>
</body>

<body>
<br>
<br>
<br>
<div class = "box1">
<h2><center> Deposited Amount </center></h2>
<p> Deposited amount = $<?=$_SESSION['amount']?></p>
<p> Current balance = $<?=$balanceResult?></p>

</div>
</body>

</html>
