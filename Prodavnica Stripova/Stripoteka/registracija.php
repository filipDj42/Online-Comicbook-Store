<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="author" content="Filip Djokovic">
	<meta name="description" content="Stripoteka je sajt namenjen za sve ljubitelje Dilan Dog stripa">
	<meta name="keywords" content="Stripoteka | Dilan | Dylan | Dog | strip | comicbook | shop | prodavnica | online | prodaja|">

	<title>Stripoteka</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/all.min.css" rel="stylesheet">
	<link href="css/mojIzgled.css" rel="stylesheet">
	<link id="idStila" href="css/mojstilLight.css" rel="stylesheet">

</head>



<body id="registracija">


	<div class="container">
		<?php 
		include "php/header.php";
		include "php/navBar.php";
		
		?>
		<div class="row">
		<?php 
			include "php/Aregistracija.php";
			include "php/Alogin.php";
		?>

		</div>

		<img style="justify-content: center; width: 100%" id="donjaSlika" src="img/Sajt/dilanDonjaStrana.png" alt="Dogoteka| Dilan Dog Logo">

		<?php 
		include "php/footer.php"; 
		?>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/citati.js" ></script>
	<script src="js/promenaModa.js"></script>
</body>
</html>