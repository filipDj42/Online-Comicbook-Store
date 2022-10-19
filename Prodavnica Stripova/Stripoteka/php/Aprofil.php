<article>
	<form method="post" action="profil.php">

		<?php 
		
		require_once "php/konekcija.php";

		$ime="";
		$prezime="";
		$email="";
		$sifra="";
		$sifraNova="";
		$sifraNovaPonovo="";

		if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) 
		{
			$upitPodaci="SELECT * FROM users WHERE email LIKE('".$_SESSION["mail"]."')";

			$rezProfil=$konekcija->query($upitPodaci);

			if (!$rezProfil)
			{
				echo "<h1>GRESKA</h1><br>";
			}
			else
			{
				$user = $rezProfil->fetch_assoc();
				$ime=$user["ime"];
				$prezime=$user["prezime"];
				$email=$user["email"];
				$sifra=$user["sifra"];
			}

			$sifraNova="";
			$sifraNovaPonovo="";

			if (isset($_POST["promeniLozinku"])) 
			{
				if($_POST["stariPass"]=== $sifra)
				{
					if($_POST["noviPass"] === $_POST["noviPassPonovo"])
					{
						$upitPromenaSifre = "UPDATE users SET sifra = '" . $_POST["noviPass"] . "' WHERE email = '".$email."'";

						$rezPromene= $konekcija ->query($upitPromenaSifre);

						if(!$rezPromene)
						{
							?>

							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Neuspešna promena šifre!</strong>Proverite da li ste uneli ispravno podatke.
							</div>

							<?php
						}
						else
							{?>
								<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>Uspešna promena šifre!</strong>Pri sledećoj prijavi unesite novu šifru.
								</div>
								<?php
							}
						}
						else
						{
							?>

							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Neuspešna promena šifre!</strong>Proverite da li ste uneli ispravno podatke.
							</div>

							<?php
						}
					}
					else
						{?>
							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong>Pogrešna šifra!</strong>Uneli ste neispravnu lozinku.
							</div>
							<?php
						}
					}
				}
				?>


				<div class="row">
					<div class="col-md-6">
						<div class="page-header">
							<h2>Vaši podaci</h2>
						</div>
						<div class="form-group">
							<label for="ime">Vaše ime</label>
							<input type="text" class="form-control" id="ime"  name="ime" value="<?php echo $ime ?>" readonly>
						</div>
						<div class="form-group">
							<label for="ime">Vaše Prezime</label>
							<input type="text" class="form-control" id="prezime"  name="prezime" value="<?php echo $prezime ?>" readonly>
						</div>
						<div class="form-group">
							<label for="ime">Vaš E-mail</label>
							<input type="text" class="form-control" id="mail"  name="mail" value="<?php echo $email ?>" readonly>
						</div>
					</div>

					<div class="col-md-6">
						<div class="page-header">
							<h2>Promena lozinke</h2>
						</div>

						<div class="form-group">
							<label for="stariPass">Stara lozinka</label>
							<input type="password" class="form-control" id="stariPass"  name="stariPass" value="" required>
						</div>
						<div class="form-group">
							<label for="noviPass">Nova lozinka</label>
							<input type="password" class="form-control" id="noviPass"  name="noviPass" value="" required>
						</div>
						<div class="form-group">
							<label for="noviPassPonovo">Ponovite novu lozinku</label>
							<input type="password" class="form-control" id="noviPassPonovo"  name="noviPassPonovo" value="" required>
						</div>
						<button type="submit" name="promeniLozinku" value="promeniLozinku" class="btn btn-danger btn-lg btn-block">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>  Promeni lozinku  </button>
						</form>
					</div>
				</div>
			</article>
			<img style="justify-content: center; width: 100%" id="donjaSlika" src="img/Sajt/dilanDonjaStrana.png" alt="Dogoteka| Dilan Dog Logo">