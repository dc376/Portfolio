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

<?php
session_start();
// retrieve the form data by using the element's name attributes value as key 
//require('betFunc.php.inc');
$basketball = $_GET['team1_pick']; 
$basketball2 = $_GET['team2_pick']; 
$basketball3 = $_GET['team3_pick'];
$_SESSION['team1_pick'] = $basketball;
$_SESSION['team2_pick'] = $basketball2;
$_SESSION['team3_pick'] = $basketball3;
?>

<style>
.box1{
    position: relative;
    margin: auto;
    float: center;
    width: 290px;
    border: 2px solid;
    font-family:"georgia";
    height: 145px;
    background-color: black;
    color: black;
    text-align: left;
    padding-left: .5cm;
    padding-top: .02cm;
    padding-bottom: .5cm;
    background-color: black| transparent;
    background: rgba(225, 225, 225, .65);
}

</style>
<center>
<br>
<br>
<body>
<div class = "box1">
<h2><font face="georgia" size="4" color="black"><center>Selected Team</center></font></h2>
<p>Team 1:     <?=$_SESSION['team1_pick']?></p>
<p>Team 2:     <?=$_SESSION['team2_pick']?></p>
<p>Team 3:     <?=$_SESSION['team3_pick']?></p>
</div>
</body>
<br>
<br>
<br>

<body>


<form name="thisForm" action="NBAinsertBets.php" method="post" style="width: 310px; padding-bottom: .5cm; padding-top: .09cm; background-color: #000000; background-color: black| transparent; background: rgba(225, 225, 225, .65); border: 2px solid;">

<h2><font face="georgia" size="3" color="black"><center>Place your bet below</center></h2> 
    
    
    <label><font size="2"><b>Bet Amount: </b></font></label>
    <input type="text" name="bet_amount" style="width: 100px;" required>
    <div class="clearfix">
      <br>
	<button type="submit" class="signupbtn">Submit Bets!</button>
</form>

</body>
</html>

	
