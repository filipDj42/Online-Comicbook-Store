		<div class="omotac">
			<nav class="navbar navbar-default"> 
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Početna Strana</a> 	
					</div> 
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a href="ODilanu.php"> <span class="glyphicon glyphicon-education" aria-hidden="true"></span> O Dilanu<span class="sr-only">(current)</span></a>
							</li>
							<li><a href="galerija.php"> <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Galerija</a></li>
							<li><a href="prodavnica.php"> <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Prodavnica</a></li>
						</ul>
						<form  class="navbar-form navbar-left" method="post" action="prodavnicas.php">
							<div id="divSearchTab"  class="form-group">

								<input type="text" class="form-control" id="poljeSEARCH" name="poljeSEARCH" placeholder="Ime stripa" maxlength="20">
							</div>
							<button  type="submit" name="pretragaDugme" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true" ></span></button>
						</form>
						<ul class="nav navbar-nav navbar-right">
							<img src="img/moon.png" name="slikaModa" id="ikonaMod">
							<?php 
							session_start();

							if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) 
							{
								if($_SESSION["status"]==1)
								{
									echo '<li class="dropdown">
									<a id="profilID" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">'.$_SESSION["mail"] .'<span class="caret"></span></a>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
									<li><a href="profil.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>   Profil</a></li>';
									echo '<li><a href="korpa.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>   Korpa</a></li>
									<li><a href="listaZelja.php"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>   Lista Želja</a></li>
									<li><a href="racun.php"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>   Porudžbine</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="administrator.php"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span>   Administracija</a></li>
									<li><a href="korisnickiServis.php"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>   Korisnički servis</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="php/logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>   Logout</a></li>
									</ul>
									</li>';
								}
								else
								{
									echo '<li class="dropdown">
									<a id="profilID" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">'.$_SESSION["mail"] .'<span class="caret"></span></a>
									<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
									<li><a href="profil.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>   Profil</a></li>';
									echo '<li><a href="korpa.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>   Korpa</a></li>
									<li><a href="listaZelja.php"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span>   Lista Želja</a></li>
									<li><a href="racun.php"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>   Porudžbine</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="php/logout.php"><span class="glyphicon glyphicon-off" aria-hidden="true"></span>   Logout</a></li>
									</ul>
									</li>';

								}


								//DODAVANJE U KORPU
								

							} else {
								echo '<li><a href="registracija.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>   Prijava</a></li>';
							}

							?>
							<li id="kontaktCSS"><a href="kontakt.php"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>   Kontakt</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>

		

