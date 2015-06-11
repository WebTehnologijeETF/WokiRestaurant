<?php

session_start();
//session_destroy();
//session_start();
if (isset($_SESSION['username']))
	 {
		 print 
			"
			<div id='tijelo'>
				<div id='logout'><a href='odjava.php'> Odjavi se</a></div>
			</div>";
	 }
else print
	"<div id='tijelo'>

	<form action='admin.php' method='post' >
				  <table class='admin'>
				 <tr><td>Korisničko ime: </td><td><input type='text' size='25' name='username'></td></tr>
				 <tr><td>Šifra:</td><td><input type='password' size='25' name='password'></td></tr>
				 
				 <tr><td></td><td><a href='potvrdiAdmin.php'>Zaboravili ste šifru?(Posalji novu sifru na mail)</a></td></tr>
				 <tr><td></td><td><input type='submit' name='buttonOstaviKom' value='Prijava'/></td></tr>
				 </table>
	</form>
	</div>";
?>