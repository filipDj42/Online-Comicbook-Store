<?php 
require_once "php/konekcija.php"; 
?>

<div class="row">

	<!-- SVI STRIPOVI -->
	<div class="col-md-12">
		<div class="panel panel-default" >
			<div class="panel-heading"><h3>Svi stripovi</h3></div>
			<div class="panel-body">


				<table id="sviStripoviADMIN" class="table" border="1">

					<?php 

					$idSVI="";
					$imeStripaSVI="";
					$brojStripaSVI="";
					$cenaStripaSVI="";
					$kategorijaStripaSVI="";

					$upitSVI="SELECT * FROM stripovi ORDER BY id";

					$rezultatSVI = $konekcija ->query($upitSVI);
					$red= $rezultatSVI ->fetch_assoc();

					if (!$red) 
					{
						echo "<tr>Trenutno nema ni jedan strip<tr>";
					}
					else
					{
						echo '<thead ><tr>
						<th style="text-align: center;">Id</th>
						<th style="text-align: center;">Ime</th> 
						<th style="text-align: center;">Broj</th> 
						<th style="text-align: center;">Cena</th>
						<th style="text-align: center;">Kategorija</th>
						</tr></thead>';
						do
						{

							echo "<tbody align='center'><tr>" .
							"<td>" . $red["id"] . "</td>".
							"<td>" . $red["imeStripa"] . "</td>" . 
							"<td>" . $red["brojStripa"] . "</td>" . 
							"<td>" . $red["cenaStripa"] . "</td>" . 
							"<td>" . $red["kategorijaStripa"] . "</td>" .
							"</tr>";

						}
						while($red = $rezultatSVI ->fetch_assoc());

						echo "</tbody>";
					}

					?>
				</table>
			</div>
		</div>
	</div>






	<!-- DODAVANJE NOVIH STRIPOVA -->
	<div class="col-md-12">

		<div class="page-header">
			<h2>Dodavanje novih stripova</h2>

		</div>
		<div class="jumbotron">

			<form enctype="multipart/form-data"  method="post" action="administrator.php"><br><br>


				<?php

				$imeUPLOAD="";
				$brojUPLOAD="";
				$cenaUPLOAD="";
				$kategorijaUPLOAD="";

				if(isset($_POST['uploadDugme']))
				{

					if (isset($_FILES["dugmeZaUpload"])) 
					{


						if ($_FILES["dugmeZaUpload"] ["type"] == "image/jpeg")
						{
							$izvor = $_FILES["dugmeZaUpload"] ["tmp_name"];

							$cilj = "ProdavnicaSlike/" . $_FILES["dugmeZaUpload"] ["name"];

							move_uploaded_file($izvor, $cilj);

							$putanjaSlike=$cilj;

							if( (!$_POST["poljeBrojUPL"]) || (!$_POST["poljeCenaUPL"]) || (!$_POST["poljeImeUPL"]))
							{
								echo "Morate popuniti sva polja za upload";
							}
							else
							{
								$upitINSERT = "INSERT INTO stripovi (brojStripa, imeStripa, cenaStripa, kategorijaStripa, slikaStripa) VALUES ('" . 
								$_POST["poljeBrojUPL"] . "','" . $_POST["poljeImeUPL"] . "','". $_POST["poljeCenaUPL"] . "','" . $_POST["radio"]."','" . $putanjaSlike."')" ;

								if (!$rezINS = $konekcija ->query($upitINSERT)) 
								{

									echo "Ne moze se izvrsiti INSERT funkcija!";
								}
								else
								{
									echo "Strip upisan u bazu!";

								}
							}

						}
						else
						{
							echo "Greska!";
						}
					}

				}

				?>

				<div class="col-md-4">
					<label>Izaberite kategoriju:<br><br>

						<label><input type="radio" name="radio" value="redovno"> Redovno<br></label><br>
						<label><input type="radio" name="radio" value="specijal"> Specijal<br></label><br>
						<label><input type="radio" name="radio" value="knjiga"> Knjiga<br></label>
					</label>
					<br><br>
				</div>

				<div class="col-md-3">
					<label for="poljeBrojUPL">Broj stripa</label>
					<input type="text"  id="poljeBrojUPL"  name="poljeBrojUPL" value=""><br>
					<label for="poljeCenaUPL">Cena stripa </label>
					<input type="text"  id="poljeCenaUPL" name="poljeCenaUPL"  value=""><br>
					<label for="poljeImeUPL">Ime stripa </label>
					<input type="text"  id="poljeImeUPL" name="poljeImeUPL"   value=""><br>
				</div>

				<div class="col-md-4">
					<label for="poljeSlika">Slika stripa</label>
					<input type="hidden" name="max_file_size" value="102400">
					<input type="file" name="dugmeZaUpload" required ><br><br> 
					<input type="submit" class="btn btn-danger btn-lg btn-block" name="uploadDugme" value="Dodajte strip">
				</div>
			</form>
		</div>
	</div>





	<div class="col-md-12">
		<div class="page-header">
			<h2>Ažuriranje postojećih stripova</h2>
		</div>
		<div class="jumbotron">
			<form name="formaUPDATE" method="post" action="administrator.php"><br>

				<?php 



				$brojStripaUPD="";
				$imeStripaUPD="";
				$cenaStripaUPD="";
				$idUPD="";
				$kategorijaStripaUPD="";


					//PRVO PRETRAGA PO ID
				if (isset($_POST["pretragaUPD"])) 
				{
					$upitSRCupd = "SELECT * FROM stripovi WHERE id LIKE '".$_POST["poljeIdUPD"]."' ";
					$rezultatSRCupd = $konekcija ->query($upitSRCupd);

					if(!($rez = $rezultatSRCupd->fetch_assoc()))
					{
						?>

						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Neuspešna pretraga!</strong>   Nema stripova sa datim id-om.
						</div>

						<?php
					}
					else
					{
						$idUPD=$rez["id"];
						$imeStripaUPD=$rez["imeStripa"];
						$brojStripaUPD=$rez["brojStripa"];
						$cenaStripaUPD=$rez["cenaStripa"];
						$kategorijaStripaUPD=$rez["kategorijaStripa"];
					}
				}

				if (isset($_POST["azuriraj"]))
				{


					if((!$_POST["novoImeUPD"]) || (!$_POST["novoBrojUPD"]) || (!$_POST["novoCenaUPD"]))
					{
						?>

						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Neuspešno!</strong>Morate popuniti sva polja za ažuriranje.
						</div>

						<?php

					}
					else
					{
						$upitUPDATE = "UPDATE stripovi SET 
						brojStripa = '" . $_POST["novoBrojUPD"] . "',
						imeStripa = '" . $_POST["novoImeUPD"] . "',
						cenaStripa = '" . $_POST["novoCenaUPD"] . "'
						WHERE id = '" . $_POST["poljeIdUPD"] . "'";

						$rezUPD = $konekcija ->query($upitUPDATE);

						if(!$rezUPD)
						{
							?>

							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Neuspešno!</strong>Neuspešno ažuriranje.
							</div>

							<?php
						}
						else
							{?>
								<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>Uspešno!</strong>Uspešno ste ažurirali strip.
								</div>

								<?php
							}
						}



					}
					?>

					<div class="col-md-6">

						<label for="poljeImeUPD">Trenutno ime </label>
						<input type="text"  id="poljeImeUPD" name="poljeImeUPD" readonly value="<?php echo $imeStripaUPD ?>"><br><br>

						<label for="poljeBrojUPD">Trenutan broj </label>
						<input type="text"  id="poljeBrojUPD" name="poljeBrojUPD" readonly value="<?php echo $brojStripaUPD ?>"><br><br>

						<label for="poljeCenaUPD">Trenutna cena </label>
						<input type="text"  id="poljeCenaUPD" name="poljeCenaUPD" readonly value=" <?php echo $cenaStripaUPD ?>"><br><br>

						<input type="text"  id="poljeIdUPD" name="poljeIdUPD" placeholder="Upišite ID stripa" value="<?php echo $idUPD ?>" required>&nbsp;&nbsp;&nbsp;<input class="dugme" type="submit" name="pretragaUPD" value="Nađi stip po ID-u"><br><br> 

					</div>



					<div class="col-md-6"> 
						<label for="novoImeUPD">Novo ime </label>
						<input type="text"  id="novoImeUPD" name="novoImeUPD"  value=""><br><br>
						<label for="novoBrojUPD">Novi broj </label>
						<input type="text"  id="novoBrojUPD" name="novoBrojUPD"  value=""><br><br>
						<label for="novoCenaUPD">Nova cena </label>
						<input type="text"  id="novoCenaUPD" name="novoCenaUPD"  value=""><br><br>
						<div class="col-md-4">
							<input class="btn btn-danger btn-lg btn-block" type="submit" name="azuriraj" value="Ažuriraj">
						</div>
					</div>

				</form>

			</div>
		</div>























































		<!-- BRISANJE I AZURIRANJE STRIPOVA -->

		<div class="col-md-12">
			<div class="page-header">
				<h2>Brisanje postojećih stripova</h2>
			</div>
			<div class="jumbotron">
				<form name="formaDELETE" method="post" action="administrator.php"><br>

					<?php 




					$idDEL="";
					$brojStripaDEL="";
					$imeStripaDEL="";
					$cenaStripaDEL="";
					$kategorijaStripaDEL="";

					if (isset($_POST["pretragaDEL"])) 
					{

						foreach($_POST["polje"] as $izbor) 
						{

						}
						$upitSRCdel = "SELECT * FROM stripovi WHERE $izbor LIKE '" . $_POST["poljeDEL"] . "' ";

						$rezultatSRCdel = $konekcija ->query($upitSRCdel);

						if (!($rezuDEL = $rezultatSRCdel ->fetch_assoc())) 
						{
							?>

							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Neuspešna pretraga!</strong>   Nema stripova sa datim podatkom.
							</div>

							<?php
						}
						else
						{
							$idDEL=$rezuDEL["id"];
							$imeStripaDEL=$rezuDEL["imeStripa"];
							$brojStripaDEL=$rezuDEL["brojStripa"];
							$cenaStripaDEL=$rezuDEL["cenaStripa"];
							$kategorijaStripaDEL=$rezuDEL["kategorijaStripa"];
							$slikaStripa=$rezuDEL["slikaStripa"];
						}




					}
					if(isset($_POST["brisi"]))
					{

						$upitDEL = "DELETE  FROM stripovi WHERE id LIKE '".$_POST["poljeIdDEL"]."'";

						$upitSlika="SELECT slikaStripa FROM stripovi WHERE id LIKE '".$_POST["poljeIdDEL"]."'";

						$rezSlika=$konekcija->query($upitSlika);
						$rezuSlika=$rezSlika->fetch_assoc();
						$slika=$rezuSlika["slikaStripa"];
						unlink($slika);

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
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Uspešno!</strong>Uspešno ste obrisali strip.
							</div>

							<?php
						}

					}

					?>

					<div class="col-md-6">
						<select id="izborID" name="polje[]">
							<option value="id">Id Stripa</option>
							<option value="imeStripa">Ime Stripa</option>
						</select>

						<input type="text"  id="poljeDEL" name="poljeDEL" value="<?php echo $idDEL ?>" required>&nbsp;&nbsp;&nbsp;&nbsp;
						<input class="dugme" type="submit" name="pretragaDEL" value="Nađi strip"><br><br><br>
						<strong><input class="btn btn-danger btn-lg btn-block" type="submit" name="brisi" value="Obriši"></strong>
						
					</div>
					<div class="col-md-6" align="center">
						<label for="poljeIdDEL">Id stripa </label>
						<input type="text"  id="poljeIdDEL" name="poljeIdDEL" readonly value="<?php echo $idDEL ?>">
						<br><br>
						<label for="poljeImeDEL">Ime stripa </label>
						<input type="text"  id="poljeImeDEL" name="poljeImeDEL" readonly value="<?php echo $imeStripaDEL ?>">
						<br><br>
						<label for="poljeBrojDEL">Broj stripa </label>
						<input type="text"  id="poljeBrojDEL" name="poljeBrojDEL" readonly value="<?php echo $brojStripaDEL ?>">
						<br><br>
						<label for="poljeCenaDEL">Cena stripa </label>
						<input type="text"  id="poljeCenaDEL" name="poljeCenaDEL" readonly value=" <?php echo $cenaStripaDEL ?>">
					</div>
				</form>
			</div>
		</div>


	</div>

</div>