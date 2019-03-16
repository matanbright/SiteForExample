<!--//////////////////////////////////////////////////// HIDDEN STATIC CONTENT ///////////////////////////////////////////////////-->
			<?php
				if (!isset($_SESSION['userAccountNumber'])) {
					echo
						'<div id="div_registerationPopUp">
							<div id="div_registerationWindow">
								<div id="div_registerationWindowTitle">
									<img class="imageButton_close" src="resources/images/closeButton.png" onclick="toggleDivVisibility(\'div_registerationPopUp\');" alt="closeButton" />
									<h2 style="text-align:center">Register</h2>
								</div>
								<div id="div_registerationWindowContent">';
					if (isset($_COOKIE['registeration_status'])) {
						if ($_COOKIE['registeration_status'] == 'The registration was successful!')
							echo '<p style="color:black; background-color:#96ff9b; font-weight:bold; text-align:center;">' . $_COOKIE['registeration_status'] . '</p>';
						else
							echo '<p style="color:black; background-color:#ff9696; font-weight:bold; text-align:center;">' . $_COOKIE['registeration_status'] . '</p>';
					} else
						echo '<br />';
					echo			'<br />
									<form id="form_registeration" method="POST" action="PHP/users/register.php">
										<table>
											<tr>
												<td><p><span style="color:red">*</span> User name:</p></td>
												<td class="tableData_registerationInput"><input class="form-control" type="text" name="userName" /></td>
											</tr>
										</table>
										<br />
										<table>
											<tr>
												<td><p><span style="color:red">*</span> Password:</p></td>
												<td class="tableData_registerationInput"><input class="form-control" type="password" name="password" /></td>
											</tr>
										</table>
										<br />
										<table>
											<tr>
												<td><p><span style="color:red">*</span> Password repeat:</p></td>
												<td class="tableData_registerationInput"><input class="form-control" type="password" name="passwordRepeat" /></td>
											</tr>
										</table>
										<br />
										<br />
										<table>
											<tr>
												<td><p>  Private name:</p></td>
												<td class="tableData_registerationInput"><input class="form-control" type="text" name="privateName" /></td>
											</tr>
										</table>
										<br />
										<table>
											<tr>
												<td><p>  Family name:</p></td>
												<td class="tableData_registerationInput"><input class="form-control" type="text" name="familyName" /></td>
											</tr>
										</table>
										<br />
										<table>
											<tr>
												<td><p><span style="color:red">*</span> Email address:</p></td>
												<td class="tableData_registerationInput"><input class="form-control" type="text" name="emailAddress" /></td>
											</tr>
										</table>
										<br />
										<br />
										<p style="color:red">* Required fields</p>
										<button class="btn btn-success btn-block" name="submit">Register</button>
									</form>
								</div>
							</div>
						</div>';
				}
				
				
				if (isset($_SESSION['userAccountNumber'])) {
					include_once 'PHP/databaseConnect.php';
					$sql = "SELECT * FROM users WHERE user_account_number=" . $_SESSION['userAccountNumber'];
					$result = mysqli_query($databaseConnect, $sql);
					$row = mysqli_fetch_assoc($result);
					echo
						'<div id="div_accountUpdatePopUp">
							<div id="div_accountUpdateWindow">
								<div id="div_accountUpdateWindowTitle">
									<img class="imageButton_close" src="resources/images/closeButton.png" onclick="toggleDivVisibility(\'div_accountUpdatePopUp\');" alt="closeButton" />
									<h2 style="text-align:center">Update account</h2>
								</div>
								<div id="div_accountUpdateWindowContent">';
					if (isset($_COOKIE['accountUpdate_status'])) {
						if ($_COOKIE['accountUpdate_status'] == 'Account details were updated successfully!')
							echo '<p style="color:black; background-color:#96ff9b; font-weight:bold; text-align:center;">' . $_COOKIE['accountUpdate_status'] . '</p>';
						else
							echo '<p style="color:black; background-color:#ff9696; font-weight:bold; text-align:center;">' . $_COOKIE['accountUpdate_status'] . '</p>';
					} else
						echo '<br />';
					echo			'<br />
									<form id="form_accountUpdate" method="POST" action="PHP/users/updateAccount.php">
										<table>
											<tr>
												<td><p>  Private name:</p></td>
												<td class="tableData_accountUpdateInput"><input class="form-control" type="text" name="privateName" value="' . $row['private_name'] . '" /></td>
											</tr>
										</table>
										<br />
										<table>
											<tr>
												<td><p>  Family name:</p></td>
												<td class="tableData_accountUpdateInput"><input class="form-control" type="text" name="familyName" value="' . $row['family_name'] . '" /></td>
											</tr>
										</table>
										<br />
										<table>
											<tr>
												<td><p>  Email address:</p></td>
												<td class="tableData_accountUpdateInput"><input class="form-control" type="text" name="emailAddress" value="' . $row['email_address'] . '" /></td>
											</tr>
										</table>
										<hr />
										<table>
											<tr>
												<td><p><span style="color:red">*</span> User name:</p></td>
												<td class="tableData_accountUpdateInput"><input class="form-control" type="text" name="userName" value="' . $row['user_name'] . '" /></td>
											</tr>
										</table>
										<br />
										<table>
											<tr>
												<td><p>  New password:</p></td>
												<td class="tableData_accountUpdateInput"><input class="form-control" type="password" name="password" placeholder="Unchanged" /></td>
											</tr>
										</table>
										<br />
										<table>
											<tr>
												<td><p>  Password repeat:</p></td>
												<td class="tableData_accountUpdateInput"><input class="form-control" type="password" name="passwordRepeat" placeholder="Unchanged" /></td>
											</tr>
										</table>
										<hr />
										<table>
											<tr>
												<td><p><span style="color:red">*</span><b> Current password:</b></p></td>
												<td class="tableData_accountUpdateInput"><input class="form-control" type="password" name="currentPassword" /></td>
											</tr>
										</table>
										<br />
										<br />
										<p style="color:red">* Required fields</p>
										<table>
											<tr>
												<td style="width:80%"><button class="btn btn-success btn-block" name="submit">Update</button></td>
												<td><input class="btn btn-link btn-xs" type="button" value="Delete account" onclick="toggleDivVisibility(\'div_accountDeletionConfirmationPopUp\');" style="color:red" /></td>
											</tr>
										</table>
									</form>
								</div>
							</div>
						</div>';
				}
				
				
				if (isset($_SESSION['userAccountNumber'])) {
					echo
						'<div id="div_accountDeletionConfirmationPopUp">
							<div id="div_accountDeletionConfirmationWindow">
								<div id="div_accountDeletionConfirmationWindowTitle">
									<img class="imageButton_close" src="resources/images/closeButton.png" onclick="toggleDivVisibility(\'div_accountDeletionConfirmationPopUp\');" alt="closeButton" />
									<h2 style="text-align:center">Delete account</h2>
								</div>
								<div id="div_accountDeletionConfirmationWindowContent">';
					if (isset($_COOKIE['accountDeletionConfirmation_status']))
						echo '<p style="color:black; background-color:#ff9696; font-weight:bold; text-align:center;">' . $_COOKIE['accountDeletionConfirmation_status'] . '</p>';
					else
						echo '<br />';
					echo			'<br />
									<p style="text-align:center; margin-bottom:0px">Delete your account?</p>
									<p style="font-size:13px; text-align:center; color:red">This action can not be undone!</p>
									<br />
									<form id="form_accountDeletion" method="POST" action="PHP/users/deleteAccount.php">
										<table>
											<tr>
												<td><p>Current password:</p></td>
												<td class="tableData_accountDeletionInput"><input class="form-control" type="password" name="currentPassword" /></td>
											</tr>
										</table>
										<br />
										<br />
										<table style="width:40%; margin:auto;">
											<tr>
												<td><input class="btn btn-primary btn-block" type="button" value="Cancel" onclick="toggleDivVisibility(\'div_accountDeletionConfirmationPopUp\');" /></td>
												<td><button name="submit" class="btn btn-danger btn-block">Accept</button></td>
											</tr>
										</table>
									</form>
								</div>
							</div>
						</div>';
				}
			?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
		</div>
		<script src="JS/script_global.js"></script>
		<script src="JS/script_shoppingCart.js"></script>
		<script>updatePricesAndQuantities();</script>
	</body>
</html>
