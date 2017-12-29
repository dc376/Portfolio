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
    width: 300px;
    border: 2px solid;
    font-family:"georgia";
    height: 150px;
    background-color: black;
    color: black;
    text-align: left;
    padding-left: .5cm;
    padding-top: .05cm;
    padding-bottom: .8cm;
    background-color: black| transparent;
    background: rgba(225, 225, 225, .65);
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
        <a href="compareResults.php">RESULTS</a>
    </div>
</center>
</div>
</body>

<body>

<?php session_start();
$_SESSION['qb'];
$_SESSION['rb'];
$_SESSION['wr'];
?>

<?php
$qb = $_GET['qb'];
$rb = $_GET['rb'];
$wr = $_GET['wr'];
require 'database1.php';
$conn    = Connect();
$bet    = $_POST['bet_amount'];
$drop = "TRUNCATE TABLE user_bets";
$success1 = $conn->query($drop);
$query   = "INSERT into user_bets (screenname,bet_amount,qb_pick,rb_pick,wr_pick) VALUES('" . "dc376" . "','" . $bet . "','" . $_SESSION["qb"] . "','" . $_SESSION["rb"] . "','" . $_SESSION["wr"] . "')";
$success = $conn->query($query);
 
//echo "<br><br>The QB is ". $_SESSION['qb'];
//echo "<br><br>The RB is ". $_SESSION['rb'];
//echo "<br><br>The WR is ". $_SESSION['wr'];
//echo "<br><br>The bet amount is ". $bet;
 
$conn->close();
 
?>

<br>
<br>
<body>
<div class = "box1">
<p>The QB is <?=$_SESSION['qb']?></p>
<p>The RB is <?=$_SESSION['rb']?></p>
<p>The WR is <?=$_SESSION['wr']?></p>
<p>The bet amount is $<?=$bet?></p>
</div>
</body>

</html>
