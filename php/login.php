<?php

session_start();

include 'database_connection.php';

if(isset($_POST["submit"])) { // Checking if you pressed the submit button on the sign in form
	$email = $_POST["email"];
	$rqt = $databaseConnection->prepare("SELECT username FROM users WHERE email = :mail");
	$rqt->bindValue(":mail", $email);

	if ($rqt->execute()) { // If that one returns true it means the request worked, hurray!

		if ($rqt->rowCount() > 0) { // Checking if the account exists
			$username = $rqt->fetch();
			$rqt = $databaseConnection->prepare("SELECT password FROM users WHERE username = :user");
			$rqt->bindValue(":user", $username[0]);

			if ($rqt->execute()) {
				$hash = $rqt->fetch();
				$password = $_POST["password"];

				if (password_verify($password, $hash[0])) {
					$_SESSION["logged"] = true;
					$_SESSION["user"] = $username[0];
					header("Location: ../index.php");

				} else {
					$_SESSION["err"] = "Password incorrect";
					header("Location: ../log_in.php");
				}
			} else {
				$_SESSION["err"] = "Could not log you in... Sorry!";
				header("Location: ../log_in.php");
			}
		} else {
			$_SESSION["err"] = "This username does not exist";
			header("Location: ../log_in.php");
		}
	} else { // In case the SQL fails...
		$_SESSION["err"] = "Could not log you in... Sorry!";
		header("Location: ../log_in.php");
	}
}

?>