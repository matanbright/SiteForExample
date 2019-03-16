							<td id="tableData_pageContent">
								<div id="div_pageNavigationGuide">
<!--//////////////////////////////////////////////////// PAGE NAVIGATION GUIDE ///////////////////////////////////////////////////-->
									<p><a href="index.php">Homepage</a> > Blog</p>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
								</div>
								<div id="div_pageContent">
<!--//////////////////////////////////////////////////////// PAGE CONTENT ////////////////////////////////////////////////////////-->
									<h1>Blog</h1>
									<hr />
									<?php
										include_once 'PHP/databaseConnect.php';
										$sql = "SELECT * FROM blog_posts";
										$result = mysqli_query($databaseConnect, $sql);
										if (mysqli_num_rows($result) == 0)
											echo '<p style="color:gray; text-align:center">There are no posts in the blog!</p>';
										else {
											while ($row = mysqli_fetch_assoc($result)) {
												$blogPostContent = $row['blog_post_content'];
												if (strlen($blogPostContent) > 250)
													$blogPostContent = substr($blogPostContent, 0, 250) . "...";
												echo
													'<br />
													<div class="div_blogPost">
														<div class="div_blogPostTitle">
															<table>
																<tr>
																	<td><h4><a href="blogPost.php?blogPostNumber=' . $row['blog_post_number'] . '">' . $row['blog_post_title'] . '</a></h4></td>
																	<td><h6 style="float:right;">' . $row['blog_post_time_stamp'] . '</h6></td>
																</tr>
															</table>
														</div>
														<div class="div_blogPostContent">
															<p>' . $blogPostContent . '</p>
														</div>
													</div>';
											}
										}
									?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
								</div>
							</td>
						</tr>
					</table>
				</div>
			</main>
