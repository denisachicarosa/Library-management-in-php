<?php
include 'views.php';
incrementViews("home");
session_start();
$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";

	$connect=mysqli_connect($host,$username,$password,$db_name);
if(!isset($_SESSION["home1"]))
	{
		$sql = "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'home' ";
		$table = mysqli_query($connect, $sql);		
		
		echo $sql;
		$_SESSION["home1"] = 1;
	}
include 'sessions.php';

?>

<html>
<title>Welcome!</title>

<head>
<link rel="stylesheet" type="text/css" href="http://localhost/project1/CSSstylesheet.css">

<?php 
error_reporting(0);


?>

</head>

<body>

<div class=navbar>
		<a href="http://localhost/project1/Page1.php"><img src="http://localhost/project1/home3.png" style="position:relative; left:7px; top:7px; align:center; width:40px; height:40px;"></a>
		<a href="http://localhost/project1/bookinfo.php"><img src = "http://localhost/project1/book.png" style="position:relative; left:30px; top:7px; align:center; width:40px; height:40px;"></a>

		<form action="bookinfo.php" method=post style="position:fixed; top:0px; right:5px;" >
		<?php if(is_null($_SESSION['mail'])) echo "<input style='padding:10px; float:right; height:45px;' type=submit class=button name=signIn value='Sign In'>"; ?>        
		<?php if(!is_null($_SESSION['mail'])) echo "<input style='float:right; padding:10px; height:45px;' type=submit class=button name=signOut value='Sign Out'>"; ?>         
		</form>
		</div>
<center>

<div style="position: relative; top: 6em;">
<br>
<p style="font-size:31; color:#000000; text-shadow: 6px 6px 15px white;">I guess there are never enough books</p>

<br><br>
<form action="signin.php" style="font-size:20; color:#000000; bold;  text-shadow: 10px 10px 20px yellow;" method="post">
Get yourself registered now!
<br><br><br>
<a href="signup.php"><input type=button value=Register class=button></a> &nbsp;&nbsp;&emsp;&emsp; <input type="submit" value="Sign In" class=button></input>

</div>

</form>

</body>

