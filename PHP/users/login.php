<?php
	session_start();
	if(isset($_POST['submit'])) {
		include_once '../databaseConnect.php';
		$userName = mysqli_real_escape_string($databaseConnect, $_POST['userName']);
		$password = mysqli_real_escape_string($databaseConnect, $_POST['password']);
		if(empty($userName) || empty($password))
			setcookie("login_status", "You need to enter user name and password!", time() + 10, "/");
		else {
			$sql = "SELECT * FROM users WHERE user_name='$userName'";
			$result = mysqli_query($databaseConnect, $sql);
			$checkRow = mysqli_num_rows($result);
			if($checkRow == 0)
				setcookie("login_status", "User name was not found!", time() + 10, "/");
			elseif($row = mysqli_fetch_assoc($result)) {
				$hashPass = password_verify($password, $row['password']);
				if(!$hashPass)
					setcookie("login_status", "Wrong password!", time() + 10, "/");
				else {
					$_SESSION['userAccountNumber'] = $row['user_account_number'];
					$_SESSION['userName'] = $row['user_name'];
				}
			}
		}
		header('Location: ' . $_SERVER["HTTP_REFERER"]);
	}
	exit();
?>
