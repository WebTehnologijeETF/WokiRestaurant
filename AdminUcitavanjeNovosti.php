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
$veza->exec("set names utf8");
$rezultat = $veza->query("select id, naziv, UNIX_TIMESTAMP(datum) vrijeme2, autor, slika, opis, opsirnije from vijest order by datum desc");
 if (!$rezultat) 
 {
    $greska = $veza->errorInfo();
    print "SQL greška: " . $greska[2];
    exit();
 }  
 if(isset($_REQUEST['tekstHidd']))
	{	
            include('header.html');
			print '<div id="tijelo">';
		$brisi=test_input($_REQUEST['tekstHidd']);
			$obrisi= $veza->query("DELETE FROM vijest where id=".$brisi);
			include 'index.html';		   
			print '</div>';
			include('footer.html');	
	}
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
							$noviKomentar= $veza->query("INSERT INTO komentar SET id='', vijest='".$vijestID."', datum=NOW(),autor='".$autor."',email='".$email."', tekst='".$komentar."'");
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

		$komentari= $veza->query("select id, UNIX_TIMESTAMP(datum) vrijeme2, autor, email, tekst from komentar where vijest=".$vijest);
		$i=0;
		$selVijest= $veza->query("select id, naziv, UNIX_TIMESTAMP(datum) vrijeme2, autor, slika, opis, opsirnije from vijest where id=".$vijest);
		$vijest=$selVijest->fetch();
        $id=$vijest['id'];
		$naziv = $vijest['naziv'];
        $datum= date("d.m.Y. h:i", $vijest['vrijeme2']);
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
			print '<p class = "datum">Datum objave: '.date("d.m.Y. h:i", $vijest['vrijeme2']).'</p>';
				
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
		$selVijest= $veza->query("select id, naziv, UNIX_TIMESTAMP(datum) vrijeme2, autor, slika, opis, opsirnije from vijest where id=".$pok);
		$vijest=$selVijest->fetch();
        $id=$vijest['id'];
		$naziv = $vijest['naziv'];
        $datum= date("d.m.Y. h:i", $vijest['vrijeme2']);
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
		
		
		$imaKomentar= $veza->query("select count(*) from komentar where vijest=".$id);
        $proba=$imaKomentar->fetchColumn();
        
		//$vijest=$vijest['id'];
        
		if($proba!=0) print "<p class='komentar'><a href='ucitavanjeNovosti.php?komentari=$pok'>".$proba." komentara (prikaži)</a></p></div>";
        else print "<p class='komentar'>Nema komentara</p></div>";
		print '</div>';
		//include('footer.html');
    }
	else
	{
		
		print "<a href='dodajVijest.php'>Dodaj vijest</a>";
		foreach ($rezultat as $vijest)
		{
          $proba=0;
            $slika=$vijest['slika'];
		    print "<div id='novosti'>";
			if($slika!="") $vijesti ='<div class="vijesti">';
		    
			else $vijesti ='<div class="vijestiBezSlike">';
			print $vijesti.'<p class="naziv">'.$vijest['naziv'].'</p>
				<p class = "datum">Datum objave: '.date("d.m.Y. h:i", $vijest['vrijeme2']).'</p>
				<p class="autor"> Autor: '.$vijest['autor'].'</p>';
				if($slika!="")
					print '<img src="'.$slika.'" alt="">';
				
				print '<p class = "opis">'.$vijest['opis'].'</p>';
				$opsirnije=$vijest['opsirnije'];
				$vijest=$vijest['id'];
				$link= "<a href='ucitavanjeNovosti.php?vijest=$vijest'> Opširnije...</a>";
				if($opsirnije!="")
					print '<p class = "opsirnije">'.$link.'</p>';
				//print "<input type='button' name='buttonObrisi' value='Obriši vijest' onclick='AdminUcitavanjeNovosti.php?brisi='".$vijest."'/>";
			    print "<input type='hidden' name='tekstHidd' value='".$vijest."'/></td>";
  			    print "<a href='AdminUcitavanjeNovosti.php'>Obriši vijest</a>";
			    print "<a href='#'>Izmijeni vijest</a>";
				print '</div></div>';
     }
}
print '</div>';

?>



