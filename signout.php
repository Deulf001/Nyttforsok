<?php
include 'connect.php';
include 'header.php';

    session_start(); //startar sessionen (måste alltid göras)
	session_destroy(); //dödar sessionen och loggar ut.
	echo "Du har nu loggats ut. Välkommen tillbaka!";
	header('location:index.php'); //redirectar tillbaka till index.php
	exit();

include 'footer.php';
?>