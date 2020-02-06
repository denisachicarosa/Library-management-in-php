<?php

$addhr = time() + (1 * 13 * 60 * 60);
$curDateTimeMil= date("Y-m-d G:i:s",$addhr);
//echo $curDateTimeMil; 

$dateInTwoWeeks =date("d.m.Y", strtotime('+2 weeks'));
echo $dateInTwoWeeks;
?>
