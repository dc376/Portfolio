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
    color: white;
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
<!--<p><font face="georgia" size="2" color="white">Place Bets</font></p>-->
    <div class="topnav" id="firstTopNav">
        <a href="homepage.php">HOME</a>
        <a href="deposit.php">DEPOSIT</a>
        <a href="about.php">ABOUT</a>
        <a href="compareResults.php">RESULTS</a>
    </div>
</center>
</div>
</body>

<body>

<?php
session_start();
// retrieve the form data by using the element's name attributes value as key 
//require('betFunc.php.inc');
$qb = $_GET['qb']; 
$rb = $_GET['rb']; 
$wr = $_GET['wr'];
$_SESSION['qb'] = $qb;
$_SESSION['rb'] = $rb;
$_SESSION['wr'] = $wr;
?>

<style>
.box1{
    position: relative;
    margin: auto;
    float: center;
    width: 300px;
    font-family:"georgia";
    height: 150px;
    background-color: black;
    color: black;
    border: 2px solid;
    text-align: left;
    padding-left: .5cm;
    padding-top: .03cm;
    padding-bottom: .5cm;
    background-color: black| transparent;
    background: rgba(225, 225, 225, .59);
}
</style>
<center>
<br>
<br>
<body>
<div class = "box1">
<h2><font face="georgia" size="4" color="black"><center>Selected Players</center></font></h2>
<p> Quarterback:     <?=$_SESSION['qb']?></p>
<p> Runningback:     <?=$_SESSION['rb']?></p>
<p> Wide Receiver:   <?=$_SESSION['wr']?></p>
</div>
</body>
<br>
<br>
<br>

<body>


<form name="thisForm" action="insertBets.php" method="post" style="width: 320px; padding-bottom: .5cm; padding-top: .03cm; background-color: #000000; background-color: black| transparent; background: rgba(225, 225, 225, .59);border: 2px solid;">

<h2><font face="georgia" size="3" color="black"><center>Place your bet below</center></h2> 
    
    
    <label><font size="2"><b>Bet Amount: </b></font></label>
    <input type="text" name="bet_amount" style="width: 100px;" required>
    <div class="clearfix">
      <br>
	<button type="submit" class="signupbtn">Submit Bets!</button>
</form>

</body>
</html>
