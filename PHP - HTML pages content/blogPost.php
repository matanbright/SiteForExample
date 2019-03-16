							<td id="tableData_pageContent">
								<div id="div_pageNavigationGuide">
<!--//////////////////////////////////////////////////// PAGE NAVIGATION GUIDE ///////////////////////////////////////////////////-->
									<p><a href="index.php">Homepage</a> > <a href="blog.php">Blog</a> > Blog post</p>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
								</div>
								<div id="div_pageContent">
<!--//////////////////////////////////////////////////////// PAGE CONTENT ////////////////////////////////////////////////////////-->
									<?php
										include_once 'PHP/databaseConnect.php';
										$blogPostNumber = mysqli_real_escape_string($databaseConnect, $_GET['blogPostNumber']);
										if (!is_numeric($blogPostNumber))
											$blogPostNumber = -1;
										$sql = "SELECT * FROM blog_posts WHERE blog_post_number = " . $blogPostNumber;
										$result = mysqli_query($databaseConnect, $sql);
										$row = mysqli_fetch_assoc($result);
										if (mysqli_num_rows($result) == 0) {
											echo
												'<br />
												<p style="color:gray; text-align:center">Blog post does not exist!</p>';
										} else {
											echo
												'<div id="div_blogPostBody">
													<div id="div_blogPostBodyTitle">
														<table>
															<tr><td colspan="2"><h6>Blog post #' . $row['blog_post_number'] . '</h6></td></tr>
															<tr>
																<td><h3>' . $row['blog_post_title'] . '</h3></td>
																<td><h6 style="float:right;">' . $row['blog_post_time_stamp'] . '</h6></td>
															</tr>
														</table>
													</div>
													<br />
													<div id="div_blogPostBodyContent">
														<p>' . $row['blog_post_content'] . '</p>
													</div>
												</div>';
										}
									?>
									<hr />
									<h5 style="text-align:center;">Comments</h5>
									<?php
										if (mysqli_num_rows($result) == 0) {
											echo
												'<br />
												<p style="color:gray; text-align:center">Error!</p>';
										} else {
											$sql2 = "SELECT * FROM blog_posts_comments WHERE blog_post_comment_blog_post_number = " . $blogPostNumber;
											$result2 = mysqli_query($databaseConnect, $sql2);
											if (mysqli_num_rows($result2) == 0) {
												echo
													'<br />
													<p style="color:gray; text-align:center">There are no comments!</p>';
											} else {
												while ($row2 = mysqli_fetch_assoc($result2)) {
													$blogPostContent = $row['blog_post_content'];
													$sql3 = "SELECT user_name FROM users WHERE user_account_number = " . $row2['blog_post_comment_user_account_number'];
													$result3 = mysqli_query($databaseConnect, $sql3);
													$blogPostCommentUserName = mysqli_fetch_array($result3)[0];
													echo
														'<br />
														<div class="div_blogPostComment">
															<div class="div_blogPostCommentTitle">
																<table>
																	<tr>
																		<td><h5 style="font-weight:bold;">' . $row2['blog_post_comment_title'] . '</h5></td>
																		<td>
																			<table>
																				<tr><td><h6 style="float:right; margin-bottom:1px">' . $row2['blog_post_comment_time_stamp'] . '</h6></td></tr>
																				<tr><td><h6 style="float:right; margin-top:1px">' . $blogPostCommentUserName . '</h6></td></tr>
																			</table>
																		</td>
																	</tr>
																</table>
															</div>
															<div class="div_blogPostCommentContent">
																<p>' . $row2['blog_post_comment_content'] . '</p>
															</div>';
													if (isset($_SESSION['userAccountNumber'])) {
														if ($_SESSION['userAccountNumber'] == $row2['blog_post_comment_user_account_number']) {
															echo
																'<form class="form_blogPostCommentDeletion" method="POST" action="PHP/blog/deleteBlogPostComment.php">
																	<input class="form-control" type="hidden" name="blogPostCommentNumber" value="' . $row2['blog_post_comment_number'] . '" />
																	<button class="btn btn-danger" name="submit" style="float:right;">Delete comment</button>
																</form>';
														}
													}
													echo
														'</div>';
												}
											}
										}
									?>
									<br />
									<br />
									<h5 style="text-align:center;">Post a new comment</h5>
									<div id="div_blogPostCommentPostingArea">
										<?php
											if (mysqli_num_rows($result) == 0) {
												echo
													'<br />
													<p style="color:gray; text-align:center">Error!</p>';
											} else {
												if (!isset($_SESSION['userAccountNumber'])) {
													echo
														'<br />
														<p style="color:gray; text-align:center">Please login or register to comment on the blog post</p>';
												} else {
													if (isset($_COOKIE['blogPostCommentPosting_status'])) {
														if ($_COOKIE['blogPostCommentPosting_status'] == 'The posting was successful!')
															echo '<p style="color:black; background-color:#96ff9b; font-weight:bold; text-align:center;">' . $_COOKIE['blogPostCommentPosting_status'] . '</p>';
														else
															echo '<p style="color:black; background-color:#ff9696; font-weight:bold; text-align:center;">' . $_COOKIE['blogPostCommentPosting_status'] . '</p>';
														echo '<br />';
													}
													echo
														'<br />
														<form id="form_blogPostCommentPosting" method="POST" action="PHP/blog/postNewBlogPostComment.php">
															<table>
																<tr>
																	<td>
																		<table>
																			<tr><td><p style="margin-bottom:1px;"><span style="color:red;">*</span> Comment title:</p></td></tr>
																			<tr><td><h6 style="margin-top:1px;">   Up to 50 characters</h6></td></tr>
																		</table>
																	</td>
																	<td class="tableData_orderInput"><input class="form-control" type="text" name="blogPostCommentTitle" style="width:100%;" /></td>
																</tr>
															</table>
															<br />
															<table>
																<tr>
																	<td>
																		<table>
																			<tr><td><p style="margin-bottom:1px;"><span style="color:red;">*</span> Comment content:</p></td></tr>
																			<tr><td><h6 style="margin-top:1px;">   Up to 250 characters</h6></td></tr>
																		</table>
																	</td>
																	<td class="tableData_blogPostCommentInput"><input class="form-control" type="text" name="blogPostCommentContent" style="width:100%;" /></td>
																</tr>
															</table>
															<br />
															<br />
															<p style="color:red">* Required fields</p>
															<input class="form-control" type="hidden" name="blogPostNumber" value="' . $row['blog_post_number'] . '" />
															<button class="btn btn-success btn-block" name="submit">Post</button>
														</form>';
												}
											}
										?>
									</div>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
								</div>
							</td>
						</tr>
					</table>
				</div>
			</main>
