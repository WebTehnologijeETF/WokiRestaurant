<?php 
include('header.html');
?>
	<div id="tijelo">
		
		<?php
		//$_SESSION['replyTo'] = $email;
		//$_SESSION['replyTo'] = $email;
			if (isset($_POST['buttonSlanje']))
			{
					session_start();
					$poruka = $_SESSION['poruka'];
					$email = $_SESSION['email'];
					ini_set('SMTP','webmail.etf.unsa.ba');
					ini_set('smtp_port',25);
					ini_set('sendmail_from', 'nagovic1@etf.unsa.ba');
					
					$To="nagovic1@etf.unsa.ba";
					$Subject="Kontak forma-Woki";
					$headers = "From: ".$email."\r\n";
					$headers .= "Reply-To: ".$email."\r\n";
					$headers .= "CC: vljubovic@etf.unsa.ba\r\n";
					$headers .= "Content-Type: text/plain; charset=utf-8";
					mail( $To, $Subject, $poruka, $headers);
			}
				/*session_start();
				
				
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
			
		?>
		<div id="glavni">
		<p>Zahvaljujemo se sto ste nas kontaktirali!</p>
		</div>
	</div>
	<?php 
	include('footer.html');
	?>