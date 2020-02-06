<?php
include 'views.php';
incrementViews("signup");
session_start();

$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";

	$connect=mysqli_connect($host,$username,$password,$db_name);

if(!isset($_SESSION["signup"]))
		{
			$sql = "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'signup' ";
			$table = mysqli_query($connect, $sql);		
			
			echo $sql;
			$_SESSION["signup"] = 1;
		}
error_reporting(0);
?>
<html>
<title>Sign Up</title>
<head>
<link rel="stylesheet" type="text/css" href="http://localhost/project1/CSSstylesheet.css">

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



<?php


	$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";
	

$connect=mysqli_connect($host,$username,$password,$db_name);

//echo "sql connected";

if(isset($_POST['submit'])){
	

	$n1 = $_SESSION["finame"] = $_POST['finame'];
	$n2 = $_SESSION["laname"] = $_POST['laname'];
	$n3 = $_SESSION["gender"] = $_POST['gender'];
	$n4 = $_SESSION["loadd"] = $_POST['loadd'];
	$n5 = $_SESSION["ltadd"] = $_POST['ltadd'];
	$n6 = $_SESSION["nationality"] = $_POST['nationality'];
	$n7 = $_SESSION["phone"] = $_POST['phone'];
	$n8 = $_SESSION["mail"] = $_POST['mail'];
	$n9 = $_SESSION["password"] = $_POST['password'];
    $n10 = $_SESSION["role"] = "2";
	header('refresh:0 URL=phpmailerX2/mail_tls.php');
/*	
$sql="INSERT INTO userinfo (finame, laname, gender, loadd, ltadd, nationality, phone, mail, password, idrole) VALUES('$n1','$n2','$n3','$n4','$n5','$n6','$n7','$n8','$n9','$n10')";
$n8=str_replace('@','at',$n8);
$n8=str_replace('.','dot',$n8);
$_SESSION['mail']=$n8;
//echo $sql;
//echo "<script type='text/javascript'> alert('$n8'); </script>";



if(mysqli_query($connect, $sql))
{
	echo "<script type='text/javascript'> alert(' Successfully registered '); </script>";
	//mysqli_close($connect);
	//$connect=mysqli_connect($host,$username,$password,$db_name);
	//$user1="CREATE TABLE $n8 (serial VARCHAR(10) UNIQUE,title VARCHAR (50),author VARCHAR(30))";//-------CREATING USER SPECIFIC TABLE
	/*if(!mysqli_query($connect,$user1))
	{
		echo "<script type='text/javascript'> alert('User profile creation failed'); </script>";
	}
	
	
	else header('refresh:0 URL=userProf.php');
	
}
else
{
	echo $sql;
	//echo "<script type='text/javascript'>alert(' Registration failed ');	</script>";
	//header('refresh:0 URL=signup.php');
}
*/
}

mysqli_close($connect);
?>

<form method="post" action="signup.php">

<br>
<center>
<div class=frm align=center>
<br><br><br>
<h1 style="color:#392613; text-shadow: 0px 0px 20px #bf8040;">
SIGN UP
</h1>
<br>
<p style="display: inline-flex; background-color:rgb(236, 217, 198); font-style:italic; color:#986F44;">
Ah, how good it is to be among people who are reading
</p><br><br><br><br>

<strong><input style="width:190px;" class=box type=text  placeholder="First Name" name="finame" required></input>
&emsp;
<input style="width:180px;" class=box type=text  name="laname" placeholder="Last Name" required></input>

<br><br>

<font size=5>
Male<input class=rad type=radio name="gender" id="Male" value="Male" required></input>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Female<input class=rad type=radio value="Female" id="Female"name="gender" required></input>

<br><br></font>

<input class=box type=text name="loadd" placeholder="Address line 1" required></input>

<br><br>

<input class=box type=text name="ltadd" placeholder="Address line 2" required></input>

<br><br>

<input class=box type=text name="nationality" placeholder="Nationality" required></input>

<br><br>

<input class=box type=text name="phone" placeholder="Phone Number" pattern="[0-9]{10}" title ="number is invalid" required></input>

<br><br>

<input class=box type="email" placeholder="Your Email" name="mail" required></input>

<br><br>
<input class=box type=password name="password" placeholder="Password" required></input>

<br><br>

<input type="submit" class=button value="Sign Up!" name="submit">&emsp;&emsp;</input><input type="Reset" class=button></input>

<br><br><br>

</div>
<br><br><br>
</form>
</body>

</html>
