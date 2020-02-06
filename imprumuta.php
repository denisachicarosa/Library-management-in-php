  
<?php
include 'views.php';
include 'updatesessions.php';
incrementViews("loanbook");
session_start();
$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";

	$connect=mysqli_connect($host,$username,$password,$db_name);
if(!isset($_SESSION["loanbook"]))
		{
			$sql = "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'loanbook' ";
			$table = mysqli_query($connect, $sql);		
			
			echo $sql;
			$_SESSION["loanbook"] = 1;
		}
error_reporting(0);

if(is_null($_SESSION['mail']))
{
	//echo "<script>alert('Please Sign In first');</script>";
	header('refresh:0 URL=signin.php');
}


?>
<html>

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
//---------------------------------------------------------------------------------------- SEARCH BOOK BY TITLE		
		?>
				

<div class=frm style="position:fixed; top:25vh; left:10px; padding:20px; width:300px; " >
<form  method=post action="imprumuta.php">
<center>
Search book by title<br><br>
<input style="width:205px;" type=text name=findName placeholder="Fill in Book Title"><br><br>
<input class=button type=submit name=submitBookName value="Find Book"><br><br>
</center>
</form>
</div>


<?php

	$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";
	$userid = $_SESSION["userid"] ;
	$_SESSION["userid"]=$userid;
$connect= mysqli_connect($host,$username,$password,$db_name);
if(!$connect)
{
	echo "<script type='text/javascript'>alert(' Can't connect to the Database ');	</script>";
}

if(!isset($_POST['submitBookName']))
{
	$table = mysqli_query($connect,"SELECT * FROM bookinfo");
	$numOfRows = mysqli_num_rows($table);
	$numOfFields = mysqli_num_fields($table);
	$colName = mysqli_query($connect,"SHOW COLUMNS FROM bookinfo");


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
			We have the following Books in our library
						<br><br></div>";

	//--------------------------------------------------------------------------------  PRINTING TABLE
	echo "<center><form action='bookinfo.php' method=post><div class=table><table>";
		echo "<tr>";

	while($colNameArr = mysqli_fetch_array($colName))
	{
		echo "<th>".strtoupper($colNameArr[0])."</th>";
	}
		echo "</tr>";
	while($tableRow = mysqli_fetch_array($table))
	{
		echo "<tr>";
		
		for($i=0;$i<$numOfFields-1;$i++)
		{
			echo "<td>".$tableRow[$i]."</td>";
		}
		if($tableRow[$numOfFields-1] == 0)
		{
			echo "<td> Not available </td>";
		}
		else 
		{
			echo "<td> Available </td>";

		}

		echo "</tr>";
	}
	echo "</table></div></form></center>";
	echo "<br><br><br><br><br><br><br>";
}
else
{
	$name = $_POST['findName'];
	$name = strtolower($name);
	
	$query = "SELECT * FROM bookinfo WHERE LOWER(title) LIKE '%".$name."%'";
	$table = mysqli_query($connect, $query);
	
	$numOfRows = mysqli_num_rows($table);
	console.print($numOfRows);
	$numOfFields = mysqli_num_fields($table);
	$colName = mysqli_query($connect,"SHOW COLUMNS FROM bookinfo");
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
			Search results:
						<br><br></div>";
	echo "<center><form action='imprumuta.php' method=post><div class=table><table>";
	echo "<tr>";

	echo "<th> SELECT </th>";
	while($colNameArr = mysqli_fetch_array($colName))
	{
		echo "<th>".strtoupper($colNameArr[0])."</th>";
	}
		echo "</tr>";
	while($tableRow = mysqli_fetch_array($table))
	{
		echo "<tr>";
		echo "<td><input type='radio' name = 'radios' value = '".$tableRow[0]."'</td>";
		for($i=0;$i<$numOfFields-1;$i++)
		{
			echo "<td>".$tableRow[$i]."</td>";	
			//echo '<input type="radio" name="radios" id="'.$tableRow[0].'" />';
			//echo '<label for="'.$tableRow[0].'"><td>'.$tableRow[$i].'</td></label>';
		}

		if($tableRow[$numOfFields-1] == 0)
		{
			echo "<td> Not available </td>";
		}
		else 
		{
			echo "<td> Available </td>";

		}
		echo "</tr>";
	}
	echo "</table>";
	echo "<br><br></div><br><br><br>";
	
	echo "<br><br><br>";
	echo "<input class=button type=submit name=rentBook value='Rent selected book'></form></center>";

	echo "<br><br><br><br><br><br><br>";
}

if(isset($_POST['rentBook']))
{
	$bookSerial = $_POST["radios"];
	$query = "SELECT availability FROM bookinfo WHERE serial =".$bookSerial;
	console.print($query);
	$result = mysqli_query($connect, $query);
	$response = mysqli_fetch_array($result);
	if ($response[0] == 0)
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
					The book is not available. You can add it to your wishlist.
						<br><br></div>";
						}
	else
	{
		$_SESSION['serial'] = $bookSerial;
		header('refresh:0 URL=rent.php');
	}
	
}

?>


</body>
</html>


