<?php
	session_start();
	if (isset($_POST['submit'])) {
		include_once '../databaseConnect.php';
		include_once 'queries_users.php';
		$currentPassword = mysqli_real_escape_string($databaseConnect, $_POST['currentPassword']);
		$row = getUserDetails($databaseConnect, $_SESSION['userAccountNumber'], 'password');
		if (empty($currentPassword))
			setcookie("accountDeletionConfirmation_status", "You need to type your password for confirmation!", time() + 10, "/");
		elseif (!password_verify($currentPassword, $row['password']))
			setcookie("accountDeletionConfirmation_status", "Wrong password!", time() + 10, "/");
		else {
			$sql = "DELETE FROM users WHERE user_account_number=" . $_SESSION['userAccountNumber'];
			$result = mysqli_query($databaseConnect, $sql);
			session_unset();
			session_destroy();
		}
		header('Location: ' . $_SERVER["HTTP_REFERER"]);
	}
	exit();
?>
