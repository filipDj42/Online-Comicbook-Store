<article>
	<form method="post" action="korpa.php">
		<?php 

		require_once "php/konekcija.php";

		$moze="disabled";

		$upitSVI="SELECT * FROM korpe WHERE korisnikMail LIKE('".$_SESSION["mail"]."') ORDER BY idArtikla";

		$rezultatSVI = $konekcija ->query($upitSVI);
		$red= $rezultatSVI ->fetch_assoc();

		if (!$red) 
		{
			echo '<div class="col-md-12">



			<div class="jumbotron"><br><br>
			<h2>Poštovani,trenutno Vam je korpa prazna!</h2><br><br>
			<div class="col-md-4">
			<p><a class="btn btn-danger btn-lg btn-block" href="prodavnica.php" role="button">&larr;  Nazad na prodavnicu</a></p>
			</div>
			</div>
			</div>';


		}
		else
		{
			$moze="";
			$UKUPNO=300;
			echo '<div class="col-md-12">
			<div class="panel panel-default">
			<div class="panel-heading"><h3><center>Vaša Korpa</center></h3></div>
			<div class="panel-body">';


			echo '<table id="korisnikKorpa" class="table table-bordered" style="text-align: center;">
			<thead><tr>				
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
				"<td>1</td>" .'<input type="hidden" name="idArtiklaSakriveno" value="'.$red["idArtikla"].'"/>'.
				'<td  align="right"><input type="submit" name="BrisiKorpa" value="Ukloni" class="btn btn-danger btn-md"></td>'.
				"</tr>";

				$UKUPNO+=$red["cenaArtikla"];
				$korisnik=$red["korisnikMail"];
				

			}
			while($red = $rezultatSVI ->fetch_assoc());

			echo '<tr><td>Poštarina</td><td colspan="1" align="center">300</td></tr></tbody></table>
			';
			$novik=$korisnik;



			echo '<table id="ukupnoTabela" class="table">
			<tr>
			<td colspan="2" align="right"><h3><strong>Total</strong></h3></td>
			<td colspan="1" align="right"><h2>'.$UKUPNO.'<small style="color:black;">.00</small> dinara</h2></td>
			</tr> 
			</table></div></div>';

			//OVDE DODATI TOTAL I DUGME ZA NASTAVAK PORUDZBINE, KADA SE NASTAVI NA PORUDZBINU PRVO IDE ADRESA I TO ONDA RACUN KONACNO
			


			if (isset($_POST["BrisiKorpa"])) 
			{
				$upitDEL = "DELETE  FROM korpe WHERE idArtikla LIKE '".$_POST["idArtiklaSakriveno"]."'";

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
				{
					?>
					<script type="text/javascript">
						window.location.href = "korpa.php";
					</script>
					
					<?php
				}	
			}


		}

		?>
		<br><br>
	</form>

	<form method="post" action="porudzbina.php">

		<div class="col-md-6">
			<div class="form-group">
				<input type="hidden"  name="korisnik" value="<?php echo $novik ?>">
				<label for="adresa"> Unesite Vašu adresu  <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></label>
				<input type="text" class="form-control" id="adresa" <?php echo $moze ?>  name="adresaG" placeholder="Unesite Grad" required><br>
				<input type="text" class="form-control" <?php echo $moze ?>  name="adresaU" placeholder="Unesite Ulicu i broj" required>
			</div>
			<div class="form-group">
				<label for="telefon">Unesite Vaš broj telefona  <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></label>
				<input type="text" class="form-control" id="telefon" <?php echo $moze ?>  name="telefon" placeholder="Unesite Vaš broj telefona" required>
			</div>
		</div>
		<br><br><br>
		<div class="col-md-6">
			<button  type="submit" name="poruci" value="porudzbina.php" <?php echo $moze ?> class="btn btn-danger btn-lg btn-block">PORUČI  <span class="glyphicon glyphicon-send" aria-hidden="true"></span></button>
		</div>
	</form>


</article>
<img style="justify-content: center; width: 100%" id="donjaSlika" src="img/Sajt/dilanDonjaStrana.png" alt="Dogoteka| Dilan Dog Logo">
