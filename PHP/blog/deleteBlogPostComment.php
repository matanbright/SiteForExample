<?php
	session_start();
	if(isset($_POST['submit'])) {
		include_once '../databaseConnect.php';
		$blogPostCommentNumber = mysqli_real_escape_string($databaseConnect, $_POST['blogPostCommentNumber']);
		$sql = "DELETE FROM blog_posts_comments WHERE blog_post_comment_number = " . $blogPostCommentNumber;
		mysqli_query($databaseConnect, $sql);
		header('Location: ' . $_SERVER["HTTP_REFERER"]);
	}
	exit();
?>
