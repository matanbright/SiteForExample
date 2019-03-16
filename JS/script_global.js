///////////////////////////////////////////////////////////// Methods /////////////////////////////////////////////////////////////
function toggleDivVisibility(divId) {
	var div = document.getElementById(divId);
	if (div.style.display == "")
		div.style.display = "block";
	else
		div.style.display = "";
}

function getCookieValue(cookieName) {
	var cookiesArray = (decodeURIComponent(document.cookie)).split("; ");
	for (i = 0; i < cookiesArray.length; i++) {
		var cookieDetailsArray = cookiesArray[i].split("=");
		if (cookieDetailsArray[0] == cookieName)
			return cookieDetailsArray[1];
	}
	return null;
}

function addCookie(cookieName, value) {
	document.cookie = cookieName + '=' + encodeURIComponent(value);
}

function addSelfDestroyCookie(cookieName, value, durationInMiliseconds) {
	var currentDate = new Date();
	currentDate.setTime(currentDate.getTime() + durationInMiliseconds);
	document.cookie = cookieName + '=' + encodeURIComponent(value) + '; expires=' + currentDate.toGMTString();
}

function deleteCookie(cookieName) {
	document.cookie = cookieName + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT';
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////// Events //////////////////////////////////////////////////////////////
window.onload = function(event) {
	if (getCookieValue("login_status") != null) {
		toggleDivVisibility("div_collapsableToolbarContent_MOBILE");
		deleteCookie("login_status");
	}
	if (getCookieValue("registeration_status") != null) {
		toggleDivVisibility("div_registerationPopUp");
		deleteCookie("registeration_status");
	}
	if (getCookieValue("accountUpdate_status") != null) {
		toggleDivVisibility("div_accountUpdatePopUp");
		deleteCookie("accountUpdate_status");
	}
	if (getCookieValue("accountDeletionConfirmation_status") != null) {
		toggleDivVisibility("div_accountUpdatePopUp");
		toggleDivVisibility("div_accountDeletionConfirmationPopUp");
		deleteCookie("accountDeletionConfirmation_status");
	}
	if (getCookieValue("order_status") != null)
		deleteCookie("order_status");
	if (getCookieValue("blogPostCommentPosting_status") != null)
		deleteCookie("blogPostCommentPosting_status");
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
