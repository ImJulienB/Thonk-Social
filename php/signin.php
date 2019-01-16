<?php

session_start();

include 'database_connection.php';

$options = ['cost' => 10,]; // Defining the cost for the password hashing

if(isset($_POST["submit"])) { // Checking if you pressed the submit button on the sign in form
	$email = $_POST["email"];
	$username = $_POST["username"];
	$password = password_hash($_POST["password"], PASSWORD_BCRYPT, $options);
	$rqt = $databaseConnection->prepare("SELECT username FROM users WHERE username = :user");
	$rqt->bindValue(":user", $username);

	if ($rqt->execute()) { // If that one returns true it means the request worked, hurray!

		if ($rqt->rowCount() > 0) { // Checking if the account already exists
			$_SESSION["err"] = "This account already exists";
			header("Location: ../sign_in.php");

		} else { // Great, if it got here that means the account doesn't exist
			$rqt = $databaseConnection->prepare("INSERT INTO users (username, email, password) VALUES (:user, :mail, :pass)");
			$rqt->bindValue(":user", $username);
			$rqt->bindValue(":mail", $email);
			$rqt->bindValue(":pass", $password);

			if ($rqt->execute()) { // Checking if the sign in was successful, if so let's log you in
				$_SESSION["logged"] = true;
				$_SESSION["user"] = $username;
				header("Location: ../index.php");

			} else { // If it got here, sorry that means it didn't work
				$_SESSION["err"] = "Could not sign you in... Sorry!";
				header("Location: ../sign_in.php");
			}
		}
	} else { // In case the SQL fails...
		$_SESSION["err"] = "Could not sign you in... Sorry!";
		header("Location: ../sign_in.php");
	}
}

?>