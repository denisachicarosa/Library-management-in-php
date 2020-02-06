<?php

function incrSession(){
	$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";

	$connect=mysqli_connect($host,$username,$password,$db_name);
echo "UPDATE sessions ";
if(isset($_SESSION["p1"]))
		{
			$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'home' ");		
		}


if(isset($_SESSION["userprof1"]))
		{
			$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'userprofile' ");		
		}
if(isset($_SESSION["return"]))
		{
			$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'return' ");		

		}
if(isset($_SESSION["signin"]))
		{
			$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'signin' ");		

		}
if(isset($_SESSION["signup"]))
		{
			$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'signup' ");		

		}

if(isset($_SESSION["rent"]))
		{
			$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'rent' ");		

		}

if(isset($_SESSION["contact"]))
		{
			$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'contact' ");		

		}
if(isset($_SESSION["admin"]))
		{
			$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'admin' ");		

		}
if(isset($_SESSION["managebooks"]))
		{
			$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'managebooks' ");		

		}
if(isset($_SESSION["manageusers"]))
		{
			$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'manageusers' ");		

		}		
if(isset($_SESSION["statistics"]))
{
	$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'statistics' ");		

}

if(isset($_SESSION["bookdetails"]))
{
	$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'bookdetails' ");		

}
		
		
		
if(isset($_SESSION["edituser"]))
{
	$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'edituser' ");		

}
		
				
		
if(isset($_SESSION["loanbook"]))
{
	$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'loanbook' ");		

}

if(isset($_SESSION["loanfile"]))
{
	$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'loanfile' ");		

}
		
if(isset($_SESSION["resetpassword"]))
{
	$table = mysqli_query($connect, "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'resetpassword' ");		

}
}	
?>