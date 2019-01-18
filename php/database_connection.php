<?php
try {
    $databaseConnection = new PDO('mysql:host=localhost;dbname=microblog', 'root', '');
    $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    $e->getMessage();
}

if (isset($_GET["page"])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}
$limite = 5;

$debut = ($page - 1) * $limite;

$rqt = 'SELECT SQL_CALC_FOUND_ROWS * FROM messages ORDER BY -date LIMIT :limite OFFSET :debut';
$rqt = $databaseConnection->prepare($rqt);
$rqt->bindValue('limite', $limite, PDO::PARAM_INT);
$rqt->bindValue('debut', $debut, PDO::PARAM_INT);
$rqt->execute();

$resultFoundRows = $databaseConnection->query('SELECT found_rows()');
$nombredElementsTotal = $resultFoundRows->fetchColumn();

$nombreDePages = ceil($nombredElementsTotal / $limite);
?>