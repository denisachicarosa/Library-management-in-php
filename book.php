<?php
include 'views.php';
include 'updatesessions.php';
$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";

	$connect=mysqli_connect($host,$username,$password,$db_name);
incrementViews("bookdetails");
session_start();
if(!isset($_SESSION["bookdetails"]))
		{
			$sql = "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'bookdetails' ";
			$table = mysqli_query($connect, $sql);		
			
			echo $sql;
			$_SESSION["bookdetails"] = 1;
		}
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
	?>
	
	<?php
	
	
	echo "<h1> ".$_POST['findName']."</h1>";
	$title = str_replace(" ","_",$_POST['findName']);
	echo "<br><br><br><br><br>";
	
	
	$page = 'https://en.wikipedia.org/wiki/'.$title;
	
	$homepage = file_get_contents($page);
	//print_r();
	//echo $homepage;
	$vector = explode('style="width:22', $homepage);
	//print_r($vector[1]);
	//$vector = explode('</h2>', $homepage);
	$content = explode ('<ul>', $vector[1]);
	$plot = explode('<p',$content[0]);
	//echo str_replace("’", "'",$content[1]);
	//echo $content."</p>";
	$toDelete = $plot[0];
	//echo $toDelete;
	$text = $content[0];
	$text = str_replace($toDelete," ",$text);
	$final = explode('<h2>',$text);
	
	$style = '<div class=welcome style="text-align:center;
					padding:5px;
					margin:auto;
					position:relative;
					top:11vh;
					box-shadow:0px 0px 5px black;
					border-radius:6px;
					text-shadow:0px 0px 4px black;
					width:40vw;
					background-color:rgba(0,0,0,.7);">';
					
	$fin = $style.$final[0].'</div>';
	//echo $final[0];
	
	echo $fin;
	?>
</body>
</html>