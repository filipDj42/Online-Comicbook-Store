<div class="col-md-6">
	<div class="page-header">
		<h2>Registrujte se</h2>
	</div>

	<form method="post" action="registracija.php">
		<?php 
		
		require_once "php/konekcija.php";

		$ime="";
		$prezime="";
		$email="";
		$sifra1="";
		$sifra2="";

			//ako je pokusata registracija,moraju sva polja biti popunjena
		if (isset($_POST["dodaj"])) 
		{
			

			if( (!$_POST["ime"]) || (!$_POST["prezime"]) || (!$_POST["email"]) || (!$_POST["sifra1"]) || (!$_POST["sifra2"]) )
				{?>

					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Morate popuniti sva polja za registraciju!</strong>
					</div>


					<?php
				}
				else
				{	

					$regexImePrezime="/^[A-Z][a-z]+$/";
					

					if(preg_match($regexImePrezime, $_POST["ime"]))
					{
						if (preg_match($regexImePrezime, $_POST["prezime"])) 
						{

							$upitINSERT = "INSERT INTO users (ime,prezime,email,sifra,status) VALUES ('". $_POST["ime"]."','".
							$_POST["prezime"]."','".
							$_POST["email"]."','". 
							$_POST["sifra1"] 
							."','0')" ;

						//provera da li je korisnik uneo obe sifre identicno
							if ($_POST["sifra1"] === $_POST["sifra2"]) 
								$rezINS = $konekcija ->query($upitINSERT);
							else
								$rezINS=false;


							if($rezINS){

								?>


								<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>Uspešno ste se registrovali!</strong>Možete se ulogovati sa Vašim podacima.
								</div>

								<?php 
							} else{
								?>


								<div class="alert alert-warning alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>Neuspešna registracija!</strong>Proverite da li ste ispravno uneli šifru i druge podatke.
								</div>

								<?php
							}
						}
						else
						{
							?>


							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Neuspešno!</strong> Ime i prezime ne smeju sadržati brojeve i znakove i moraju počinjati velikim slovom.
							</div>

							<?php
						}
					}
					else
					{
						?>


						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Neuspešno!</strong> Ime i prezime ne smeju sadržati brojeve i znakove i moraju počinjati velikim slovom.
						</div>

						<?php
					}	
				}
			}
			?>


			<div class="form-group">
				<label for="ime">Vaše ime</label>
				<input type="text" class="form-control" id="ime"  name="ime" value="<?php echo $ime ?>" placeholder="Unesite Vaše ime" required>
			</div>
			<div class="form-group">
				<label for="prezime">Vaše prezime</label>
				<input type="text" class="form-control" id="prezime"  name="prezime" value="<?php echo $prezime?>" placeholder="Unesite Vaše prezime" required>
			</div>
			<div class="form-group">
				<label for="email">Vaš E-mail</label>
				<input type="email" maxlength="20" class="form-control" id="email"  name="email" value="<?php echo $email ?>" placeholder="Unesite Vaš E-mail" required>
			</div>

			<div class="form-group">
				<label for="sifra1">Šifra</label>
				<input type="password" class="form-control" id="sifra1"  name="sifra1" value="<?php echo $sifra1 ?>" placeholder="Unesite Vašu šifru" required>
			</div>
			<div class="form-group">
				<label for="sifra2">Ponovite šifru</label>
				<input type="password" class="form-control" id="sifra2"  name="sifra2" value="<?php echo $sifra2 ?>" placeholder="Ponovite Vašu šifru" required>
			</div>

			<button type="submit" name="dodaj" value="dodaj" class="btn btn-danger btn-lg btn-block">Registrujte se  <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  </button>
		</div>
	</form>


