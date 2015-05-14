<?php 
include 'validacija.php';
include('header.html');
?>
		<div id="tijelo">	
		<h4>Provjerite da li ste ispravno popunili kontakt formu:</h4>
		<?php
		session_start();
		$ime = $_SESSION['ime'];
		$prezime = $_SESSION['prezime'];
		$mjesto =$_SESSION['mjesto'];
		$opcina = $_SESSION['opcina'];
		$email = $_SESSION['email'];
		$tel = $_SESSION['tel'];
		$razlogKon = $_SESSION['razlog'];
		$ocjena = $_SESSION['ocjena'];
		$tekst = $_SESSION['tekst'];
		
		?>
		<div id="uneseno">
		<table>
			<tr><td><?php print "Ime: "; ?></td> <td><?php print$ime?></td></tr>
			<tr><td><?php print "Prezime: "?></td><td><?php print $prezime?></td></tr>
			<tr><td><?php print "Mjesto: "?></td><td><?php print $mjesto?></td></tr>
			<tr><td><?php print "Općina: "?></td><td><?php print $opcina?></td></tr>
			<tr><td><?php print "Email: "?></td><td><?php print $email?></td></tr>
			<tr><td><?php print "Kontakt tel: "?></td><td><?php print $tel?></td></tr>
			<tr><td><?php print "Razlog kontaktiranja: "?></td><td><?php print $razlogKon?></td></tr>
			<tr><td><?php print "Ocijenite našu uslugu: "?></td><td><?php print $ocjena?></td></tr>
			<tr><td><?php print "Tekst: "?></td><td><?php print $tekst ?></td></tr>
		</table>
		<h4>Da li ste sigurni da želite poslati ove podatke?</h4>
		<form class="forma" action="slanjeMaila.php" method="post" ><!--onsubmit="Validacija_forme(); return false;"--> <input type="submit" name="buttonSlanje" id="slanjeMaila" value="Siguran sam" />
		<?php
		$_SESSION['poruka'] = $tekst;
		$_SESSION['email']= $email;
		$_SESSION['nazivIme']= $ime;
		$_SESSION['nazivPrezime']= $prezime;
		?>
		</form>
		</div>
		<h4>Ako ste pogrešno popunili formu, možete ispod prepraviti unesene podatke:</h4>
			<form action="kontakt.php" id="forma" name="kontaktForma" method="post" novalidate> <!--onsubmit="return ValidacijaForme(this);"--> 
			<table class="kontaktForma">
				<tr>
					<td>Ime:</td>
					<td>
						<input type="text" size="25" id="ime" name="ime" value="<?php if (isset($_SESSION['ime'])) print $_SESSION['ime']; elseif (isset($_REQUEST['ime'])) print htmlspecialchars($_REQUEST['ime']); ; ?>"><br>
						<span id="imeError" class="red">
						<?php if($imeErr!=""){ print '<img src="slike/Error.png" alt="" class="error">'; echo $imeErr; }  ?>
						</span>
					</td>
				</tr>
				<tr>
					<td>Prezime:</td>
					<td>
						<input type="text" size="25" id="prezime" name="prezime" value="<?php if (isset($_SESSION['prezime'])) print $_SESSION['prezime']; elseif(isset($_REQUEST['prezime'])) print htmlspecialchars($_REQUEST['prezime']); ?>"><br>
						<span id="prezimeError" class="red">
						<?php if($prezimeErr!=""){ print '<img src="slike/Error.png" alt="" class="error">'; echo $prezimeErr; }  ?>
						</span>
					</td>
				</tr>
				<tr>
					<td>Mjesto:</td>
					<td>
						<input type="text" size="25" id="mjesto" value="<?php if (isset($_SESSION['mjesto'])) print $_SESSION['mjesto']; elseif (isset($_REQUEST['mjesto'])) print htmlspecialchars($_REQUEST['mjesto']);?>"><br>
						<span id="mjestoError" class="red"></span>
					</td>
					
				</tr>
				<tr>
					<td>Općina:</td>
					<td>
						<input type="text" size="25" id="opcina" value="<?php if (isset($_SESSION['opcina'])) print $_SESSION['opcina']; elseif (isset($_REQUEST['opcina'])) print htmlspecialchars($_REQUEST['opcina']); ?>"><br>
						<span id="opcinaError" class="red"></span>
					</td>
					
				</tr>
				<tr>
					<td>E-mail:</td>
					<td>
						<input type="email" size="25" id="email" name="email" value="<?php if (isset($_SESSION['email'])) print $_SESSION['email']; elseif (isset($_REQUEST['email'])) print htmlspecialchars($_REQUEST['email']); ?>" ><br>
						<span id="mailError" class="red">
						<?php if($emailErr!=""){ print '<img src="slike/Error.png" alt="" class="error">'; echo $emailErr; }  ?>
						</span>
					</td>
				</tr>
				<tr>
					<td>Kontakt tel:</td>
					<td>
						<input type="tel" name="usrtel" size="25" id="tel" name="tel" value="<?php if (isset($_SESSION['tel'])) print $_SESSION['tel']; elseif (isset($_REQUEST['usrtel'])) print htmlspecialchars($_REQUEST['usrtel']);?>"><br>
						<span id="telError" class="red">
						<?php if($telErr!=""){ print '<img src="slike/Error.png" alt="" class="error">'; echo $telErr; }  ?>
						</span>
					</td>
				</tr>
				<tr>
				<tr>
					<td>Razlog kontaktiranja:</td>
					<td>
					<?php $proba=""; ?>
					<select id="opcija" name="opcija" value="<?php if (isset($_SESSION['razlog'])) {print $_SESSION['razlog']; $proba = $_SESSION['razlog'];} elseif (isset($_REQUEST['opcija'])) {print htmlspecialchars($_REQUEST['opcija']); $proba = htmlspecialchars($_REQUEST['opcija']);} ?>">
							<option <?php if ($proba == 'Sugestija' ) echo 'selected'; ?> value="Sugestija">Sugestija</option>
							<option <?php if ($proba == 'Kritika' ) echo 'selected'; ?> value="Kritika">Kritika</option>
							<option <?php if ($proba == 'Ostalo' ) echo 'selected'; ?> value="Ostalo">Ostalo</option>
					</select>
					</td>
				</tr>
				<tr>
					<td>Ocijenite našu uslugu(1-5):</td>
					<td><input type="range" name="points" min="1" max="5" id="range" value="<?php if (isset($_SESSION['ocjena'])) print $_SESSION['ocjena']; elseif (isset($_REQUEST['points'])) print htmlspecialchars($_REQUEST['points']); ?>"></td>
				</tr>
				<tr>
					<td>Tekst:</td>
					<td>
						<textarea id="tekst" name="text" cols="40" rows="10"><?php if (isset($_SESSION["tekst"])) { echo $_SESSION["tekst"]; }  elseif (isset($_POST["text"])) { print htmlspecialchars($_POST["text"]); }?></textarea><br>
						<span id="txtError" class="red">
						<?php if($txtErr!=""){ print '<img src="slike/Error.png" alt="" class="error">'; echo $txtErr; }  ?>
						</span>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<button type="reset" id="ponisti">Poništi</button>
						<button type="submit" name="submit" id="posalji">Pošalji </button>
					</td>
				</tr>
			</table>
			</form>
			</div>
			<?php 
			include('footer.html');
			?>