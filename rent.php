<?php 
include 'views.php';
include 'updatesessions.php';
incrementViews("rent");
	session_start(); $host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";

	$connect=mysqli_connect($host,$username,$password,$db_name);
if(!isset($_SESSION["rent"]))
		{
			$sql = "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'rent' ";
			$table = mysqli_query($connect, $sql);		
			
			echo $sql;
			$_SESSION["rent"] = 1;
		}
	error_reporting(0);
?>
<html>
<title>Book Info</title>
<head>
<link rel="stylesheet" type="text/css" href="http://localhost/project1/CSSstylesheet.css">
</head>
<body>

		<div class=navbar>
		<a href="http://localhost/project1/Page1.php"><img src="http://localhost/project1/home3.png" style="position:relative; left:7px; top:7px; align:center; width:40px; height:40px;"></a>
		<a href="http://localhost/project1/userProf.php"><img src = "http://localhost/project1/book.png" style="position:relative; left:30px; top:7px; align:center; width:40px; height:40px;"></a>
		<a href="http://localhost/project1/imprumuta.php"><img src = "http://localhost/project1/rent.png" style="position:relative; left:50px; top:7px; align:center; width:40px; height:40px"></a>
		<a href="http://localhost/project1/return.php"><img src = "http://localhost/project1/return.png" style="position:relative; left:70px; top:7px; align:center; width:40px; height:40px"></a>
		<a href="http://localhost/project1/contact.php"><img src = "http://localhost/project1/contact.png" style="position:relative; left:90px; top:7px; align:center; width:40px; height:40px"></a>
		<?php
			if($_SESSION["userrole"] == 1)
			{
				echo "<a href='http://localhost/project1/admin.php'><img src = 'http://localhost/project1/admin.png' style='position:relative; left:110px; top:7px; align:center; width:40px; height:40px'></a>
					<a href='http://localhost/project1/managebooks.php'><img src = 'http://localhost/project1/managebooks.png' style='position:relative; left:130px; top:7px; align:center; width:40px; height:40px'></a>
					<a href='http://localhost/project1/manageusers.php'><img src = 'http://localhost/project1/manageusers.png' style='position:relative; left:150px; top:7px; align:center; width:40px; height:40px'></a>
					<a href='http://localhost/project1/statistics.php'><img src = 'http://localhost/project1/statistics.png' style='position:relative; left:170px; top:7px; align:center; width:40px; height:40px'></a>
					";
	
			}
		?>
		<form action="bookinfo.php" method=post style="position:fixed; top:0px; right:5px;" >
		<?php if(is_null($_SESSION['mail'])) echo "<input style='padding:10px; float:right; height:45px;' type=submit class=button name=signIn value='Sign In'>"; ?>        
		<?php if(!is_null($_SESSION['mail'])) echo "<input style='float:right; padding:10px; height:45px;' type=submit class=button name=signOut value='Sign Out'>"; ?>         
		</form>
		</div>
		<?php

		if(isset($_POST['signOut']))
		{
			session_unset();
			header('refresh:0 URL=Page1.php');
		}
		elseif (isset($_POST['signIn']))
		{
			header('refresh:0 URL=signin.php');
		}

?>

<?php

	$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";
	
$connect= mysqli_connect($host,$username,$password,$db_name);
if(!$connect)
{
	echo "<script type='text/javascript'>alert(' Can't connect to the Database ');	</script>";
}

	$query = "SELECT * FROM userinfo WHERE ID = ".$_SESSION["userid"];
	
	$result = mysqli_query($connect, $query);
	$table = mysqli_fetch_array($result);
	
	$getbook = "SELECT * FROM bookinfo WHERE serial =".$_SESSION['serial'];
	//echo $getbook;
	$bookresult = mysqli_query($connect, $getbook);
	$bookinfo = mysqli_fetch_array($bookresult);
	
	
?>



<?php 
echo '

<form method="post" action="loanfile.php">

<br>
<center>
<div class=frm align=center>
<br><br><br>
<h1 style="color:#392613; text-shadow: 0px 0px 20px #bf8040;">
Loan Card</h1>
<br>
<p style="display: inline-flex; background-color:rgb(236, 217, 198); font-style:italic; color:#986F44;">
Please check the following details
</p><br><br><br><br>

<strong><input style="width:190px;" class=box type=text value="'.$table[1].'" name="finame" required></input>
&emsp;
<input style="width:180px;" class=box type=text name="laname" value="'.$table[2].'" required></input>

<br><br>

<input class=box type=text name="loadd" value="'.$table[4].'" required></input>

<br><br>

<input class=box type=text name="phone" value="'.$table[7].'" pattern="{1000000000,9999999999}" required></input>

<br><br>

<input class=box type="email" value="'.$table[8].'" name="mail" required></input>

<br><br>

<input class=box type=text value="'.$bookinfo[2].'" name ="title" required readonly></input>

<br><br>

<input class=box type=text value="'.$bookinfo[1].'"name ="author" required readonly></input>

<br><br>

<input type="submit" class=button value="Get loan card" name="submit">&emsp;&emsp;</input>

<br><br><br>

</div>
<br><br><br>
</form>';
?>
</body>
</html>