<?php

$imeErr =$prezimeErr = $emailErr = $telErr = $txtErr ="";
$ime = $prezime = $email =$tel = $tekst = $mjesto = $opcina = $razlogKon = $ocjena = "";
$errorSlika="";
$imeCheck=false;
$prezimeCheck=false;
$emailCheck=false;
$usrtelCheck=true;
$txtCheck=false;

if (isset($_REQUEST['submit']))
{
	if(isset($_POST["mjesto"]))
		$mjesto = test_input($_POST["mjesto"]);
	if(isset($_POST["opcina"]))
		$opcina = test_input($_POST["opcina"]);
	if(isset($_POST["opcija"]))
	{
		$razlogKon = test_input($_POST["opcija"]);
	}
	if(isset($_POST["points"]))
		$ocjena = test_input($_POST["points"]);
	
	if (empty($_POST["ime"]))
		  {
			$imeErr = "Morate unijeti ime!";
			$imeCheck=false;
		  }
	else
		  {
			$ime = test_input($_POST["ime"]);
			if (!preg_match("/^[a-zA-Z ]+$/",$ime))
				{
					$imeErr = "Ime nije validno!";
					$imeCheck=false;
					
				}
			else $imeCheck=true;
		  }
	if (empty($_POST["prezime"]))
		  {
			$prezimeErr = "Morate unijeti prezime!";
			$prezimeCheck=false;
		  }
	else
		  {
			$prezime = test_input($_POST["prezime"]);
			if (!preg_match("/^[a-zA-Z ]+$/",$prezime))
				{
					$prezimeErr = "Prezime nije validno!";
					$prezimeCheck=false;
				}
			else $prezimeCheck=true;
		  }		
	if (!empty($_POST["email"]))
	{
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				$emailErr = "Mail format: nekoime@nesto.com"; 
				$emailCheck=false;
			}
		else $emailCheck=true;
	}
	else
	{
		$emailErr="Morate unijeti email!";
	}
	if (!empty($_POST["usrtel"]))	
	{	$tel = test_input($_POST["usrtel"]);
		if (!preg_match("/^\(?(\d{3})\)?[-]?(\d{3})[-]?(\d{3})$/",$tel))
		{
			$telErr = "Telefon format: (061)-123-345 ili 061-123-456 ili 061123456<br>"; 
			$usrtelCheck=false;
		}
		else $usrtelCheck=true;
	}
	if (empty($_POST["text"]))
		  {
			$txtErr = "Morate unijeti tekst!";
			$txtCheck=false;
		  }
	else
		  {
			$tekst = test_input($_POST["text"]);
			if (!preg_match("/[\p{L}\p{P}]+/",$tekst))
			{
				$txtErr = "Tekst nije validan!"; 
				$txtCheck=false;
			}
			else $txtCheck=true;
		  }
	 
	
	
}
	if($imeCheck==true && $prezimeCheck==true && $emailCheck==true && $usrtelCheck==true && $txtCheck==true)
	{
		session_start();
		$_SESSION['ime'] = $ime;
		$_SESSION['prezime'] = $prezime;
		$_SESSION['mjesto'] = $mjesto;
		$_SESSION['opcina'] = $opcina;
		$_SESSION['email'] = $email;
		$_SESSION['tel'] = $tel;
		$_SESSION['razlog'] = $razlogKon;
		$_SESSION['ocjena'] = $ocjena;
		$_SESSION['tekst'] = $tekst;
		header('Location: successfulForm.php');
		exit();
    }

function test_input($data) {
   $data = trim($data);
   $data = stripslashes(strip_tags($data));
   $data = htmlspecialchars($data);
   return $data;
}
?>