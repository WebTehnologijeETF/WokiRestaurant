<?php 
include('header.html');
print '<div id="tijelo">';

ini_set('session.gc_maxlifetime', 60);

session_start();
    $veza = new PDO("mysql:dbname=novosti;host=localhost;charset=utf8", "wtuser", "wtpass");
    $veza->exec("set names utf8");
    $username="";
    $password="";
    $user2="";
	
     if (isset($_SESSION['username']))
	 {
		 $username = $_SESSION['username'];
	 }

     if (isset($_REQUEST['username']) && isset($_REQUEST['password']))
      {  
       $username = $_REQUEST['username'];
       $password = $_REQUEST['password'];
	   
	   $upit = $veza->prepare("SELECT * FROM korisnici WHERE username=? and password=?");
       $upit->execute(array($username,$password));
        foreach ($upit as $user) 
        {
          $user1=$user['username'];
		  $pass1=$user['password'];
          if($user1==$username && $pass1=$password)
           {
            $_SESSION['username'] = $username;
            $user2=$_SESSION['username'];
            }
        }
      }
	if($user2!="")
          {
			//include('header.html');
			print '<div id="tijelo">';
			 print 
			"
				<div id='logout'><a href='odjava.php'> Odjavi se</a></div>
			";
            include 'AdminUcitavanjeNovosti.php';
			print '</div>';
			//include('footer.html');
		  }
    else 
		  {
			 
			  // <tr><td></td><td><a href='mailto:".$email."?body=".$body."'>Zaboravili ste šifru?(Posalji novu sifru na mail)</a></td></tr>
			  //'AdminUcitavanjeNovosti.php?brisi='".$vijest."'
			  //include('header.html');
			  //print '<div id="tijelo">';
			  print "<form action='admin.php' method='post' >
              <table class='admin'>
             <tr><td>Korisničko ime: </td><td><input type='text' size='25' name='username'></td></tr>
             <tr><td>Šifra:</td><td><input type='password' size='25' name='password'></td></tr>
			 
			 <tr><td></td><td><a href='potvrdiAdmin.php'>Zaboravili ste šifru?(Posalji novu sifru na mail)</a></td></tr>
             <tr><td></td><td><input type='submit' name='buttonOstaviKom' value='Prijava'/></td></tr>
			 </table></form>";
			 //print '</div>';
			//include('footer.html');
			 
		  }
	//else echo"PROBAAAAAAAAAAAAA";
    /*if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600))
		{
			// last request was more than 10 minutes ago
			session_unset();     // unset $_SESSION variable for the run-time 
			session_destroy();   // destroy session data in storage
		}
	$_SESSION['LAST_ACTIVITY'] = time(); 
*/

	print '</div>';
	
	include('footer.html');
?>