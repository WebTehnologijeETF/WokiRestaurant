<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{	
	$check1=false;
	$check2=false;
	
	if (empty($_POST["autorKom"]))
		  {
			$message = "Niste unijeli sve podatke";
			echo "<script type='text/javascript'>alert('$message');</script>";
		  }
	else $check1=true;
	
	else if (empty($_POST["tekstKom"]))
		  {
			$message = "Niste unijeli sve podatke";
			echo "<script type='text/javascript'>alert('$message');</script>";
		  }
	else $check2=true;
	
	if($check1==false || $check2==false)
	{
		session_start();
		$check=true;
		$_SESSION['provjera'] = $check;
	}
}
?>