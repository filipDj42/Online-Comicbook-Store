<article>
	<form method="post" action="otvaranjeRacuna.php" target="_blank">

		<?php 

		require_once "php/konekcija.php";

		$upitSVIrac ="SELECT * FROM racuni WHERE korisnikMail LIKE ('".$_SESSION["mail"]."') ORDER BY datumRacuna";

		$rezultatSVIrac = $konekcija ->query($upitSVIrac);

		$redrac= $rezultatSVIrac ->fetch_assoc();

		if (!$redrac) 
		{
			echo '<div class="col-md-12">
			<div class="jumbotron"><br><br>
			<h2>Poštovani,još uvek ništa niste poručili!</h2><br><br>
			<div class="col-md-4">
			<p><a class="btn btn-danger btn-lg btn-block" href="prodavnica.php" role="button">&larr;   Nazad na prodavnicu</a></p>
			</div>
			</div>
			</div>';
		}
		else
		{
			echo '<div class="col-md-12">
			<div class="panel panel-default">
			<div class="panel-heading"><h3><center>Sve Vaše porudžbine</center></h3></div>
			<div class="panel-body">';
			echo '<table id="svePorudzbineKorisnik" class="table  table-bordered" style="text-align: center;"><thead>
			<tr>				
			<th style="text-align: center;">Id porudžbine</th>
			<th style="text-align: center;">Datum porudžbine</th> 
			<th style="text-align: center;">Akcija</th> 
			</tr></thead>';
			do
			{

				echo '<tbody align="center">'. "<tr>" .
				"<td>" . $redrac["racunID"] . "</td>".
				"<td>" . $redrac["datumRacuna"] . "</td>".
				'<td  align="center"><button type="submit" name="prikaziRacun" value="'.$redrac["lokacijaRacuna"].'" class="btn btn-danger btn-sm">Otvori</button></td>'.
				"</tr>";

			}
			while($redrac = $rezultatSVIrac ->fetch_assoc());

			echo "</tbody></table></div>
			</div>";

			echo '<div class="col-md-12">
			<div class="col-md-3">
			<p><a class="btn btn-danger btn-lg btn-block" href="prodavnica.php" role="button">&larr;  Nazad na prodavnicu</a></p>
			</div>';
		}	
		?>
		<br><br>
	</form>
</article>
<img style="justify-content: center; width: 100%" id="donjaSlika" src="img/Sajt/dilanDonjaStrana.png" alt="Dogoteka| Dilan Dog Logo">
