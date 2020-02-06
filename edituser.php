<?php 
include 'views.php';
include 'updatesessions.php';
incrementViews("edituser");
$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";

	$connect=mysqli_connect($host,$username,$password,$db_name);
	session_start(); 
if(!isset($_SESSION["edituser"]))
		{
			$sql = "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'edituser' ";
			$table = mysqli_query($connect, $sql);		
			
			echo $sql;
			$_SESSION["edituser"] = 1;
		}
	error_reporting(0);
?>
<html>
<title>Edit user</title>
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

print_r($_SESSION['editid']);
	$query = "SELECT * FROM userinfo WHERE ID = ".$_SESSION["editid"];
	//print_r($query);

	$result = mysqli_query($connect, $query);
	$table = mysqli_fetch_array($result);
	echo "

<form method='post' action='edituser.php'>
<center>
<div class=frm align=center>
<br><br><br>
<h1 style='color:#392613; text-shadow: 0px 0px 20px #bf8040;'>
Edit user</h1>
<br>
<p style='display: inline-flex; background-color:rgb(236, 217, 198); font-style:italic; color:#986F44;'>
Please check the following details
</p><br><br>


<strong><input style='width:190px;' class=box type=text value='".$table[1]."' name='finame' required></input>
&emsp;
<input style='width:180px;' class=box type=text name='laname' value='".$table[2]."' required></input>

<br><br>

<input class=box type=text name='loadd' value='".$table[4]."' required></input>

<br><br>

<input class=box type=text name='ltadd' value='".$table[5]."' required></input>

<br><br>

<input class=box type=text name='nationality' value='".$table[6]."' required></input>

<br><br>

<input class=box type=text name='phone' value='".$table[7]."' pattern='{1000000000,9999999999}' required></input>

<br><br>

<input class=box type='email' value='".$table[8]."' name='mail' required></input>
<br><br>
<strong><p style='color:#392613; width:190px; text-shadow: 0px 0px 20px #bf8040;'> Role :  </p>&emsp;
<select style='width:180px;' name ='userrole'>
<option value='1'> Administrator </option>
<option value = '2'> User </option>
</select>

<br> <br>
<input type='submit' class=button value='Save' name='save'>

<br><br><br>

</div>
<br><br><br>
</form>";
	
?>
<?php

if(isset($_POST['save']))
{
	$id = $_SESSION['editid'];
	$finame = $_POST['finame'];
	$laname = $_POST['laname'];
	$loadd = $_POST['loadd'];
	$ltadd = $_POST['ltadd'];
	$nationality = $_POST['nationality'];
	$phone = $_POST['phone'];
	$mail = $_POST['mail'];
	$role = $_POST['userrole'];
	$updateuser = "UPDATE `userinfo` SET finame ='".$finame."',`laname`='".$laname."',`loadd`='".$loadd."',`ltadd`='".$ltadd."',`nationality`='".$nationality."',`phone`='".$phone."',`mail`='".$mail."', idrole = '".$role."'  WHERE id = ".$id;
	//print_r($updateuser);
	$res = mysqli_query($connect, $updateuser);
	if(!empty($res)) 
		{
			echo "<div style='text-align:center;
						margin:auto;
						position:relative;
						top:11vh;
						box-shadow:0px 0px 5px black;
						border-radius:6px;
						text-shadow:0px 0px 4px black;
						width:50vw;
						background-color:rgba(0,0,0,.7);'>
						<br>
					 The user was successfully updated
						<br><br></div>";
						
		}
		else 
		{
			echo "<div style='text-align:center;
						margin:auto;
						position:relative;
						top:11vh;
						box-shadow:0px 0px 5px black;
						border-radius:6px;
						text-shadow:0px 0px 4px black;
						width:50vw;
						background-color:rgba(0,0,0,.7);'>
						<br>
					 There was a problem while updating the user. Please contact our support team.
						<br><br></div>";
		}
}

?>



</body>
</html>