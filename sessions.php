<?php

if(isset($_SESSION["bookinfo1"]))
		{
			echo "sesiune bookinfo1: ".$_SESSION["bookinfo1"];
		}
else 
{
	echo "sesiune bookinfo1: 0";
}

if(isset($_SESSION["p1"]))
		{
			echo "sesiune p1: ".$_SESSION["p1"];
		}
else 
{
	echo "sesiune p1: 0";
}


if(isset($_SESSION["userprof1"]))
		{
			echo "sesiune userprof1: ".$_SESSION["userprof1"];
		}
else 
{
	echo "sesiune userprof1: 0";
}


?>