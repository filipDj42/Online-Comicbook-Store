<?php 
require_once "php/konekcija.php"; 
 ?>


<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"><h3>Svi Korisnici</h3></div>
		<div class="panel-body">


			<table id="sviKorisniciADMIN"  class="table" border="1">

				<?php 

				$upitSviKorisnici="SELECT * FROM users ORDER BY idKorisnika";

				$rezultatSviKorisnici = $konekcija ->query($upitSviKorisnici);
				$rezRed= $rezultatSviKorisnici ->fetch_assoc();

				if (!$rezRed) 
				{
					echo "<tr>Trenutno nema ni jedan korisnik<tr>";
				}
				else
				{
					echo '<thead><tr>
					<th style="text-align: center;">Id</th>
					<th style="text-align: center;">Ime</th>
					<th style="text-align: center;">Prezime</th> 
					<th style="text-align: center;">Email</th> 
					

					</tr></thead>';
					do
					{

						echo "<tbody align='center'><tr>" . "<td>" . $rezRed["idKorisnika"] . "</td>" .
						"<td>" . $rezRed["ime"] . "</td>".
						"<td>" . $rezRed["prezime"] . "</td>" . 
						"<td>" . $rezRed["email"] . "</td>" .
						"</tr>";

					}
					while($rezRed = $rezultatSviKorisnici ->fetch_assoc());

					echo "</tbody>";
				}

				?>
			</table>
		</div>
	</div>
</div>




<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"><h3>Sve Porudžbine</h3></div>
		<div class="panel-body">
			<form method="post" action="otvaranjeRacuna.php" target="_blank">

				<table id="svePorudzbineADMIN" class="table" border="1">

					<?php 

					$upitSviRacuni="SELECT * FROM racuni ORDER BY racunID";

					$rezultatSviRacuni = $konekcija ->query($upitSviRacuni);
					$rezRac= $rezultatSviRacuni ->fetch_assoc();

					if (!$rezRac) 
					{
						echo "<tr>Trenutno nema ni jedna porudžbina.<tr>";
					}
					else
					{
						echo '<thead><tr>
						<th style="text-align: center;">ID porudžbine</th>
						<th style="text-align: center;">Datum porudžbine</th>
						 
						<th style="text-align: center;">Poručeno od strane</th> 
						<th style="text-align: center;">Akcija</th> 

						</tr></thead>';
						do
						{

							echo "<tbody align='center'><tr>" . "<td>" . $rezRac["racunID"] . "</td>" .
							"<td>" . $rezRac["datumRacuna"] . "</td>". 
							"<td>" . $rezRac["korisnikMail"] . "</td>" . 
							'<td  align="center"><button type="submit" name="prikaziRacun" value="'.$rezRac["lokacijaRacuna"].'" class="btn btn-danger btn-sm">Otvori</button></td>'.
							"</tr>";

						}
						while($rezRac = $rezultatSviRacuni ->fetch_assoc());
						echo "</tbody>";
					}

					?>
				</table>

			</form>
		</div>
	</div>
</div>


<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading"><h3>Svi Mailovi <small>  ( Nakon otvaranja poruke ista se briše jer smatramo da je taj zahtev obrađen! )</small></h3></div>
		<div class="panel-body">
			<form method="post" action="otvaranjeMaila.php" target="_blank">

				<table id="sviMailoviADMIN" class="table" border="1">

					<?php 

					$upitSviMailovi="SELECT * FROM poruke ORDER BY porukaID";

					$rezultatSvePoruke = $konekcija ->query($upitSviMailovi);
					$rezPor= $rezultatSvePoruke ->fetch_assoc();

					if (!$rezPor) 
					{
						echo "<tr>Trenutno nema ni jedna poruka od korisnika.<tr>";
					}
					else
					{
						echo '<thead><tr>
						<th style="text-align: center;">ID poruke</th>
						<th style="text-align: center;">Datum poruke</th>
						<th style="text-align: center;">Poslato od strane</th> 
						<th style="text-align: center;">Akcija</th> 

						</tr><thead>';
						do
						{

							echo "<tbody align='center'><tr>" . "<td>" . $rezPor["porukaID"] . "</td>" .
							"<td>" . $rezPor["datumPoruke"] . "</td>".
							"<td>" . $rezPor["imePoruke"] . "</td>" .'<input type="hidden" name="idPorukeSakriveno" value="'.$rezPor["porukaID"].'"/>'.
							'<td  align="center"><button type="submit" name="prikaziPoruku" value="'.$rezPor["lokacijaPoruke"].'" class="btn btn-danger btn-sm">Otvori</button></td>'.
							"</tr>";

						}
						while($rezPor = $rezultatSvePoruke ->fetch_assoc());
						echo '</tbody>';
					}

					?>
				</table>

			</form>
		</div>
	</div>
</div>