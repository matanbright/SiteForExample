			<main>
				<div id="div_main">
					<table id="table_main">
						<tr id="tableRow_topToolbar_MOBILE">
							<td id="tableData_topToolbar_MOBILE" colspan="2">
								<div id="div_topTootbar_MOBILE">
									<span id="span_topToolbarHamburgerButton_MOBILE" class="glyphicon glyphicon-menu-hamburger" onclick="toggleDivVisibility('div_collapsableToolbarContent_MOBILE')"></span>
									<?php
										if (!isset($_SESSION['userAccountNumber']))
											echo '<p style="color:white; font-size:22px; margin:0px;"> Login/Register</p>';
										else
											echo '<p style="color:white; font-size:22px; margin:0px;"> ' . $_SESSION['userName'] . '</p>';
									?>
									<div id="div_collapsableToolbarContent_MOBILE">
										<div id="div_loginArea_MOBILE">
											<?php
												if (!isset($_SESSION['userAccountNumber'])) {
													echo
														'<form id="form_login_MOBILE" method="POST" action="PHP/users/login.php">
															<table>
																<tr>
																	<td style="width:15%"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span></td>
																	<td><input class="form-control" type="text" name="userName" placeholder="User name" style="height:100%; width:100%; border-radius:0px" /></td>
																</tr>
																<tr>
																	<td style="width:15%"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span></td>
																	<td><input class="form-control" type="password" name="password" placeholder="Password" style="height:100%; width:100%; border-radius:0px" /></td>
																</tr>
															</table>
															<table>
																<tr>
																	<td><input class="btn btn-sm btn-primary btn-block" type="button" value="Register" onclick="toggleDivVisibility(\'div_registerationPopUp\');" style="border-radius:0px" /></td>
																	<td><button class="btn btn-sm btn-primary btn-block" name="submit" style="border-radius:0px">Login</button></td>
																</tr>
															</table>
														</form>';
													if (isset($_COOKIE['login_status']))
														echo '<p style="color:black; background-color:#ff9696; font-weight:bold; margin:0px; text-align:center;">' . $_COOKIE['login_status'] . '</p>';
												} else {
													echo
														'<div id="div_loginAreaWelcomeMessage_MOBILE">
															<p style="text-align:center">Welcome, ' . $_SESSION['userName'] . '</p>
														</div>
														<form id="form_logout_MOBILE" method="POST" action="PHP/users/logout.php">
															<table>
																<tr>
																	<td><button class="btn btn-sm btn-primary btn-block" name="submit" style="border-radius:0px">Logout</button><td>
																	<td><input class="btn btn-sm btn-default btn-block" type="button" value="Update account" onclick="toggleDivVisibility(\'div_accountUpdatePopUp\');" style="border-radius:0px" /></td>
																</tr>
															</table>
														</form>';
												}
											?>
										</div>
										<div id="div_shoppingCart_MOBILE">
											<p style="font-size:17px; margin:0px;">
												<?php
													if (!isset($_COOKIE['shoppingCart_data']))
														echo 'There are no items in shopping cart';
													else {
														include_once 'PHP/shoppingCart/functions_shoppingCart.php';
														echo
															'There are <span id="span_shoppingCartItemsCount_MOBILE">' . getShoppingCartItemsCount() . '</span> items in shopping cart
															<br />
															<a href="shoppingCart.php">Continue to shopping cart</a>';
													}
												?>
											</p>
										</div>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td id="tableData_sideToolbar_DESKTOP">
								<div id="div_sideTootbar_DESKTOP">
									<div id="div_loginArea_DESKTOP">
										<?php
											if (!isset($_SESSION['userAccountNumber'])) {
												echo
													'<form id="form_login_DESKTOP" method="POST" action="PHP/users/login.php">
														<table>
															<tr>
																<td style="width:15%"><span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span></td>
																<td><input class="form-control" type="text" name="userName" placeholder="User name" style="height:100%; width:100%; border-radius:0px" /></td>
															</tr>
															<tr>
																<td style="width:15%"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span></td>
																<td><input class="form-control" type="password" name="password" placeholder="Password" style="height:100%; width:100%; border-radius:0px" /></td>
															</tr>
														</table>
														<table>
															<tr>
																<td><input class="btn btn-sm btn-primary btn-block" type="button" value="Register" onclick="toggleDivVisibility(\'div_registerationPopUp\');" style="border-radius:0px" /></td>
																<td><button class="btn btn-sm btn-primary btn-block" name="submit" style="border-radius:0px">Login</button></td>
															</tr>
														</table>
													</form>';
												if (isset($_COOKIE['login_status']))
													echo '<p style="color:black; background-color:#ff9696; font-weight:bold; margin:0px; text-align:center;">' . $_COOKIE['login_status'] . '</p>';
											} else {
												echo
													'<div id="div_loginAreaWelcomeMessage_DESKTOP">
														<p style="text-align:center">Welcome, ' . $_SESSION['userName'] . '</p>
													</div>
													<form id="form_logout_DESKTOP" method="POST" action="PHP/users/logout.php">
														<table>
															<tr>
																<td><button class="btn btn-sm btn-primary btn-block" name="submit" style="border-radius:0px">Logout</button><td>
																<td><input class="btn btn-sm btn-default btn-block" type="button" value="Update account" onclick="toggleDivVisibility(\'div_accountUpdatePopUp\');" style="border-radius:0px" /></td>
															</tr>
														</table>
													</form>';
											}
										?>
									</div>
									<div id="div_shoppingCart_DESKTOP">
										<p style="font-size:17px; margin:0px;">
											<?php
												if (!isset($_COOKIE['shoppingCart_data']))
													echo 'There are no items in shopping cart';
												else {
													include_once 'PHP/shoppingCart/functions_shoppingCart.php';
													echo
														'There are <span id="span_shoppingCartItemsCount_DESKTOP">' . getShoppingCartItemsCount() . '</span> items in shopping cart
														<br />
														<a href="shoppingCart.php">Continue to shopping cart</a>';
												}
											?>
										</p>
									</div>
								</div>
							</td>
