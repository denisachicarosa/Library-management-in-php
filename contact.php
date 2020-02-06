<?php
include 'views.php';
include 'updatesessions.php';
incrementViews("contact");
$host="localhost";
	$username="root";
	$password="lab223";
	$db_name="library";

	$connect=mysqli_connect($host,$username,$password,$db_name);
session_start();
if(!isset($_SESSION["contact"]))
		{
			$sql = "UPDATE views SET sessions = sessions + 1 WHERE pagename = 'contact' ";
			$table = mysqli_query($connect, $sql);		
			
			echo $sql;
			$_SESSION["contact"] = 1;
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
	
	
<!-- ---------------------------------------------------------------------------------- Contact form -->

<?php

if(!empty($_SESSION["returntext"]))
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
					Message sent
						<br><br></div>";
			$_SESSION["returntext"] = "";
		}
		
?>


<form id ="messform" name="messform" method="post" action="phpmailerX2/sendMessage.php">

<br>
<center>
<div class=frm2 align=center>
<br><br><br>
<h1 style="color:#392613; text-shadow: 0px 0px 20px #bf8040;">  ~ CONTACT ~  </h1>
<br>
<div style = "display: inline-flex; text-align: center">
<p style="display: inline-flex;  font-style:italic; color:#392613;">
		Splaiul Independentei nr. 58
</p></div>
<br>
<div style = "display: inline-flex; text-align: center">

<p style="display: inline-flex;  font-style:italic; color:#392613;">
		Sector 6 - Bucuresti	
</p></div><br>
<div style = "display: inline-flex; text-align: center">

<p style="display: inline-flex;  font-style:italic; color:#392613;">
		E-mail: phpfmi2020@gmail.com
</p></div><br>
<div style = "display: inline-flex; text-align: center">

<p style="display: inline-flex;  font-style:italic; color:#392613;">
		Phone number: +40728542934 | 02396691111
</p>
</div>
<br>


<br><br><br>
<strong><input style="width:190px;" class=box type=text placeholder="Name" name="name" required></input>
&emsp;
<input class=box type="email" placeholder="Your Email" name="mail" required></input>

<br><br>
<textarea  class=box style="width:620px; height:200px; border-radius: 7px;
	font-size: 14pt; background-color: rgb(236, 217, 198);"  rows="4" cols="50" name="message" form="messform" placeholder = "Message">
</textarea>

<br><br>

<input type="submit" class=button value="Submit" name="submit">

<br><br><br>

</div>
<br><br><br>
</form>
</body>

</html>