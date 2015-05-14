<?php 
include 'validacija.php';
include('header.html');
?>
		<div id="tijelo">	
		<div id="glavni">
			<p>Za sve dodatne informacije, sugestije i kritike budite slobodni da nas kontaktirate putem sljedeće forme:</p>
			<form action="kontakt.php" id="forma" name="kontaktForma" method="post" novalidate> <!--onsubmit="return ValidacijaForme(this);"--> 
			<table class="kontaktForma">
				<tr>
					<td>Ime:</td>
					<td>
						<input type="text" size="25" id="ime" name="ime" value="<?php if (isset($_REQUEST['ime'])) print htmlspecialchars($_REQUEST['ime']); ?>"><br>
						<span id="imeError" class="red">
						<?php if($imeErr!=""){ print '<img src="slike/Error.png" alt="" class="error"> '; echo $imeErr; }  ?>
						</span>
					</td>
				</tr>
				<tr>
					<td>Prezime:</td>
					<td>
						<input type="text" size="25" id="prezime" name="prezime" value="<?php if (isset($_REQUEST['prezime'])) print htmlspecialchars($_REQUEST['prezime']); ?>"><br>
						<span id="prezimeError" class="red">
						<?php if($prezimeErr!=""){ print '<img src="slike/Error.png" alt="" class="error"> '; echo $prezimeErr; }  ?>
						</span>
					</td>
				</tr>
				<tr>
					<td>Mjesto:</td>
					<td>
						<input type="text" size="25" id="mjesto" name="mjesto" value="<?php if (isset($_REQUEST['mjesto'])) print htmlspecialchars($_REQUEST['mjesto']); ?>"><br>
						<span id="mjestoError" class="red"></span>
					</td>
					
				</tr>
				<tr>
					<td>Općina:</td>
					<td>
						<input type="text" size="25" id="opcina" name="opcina" value="<?php if (isset($_REQUEST['opcina'])) print htmlspecialchars($_REQUEST['opcina']); ?>"><br>
						<span id="opcinaError" class="red"></span>
					</td>
					
				</tr>
				<tr>
					<td>E-mail:</td>
					<td>
						<input type="email" size="25" id="email" name="email" value="<?php if (isset($_REQUEST['email'])) print htmlspecialchars($_REQUEST['email']); ?>" ><br>
						<span id="mailError" class="red">
						<?php if($emailErr!=""){ print '<img src="slike/Error.png" alt="" class="error"> '; echo $emailErr; }  ?>
						</span>
					</td>
				</tr>
				<tr>
					<td>Kontakt tel:</td>
					<td>
						<input type="tel" name="usrtel" size="25" id="tel" value="<?php if (isset($_REQUEST['usrtel'])) print htmlspecialchars($_REQUEST['usrtel']); ?>"><br>
						<span id="telError" class="red">
						<?php if($telErr!=""){ print '<img src="slike/Error.png" alt="" class="error"> '; echo $telErr; }  ?>
						</span>
					</td>
				</tr>
				<tr>
				<tr>
					<td>Razlog kontaktiranja:</td>
					<td>
					<?php $proba=""; ?>
						<select id="opcija" name="opcija" value="<?php if (isset($_REQUEST['opcija'])) {print htmlspecialchars($_REQUEST['opcija']); $proba = htmlspecialchars($_REQUEST['opcija']);} ?>">
							<option <?php if ($proba == 'Sugestija' ) echo 'selected'; ?> value="Sugestija">Sugestija</option>
							<option <?php if ($proba == 'Kritika' ) echo 'selected'; ?> value="Kritika">Kritika</option>
							<option <?php if ($proba == 'Ostalo' ) echo 'selected'; ?> value="Ostalo">Ostalo</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Ocijenite našu uslugu(1-5):</td>
					<td><input type="range" name="points" min="1" max="5" id="range" value="<?php if($_REQUEST['opcija']=='Ostalo'){ echo "disabled='true'";}if (isset($_REQUEST['points'])) print htmlspecialchars($_REQUEST['points']); ?>"></td>
				</tr>
				<tr>
					<td>Tekst:</td>
					<td>
						<textarea id="tekst" name="text" cols="40" rows="10" ><?php if (isset($_POST["text"])) { print htmlspecialchars($_POST["text"]); } ?></textarea><br>
						<span id="txtError" class="red">
						<?php if($txtErr!=""){ print '<img src="slike/Error.png" alt="" class="error"> '; echo $txtErr; }  ?>
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
		</div>
		<?php 
			include('footer.html');
		?>