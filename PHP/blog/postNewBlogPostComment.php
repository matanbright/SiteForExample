<?php
	session_start();
	if(isset($_POST['submit'])) {
		include_once '../databaseConnect.php';
		$blogPostNumber = mysqli_real_escape_string($databaseConnect, $_POST['blogPostNumber']);
		$blogPostCommentTitle = mysqli_real_escape_string($databaseConnect, $_POST['blogPostCommentTitle']);
		$blogPostCommentContent = mysqli_real_escape_string($databaseConnect, $_POST['blogPostCommentContent']);
		if(empty($blogPostCommentTitle) || empty($blogPostCommentContent))
			setcookie("blogPostCommentPosting_status", "One or more of the required fields are empty!", time() + 10, "/");
		else if (strlen($blogPostCommentTitle) > 50 || strlen($blogPostCommentContent) > 250)
			setcookie("blogPostCommentPosting_status", "One or more of the fields exceed the length limit!", time() + 10, "/");
		else {
			$sql = "INSERT INTO blog_posts_comments (blog_post_comment_blog_post_number, blog_post_comment_user_account_number, blog_post_comment_title, blog_post_comment_content) VALUES(" . $blogPostNumber . ", " . $_SESSION['userAccountNumber'] . ", '" . $blogPostCommentTitle . "', '" . $blogPostCommentContent . "')";
			$result = mysqli_query($databaseConnect, $sql);
			setcookie("blogPostCommentPosting_status", "The posting was successful!", time() + 10, "/");
		}
		header('Location: ' . $_SERVER["HTTP_REFERER"] . "#form_blogPostCommentPosting");
	}
	exit();
?>
