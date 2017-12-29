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
    /**text-align: center;**/
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
    width: 310px;
    font-family:"georgia";
    height: 150px;
    background-color: black;
    color: black;
    border: 2px solid;
    text-align: left;
    padding-left: .5cm;
    padding-top: .05cm;
    padding-bottom: .8cm;
    background-color: black| transparent;
    background: rgba(225, 225, 225, .70);
}
    
</style>

</head>
<style>
    { margin: 0; padding: 0; }
    html {
        background: url('https://images5.alphacoders.com/467/thumb-1920-467394.jpg') no-repeat center center fixed;
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
        <a href="NBAcompareResults.php">RESULTS</a>
    </div>
</center>
</div>
</body>

<body>

<?php session_start();
$_SESSION['team1_pick'];
$_SESSION['team2_pick'];
$_SESSION['team3_pick'];
?>

<?php
$team1_pick = $_GET['team1_pick'];
$team2_pick = $_GET['team2_pick'];
$team3_pick = $_GET['team3_pick'];
require 'database1.php';
$conn    = Connect();
$bet    = $_POST['bet_amount'];
$drop = "TRUNCATE TABLE user_bballbet";
$success1 = $conn->query($drop);
$query   = "INSERT into user_bballbet (screenname,bet_amount,team1_pick,team2_pick,team3_pick) VALUES('" . "dc376" . "','" . $bet . "','" . $_SESSION["team1_pick"] . "','" . $_SESSION["team2_pick"] . "','" . $_SESSION["team3_pick"] . "')";
$success = $conn->query($query);
 
 
$conn->close();
 
?>

<br>
<br>
<body>
<div class = "box1">
<p>Team 1 pick is <?=$_SESSION['team1_pick']?></p>
<p>Team 2 pick is <?=$_SESSION['team2_pick']?></p>
<p>Team 3 pick is <?=$_SESSION['team3_pick']?></p>
<p>The bet amount is $<?=$bet?></p>
</div>
</body>

</html>
