<article>
	<div class="row">
		

		<?php 

		require_once "php/konekcija.php"; 

		$brojStripaP="";
		$imeStripaP="";
		$cenaStripaP="";
		$kategorijaStripaP="";
		$slikaStripaP="";



		if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) 
		{

			if(isset($_POST["pretragaDugme"]))
			{
		//OVDE REGEX IF TACNO ONDA RADI SVE TO, ELSE GRESKA MORA MIN TRI SLOVA IMATI
				$regEx="/^[A-Za-z]{3,}$/";


				if(preg_match($regEx, $_POST["poljeSEARCH"]))
				{


					$upitPRETRAGES = "SELECT * FROM stripovi WHERE imeStripa LIKE ('%". $_POST["poljeSEARCH"] . "%')";

					$rezPRETRAGES = $konekcija ->query($upitPRETRAGES);

					$strip = $rezPRETRAGES->fetch_assoc();
					if(!$strip)
					{
						echo '
						<div class="col-md-12">
						<div class="thumbnail">
						<h2><br>Poštovani korisniče!</h2>
						<h3 id="nemaSearch">Trenutno nemamo ni jedan strip sa traženim imenom.</h3><br>
						
						<a class="btn btn-danger btn-lg" href="prodavnica.php" role="button">&larr;  Nazad na prodavnicu</a><br>
						<br>
						</div>
						</div><img style="justify-content: center; width: 100%" id="donjaSlika" src="img/Sajt/dilanDonjaStrana.png" alt="Dogoteka| Dilan Dog Logo">

						';

					}
					else
					{
						do
						{	

							echo '

							<div class=" col-sm-6 col-md-3" id="redmoj">
							<div class="thumbnail">

							<img src="'.$strip["slikaStripa"].'" alt="Slika nije nadjena">
							<h4>'.$strip["imeStripa"].'</h4>

							<div class="caption">
							<form method="post" action="prodavnica.php" id="formaS">
							
							<b>Ovo je '.$strip["kategorijaStripa"].' izdanje broj '.$strip["brojStripa"].'</b>
							<p>Cena: <strong>'.$strip["cenaStripa"].',00 din</strong> </p><input type="hidden" name="cenaSakriveno" value="'.$strip["cenaStripa"].'"/>
							<p><button class="btn btn-danger" name="dugmeDodajUKorpu" type="submit" value="Dodaj u Korpu"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Dodaj u Korpu</button><br><br><button class="btn btn-danger" name="dugmeDodajUListu" type="submit" value="Dodaj u Listu Želja"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>  Dodaj u Listu Želja</button></p>
							
							<input type="hidden" name="imeSakriveno" value="'.$strip["imeStripa"].'"/> 
							
							</form>
							</div>
							</div>
							</div>';
						} while ($strip=$rezPRETRAGES->fetch_assoc());



						if(isset($_POST["dugmeDodajUKorpu"]))
						{
							$upitADDkorpa="INSERT INTO korpe (imeArtikla, cenaArtikla, korisnikMail) VALUES ('" . $_POST["imeSakriveno"] . "','" . $_POST["cenaSakriveno"] . "','" . $_SESSION["mail"]."')";
							if (!$rezKorpa = $konekcija ->query($upitADDkorpa)) 
							{						
								echo '<script type="text/javascript">';
								echo 'alert("Neuspešno dodavanje u korpu.")';
								echo '</script>';
							}
							else
							{
								echo '<script type="text/javascript">';
								echo 'alert("Uspesno dodato u korpu")';
								echo '</script>';

							}
						}



						if(isset($_POST["dugmeDodajUListu"]))
						{
							$upitADDLista="INSERT INTO listazelja (imeArtikla, cenaArtikla, korisnikMail) VALUES ('" . $_POST["imeSakriveno"] . "','" . $_POST["cenaSakriveno"] . "','" . $_SESSION["mail"]."')";
							if (!$rezLista = $konekcija ->query($upitADDLista)) 
							{						
								echo '<script type="text/javascript">';
								echo 'alert("Neuspešno dodavanje u korpu.")';
								echo '</script>';
							}
							else
							{
								echo '<script type="text/javascript">';
								echo 'alert("Uspesno dodato u listu želja")';
								echo '</script>';

							}
						}
					}



					echo '<img style="justify-content: center; width: 100%" id="donjaSlika" src="img/Sajt/dilanDonjaStrana.png" alt="Dogoteka| Dilan Dog Logo">';

				}
				else
				{
					$greska="Morate uneti minimum 3 slova za pretragu";
					echo '
					<div class="col-md12"><div class="thumbnail">
					<h2><br>Poštovani korisniče!</h2>
					<h3 id="h3PretragaMaloSlova">Za pretragu prodavnice morate uneti minimum 3 slova.</h3><br>
					<a class="btn btn-danger btn-lg" href="prodavnica.php" role="button">&larr;  Nazad na prodavnicu</a><br><br>
					</div></div><img style="justify-content: center; width: 100%" id="donjaSlika" src="img/Sajt/dilanDonjaStrana.png" alt="Dogoteka| Dilan Dog Logo">
					';
				}
			}
		}
		else 
		{
			echo '
			<div class="col-md12"><div class="thumbnail">
			<h2><br>Poštovani korisniče!</h2>
			<h3>Da bi ste pristupili prodavnici i njenim proizvodima, morate se prvo prijaviti.</h3>
			<p><a class="btn btn-danger btn-lg" href="registracija.php" role="button"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>  Prijavite se</a></p>
			</div></div>
			<img style="justify-content: center; width: 100%" id="donjaSlika" src="img/Sajt/dilanDonjaStrana.png" alt="Dogoteka| Dilan Dog Logo">
			';
		}







		?>
	</div>
</article>











