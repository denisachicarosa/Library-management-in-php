<?php

function incrementViews($pagename){


	$host1="localhost";
	$username1="root";
	$password1="lab223";
	$db_name1="library";

	$connect1=mysqli_connect($host1,$username1,$password1,$db_name1);
	
	
	$number =mysqli_fetch_array( mysqli_query($connect1, "SELECT number FROM views WHERE pagename = '".$pagename."'"));
	
	$nr = $number[0] + 1;
	//print_r($nr);
	$insert = mysqli_query($connect1, "UPDATE `views` SET `number`= ".$nr." WHERE pagename =  '".$pagename."'");

}
?>