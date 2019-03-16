							<td id="tableData_pageContent">
								<div id="div_pageNavigationGuide">
<!--//////////////////////////////////////////////////// PAGE NAVIGATION GUIDE ///////////////////////////////////////////////////-->
									<p><a href="index.php">Homepage</a> > Products catalog</p>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
								</div>
								<div id="div_pageContent">
<!--//////////////////////////////////////////////////////// PAGE CONTENT ////////////////////////////////////////////////////////-->
									<h1>Products catalog</h1>
									<hr />
									<div id="div_catalogArea">
										<?php
											include_once 'PHP/databaseConnect.php';
											include_once 'PHP/shoppingCart/functions_shoppingCart.php';
											$sql = "SELECT * FROM products";
											$result = mysqli_query($databaseConnect, $sql);
											while ($row = mysqli_fetch_assoc($result)) {
												echo
													'<div class="div_product">
														<table>
															<tr style="vertical-align:top">
																<td style="width:40%; border-right:1px solid;"><img src="' . $row['product_image_url'] . '" alt="product1" style="max-width:100%; max-height:100%;" /></td>
																<td style="padding:10px;">
																	<h4 style="color:#0f4f95; text-decoration:underline; font-weight:bold;">' . $row['product_name'] . '</h4>
																	<p>' . $row['product_description'] . '</p>
																	<p><span style="text-decoration:underline; font-weight:bold;">Price:</span> ' . $row['product_price'] . '$</p>
																	<br />';
												if (!isItemAlreadyInShoppingCart($row['product_number']))
													echo
																	'<form class="form_addItemToShoppingCart" method="POST" action="PHP/shoppingCart/addItemToShoppingCart.php">
																		<button class="btn btn-sm btn-success" name="submit" style="position:absolute; right:5px; bottom:5px;">Add to shopping cart</button>
																		<input type="hidden" name="productNumber" value="' . $row['product_number'] . '" />
																	</form>';
												else
													echo
																	'<p style="position:absolute; right:5px; bottom:5px; margin:0px; color:gray;">Item is in shopping cart</p>';
												echo			'</td>
															</tr>
														</table>
													</div>';
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
