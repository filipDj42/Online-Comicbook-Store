		<article>	
			<div class="row" id="prodavnica">

				<?php 

				require_once "php/konekcija.php";

				$brojac=0;
				$brojStripa="";
				$imeStripa="";
				$kategorijaStripa="";
				$slikaStripa="";

				if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) 
				{
					$stripoviUpit="SELECT * FROM stripovi order by id";

					$rezSTRIP = $konekcija ->query($stripoviUpit);

					$strip = $rezSTRIP->fetch_assoc();

					if (!$strip) //izvlacim podatke sa ovim ovde
					{
						echo '
						<div class="col-md12"><div class="thumbnail">
						<h2><br>Poštovani korisniče!</h2>
						<h3>Nema stripova trenutno u prodaji.</h3>
						<p><a class="btn btn-danger btn-lg" href="index.php" role="button"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>  Nazad na početnu</a></p>
						</div>
						</div>
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
							<form method="post" action="prodavnica.php">
							
							<p id="poljeOpisStripa"><b>Ovo je '.$strip["kategorijaStripa"].' izdanje broj '.$strip["brojStripa"].'</b><br>
							Cena: <strong>'.$strip["cenaStripa"].',00 din</strong> </p><input type="hidden" name="cenaSakriveno" value="'.$strip["cenaStripa"].'"/>
							<p><button class="btn btn-danger" name="dugmeDodajUKorpu" type="submit" value="Dodaj u Korpu"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Dodaj u Korpu</button><br><br><button class="btn btn-danger" name="dugmeDodajUListu" type="submit" value="Dodaj u Listu Želja"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>  Dodaj u Listu Želja</button></p>
							
							<input type="hidden" name="imeSakriveno" value="'.$strip["imeStripa"].'"/> 
							
							</form>
							</div>
							</div>
							</div>';
						} while ($strip=$rezSTRIP->fetch_assoc());


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
				}
				else
				{
					echo '
					<div class="col-md12"><div class="thumbnail">
					<h2><br>Poštovani korisniče!</h2>
					<h3>Da bi ste pristupili prodavnici i njenim proizvodima, morate se prvo prijaviti.</h3>
					<p><a class="btn btn-danger btn-lg" href="registracija.php" role="button"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>  Prijavite se</a></p>
					</div>
					</div>

					';
				}


				?>
			</div>
		</article>
