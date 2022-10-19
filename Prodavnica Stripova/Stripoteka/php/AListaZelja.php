<article>
	<form method="post" action="listaZelja.php">
		

		<?php 

		require_once "php/konekcija.php";

		$upitSVI="SELECT * FROM listazelja WHERE korisnikMail LIKE('".$_SESSION["mail"]."') ORDER BY idArtikla";

		$rezultatSVI = $konekcija ->query($upitSVI);
		$red= $rezultatSVI ->fetch_assoc();

		if (!$red) 
		{
			echo '<div class="col-md-12">

			<div class="jumbotron"><br>
			<h2>Poštovani,trenutno Vam je Lista želja prazna!</h2><br><br>
			<div class="col-md-4">
			<p><a class="btn btn-danger btn-lg btn-block" href="korpa.php" role="button"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Korpa</a></p>
			<p><a class="btn btn-danger btn-lg btn-block" href="prodavnica.php" role="button">&larr;  Nazad na prodavnicu</a></p>
			</div>
			</div>
			</div>';
		}
		else
		{
			echo '<div class="col-md-12">
			<div class="panel panel-default">
			<div class="panel-heading"><h3><center>Vaša Lista Želja</center></h3></div>
			<div class="panel-body">';
			echo '<table id="sveListeZeljaKorisnik" class="table  table-bordered" style="text-align: center;"><thead>
			<tr>				
			<th style="text-align: center;">Ime</th>
			<th style="text-align: center;">Cena</th> 
			<th style="text-align: center;">Kolicina</th>
			<th style="text-align: center;">Akcija</th>
			</tr></thead>';
			do
			{

				echo '<tbody align="center">'. "<tr>" .
				"<td>" . $red["imeArtikla"] . "</td>".
				"<td>" . $red["cenaArtikla"] . "</td>" . 
				"<td>1</td>" .'<input type="hidden" name="idArtiklaSakriveno" value="'.$red["idArtikla"].'"/>'.'<input type="hidden" name="imeSakriveno" value="'.$red["imeArtikla"].'"/>'.'<input type="hidden" name="cenaSakriveno" value="'.$red["cenaArtikla"].'"/>'.
				'<td><input style="margin-right:10px;" type="submit" name="BrisiLista" value="Ukloni" class="btn btn-danger btn-md"><input type="submit" name="PrebaciLista" value="Prebaci u korpu" style="margin-left:10px;" class="btn btn-danger btn-md"></td>'.
				"</tr>";

			}
			while($red = $rezultatSVI ->fetch_assoc());


			echo "</tbody></table></div>
			</div>";


			//OVDE DODATI TOTAL I DUGME ZA NASTAVAK PORUDZBINE, KADA SE NASTAVI NA PORUDZBINU PRVO IDE ADRESA I TO ONDA RACUN KONACNO
			


			if (isset($_POST["BrisiLista"])) 
			{
				$upitDEL = "DELETE  FROM listazelja WHERE idArtikla LIKE '".$_POST["idArtiklaSakriveno"]."'";

				$rezDEL = $konekcija->query($upitDEL);


				if (!$rezDEL) 
				{
					?>

					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Neuspešno!</strong>Neuspešno brisanje.
					</div>

					<?php
				}
				else
					{?>
						<script type="text/javascript">
							window.location.href = "listaZelja.php";
						</script>

						<?php
					}
				}


				if (isset($_POST["PrebaciLista"])) 
				{
					$upitPrebaciINS="INSERT INTO korpe (imeArtikla, cenaArtikla, korisnikMail) VALUES ('" . $_POST["imeSakriveno"] . "','" . $_POST["cenaSakriveno"] . "','" . $_SESSION["mail"]."')";

					$rezINS=$konekcija->query($upitPrebaciINS);

					$upitPrebaciDEL = "DELETE  FROM listazelja WHERE idArtikla LIKE '".$_POST["idArtiklaSakriveno"]."'";

					$rezPrebaciDel = $konekcija->query($upitPrebaciDEL);


					if (!$rezPrebaciDel) 
					{
						?>

						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Neuspešno!</strong>Neuspešno brisanje.
						</div>

						<?php
					}
					else
					{
						?>
						<script type="text/javascript">
							window.location.href = "listaZelja.php";
						</script>

						<?php
					}
				}
				echo '<div class="col-md-12">
				<div class="col-md-3">
				<p><a class="btn btn-danger btn-lg btn-block" href="prodavnica.php" role="button">&larr;  Nazad na prodavnicu</a></p>
				</div>';
			}

			?>






		</form>
	</article>

	<img style="justify-content: center; width: 100%" id="donjaSlika" src="img/Sajt/dilanDonjaStrana.png" alt="Dogoteka| Dilan Dog Logo">