
<?php
session_start();

?>
<html>
<title>Verify</title>
<head>
<link rel="stylesheet" type="text/css" href="http://localhost/project1/CSSstylesheet.css">

</head>
<body>

	<div class=navbar>
	<a href="http://localhost/project1/Page1.php"><img src="http://localhost/project1/home3.png" style="position:relative; left:7px; top:7px; align:center; width:40px; height:40px;"></a>
	<form action="bookinfo.php" method=post style="position:fixed; top:0px; right:5px;" >
	<?php if(is_null($_SESSION['mail'])) echo "<input style='padding:10px; float:right; height:45px;' type=submit class=button name=signIn value='Sign In'>"; ?>        
	<?php if(!is_null($_SESSION['mail'])) echo "<input style='float:right; padding:10px; height:45px;' type=submit class=button name=signOut value='Sign Out'>"; ?>         
	</form>
	</div>
	<?php

		if(isset($_POST['signOut']))
		{
			echo "Hello signOut";
			session_unset();
			header('refresh:0 URL=Page1.php');
		}
		elseif (isset($_POST['signIn']))
		{
			header('refresh:0 URL=signin.php');
		}
	?>
	
	
	
	<br><br>

	<br><br>

	<br><br>

	<form method="post" action="verification.php">
	<center>
	<div class=frm align=center>
	<p>Check your mail. Entere the code you received here: </p>
	
	<strong><input style="width:190px;" class=box type=text placeholder="Verification code" name="code" required></input>
	<br><br>

	<input type="submit" class=button value="Enter" name="submit">
	</div>
	</center>
	</form>
	
</html>

<?php
//session_start();

$input_code = $_SESSION["correct_code"];

if(isset($_POST['submit'])){

if ($input_code == $_POST['code'])
{
	
	$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";
	

	$connect=mysqli_connect($host,$username,$password,$db_name);
	
	$n1 = $_SESSION["finame"] ;
	$n2 = $_SESSION["laname"];
	$n3 = $_SESSION["gender"] ;
	$n4 = $_SESSION["loadd"];
	$n5 = $_SESSION["ltadd"] ;
	$n6 = $_SESSION["nationality"] ;
	$n7 = $_SESSION["phone"];
	$n8 = $_SESSION["mail"] ;
	$n9 = $_SESSION["password"] ;
    $n10 = "2";
	$sql="INSERT INTO userinfo (finame, laname, gender, loadd, ltadd, nationality, phone, mail, password, idrole) VALUES('$n1','$n2','$n3','$n4','$n5','$n6','$n7','$n8','$n9','$n10')";
	if(mysqli_query($connect, $sql))
	{
		//echo "<script type='text/javascript'> alert(' Successfully registered '); </script>";
		$findId = "SELECT id FROM userinfo WHERE mail = '$n8'";
		$id = mysqli_query($connect, $findId);
		$userid = mysqli_fetch_array($id);
		$_SESSION["userid"] = $userid[0]; 
		$query = "INSERT INTO userrole (userid, roleid) VALUES ($userid[0], 2)";
		mysqli_query($connect, $query);
		header('refresh:0 URL=signIn.php');
	}
	else 
	{
		echo "<script type='text/javascript'>alert(' Registration failed ');	</script>";
		header('refresh:0 URL=signup.php');
	}
}

else {
	echo "<script type='text/javascript'>alert(' Registration failed ');	</script>";
	header('refresh:0 URL=signup.php');
}

mysqli_close($connect);
}

?>