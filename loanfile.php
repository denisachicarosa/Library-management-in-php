<?php
include 'views.php';
incrementViews("loanfile");
session_start();
	$_SESSION["loanfile"] = 1;

ob_start();
require('./fpdf/fpdf.php');

$iduser = $_SESSION['userid'];
$idbook = $_SESSION['serial'];
$rentalDate =date ("d.m.Y", strtotime("today"));
$returndate = date("d.m.Y", strtotime("+2 Weeks"));
$status = "rented";
$returnAddress = "Splaiul Independentei nr. 58";

$query = "INSERT INTO rentals(iduser, idbook, rentalDate, returnDate,status) VALUES ($iduser, $idbook,STR_TO_DATE('$rentalDate','%d.%m.%Y'),STR_TO_DATE('$returndate','%d.%m.%Y'),'$status')";
//echo $query;
$host="localhost";
$username="root";
$password="lab223";
$db_name="library";

$connect=mysqli_connect($host,$username,$password,$db_name);
$result = mysqli_query($connect,$query);

$query = "UPDATE bookinfo SET availability = '0' WHERE serial = $idbook ";
$result = mysqli_query($connect,$query);

$result = mysqli_query($connect,"SELECT * FROM bookinfo WHERE serial = $idbook");
$bookdetails = mysqli_fetch_array($result);

$getindex = "SELECT ID FROM rentals WHERE iduser = $iduser AND idbook = $idbook AND rentalDate = STR_TO_DATE('$rentalDate','%d.%m.%Y') AND status = '$status'";

//echo $getindex; 
$res = mysqli_query($connect, $getindex);
$indexarr = mysqli_fetch_array($res);
$index = $indexarr[0];


$pdf = new FPDF();
$pdf->AddPage('A4'); 
$pdf->SetFont('Arial','',10);

$pdf->SetMargins(0,0,0);
$pdf->SetXY(0,0);


$lat= 297;

$pdf->Cell($lat-70, 15, ' ',0,0,'ร',0);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(30, 15, '',0,1,'C',1);

$pdf->Cell($lat-70, 24, ' ',0,0,'C',0);

$x=$pdf->GetX();
$y=$pdf->GetY() ;
$pdf->SetFont('Arial','B',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(60,6,'Customer Service',0,1,'R',0);
$pdf->SetX($x);
$pdf->SetFont('Arial','',8);
$pdf->Cell(60,6,'Telephone: 0728542934',0,1,'R',0);
$pdf->SetX($x);
$pdf->SetFont('Arial','',8);
$pdf->Cell(60,6,'7 AM - 7 PM Mon -Fri',0,1,'R',0);
$pdf->SetX($x);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(60,6,'onlinelibrary.com',0,1,'R',0);

$pdf->SetX(0);
$pdf->SetFillColor(255,222,151);
$pdf->Cell($lat, 4,' ',0,0,'รง',1);
$pdf->Image('logo.png',10,-1,40);

//$index = 1;
$pdf->SetY($y+5);
$pdf->SetX(120);
$pdf->SetFont('Arial','B',25);
$pdf->Cell(60,25,"Loan file #$index",0,1,'C',false);

$pdf->ln(10);
$pdf->SetX(25);
$pdf->SetFont('Arial','',16);

$pdf->SetTextColor(0,0,0);
$pdf->SetX(25);
$pdf->Cell(250,25,"\t\t\t Name:",'LRT',0,'L',false);
$pdf->SetX(124);
$name = " ".$_POST['laname']." ".$_POST['finame'];
$pdf->Cell(250,25,$name,0,0,'L',false);

$pdf->ln(10);
$pdf->SetFont('Arial','',16);

$pdf->SetTextColor(0,0,0);
$pdf->SetX(25);
$pdf->Cell(250,25,"\t\t\t Address:",'LR',0,'L',false);
$pdf->SetX(124);
$add = " ".$_POST["loadd"];
$pdf->Cell(250,25,$add,0,0,'L',false);


$pdf->ln(10);
$pdf->SetFont('Arial','',16);

$pdf->SetX(25);
$pdf->Cell(250,25,"\t\t\t Email:",'LR',0,'L',false);
$pdf->SetX(124);
$mail = " ".$_POST["mail"];
$pdf->Cell(250,25,$mail,0,0,'L',false);


$pdf->ln(10);
$pdf->SetX(25);
$pdf->Cell(250,25,"\t\t\t Phone:",'LR',0,'L',false);
$pdf->SetX(124);
$phone = " ".$_POST["phone"];
$pdf->Cell(250,25,$phone,0,'L',false);

$pdf->ln(10);
$pdf->SetX(25);
$pdf->Cell(250,25,"\t\t\t Book Serial Number:",'LR',0,'L',false);
$pdf->SetX(124);
$ser = " ".$idbook;
$pdf->Cell(250,25,$ser,0,0,'L',false);


$pdf->ln(10);
$pdf->SetX(25);
$pdf->Cell(250,25,"\t\t\t Book Title:",'LR',0,'L',false);
$pdf->SetX(124);
$title = " ".$_POST["title"];
$pdf->Cell(250,25,$title,0,0,'L',false);

$pdf->ln(10);
$pdf->SetX(25);
$pdf->Cell(250,25,"\t\t\t Book Author:",'LR',0,'L',false);
$pdf->SetX(124);
$aut = " ".$_POST['author'];
$pdf->Cell(250,25,$aut,0,0,'L',false);

$pdf->ln(10);
$pdf->SetX(25);
$pdf->Cell(250,25,"\t\t\t Rental date:",'LR',0,'L',false);
$pdf->SetX(124);
$redate = " ".$rentalDate;
$pdf->Cell(250,25,$redate,0,0,'L',false);


$pdf->ln(10);
$pdf->SetX(25);
$pdf->Cell(250,25,"\t\t\t Return date:",'LR',0,'L',false);
$pdf->SetX(124);
$rdate = " ".$returndate;
$pdf->Cell(250,25,$rdate,0,0,'L',false);


$pdf->ln(10);
$pdf->SetX(25);
$pdf->Cell(250,25,"\t\t\t Return address:",'LRB',0,'L',false);
$pdf->SetX(124);
$radd = " ".$returnAddress;
$pdf->Cell(250,25,$radd,0,0,'L',false);


$pdf->Output();
ob_end_flush(); 
?> 