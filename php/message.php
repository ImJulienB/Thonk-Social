<?php
session_start();

include 'database_connection.php';

if(isset($_POST["message"])) {
	$message = $_POST["message"];
	if($message != "") {
		if(isset($_POST["username"])) {
			$user = $_POST["username"];
			if($user != "") {
				$rqt = $databaseConnection->prepare("INSERT IGNORE INTO messages (message, user, date) VALUES(:message, :user, NOW())");
				$rqt->bindValue(":message", $message);
				$rqt->bindValue(":user", $user);
				$rqt->execute();
			}
		}
	}
}

if(isset($_GET['a'])) {
	if($_GET['a'] == "sup") {
		if(isset($_GET['id'])) {
			$id = $_GET['id'];
			$rqt = $databaseConnection->prepare("DELETE FROM messages WHERE ID = :id");
			$rqt->bindValue(":id", $id);
			$rqt->execute();
		}
	}
}

if(isset($_POST["msgedit"])) {
	$message = $_POST["msgedit"];
	if($message != "") {
		$id = $_POST["id"];
		$rqt = $databaseConnection->prepare("UPDATE messages SET message = :message WHERE ID = :id");
		$rqt->bindValue(":message", $message);
		$rqt->bindValue(":id", $id);
		$rqt->execute();
	}
}

header("Location: ../index.php");
?>