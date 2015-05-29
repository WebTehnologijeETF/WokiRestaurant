<?php 
//include('header.html');
print '<div id="tijelo">';

session_start();
    $veza = new PDO("mysql:dbname=novosti;host=localhost;charset=utf8", "wtuser", "wtpass");
    $veza->exec("set names utf8");
    $username="";
    $password="";
    $user2="";
     if (isset($_SESSION['username']))
       $username = $_SESSION['username'];

     else if (isset($_REQUEST['username']) && isset($_REQUEST['password']))
      {  
       $username = $_REQUEST['username'];
       $password = $_REQUEST['password'];
	   
	   $upit = $veza->prepare("SELECT * FROM korisnici WHERE username=? and password=?");
       $upit->execute(array($username,$password));
        foreach ($upit as $user) 
        {
          $user1=$user['username'];
          if($user1==$username )
           {
            $_SESSION['username'] = $username;
            $user2=$_SESSION['username'];
            }
        }
      }
	if($user2!="")
          {
			include('header.html');
			print '<div id="tijelo">';
            include 'AdminUcitavanjeNovosti.php';
			print '</div>';
			include('footer.html');
		  }
    else
		  {
			  
			  // <tr><td></td><td><a href='mailto:".$email."?body=".$body."'>Zaboravili ste šifru?(Posalji novu sifru na mail)</a></td></tr>
			  //'AdminUcitavanjeNovosti.php?brisi='".$vijest."'
			  print "<form action='admin.php' method='post' >
              <table class='admin'>
             <tr><td>Korisničko ime: </td><td><input type='text' size='25' name='username'></td></tr>
             <tr><td>Šifra:</td><td><input type='password' size='25' name='password'></td></tr>
			 
			 <tr><td></td><td><a href='potvrdiAdmin.php'>Zaboravili ste šifru?(Posalji novu sifru na mail)</a></td></tr>
             <tr><td></td><td><input type='submit' name='buttonOstaviKom' value='Prijava'/></td></tr>
			 </table></form>";
		  }
    
 //session_unset();


	print '</div>';
	//include('footer.html');
?>