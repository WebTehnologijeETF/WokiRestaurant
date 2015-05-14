<?php 
include('header.html');
?>
	<div id="tijelo">
		<?php
		if (isset($_REQUEST['submit']))
{
		 //mail($primaoc,$tema,$poruka,$dodatneopcije);		
				ini_set("SMTP","webmail.etf.unsa.ba");
				ini_set("smtp_port","25");
				ini_set('sendmail_from', 'nagovic1@etf.unsa.ba');
				
				$To="nagovic1@etf.unsa.ba";
				$Subject="Kontak forma-Woki";
				$body="Caooo";
				$msg=wordwrap($body,70);
				$headers = "From: agranulo1@etf.unsa.ba\r\n";
				$headers .= "Reply-To: nagovic1@etf.unsa.ba\r\n";
				$headers .= "CC: sbotulja1@etf.unsa.ba\r\n";
				
				mail( $To, $Subject, $msg, $headers);
				/*session_start();
				$ReplyTo = $_SESSION['replyTo'];
				
				//slanje maila
				$To="nagovic1@etf.unsa.ba";
				$ReplyTo="proba@hotmail.com";
				$Subject="Kontak forma-Woki";
				$Message="Poruka";
				$headers .= = "From:". $ReplyTo . "\r\n" .
				"CC: nagovic1@etf.unsa.ba";
				$headers .= "Content-Type: text/html; charset=utf-8"
				//posalji mail
				mail( $To, $Subject, $Message, $headers);
				
				*/
			
}
		?>
		<div id="glavni">
		<p>Zahvaljujemo se sto ste nas kontaktirali!</p>
		</div>
	</div>
	<?php 
	include('footer.html');
	?>