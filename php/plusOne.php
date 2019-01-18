<?php
session_start();

include 'database_connection.php';

if($_POST['id']) {
	$id = $_POST['id'];
	$sql = "UPDATE messages SET plusone = plusone + 1 WHERE ID = '$id'";
	$sql = $databaseConnection->prepare($sql);
	$sql->execute();
}
?>