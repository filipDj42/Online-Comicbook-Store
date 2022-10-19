<?php 
require_once "php/konekcija.php"; 
?>
<div class="row">
	<div class="col-md-6">
		<header class="page-header">
			<h2>Kontakt</h2>
		</header>
		<form action="kontakt.php" id="mojaForma" method="post" name="formaKontakt">



			<?php 

			//slanje maila
			if (isset($_POST["dugmePosaljiKorisnik"])) 
			{
				if (isset($_POST["inputName"]) && isset($_POST["inputEmail"]) ) 
				{
					$ime=$_POST["inputName"];
					$email=$_POST["inputEmail"];
					$telefon=$_POST["inputTel"];
					$naslov=$_POST["inputSubject"];
					$tekstPoruke=$_POST["inputText"];

					$datum = date(DATE_RFC2822);

					$i=0;

					do
					{
						$i++;
					}
					while(file_exists("kontakti/".$i.".txt")==true);

					$IZLAZ="\n\nDatum: " . $datum . "\nIme i Prezime: ".$ime."\nEmail: ".$email . "\nTelefon: " . $telefon . "\nNaslov: " . $naslov . "\nTekst: ".$tekstPoruke . "\n";

					$stampa = fopen("Kontakti/".$i.".txt", "w");

					flock($stampa, LOCK_EX);
					fwrite($stampa, $IZLAZ, strlen($IZLAZ));
					flock($stampa, LOCK_UN);
					fclose($stampa);
					//Upis korisnickih mailova u bazu

					$putanjaPoruke = "kontakti/".$i.".txt";
					$datumPoruke = date('Y-m-d H:i:s');
					$upitINSERTporuku = "INSERT INTO poruke (datumPoruke, lokacijaPoruke, imePoruke) VALUES ('" .$datumPoruke . "','" . $putanjaPoruke . "','". $email ."')" ;

					if (!$rezINSporuke = $konekcija ->query($upitINSERTporuku)) 
					{

						echo "Greska!";
					}
					else
					{

						?>
						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Uspešno!</strong> Poslali ste E-mail korisničkoj službi.
						</div>

						<?php
					}
				}
			}


			?>


			<div class="form-group">
				<label for="inputName">Vaše ime i prezime</label>
				<input type="text" name="inputName" class="form-control" id="inputName" placeholder="Upišite Vaše ime i prezime" required>
			</div>
			<div class="form-group">
				<label for="inputEmail">Vaš e-mail</label>
				<input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Upišite Vaš e-mail" required>
			</div>
			<div class="form-group">
				<label for="inputTel">Vaš telefonski broj</label>
				<input type="tel" name="inputTel" class="form-control" id="inputTel" placeholder="Upišite Vaš telefonski broj">
			</div>
			<div class="form-group">
				<label for="inputSubject">Naslov poruke</label>
				<input type="text" name="inputSubject" class="form-control" id="inputSubject" placeholder="Naslov Vaše poruke">
			</div>
			<div class="form-group">
				<label for="inputText">Tekst Poruke</label>
				<textarea class="form-control" name="inputText" rows="5" id="inputText"></textarea>
			</div>
			<button type="submit" class="btn btn-danger btn-lg btn-block" name="dugmePosaljiKorisnik"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Pošaljite</button>
		</form>
	</div>

	<!-- LEVI PRIKAZ -->
	<div class="col-md-6">
		<header class="page-header">
			<h2>Gde se nalazimo</h2>
		</header>
		<p class="klasaGde"><i class="fas fa-map-marker-alt"></i> Kostolačka 8, Beograd 11000</p>
		<p class="klasaGde"><i class="fas fa-phone-alt"></i>  +381 11 22 33 44</p>
		<p class="klasaGde"><i class="fas fa-envelope"></i> stripoteka@gmail.com</p>
		<!-- UBACUJEM MAPU ISPOD,idem na google maps,nadjem lokaciju koju ocu,idem share,embeded a map,medium,copy html i paste ispod,AKO OCU DA PORAVNJAM MAPU MENJAM WIDTH,HEIGHT I BORDER -->
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1298.640076367697!2d20.478410071400887!3d44.773593211870434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7059b3cb6855%3A0x6aca5785f5420b9!2zNDTCsDQ2JzI3LjIiTiAyMMKwMjgnMzcuMyJF!5e0!3m2!1sen!2srs!4v1648631493854!5m2!1sen!2srs" width="550" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
	</div>
</div>
<img style="justify-content: center; width: 100%" id="donjaSlika" src="img/Sajt/dilanDonjaStrana.png" alt="Dogoteka| Dilan Dog Logo">