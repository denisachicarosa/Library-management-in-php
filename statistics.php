<?php
include 'views.php';
include 'updatesessions.php';
incrementViews("statistics");
session_start();
$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";

	$connect=mysqli_connect($host,$username,$password,$db_name);
if(!isset($_SESSION["statistics"]))
		{
			$sql = "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'statistics' ";
			$table = mysqli_query($connect, $sql);		
			
			echo $sql;
			$_SESSION["statistics"] = 1;
		}
if(is_null($_SESSION['mail']))
	{
		//echo "<script>alert('Please Sign In first');</script>";
		header('refresh:0 URL=signin.php');
	}
?>
<html>
<title>Contact > Library</title>

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
	
	$query = 'SELECT
	b.serial as serial,
    b.author as author,
    b.title as title,
    r.iduser as iduser,
    r.rentalDate as rentalDate,
 	r.status as status
 FROM rentals r
 JOIN bookinfo b 
 ON b.serial = r.idbook
 WHERE r.status = "pending"
  ';

if(isset($_POST['submit']))
{
	
	print_r("After submit");
  $connect=mysqli_connect('localhost','root','lab223','library');
  $result = mysqli_query($connect, $query);
  while($tableRow = mysqli_fetch_array($result))
  {
	  $serial = $tableRow[0];
	  $actualStatus = $tableRow[5];
	  $changedStaus = $_POST[$serial];
	  
	  if($actualStatus != $changedStaus)
	  {
		$updateQuery = "UPDATE rentals SET status = '".$changedStaus."'WHERE rentals.idbook =".$serial;
		$res = mysqli_query($connect, $updateQuery);
		
		print_r($updateQuery);
		
		
		if($changedStaus == "returned")
		{
			$bookAv = "UPDATE bookinfo SET availability = 1 WHERE serial = ".$serial;
			$res = mysqli_query($connect, $bookAv);
			print_r($bookAv);
		}
		
	  }  
	  
  }
 // header('refresh:0 URL=book.php');
  
}

	
	?>
	
	
	
	
<!-- ---------------------------------------------------------------------------------- Set pending files -->


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
<h3>Hello <?php echo $_SESSION['finame']; ?> !</h3><br>Here are all the pages that can be accessed in this project and the number of views for each one.
</div>

<?php 


	$query = 'SELECt * FROM views';
  $connect=mysqli_connect('localhost','root','lab223','library');
  $result = mysqli_query($connect, $query);
  $colName = mysqli_query($connect,"SHOW COLUMNS FROM views");

  $numOfRows = mysqli_num_rows($result);
  $numOfFields = mysqli_num_fields($result);


	echo "<center><form action='admin.php' method=post><div class=table><table>";
	echo "<tr>";

while($colNameArr = mysqli_fetch_array($colName))
{
	echo "<th>".strtoupper($colNameArr[0])."</th>";
}
while($tableRow = mysqli_fetch_array($result))
{
	$title = $tableRow[2];
	$_SESSION['title'] = $title;
	echo "<tr>";
	for($i=0;$i<$numOfFields;$i++)
	{			
			echo "<td>".$tableRow[$i]."</td>";	
	}
	
	echo "</tr>";
}

echo "</table>";
echo "<br><br></div><br><br><br>";
echo "<br><br><br>";
echo "<br><br><br><br><br><br><br>";



?>

</body>

</html>