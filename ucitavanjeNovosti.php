<?php
$vijesti = $fajl = $datum = $autor = $naziv = $slika = $opis = $opsirnije = $link = "";

function test_input($data) 
	{
	   $data = trim($data);
	   $data = stripslashes(strip_tags($data));
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
foreach ( glob("novosti/*.txt") as $filename)
 {
		
		$fajl = file($filename);
		test_input($fajl[0]);
		$datum = trim($fajl[0]);
		test_input($fajl[1]);
		$autor = trim($fajl[1]);
		test_input($fajl[2]);
		$naziv = ucfirst(strtolower(trim($fajl[2])));
		test_input($fajl[3]);
		$slika = trim($fajl[3]);
		
		$i = 4;
		$j = count($fajl);
		
		while ($j-1 != $i && trim($fajl[$i]) != "--") 
		{
			test_input($fajl[$i]);
			$opis .= $fajl[$i];
			$i++;
		}
		if(trim($fajl[$i]) == "--")
		{
			$i++;
			while ($i != count($fajl)) 
			{
				test_input($fajl[$i]);
				$opsirnije .= $fajl[$i];
				$i++;
			}
		}
		if ($opsirnije != "")
		{
			//$link = '<a href="#" class="detaljnije" onClick="AjaxOpsirnije('.$naziv.','.$datum.','.$autor.','.$slika.','.$opis.','.$opsirnije.')">Opširnije...</a>';
			$link = '<a href="#" class="detaljnije" onClick="">Opširnije...</a>';
			$vijesti ='<div class="vijesti">
				<p class="naziv">'.$naziv.'</p>
				<p class = "datum">Datum objave: '.$datum.'</p>
				<p class="autor"> Autor: '.$autor.'</p>
				<img src="'.$slika.'" alt="">
				<p class = "opis">'.$opis.'</p>
				<p class = "opsirnije">'.$link.'</p>
				<br><br>';
		}
		else
		{
			$vijesti ='<div class="vijesti">
				<p class="naziv">'.$naziv.'</p>
				<p class = "datum">Datum objave: '.$datum.'</p>
				<p class="autor"> Autor: '.$autor.'</p>
				<img src="'.$slika.'" alt="">
				<p class = "opis">'.$opis.'</p>
				<br><br>';
			
		}
	   	print $vijesti;
	}
	

?>



