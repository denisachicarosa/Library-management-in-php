<?php
session_start();

$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";
	
	
$connect=mysqli_connect($host,$username,$password,$db_name);
$mail = $_SESSION["mail"];
$sql="DELETE FROM userinfo WHERE mail = ".$_SESSION["email"];
if(mysqli_query($connect, $sql))
{
	
	//mysqli_close($connect);
	//$connect=mysqli_connect($host,$username,$password,$db_name);
	$user1="DROP TABLE $mail "//-------DROP USER SPECIFIC TABLE
	if(!mysqli_query($connect,$user1))
	{
		echo "<script type='text/javascript'> alert('User profile creation failed'); </script>";}
	
	//*********************************************************
	else  {
		echo "<script type='text/javascript'> alert('We have some issues *tears*'); </script>";
	}
}
?>