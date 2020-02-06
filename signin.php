<?php
include 'views.php';
incrementViews("signin");
session_start();
	$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";

	$connect=mysqli_connect($host,$username,$password,$db_name);
//echo $_SESSION["signin1"];
if(!isset($_SESSION["signin1"]))
		{
			$sql = "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'signin' ";
			$table = mysqli_query($connect, $sql);		
			
			echo $sql;
			$_SESSION["signin1"] = 1;
		}

error_reporting(0);

if(!is_null($_SESSION['mail']))
{
	$_SESSION['mail'] = $_SESSION['mail'];
	header('refresh:0 URL=userProf.php');
}

?>
<html>
<title>Sign In</title>
<head>
<link rel="stylesheet" type="text/css" href="http://localhost/project1/CSSstylesheet.css">
</head>

<body >

		<div class=navbar>
		<a href="http://localhost/project1/Page1.php"><img src="http://localhost/project1/home3.png" style="position:relative; left:7px; top:7px; align:center; width:40px; height:40px;"></a>
		<?php
		if(is_null($_SESSION['mail']))
			echo '<a href="http://localhost/project1/bookinfo.php"><img src = "http://localhost/project1/book.png" style="position:relative; left:30px; top:7px; align:center; width:40px; height:40px;"></a>';
		else
			echo '<a href="http://localhost/project1/userProf.php"><img src = "http://localhost/project1/book.png" style="position:relative; left:30px; top:7px; align:center; width:40px; height:40px;"></a>';
		?>
		
		<!-- <a href="http://localhost/project1/contact.php"><img src = "http://localhost/project1/contact.png" style="position:relative; left:29px; top:7px; align:center; width:40px; height:40px"></a>
		-->
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


<center>

<?php

$tbl_name="userinfo";

$connect=mysqli_connect('localhost','root','lab223','library');
if(isset($_POST['submit']))
{
	$_SESSION["finame"] = $_POST['fname'];
	
	$usermail = $_SESSION['mail'] = $_POST['amail'];
	$_SESSION['mail']=str_replace('@','at',$_SESSION['mail']);
	$_SESSION['mail']=str_replace('.','dot',$_SESSION['mail']);
	//$usermail = $_SESSION['mail']ș
	
	console.print( $usermail);
	$userpassword=$_POST['apassword'];
	
	$sql="SELECT * FROM userinfo WHERE mail='$usermail' and password='$userpassword'";
	$result=mysqli_query($connect,$sql);
	$count=mysqli_num_rows($result);
	if($count==1)
	{
		
		//echo "hello world~!";
		$obj = mysqli_fetch_object($result);
		
		//echo $obj->ID;
		$_SESSION["userid"]= $obj->ID;
		$_SESSION["userrole"] = $obj->idrole;
		if($obj->idrole == 1)
		{
			header('refresh:0 URL=admin.php');
		}
		else
		{
			echo "<script type='text/javascript'>alert('Succesfully Logged In');</script>";
			header('refresh:0 URL=userProf.php');
		}
	}
	else
		if($count != 1)
	{
		echo "<script type='text/javascript'>alert('Incorrect Email and Password Combination');	</script>";
		header('refresh:0 URL=signin.php');
	}
}
?>
<br><br><br>
<div class=frm >
<br><br><br>
<form action="signin.php" method="post">

<input type=text name=fname placeholder="First Name" ></input><br><br>
<input type=text placeholder="Your registered mail" name="amail"></input><br><br>
<input type="password" name="apassword" placeholder="Password" ></input><br><br>
<input type="reset" class=button></input>&emsp;&emsp;<input type="submit" name="submit" value="Submit" class=button></input><br><br>

<sub><a href="resetPassword.php">Forgot password?</a></sub>

</form>
</div>

</body>
</html>

