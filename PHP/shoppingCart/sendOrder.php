<?php
	$status = '';
	if(isset($_POST['submit'])) {
		if (empty($_POST['fullName']) || empty($_POST['emailAddress'])) {
			setcookie("order_status", "One or more of the required fields are empty!", time() + 10, "/");
			$status = 'order=empty';
		} elseif (!empty($_POST['phoneNumber']) && !preg_match("/([0-9])/", $_POST['phoneNumber'])) {
			setcookie("order_status", "Invalid phone number!", time() + 10, "/");
			$status = 'order=invalidPhoneNumber';
		} else {
			$targetMail = "matana0000@gmail.com";
			$message_title = "Message from Sics site";
			$message_content = "Book order notification" . "\n" . "\n";
			$message_content .= "Full name: " . $_POST['fullName'] . "\n";
			$message_content .= "Email address: " . $_POST['emailAddress'] . "\n";
			$message_content .= "Phone number: " . $_POST['phoneNumber'] . "\n";
			$message_content .= "Notes: " . $_POST['notes'] . "\n";
			$message_content .= "Purchase type: " . $_POST['purchaseType'];
			if (mail($targetMail, $message_title, $message_content)) {
				setcookie("order_status", "The order was sent successfully!", time() + 10, "/");
				$status = 'order=success';
			} else {
				setcookie("order_status", "The order was not sent! Please try again.", time() + 10, "/");
				$status = 'order=sendFail';
			}
		}
	}
	header('Location: ' . $_SERVER["HTTP_REFERER"] . "#form_order");
	exit();
?>
