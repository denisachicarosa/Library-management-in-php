<?php
	include 'views.php';
	include 'updatesessions.php';
	incrementViews("userprofile");
	session_start();
	$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";

	$connect=mysqli_connect($host,$username,$password,$db_name);
	if(!isset($_SESSION["userprofile"]))
		{
			$sql = "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'userprofile' ";
			$table = mysqli_query($connect, $sql);		
			
			echo $sql;
			$_SESSION["userprofile"] = 1;
		}
	if(is_null($_SESSION['mail']))
	{
		//echo "<script>alert('Please Sign In first');</script>";
		header('refresh:0 URL=signin.php');
	}
	
	include 'sessions.php';
	

?>
<html>
<title>Welcome!</title>
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

	echo $_SESSION["userid"];
	$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";

	$connect=mysqli_connect($host,$username,$password,$db_name);

	$_SESSION['mail'] = $_SESSION['mail'];

?>


<div class=welcome style="text-align:center;
					padding:5px;
					margin:auto;
					position:relative;
					top:11vh;
					box-shadow:0px 0px 5px black;
					border-radius:6px;
					text-shadow:0px 0px 4px black;
					width:40vw;
					background-color:rgba(0,0,0,.7);">
<h3>Hello <?php echo $_SESSION['finame']; ?> !</h3><br>Here are the books You added to your wishlist
</div>


<?php

	$userid = $_SESSION['userid'];

	//$table = mysqli_query($connect,"SELECT * FROM userwishlist WHERE iduser = $userid");
	$table = mysqli_query($connect, "SELECT * FROM bookinfo WHERE serial IN (SELECT idbook FROM userwishlist WHERE iduser = $userid)");

	$numOfRows = mysqli_num_rows($table);
	$numOfFields = mysqli_num_fields($table);
	$colName = mysqli_query($connect,"SHOW COLUMNS FROM bookinfo");


//--------------------------------------------------------------------------------  PRINTING USER SPECIFIC TABLE
echo "<center><div class=table><table>";
	echo "<tr>";

while($colNameArr = mysqli_fetch_array($colName))
{
	echo "<th>".strtoupper($colNameArr[0])."</th>";
}
	echo "</tr>";
if(!empty($table)) {
while($tableRow = mysqli_fetch_array($table))
{
	
	
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
}
echo "</table></div></center>";
echo "<br><br><br><br><br><br><br>";


//--------------------------------------------------------------PRINTING RENTED BOOKS

$query ='SELECT r.ID "CARD INDEX",
			b.serial "BOOK SERIAL",
			b.author "AUTHOR",
			b.title "TITLE",
			b.availability "AVAILABILITY",
			r.rentalDate "RENTALDATE",
			r.returnDate "RETURNDATE",
			r.status "STATUS"
		FROM rentals r
		JOIN bookinfo b
		ON r.idbook = b.serial
		WHERE r.iduser = '.$userid;
		
$table = mysqli_query($connect,$query);
$numOfRows = mysqli_num_rows($table);
$numOfFields = mysqli_num_fields($table);
//$colName = mysqli_query($connect,'SHOW COLUMNS FROM ');


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
			These are the Books you rented so far
					<br><br></div>";

//--------------------------------------------------------------PRINTING TABLE

echo "<center><div class=table><table>";
	echo "<tr>";


	echo "<th>CARD INDEX</th>";
    echo "<th>BOOK SERIAL</th>";
	echo "<th>AUTHOR</th>";
	echo "<th>TITLE</th>";
	echo "<th>AVAILABILITY</th>";
	echo "<th>RENTALDATE</th>";
	echo "<th>RETURNDATE</th>";
	echo "<th>STATUS</th>";
	echo "</tr>";
while($tableRow = mysqli_fetch_array($table))
{
	$title = $tableRow[2];
	$_SESSION['title'] = $title;
	echo "<tr>";
	for($i=0;$i<$numOfFields;$i++)
	{	
		if ($i == 4 )
		{
			if($tableRow[$i] == 0)
			{
				echo "<td> Not available </td>";
			}
			else 
			{
				echo "<td> Available </td>";

			}	
		}
		else
		{
			echo "<td>".$tableRow[$i]."</td>";
		}
	}
	
	echo "</tr>";
}
echo "</table> </div></center>";
echo "<br><br><br><br><br><br><br>";


//--------------------------------------------------------------PRINTING BOOKINFO TABLE FOR USER'S CONVENIENCE
$table = mysqli_query($connect,"SELECT * FROM bookinfo");
$numOfRows = mysqli_num_rows($table);
$numOfFields = mysqli_num_fields($table);
$colName = mysqli_query($connect,"SHOW COLUMNS FROM bookinfo");


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
			These are the Books in our library<br>You can put them in your wishlist
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


//--------------------------------------------------------------------------ADDING BOOK TO WISHLIST

if(isset($_POST['srl']))
	{$ser = $_POST['srl'];}
if (isset($_POST['submitSerial']))
{
	$book=mysqli_query($connect,"SELECT * FROM bookinfo WHERE serial='$ser'");
	$book=mysqli_fetch_array($book);
	if(is_null($book[0]))
	{
		echo "<script> alert('Book unavailable in Library'); </script>";
	}
	else
	{
		$id = $_SESSION["userid"];
		if(mysqli_query($connect,"INSERT INTO userwishlist VALUES('$id','$book[0]')"))
		{
			echo "<script> alert('Added to Wishlist'); </script>";
			header('refresh:0 URL=userProf.php');
		}
		else echo "<script> alert('Already present in the Wishlist'); </script>";
	}		
}
elseif(isset($_POST['removeSerial']))
{
	$rmvSrl=$_POST['rmv'];
	$iduser = $_SESSION['userid'];
	$remove=mysqli_query($connect,"DELETE FROM userwishlist WHERE idbook ='$rmvSrl' AND iduser = '$iduser' ");
	if($remove)
	{
		echo "<script> alert('Book is removed from your Wishlist'); </script>";
		header('refresh:0 URL=userProf.php');
	}
	else echo "<script> alert('Book is not present in your Wishlist'); </script>";
}
elseif(isset($_POST['submitBookName']))
{
	$title = $_POST['findName'];
	$_SESSION['title'] = $title;
	header('refresh:0 URL=book.php');
}


?>


<div class=frm style="position:fixed; top:25vh; left:10px; padding:20px; width:300px; " >
<form  method=post action="book.php">
<center>
Search book by title<br><br>
<input style="width:205px;" type=text name=findName placeholder="Fill in Book Title"><br><br>
<input class=button type=submit name=submitBookName value="Find Book"><br><br>
</center>
</form>
<form method=post action="userProf.php">
<center>
You can add books to your Wishlist<br><br>
<input style="width:205px;" type=text name=srl placeholder="Fill in Serial Number"><br><br>
<input class=button type=submit name=submitSerial value="Add to Wishlist"><br><br>
Or you can remove them<br><br>
<input style="width:250px;" type=text name=rmv placeholder="Serial Number to remove"><br><br>
<input class=button type=submit name=removeSerial value="Remove from Wishlist">
</center>
</form>
</div>
</body>
</html>
