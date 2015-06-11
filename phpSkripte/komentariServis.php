<?php


function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}
function rest_get($request, $data) 
{
	if(isset($_GET['vijest']))
	{
	$veza = new PDO("mysql:dbname=novosti;host=localhost;charset=utf8", "wtuser", "wtpass");
	$veza->exec("set names utf8");
	$idvijesti = $_GET['vijest'];
	$upit = $veza->prepare("SELECT * FROM komentar WHERE vijest=?");
	$upit->bindValue(1, $idvijesti, PDO::PARAM_INT);
	$upit->execute();
	
	print "<div id='tijelo'> <div class='komentariNovi'>";
	$proba=json_encode($upit->fetchAll());
	$result = json_decode($proba,true);
	$i=0;
	foreach($result as $red)
	{
		
		$i++;
		print "<br>";
		print "Komentar #".$i."<br>";
		print "Datum objave: ".$red['datum']."<br>";
		print "Autor: ".$red['autor']."<br>";
		if(!empty($red['email']))
			print "Email: ".$red['email']."<br>";
		print "Komentar: ".$red['tekst']."<br>";
		
	}
	print "</div></div>";
	}
}
function rest_post($request, $data)
 {
	$veza = new PDO("mysql:dbname=novosti;host=localhost;charset=utf8", "wtuser", "wtpass");
	$veza->exec("set names utf8");
	$vijestID=$_POST['id'];
	$autor=$_POST['autor'];
	$komentar=$_POST['komentar'];
	$email=$_POST['id'];
	$noviKomentar= $veza->query("INSERT INTO komentar (id, vijest, datum, autor, email, tekst) values ('','$vijestID', CURRENT_TIMESTAMP,'$autor', '$email', '$komentar')");
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