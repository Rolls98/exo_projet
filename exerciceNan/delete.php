<?php
	include 'database.php';

	$db = database::connexion();

	$id = $_GET['id'];

	$continent = $_GET['continent'];

	$del = $db->prepare("DELETE FROM habitants WHERE id=?");

	$del->execute(array($id));

	header("location: habitants-1.php?id=$continent");
?>