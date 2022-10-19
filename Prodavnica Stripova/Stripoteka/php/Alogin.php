<div class="col-md-6">
	<div class="page-header">
		<h2>Ulogujte se</h2>
	</div>

	<form  method="post" action="registracija.php">
		<?php 

		require_once "php/konekcija.php";


		$emailLog="";
		$sifraLog="";
		$status=0;

		if (isset($_POST["login"])) 
		{
			$emailLog=$_POST["loginMail"];
			$sifraLog=$_POST["loginSifra"];

			$upitLogin = "SELECT * FROM users WHERE email LIKE '" . $_POST["loginMail"] . "' AND sifra LIKE '".$_POST["loginSifra"] . "'";

			$rezLOG = $konekcija ->query($upitLogin);

			$rez = $rezLOG->fetch_assoc();

			

			if ($rezLOG->num_rows > 0) 
			{
				$status=$rez["status"];

				$_SESSION["loggedin"] = true;
				$_SESSION["mail"] = $emailLog;
				$_SESSION["status"]=$status;
				if(!$status==true)
				{?>
					<script type="text/javascript">
						window.location.href = "prodavnica.php";
					</script>
					
					<?php
				}
				else
				{?>
					<script type="text/javascript">
						window.location.href = "index.php";
					</script>
					
					<?php
				}
				
			} 
			else 
				{?>

					<div class="alert alert-warning alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Neuspešna prijava!</strong> Proverite da li ste ispravno uneli šifru i e-mail.
					</div>

					<?php
				}			
			}
			$konekcija->close();

			?>
			<div class="form-group">
				<label for="loginMail">Vaš E-mail</label>
				<input type="email" class="form-control" id="loginMail" name="loginMail" placeholder="Unesite Vaš E-mail" required>
			</div>
			<div class="form-group">
				<label for="loginSifra">Vaša Šifra</label>
				<input type="password" class="form-control" id="loginSifra" name="loginSifra" placeholder="Unesite Vašu šifru" required>
			</div>
			<button type="submit" name="login" value="login" class="btn btn-danger btn-lg btn-block">  Ulogujte se <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span></button>
		</form>
	</div>
