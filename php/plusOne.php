<?php
session_start();

include 'database_connection.php';
/*
$id = $_POST["id"];

$rqt = $databaseConnection->prepare('UPDATE messages SET plusone = plusone + 1 WHERE ID = :id');
$rqt->bindValue(":id", $id);
$rqt->execute();
*/

if($_POST['id'])
{
	$id = $_POST['id'];
	$sql = "UPDATE messages SET plusone = plusone + 1 WHERE ID = '$id'";
	$sql = $databaseConnection->prepare($sql);
	$sql->execute();
}
?>