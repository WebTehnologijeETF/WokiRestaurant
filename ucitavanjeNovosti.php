<?php
 
$vijesti = $fajl = $datum = $autor = $naziv = $slika = $opis = $opsirnije = $link = "";

function test_input($data) 
	{
	   $data = trim($data);
	   $data = stripslashes(strip_tags($data));
	   $data = htmlspecialchars($data);
	   return $data;
	}
$veza = new PDO("mysql:dbname=novosti;host=localhost;charset=utf8", "wtuser", "wtpass");
$link = mysqli_connect("localhost", "wtuser", "wtpass","novosti");
$veza->exec("set names utf8");
	if (isset ($_REQUEST['tekstKom']) &&  isset ($_REQUEST['autorKom']) && isset ($_REQUEST['tekstHidd']))
        {
			include('header.html');
			print '<div id="tijelo">';
			$komentar=test_input($_REQUEST['tekstKom']);
			$autor=test_input($_REQUEST['autorKom']);
			$vijestID=test_input($_REQUEST['tekstHidd']);
			$email="";
			if(isset($_REQUEST['email']))
				$email=test_input($_REQUEST['email']);
			$vijestID = mysqli_real_escape_string($link, $vijestID);
			$autor = mysqli_real_escape_string($link, $autor);
			$email= mysqli_real_escape_string($link, $email);
			$komentar = mysqli_real_escape_string($link, $komentar);
						//$noviKomentar= $veza->query("INSERT INTO komentar SET id='', vijest='".$vijestID."', datum=NOW(),autor='".$autor."',email='".$email."', tekst='".$komentar."'");
			//$noviKomentar= $veza->query("INSERT INTO komentar (id, vijest, datum, autor, email, tekst) values ('',".$vijestID.", NOW(),".$autor.",".$email.",".$komentar.")");
			$noviKomentar= $veza->query("INSERT INTO komentar (id, vijest, datum, autor, email, tekst) values ('','$vijestID', CURRENT_TIMESTAMP,'$autor', '$email', '$komentar')");
			include 'index.html';		   
			print '</div>';
			include('footer.html');		   
         } 
	else if(isset($_GET['komentari']))
	{	
		include('header.html');
		print '<div id="tijelo">';
		
		$komentar="";
        $autor="";    
		$vijest=test_input($_GET['komentari']);

		$komentari= $veza->prepare("select id, UNIX_TIMESTAMP(datum) vrijeme2, autor, email, tekst from komentar where vijest=?");
		$komentari->execute(array($vijest));
		$i=0;
		$selVijest= $veza->prepare("select id, naziv, UNIX_TIMESTAMP(datum) vrijeme2, autor, slika, opis, opsirnije from vijest where id=?");
		$selVijest->execute(array($vijest));
		$vijest=$selVijest->fetch();
        $id=$vijest['id'];
		$naziv = $vijest['naziv'];
        $datum= date("d.m.Y. H:i", $vijest['vrijeme2']);
		$autor=$vijest['autor'];
		$slika=$vijest['slika'];
		$opis=$vijest['opis'];
        $opsirnije=$vijest['opsirnije'];
		 
		
		if($slika!="")            
			$vijesti ='<div class="vijestiPHPSlika">';
		
		else
			$vijesti ='<div class="vijestiPHP">';
		
		print 
            $vijesti.'<p class="naziv">'.$naziv.'</p>
			<p class = "datum">Datum objave: '.$datum.'</p>
			<p class="autor"> Autor: '.$autor.'</p>';
		
		if($slika!="")
			print '<img src="'.$slika.'" alt="">';
		
		print '<p class="opsirnijeTekst">'.$opsirnije.'</p>';
		print '<div class="komentari">';
		foreach ($komentari as $komentar)
		{
			$i++;
			print '<h4>Komentar #'.$i.'</h4><br>';
			print '<p class = "datum">Datum objave: '.date("d.m.Y. H:i", $komentar['vrijeme2']).'</p>';
				
			if($komentar['autor']!="" && $komentar['email']!="")
			{	$email=$komentar['email'];
				print 
					'<p><a href="mailto:'.$komentar['email'].'">Autor:'.$komentar['autor'].'</a></p>
					 <p>Email:'.$komentar['email'].'</p>';
			}
			else 
				print '<p>Autor:'.$komentar['autor'].'</p>';
		    print '<p>Tekst:'.$komentar['tekst'].'</p>';
			
		}
		print '<h4>Ostavi komentar:<h4>'
			  ."<form action='ucitavanjeNovosti.php' method='post' >
              <table class='komTabela'>
				  <tr><td>Autor: </td><td><input type='text' size='25' name='autorKom' required></td></tr>
				  <tr><td>Email: </td><td><input type='email' size='25' id='email' name='email'></td></tr>
				  <tr><td>Tekst komentara: </td><td><textarea size='25' name='tekstKom' required></textarea></td></tr>
				  <tr><td><input type='hidden' name='tekstHidd' value='".$id."'/></td>
				  <td><input type='submit' name='buttonOstaviKom' value='Ostavi komentar'/></td></tr>
			  </table>
				"."</form>";
		print '</div></div>';
		print'</div>';
	   //include('footer.html');
		
	}
	else if(isset($_GET['vijest']))
    {
		include('header.html');
		print '<div id="tijelo">';
        $pok=test_input($_GET['vijest']);
        session_start();
		$_SESSION['vijest'] = $pok;
		$selVijest= $veza->prepare("select id, naziv, UNIX_TIMESTAMP(datum) vrijeme2, autor, slika, opis, opsirnije from vijest where id=?");
		$selVijest->execute(array($pok));
		$vijest=$selVijest->fetch();
        $id=$vijest['id'];
		$naziv = $vijest['naziv'];
        $datum= date("d.m.Y. H:i", $vijest['vrijeme2']);
		$autor=$vijest['autor'];
		$slika=$vijest['slika'];
		$opis=$vijest['opis'];
        $opsirnije=$vijest['opsirnije'];
		 
		if($slika!="")            
			$vijesti ='<div class="vijestiPHPSlika">';
		
		else
			$vijesti ='<div class="vijestiPHP">';
		
		print 
            $vijesti.'<p class="naziv">'.$naziv.'</p>
			<p class = "datum">Datum objave: '.$datum.'</p>
			<p class="autor"> Autor: '.$autor.'</p>';
		
		if($slika!="")
			print '<img src="'.$slika.'" alt="">';
		
		print '<p class="opsirnijeTekst">'.$opsirnije.'</p>';
		
		
		$imaKomentar= $veza->prepare("select count(*) from komentar where vijest=?");
		$imaKomentar->execute(array($id));
        $proba=$imaKomentar->fetchColumn();
        
		//$vijest=$vijest['id'];
        
		if($proba!=0) {print "<p class='komentar'><a href='#' onclick='ucitajKomentare(".$pok.")'>".$proba." komentara (sakrij/prikaži)</a></p>";
		print '
			<h4>Ostavi komentar:<h4>'
			  ."<form action='ucitavanjeNovosti.php' method='post' >
              <table class='komTabela'>
				  <tr><td>Autor: </td><td><input type='text' size='25' name='autorKom' required></td></tr>
				  <tr><td>Email: </td><td><input type='email' size='25' id='email' name='email'></td></tr>
				  <tr><td>Tekst komentara: </td><td><textarea size='25' name='tekstKom' required></textarea></td></tr>
				  <tr><td><input type='hidden' name='tekstHidd' value='".$id."'/></td>
				  <td><input type='submit' name='buttonOstaviKom' value='Ostavi komentar'/></td></tr>
			  </table>
				"."</form>".'</div>';
		}
        else 
		{
			print '<p class="komentar">Nema komentara</p>
			<div class="komentari">
			<h4>Ostavi komentar:<h4>'
			  ."<form action='ucitavanjeNovosti.php' method='post' >
              <table class='komTabela'>
				  <tr><td>Autor: </td><td><input type='text' size='25' name='autorKom' required></td></tr>
				  <tr><td>Email: </td><td><input type='email' size='25' id='email' name='email'></td></tr>
				  <tr><td>Tekst komentara: </td><td><textarea size='25' name='tekstKom' required></textarea></td></tr>
				  <tr><td><input type='hidden' name='tekstHidd' value='".$id."'/></td>
				  <td><input type='submit' name='buttonOstaviKom' value='Ostavi komentar'/></td></tr>
			  </table>
				"."</form>".
			
			'</div></div>';

		}
		print "<br><br><div id='sadrzaj".$pok."'></div>";
		print '</div>';
		//include('footer.html');
    }
print '</div>';

?>



