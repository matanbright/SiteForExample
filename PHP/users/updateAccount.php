<?php
	session_start();
	if (isset($_POST['submit'])) {
		include_once '../databaseConnect.php';
		include_once 'queries_users.php';
		$privateName = mysqli_real_escape_string($databaseConnect , $_POST['privateName']);
		$familyName = mysqli_real_escape_string($databaseConnect , $_POST['familyName']);
		$emailAddress = mysqli_real_escape_string($databaseConnect, $_POST['emailAddress']);
		$userName = mysqli_real_escape_string($databaseConnect, $_POST['userName']);
		$password = mysqli_real_escape_string($databaseConnect, $_POST['password']);
		$passwordRepeat = mysqli_real_escape_string($databaseConnect, $_POST['passwordRepeat']);
		$currentPassword = mysqli_real_escape_string($databaseConnect, $_POST['currentPassword']);
		
		$isNewPasswordEntered = (!empty($password) || !empty($passwordRepeat));
		$row = getUserDetails($databaseConnect, $_SESSION['userAccountNumber'], 'user_name, password');
		if (empty($userName) || empty($currentPassword))
			setcookie("accountUpdate_status", "One or more of the required fields are empty!", time() + 10, "/");
		elseif ($isNewPasswordEntered && $password!==$passwordRepeat)
			setcookie("accountUpdate_status", "Passwords do not match!", time() + 10, "/");
		elseif (!preg_match("/([a-zA-Z0-9])/", $userName) || strlen($userName) <= 2)
			setcookie("accountUpdate_status", "The user name must be in english letters and numbers only and its length must be 3 or above!", time() + 10, "/");
		elseif (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL) && !empty($emailAddress))
			setcookie("accountUpdate_status", "Invalid email address!", time() + 10, "/");
		elseif (!password_verify($currentPassword, $row['password']))
			setcookie("accountUpdate_status", "Wrong password!", time() + 10, "/");
		else {
			if (isUserNameExist($databaseConnect, $userName) && $row['user_name'] != $userName)
				setcookie("accountUpdate_status", "The user name already exists!", time() + 10, "/");
			else {
				$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
				$sql = "";
				if ($isNewPasswordEntered)
					$sql = "UPDATE users SET user_name='$userName', password='$hashedPassword', private_name='$privateName', family_name='$familyName', email_address='$emailAddress' WHERE user_account_number=" . $_SESSION['userAccountNumber'];
				else
					$sql = "UPDATE users SET user_name='$userName', private_name='$privateName', family_name='$familyName', email_address='$emailAddress' WHERE user_account_number=" . $_SESSION['userAccountNumber'];
				$result = mysqli_query($databaseConnect, $sql);
				setcookie("accountUpdate_status", "Account details were updated successfully!", time() + 10, "/");
				$_SESSION['userName'] = $userName;
			}
		}
		header('Location: ' . $_SERVER["HTTP_REFERER"]);
	}
	exit();
?>
