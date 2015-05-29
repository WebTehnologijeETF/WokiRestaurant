<?php
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
				if(isset($_REQUEST['naziv']) && isset($_REQUEST['autor']) && isset($_REQUEST['opis']) ) 
				{
					$opsirnije="";
					$slika="";
					$naziv=test_input($_REQUEST['naziv']);
					$autor=test_input($_REQUEST['autor']);
					$opis=test_input($_REQUEST['opis']);
					if(isset($_REQUEST['opsirnije']))
						$opsirnije=test_input($_REQUEST['opsirnije']);
					if(isset($_REQUEST['slika']))
						$opsirnije=test_input($_REQUEST['slika']);
					
					$dodaj= $veza->query("INSERT INTO vijest SET id='', naziv='".$naziv."', datum=NOW(),autor='".$autor."',slika='".$slika."', opis='".$opis."', opsirnije='".$opsirnije."'");
					echo "<h3>Uspješno ste dodali vijest!</h3>";
				}
				else 
				{
				  print "<form action='dodajVijest.php' method='post' >
				  <table class='admin'>
				 <tr><td>Naziv:</td><td><input type='text' size='30' name='naziv' required></td></tr>
				 <tr><td>Autor:</td><td><input type='text' size='30' name='autor' required></td></tr>
				 <tr><td>Slika:</td><td><input type='text' size='30' name='slika'></td></tr>
				 <tr><td>Opis:</td><td><textarea size='30' name='opis' rows='7' cols='33' required></textarea></td></tr>
				 <tr><td>Opsirnije:</td><td><textarea size='30' name='opsirnije' rows='10' cols='33'></textarea></td></tr>
				 <tr><td></td><td><input type='submit' name='buttonOstaviKom' value='Dodaj vijest'/></td></tr>
				 </table></form>";
				}
				 print '</div>';
				include('footer.html');
?>