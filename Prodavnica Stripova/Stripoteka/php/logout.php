<?php
session_start();
session_destroy();// unistavanje sesije
header('Location: //localhost/Stripoteka/index.php');