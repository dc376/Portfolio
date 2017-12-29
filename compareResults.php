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
/**.topnav a.active{
    background-color: #ee2211;
    color: red;
}   
.box1{
    position: relative;
    margin: auto;
    float: center;
    width: 400px;
    font-family:"georgia";
    height: 100px;
    background-color: pink;
    text-align: left;
    padding-left: .5cm;
    padding-top: .05cm;
    padding-bottom: .8cm;
}**/
    
</style>

</head>

<body>
<center>
<div id = "css1">
<h3><font face="georgia" size="5" color="white">Kehoe's Bros Betting</font></h3>
    <div class="topnav" id="firstTopNav">
        <a href="pickaSport.php">HOME</a>
        <a href="deposit.php">DEPOSIT</a>
        <a href="about.php">ABOUT</a>
        <a href="compareResults.php">RESULTS</a>
    </div>
</div>
</center>
</body>
</style>


</head>
<body>
<center>
<style>
    { margin: 0; padding: 0; }
    html {
        background: url('http://www.drodd.com/nfl/nfl22.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>


<!--#!/usr/bin/php-->
<?php
include "database1.php";
$conn    = Connect();
//get top QB
$getQB = "SELECT player_name AS var FROM football_stats WHERE position = 'QB' ORDER BY passing_yards DESC LIMIT 1";
$qbQuery = mysqli_query($conn,$getQB);
$qbResult = $qbQuery->fetch_object()->var;
//get top RB
$getRB = "SELECT player_name AS var FROM football_stats WHERE position = 'RB' ORDER BY running_yards DESC LIMIT 1";
$rbQuery = mysqli_query($conn,$getRB);
$rbResult = $rbQuery->fetch_object()->var;
//get top WR
$getWR="SElECT player_name AS var FROM football_stats WHERE position = 'WR' ORDER BY receiving_yards DESC LIMIT 1";
$wrQuery = mysqli_query($conn,$getWR);
$wrResult = $wrQuery->fetch_object()->var;
//get user name...need a session var for username
$getUser = "SELECT screenname AS var from user_bets WHERE screenname = 'dc376'";
$userQuery = mysqli_query($conn,$getUser);
$userResult = $userQuery->fetch_object()->var;
//get bet amount
$getBet = "SELECT bet_amount AS var from user_bets WHERE screenname = 'dc376'";
$betQuery = mysqli_query($conn,$getBet);
$betResult = $betQuery->fetch_object()->var;
//get user qb
$getUserQb = "SELECT qb_pick AS var from user_bets where screenname = 'dc376'";
$userQbQuery = mysqli_query($conn,$getUserQb);
$userQbResult = $userQbQuery->fetch_object()->var;
//get user rb
$getUserRb = "SELECT rb_pick AS var from user_bets where screenname = 'dc376'";
$userRbQuery = mysqli_query($conn,$getUserRb);
$userRbResult = $userRbQuery->fetch_object()->var;
//get user wr
$getUserWr = "SELECT wr_pick AS var from user_bets where screenname = 'dc376'";
$userWrQuery = mysqli_query($conn,$getUserWr);
$userWrResult = $userWrQuery->fetch_object()->var;
//connects to user DB
$conn->close();
$hostname = "192.168.1.120";
$username = "miguelle";
$password = "miguelle";
$dbname = "login";
$db2 = mysqli_connect($hostname, $username, $password,$dbname);
$dbselect = mysqli_select_db($db2, "login");
//get user balance from user DB
$getUserBalance = "SELECT balance AS var FROM users WHERE screenname = '$userResult'";
$userBalanceQuery = mysqli_query($db2, $getUserBalance);
$userBalanceResult = $userBalanceQuery->fetch_object()->var;
//echo $userBalanceResult;
//gets email address
$getEmail = "SELECT email AS var FROM users where screenname = '$userResult'";
$emailQuery = mysqli_query($db2, $getEmail);
$emailResult = $emailQuery->fetch_object()->var;
//checks if hit on qb
if($qbResult == $userQbResult)
{
$amount = (.33 * $betResult) + $userBalanceResult;
$qbBetWon = "update users set balance = '$amount' where screenname = '$userResult'";
$success = $db2->query($qbBetWon);
echo "<p style='color:black; background-color:white; height:30px; width: 350px; padding-top: 30px; padding-bottom: 50px; padding-left: 30px; padding-right: 30px; border: 2px solid; background-color: black| transparent; background: rgba(225, 225, 225, .70);'>Your choice ". $userQbResult . " won! Email sent: Your QB won </p><br>";
 mail($emailResult, "your quarterback choice was right", " you have earned " (.33 * $betResult), "so your total is now ",$userBalanceResult);
}
//check if miss on qb
if($qbResult != $userQbResult)
    {
        $getUserBalance = "SELECT balance AS var FROM users WHERE screenname = '$userResult'";
        $userBalanceQuery = mysqli_query($db2, $getUserBalance);
        $userBalanceResult = $userBalanceQuery->fetch_object()->var;
        $amount = $userBalanceResult - (.33 * $betResult);
        $qbBetLost = "update users set balance = '$amount' where screenname = '$userResult'";
        $success = $db2->query($qbBetLost);
        
        echo "<p style='color:black; background-color:white; height:30px; width: 350px; padding-top: 30px; padding-bottom: 50px; padding-left: 30px; padding-right: 30px; border: 2px solid;background-color: black| transparent; background: rgba(225, 225, 225, .70);'>Your choice ".$userQbResult." did not win. Email sent: Your QB choice lost </p><br>";         
        mail($emailResult, "your quarterback choice was not right", "you have not earned any more money");
        
//code to track a win, put it in a database that just has an INT for a number to add/subtract to it.
        $getCurrentYTD = "SELECT yearly_total as var FROM admin";
        $currentYTDQuery = mysqli_query($db2,$getCurrentYTD);
        $currentYTDResult = $currentYTDQuery->fetch_object()->var;
        
        
        $profitGain = (.33 * $betResult);
        $updateProfitYTD = "update admin set yearly_total = '$profitGain' where screenname = 'admin'";
        $updateProfitWT = "update admin set weekly_total = '$profitGain' where screenname = 'admin'";
        $success1 = $db2->query($updateProfitYTD);
        $success2 = $db2->query($updateProfitWT);
}
//checks if hit on RB
if($rbResult == $userRbResult)
    {
        $getUserBalance = "SELECT balance AS var FROM users WHERE screenname = '$userResult'";
        $userBalanceQuery = mysqli_query($db2, $getUserBalance);
        $userBalanceResult = $userBalanceQuery->fetch_object()->var;
        $amount = (.33 * $betResult) + $userBalanceResult;
        $rbBetWon = "update users set balance = '$amount' where screenname = '$userResult'";
        $success = $db2->query($rbBetWon);
        
//         echo ".\n" . "your choice " . $userRbResult . " won!<br><br>";
        echo "<p style='color:black; background-color:blue; height:30px; width: 350px; padding-top: 30px; padding-bottom: 50px; padding-left: 30px; padding-right: 30px;border: 2px solid;background-color: black| transparent; background: rgba(225, 225, 225, .70);'>Your choice ".$userRbResult." won </p><br>";
        mail($emailResult, "your runningback was right", " you have earned ",(.33 * $betResult), "so your total is now " , $userBalanceResult);
//         echo "<p style='color:black; background-color:red; height:50px; width: 350px; padding-top: 50px; padding-bottom: 50px; padding-left: 30px; padding-right: 30px;'>email sent for winning rb</p><br>";
    }
//check if miss on RB
if($rbResult != $userRbResult)
    {
        $getUserBalance = "SELECT balance AS var FROM users WHERE screenname = '$userResult'";
        $userBalanceQuery = mysqli_query($db2, $getUserBalance);
        $userBalanceResult = $userBalanceQuery->fetch_object()->var;
        $amount = $userBalanceResult - (.33 * $betResult);
        $rbBetLost = "update users set balance = '$amount' where screenname = '$userResult'";
        $success = $db2->query($rbBetLost);
        
//         echo "\n" . "your choice " . $userRbResult . " did not win<br><br>";
        echo "<p style='color:black; background-color:blue; height:30px; width: 350px; padding-top: 30px; padding-bottom: 50px; padding-left: 30px; padding-right: 30px;border: 2px solid; background-color: black| transparent; background: rgba(225, 225, 225, .70);'>Your choice ".$userRbResult." did not win. Email sent: Your Runningback choice did not win</p><br>";
        mail($emailResult, "your running back choice  was not right", "you have not earned any more money");
//         echo "<p style='color:black; background-color:red; height:50px; width: 350px; padding-top: 50px; padding-bottom: 50px; padding-left: 80p; padding-right: 30px;'>Email sent: rb-losing</p><br>";
    }
//checks if hit on WR
if($wrResult == $userWrResult)
    {
        $getUserBalance = "SELECT balance AS var FROM users WHERE screenname = '$userResult'";
        $userBalanceQuery = mysqli_query($db2, $getUserBalance);
        $userBalanceResult = $userBalanceQuery->fetch_object()->var;
        $amount = (.33 * $betResult) + $userBalanceResult;
        $wrBetWon = "update users set balance = '$amount' where screenname = '$userResult'";
        $success = $db2->query($wrBetWon);
//      echo "\n" . "your choice " . $userWrResult . " won<br><br>";
        echo "<p style='color:black; background-color:red; height:30px; width: 350px; padding-top: 30px; padding-bottom: 50px; padding-left: 30px; padding-right: 30px;border: 2px solid;background-color: black| transparent; background: rgba(225, 225, 225, .70);'>Your choice ".$userWrResult." won! Email sent: Your Wide Receiver choice won!</p>";
        mail($emailResult, "Your reciever choice was correct you have earned " , (.33 * $betResult), "so your total is now: " , $userBalanceResult);
//      echo "<p style='color:black; background-color:red; height:50px; width: 350px; padding-top: 50px; padding-bottom: 50px; padding-left: 80p; padding-right: 30px;'>Email sent: wr-winning</p><br>";
    }
//check if miss on WR
if($wrResult != $userWrResult)
    {
        $getUserBalance = "SELECT balance AS var FROM users WHERE screenname = '$userResult'";
        $userBalanceQuery = mysqli_query($db2, $getUserBalance);
        $userBalanceResult = $userBalanceQuery->fetch_object()->var;
        $amount = $userBalanceResult - (.33 * $betResult);
        $wrBetLost = "update users set balance = '$amount' where screenname = '$userResult'";
        $success = $db2->query($wrBetLost);
        
//         echo /*"\n" . */"<div style=\"background:$hexcolor; height:5px; width:25px;\">"your choice " . $userWrResult . " did not win<br><br>"";
        echo "<p style='color:black; background-color:red; height:30px; width: 350px; padding-top: 30px; padding-bottom: 50px; padding-left: 30px; padding-right: 30px; border: 2px solid;background-color: black| transparent; background: rgba(225, 225, 225, .70);'>Your choice ".$userWrResult." did not win. Email sent: wr-losing</p><br>";
        mail($emailResult, "Your receiver choice  was not right", "you have not earned any more money");
//         echo "<p style='color:black; background-color:red; height:50px; width: 350px; padding: 1px;'>Email sent: wr-losing</p><br><br>";
    }
$getUserBalance = "SELECT balance AS var FROM users WHERE screenname = '$userResult'";
$userBalanceQuery = mysqli_query($db2, $getUserBalance);
$userBalanceResult = $userBalanceQuery->fetch_object()->var;
echo "<p style='color:black; background-color:red; height:30px; width: 350px; padding-top: 30px; padding-bottom: 50px; padding-left: 30px; padding-right: 30px; border: 2px solid;background-color: black| transparent; background: rgba(225, 225, 225, .70);'>". $userResult . " your new balance is " . $userBalanceResult ." Cool! </p>"; 
?>

<!--<br>
<br>
<body>
<div class = "box1">
<p>The QB is <?=$_SESSION['qb']?></p>
<p>The RB is <?=$_SESSION['rb']?></p>
<p>The WR is <?=$_SESSION['wr']?></p>
<p>Your new balance is <?=$userBalanceResult?></p>
</div>
</body>-->

</html>
