							<td id="tableData_pageContent">
								<div id="div_pageNavigationGuide">
<!--//////////////////////////////////////////////////// PAGE NAVIGATION GUIDE ///////////////////////////////////////////////////-->
									<p><a href="index.php">Homepage</a> > Shopping cart</p>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
								</div>
								<div id="div_pageContent">
<!--//////////////////////////////////////////////////////// PAGE CONTENT ////////////////////////////////////////////////////////-->
									<h1>Shopping cart</h1>
									<hr />
									<div id="div_shoppingCartItemsArea">
										<?php
											if (isset($_COOKIE['shoppingCart_data'])) {
												include_once 'PHP/databaseConnect.php';
												include_once 'PHP/shoppingCart/functions_shoppingCart.php';
												$sql = "SELECT * FROM products WHERE " . getSqlWhereConditionStringOfShoppingCartItems();
												$result = mysqli_query($databaseConnect, $sql);
												echo
													'<table id="table_shoppingCartItems">
														<tr>
															<td style="width:10%; border:1px solid; padding:5px; text-align:center;"><h6>Product image</h6></td>
															<td style="width:50%; border:1px solid; padding:5px; text-align:center;"><h6>Product name</h6></td>
															<td style="width:10%; border:1px solid; padding:5px; text-align:center;"><h6>Price for a unit</h6></td>
															<td style="width:10%; border:1px solid; padding:5px; text-align:center;"><h6>Quantity</h6></td>
															<td style="width:10%; border:1px solid; padding:5px; text-align:center;"><h6>Price for payment</h6></td>
															<td style="border:1px solid; padding:5px; text-align:center;"><h6>Remove</h6></td>
														</tr>';
												while ($row = mysqli_fetch_assoc($result)) {
													echo
															'<tr>
																<td style="width:10%; border:1px solid; padding:5px; text-align:center;"><img src="' . $row['product_image_url'] . '" alt="productImage" style="max-width:100%; max-height:100%;" /></td>
																<td style="width:50%; border:1px solid; padding:5px;"><p style="margin:0px;">' . $row['product_name'] . '</p></td>
																<td style="width:10%; border:1px solid; padding:5px; text-align:center;"><p style="margin:0px;">' . $row['product_price'] . '$</p></td>
																<td style="width:10%; border:1px solid; padding:5px; text-align:center;">
																	<table>
																		<tr>
																			<td><span style="border:1px solid; padding:1px;" onclick="decrementShoppingCartItemQuantity(' . $row['product_number'] . ');"><span class="glyphicon glyphicon-minus"></span></span></td>
																			<td><p id="paragraph_productQuantity' . $row['product_number'] . '" style="margin:0px;">N/A</p></td>
																			<td><span style="border:1px solid; padding:1px;" onclick="incrementShoppingCartItemQuantity(' . $row['product_number'] . ');"><span class="glyphicon glyphicon-plus"></span></span></td>
																		</tr>
																	</table>
																</td>
																<td style="width:10%; border:1px solid; padding:5px; text-align:center;">
																	<input id="input_productPrice' . $row['product_number'] . '" type="hidden" value="' . $row['product_price'] . '" />
																	<p id="paragraph_productPurchasePrice' . $row['product_number'] . '" style="margin:0px;">N/A</p>
																</td>
																<td style="border:1px solid; padding:5px; text-align:center;">
																	<form class="form_deleteItemFromShoppingCart" method="POST" action="PHP/shoppingCart/deleteItemFromShoppingCart.php">
																		<button class="btn btn-sm btn-danger" name="submit">Remove</button>
																		<input type="hidden" name="productNumber" value="' . $row['product_number'] . '" />
																	</form>
																</td>
															</tr>';
												}
												echo
													'</table>
													<form id="form_deleteAllItemsFromShoppingCart" method="POST" action="PHP/shoppingCart/deleteAllItemsFromShoppingCart.php">
														<button class="btn btn-sm btn-danger" name="submit" style="margin-top:10px;">Empty shopping cart</button>
													</form>
													<p id="paragraph_purchaseTotalPrice" style="text-align:left;">Total price: N/A</p>';
											} else {
												echo '<p style="color:gray; text-align:center;">There are no items in shopping cart!</p>';
											}
										?>
									</div>
									<?php
										if (isset($_COOKIE['shoppingCart_data'])) {
											echo
												'<hr />
												<div id="div_orderArea">';
											if (isset($_COOKIE['order_status'])) {
												if ($_COOKIE['order_status'] == 'The order was sent successfully!')
													echo '<p style="color:black; background-color:#96ff9b; font-weight:bold; text-align:center;">' . $_COOKIE['order_status'] . '</p>';
												else
													echo '<p style="color:black; background-color:#ff9696; font-weight:bold; text-align:center;">' . $_COOKIE['order_status'] . '</p>';
												echo '<br />';
											}
											echo	'<form id="form_order" method="POST" action="PHP/shoppingCart/sendOrder.php">
														<table>
															<tr>
																<td><p><span style="color:red">*</span> Full name:</p></td>
																<td class="tableData_orderInput"><input type="text" class="form-control" name="fullName" style="width:100%" /></td>
															</tr>
														</table>
														<br />
														<table>
															<tr>
																<td><p><span style="color:red">*</span> Email address:</p></td>
																<td class="tableData_orderInput"><input type="text" class="form-control" name="emailAddress" style="width:100%" /></td>
															</tr>
														</table>
														<br />
														<table>
															<tr>
																<td><p>  Phone number:</p></td>
																<td class="tableData_orderInput"><input type="text" class="form-control" name="phoneNumber" style="width:100%" /></td>
															</tr>
														</table>
														<br />
														<table>
															<tr>
																<td><p>  Notes:</p></td>
																<td class="tableData_orderInput"><input type="text" class="form-control" name="notes" style="width:100%" /></td>
															</tr>
														</table>
														<br />
														<table>
															<tr style="vertical-align:top">
																<td><p>  Purchase type:</p></td>
																<td class="tableData_orderInput">
																	<table>
																		<tr><td class="tableData_orderInput"><label><input type="radio" name="purchaseType" value="Single purchase" checked /> Single purchase</label></td></tr>
																		<tr><td class="tableData_orderInput"><label><input type="radio" name="purchaseType" value="Bulk purchase" /> Bulk purchase</label></td></tr>
																	</table>
																</td>
															</tr>
														</table>
														<br />
														<br />
														<p style="color:red">* Required fields</p>
														<button class="btn btn-success btn-block" id="button_order" name="submit" onclick="generateCookieOfPurchaseItemsDetails();">Send order request</button>
													</form>
												</div>';
										}
									?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
								</div>
							</td>
						</tr>
					</table>
				</div>
			</main>
