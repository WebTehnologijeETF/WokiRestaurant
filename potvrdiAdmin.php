<?php

function generateRandomString($length = 7) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function test_input($data) 
	{
	   $data = trim($data);
	   $data = stripslashes(strip_tags($data));
	   $data = htmlspecialchars($data);
	   return $data;
	}
			 include('header.html');
				print '<div id="tijelo">';	
			 $veza = new PDO("mysql:dbname=novosti;host=localhost;charset=utf8", "wtuser", "wtpass");
			 $veza->exec("set names utf8");
				if(!empty($_REQUEST['user']))
			{
				$user=test_input($_REQUEST['user']);
				//$user="admin";
				$upit = $veza->prepare("SELECT username, email FROM korisnici WHERE username=?");
				$upit->execute(array($user));
				$email=$upit->fetch();
				$email=$email['email'];
				$body=generateRandomString();
				if($email!="")
				{
					$upit = $veza->prepare("UPDATE korisnici SET password='".$body."' WHERE username=?");
					$upit->execute(array($user));
					print "<form action='potvrdiAdmin.php' method='post' >
					<table class='admin'>
					<tr><td></td><td><a href='mailto:".$email."?body=".$body."'>Potvrdi slanje</a></td></tr>
					</table></form>";
				}
				else echo "<h3>Nepostojeci korisnik!</h3>";
			}
			else
			{
				
				 print "<form action='potvrdiAdmin.php' method='post' >
				  <table class='admin'>
				 <tr><td>Username:</td><td><input type='text' size='25' name='user'></td></tr>
				 <tr><td></td><td><input type='submit' name='buttonOstaviKom' value='Posalji novu sifru na mail'/></td></tr>
				 </table></form>";
			}
			print '</div>';
				include('footer.html');
?>