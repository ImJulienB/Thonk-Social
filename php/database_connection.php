<?php
try {
    $databaseConnection = new PDO('mysql:host=localhost;dbname=microblog', 'root', '');
    $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    $e->getMessage();
}

$rqt = $databaseConnection->prepare('SELECT * FROM messages ORDER BY -date');
$rqt->execute();
?>