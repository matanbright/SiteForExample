<?php
	if(isset($_POST['submit'])) {
		include_once '../databaseConnect.php';
		$userName = mysqli_real_escape_string($databaseConnect, $_POST['userName']);
		$password = mysqli_real_escape_string($databaseConnect, $_POST['password']);
		$passwordRepeat = mysqli_real_escape_string($databaseConnect, $_POST['passwordRepeat']);
		$privateName = mysqli_real_escape_string($databaseConnect , $_POST['privateName']);
		$familyName = mysqli_real_escape_string($databaseConnect , $_POST['familyName']);
		$emailAddress = mysqli_real_escape_string($databaseConnect, $_POST['emailAddress']);
		if(empty($userName) || empty($password) || empty($passwordRepeat) || empty($emailAddress))
			setcookie("registeration_status", "One or more of the required fields are empty!", time() + 10, "/");
		elseif($password!==$passwordRepeat)
			setcookie("registeration_status", "Passwords do not match!", time() + 10, "/");
		elseif(!preg_match("/([a-zA-Z0-9])/", $userName) || strlen($userName) <= 2)
			setcookie("registeration_status", "The user name must be in english letters and numbers only and its length must be 3 or above!", time() + 10, "/");
		elseif(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL))
			setcookie("registeration_status", "Invalid email address!", time() + 10, "/");
		else {
			$sql = "SELECT * FROM users WHERE user_name='$userName'";
			$result = mysqli_query($databaseConnect, $sql);
			$rowNum = mysqli_num_rows($result);
			if($rowNum > 0)
				setcookie("registeration_status", "The user name already exists!", time() + 10, "/");
			else {
				$hashPass = password_hash($password, PASSWORD_DEFAULT);
				$sql = "INSERT INTO users (user_name, password, private_name, family_name, email_address) VALUES('$userName', '$hashPass', '$privateName', '$familyName', '$emailAddress')";
				$result = mysqli_query($databaseConnect, $sql);
				setcookie("registeration_status", "The registration was successful!", time() + 10, "/");
			}
		}
		header('Location: ' . $_SERVER["HTTP_REFERER"]);
	}
	exit();
?>
