<?php


function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}
function rest_get($request, $data) 
{
	$veza = new PDO("mysql:dbname=novosti;host=localhost;charset=utf8", "wtuser", "wtpass");
	$veza->exec("set names utf8");
	$rezultat = $veza->query("select id, naziv, UNIX_TIMESTAMP(datum) vrijeme2, autor, slika, opis, opsirnije from vijest order by datum desc");
	$proba=json_encode($rezultat->fetchAll());
	$result = json_decode($proba,true);
	
	print "<div>
			<h3>Obavijesti:</h3>
			</div>
			<div id='novosti'><div id='tijelo'>";
	
	$i=0;
	foreach($result as $vijest)
	{
		
	 $slika=$vijest['slika'];
		    
			if($slika!="") $vijesti ='<div class="vijesti">';
		    
			else $vijesti ='<div class="vijestiBezSlike">';
			
			print $vijesti.'<p class="naziv">'.$vijest['naziv'].'</p>
				<p class = "datum">Datum objaveee: '.date("d.m.Y. H:i", $vijest['vrijeme2']).'</p>
				<p class="autor"> Autor: '.$vijest['autor'].'</p>';
				if($slika!="")
					print '<img src="'.$slika.'" alt="">';
				
				print '<p class = "opis">'.$vijest['opis'].'</p>';
				$opsirnije=$vijest['opsirnije'];
				$vijest=$vijest['id'];
				$link= "<a href='ucitavanjeNovosti.php?vijest=$vijest'> Opširnije...</a>";
				if($opsirnije!="")
					print '<p class = "opsirnije">'.$link.'</p>';
				print '</div>';
	}
	print "</div></div>";
}
function rest_post($request, $data)
 {
	$veza = new PDO("mysql:dbname=novosti;host=localhost;charset=utf8", "wtuser", "wtpass");
	$veza->exec("set names utf8");
 }
function rest_delete($request) 
{
	
}
function rest_put($request, $data) { }
function rest_error($request) { }

$method  = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

switch($method) {
    case 'PUT':
        parse_str(file_get_contents('php://input'), $put_vars);
        zag(); $data = $put_vars; rest_put($request, $data); break;
    case 'POST':
        zag(); $data = $_POST; rest_post($request, $data); break;
    case 'GET':
        zag(); $data = $_GET; rest_get($request, $data); break;
    case 'DELETE':
        zag(); rest_delete($request); break;
    default:
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        rest_error($request); break;
}
?>