<?php
include 'views.php';
include 'updatesessions.php';
incrementViews("managebooks");
session_start();
$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";

	$connect=mysqli_connect($host,$username,$password,$db_name);
if(!isset($_SESSION["managebooks"]))
		{
			$sql = "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'managebooks' ";
			$table = mysqli_query($connect, $sql);		
			
			echo $sql;
			$_SESSION["managebooks"] = 1;
		}
if(is_null($_SESSION['mail']))
	{
		//echo "<script>alert('Please Sign In first');</script>";
		header('refresh:0 URL=signin.php');
	}
?>
<html>
<title>Manage books > Library</title>

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
		<a href="http://localhost/project1/admin.php"><img src = "http://localhost/project1/admin.png" style="position:relative; left:110px; top:7px; align:center; width:40px; height:40px"></a>
		<a href="http://localhost/project1/managebooks.php"><img src = "http://localhost/project1/managebooks.png" style="position:relative; left:130px; top:7px; align:center; width:40px; height:40px"></a>
		<a href="http://localhost/project1/manageusers.php"><img src = "http://localhost/project1/manageusers.png" style="position:relative; left:150px; top:7px; align:center; width:40px; height:40px"></a>
		<a href='http://localhost/project1/statistics.php'><img src = 'http://localhost/project1/statistics.png' style='position:relative; left:170px; top:7px; align:center; width:40px; height:40px'></a>



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
	
	
	
<!-- ---------------------------------------------------------------------------------- Print all books -->




<?php 
$host="localhost";
$username="root";
$password="lab223";
$db_name="library";

$connect=mysqli_connect($host,$username,$password,$db_name);

$table = mysqli_query($connect,"SELECT * FROM bookinfo");
$numOfRows = mysqli_num_rows($table);
$numOfFields = mysqli_num_fields($table);
$colName = mysqli_query($connect,"SHOW COLUMNS FROM bookinfo");

echo "<br><br><br><br><br>";
echo "<div style='text-align:center;
					margin:auto;
					position:relative;
					top:7vh;
					box-shadow:0px 0px 5px black;
					border-radius:6px;
					text-shadow:0px 0px 4px black;
					width:30vw;
					background-color:rgba(0,0,0,.7);'>
					<br>
			These are the Books in our library
					<br><br></div>";

//-------------------------------------------------------------PRINTING TABLE

echo "<center><div class=table><table>";
	echo "<tr>";

while($colNameArr = mysqli_fetch_array($colName))
{
	echo "<th>".strtoupper($colNameArr[0])."</th>";
}
	echo "</tr>";
while($tableRow = mysqli_fetch_array($table))
{
	$title = $tableRow[2];
	$_SESSION['title'] = $title;
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
echo "</table> </div></center>";
echo "<br><br><br><br><br><br><br>";

?>

<!-------------------------------------------------------------------------------------- Add book -->

<?php
	if(isset($_POST['add']))
	{
		$title = $_POST['title'];
		$author = $_POST['author'];
		$availability = "1";
		$query = "INSERT INTO bookinfo(title, author, availability) VALUES ('".$title."','".$author."','".$availability."')";
		$res = mysqli_query($connect, $query);
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
					 The book was successfully added
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
					 There was a problem while adding the book. Please contact our support team.
						<br><br></div>";
						
		}
	}
	
	if(isset($_POST['removeSerial']))
	{
		$serial = $_POST['rmv'];
		$query = "DELETE FROM bookinfo WHERE serial = ".$serial;
		
		$res = mysqli_query($connect, $query);
		if(!empty($res)) 
		{
			$rmWish = "DELETE FROM userwishlist WHERE idbook = ".$serial;
			$r1 = mysqli_query($connect, $rmWish);
			$rmRent = "DELETE FROM rentals WHERE idbook = ".$serial;
			$r2 = mysqli_query($connect, $rmRent);
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
					 The book was successfully removed
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
					 There was a problem while removing the book. Please contact our support team.
						<br><br></div>";
		}
		
	}
	


?>

</body>


<div class=frm style="position:fixed; top:25vh; left:10px; padding:20px; width:300px; " >
<form method=post action="managebooks.php">
<center>
You can add books<br><br>
<input style="width:205px;" type=text name=title placeholder="Fill in Book Title"><br><br>
<input style="width:205px;" type=text name=author placeholder="Fill in Book Author"><br><br>
<input class=button type=submit name=add value="Add Book"><br><br>
Or you can remove them<br><br>
<input style="width:250px;" type=text name=rmv placeholder="Serial Number to remove"><br><br>
<input class=button type=submit name=removeSerial value="Remove Book">
</center>
</form>
</div>

</html>