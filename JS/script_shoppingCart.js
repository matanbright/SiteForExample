///////////////////////////////////////////////////////////// Methods /////////////////////////////////////////////////////////////
function updatePricesAndQuantities() {
	var cookieValue = getCookieValue('shoppingCart_data');
	if (cookieValue != null) {
		var splittedCookieValueArray = cookieValue.split(',');
		var cookieNewValue = '';
		var priceSum = 0;
		var quantitySum = 0;
		var paragraph_purchaseTotalPrice = document.getElementById('paragraph_purchaseTotalPrice');
		var span_shoppingCartItemsCount_MOBILE = document.getElementById('span_shoppingCartItemsCount_MOBILE');
		var span_shoppingCartItemsCount_DESKTOP = document.getElementById('span_shoppingCartItemsCount_DESKTOP');
		for (i = 0; i < splittedCookieValueArray.length - 1; i++) {
			var itemIdFromCookie = parseInt(splittedCookieValueArray[i].split('*')[0]);
			var itemQuantityFromCookie = parseInt(splittedCookieValueArray[i].split('*')[1]);
			var paragraph_productQuantity = document.getElementById('paragraph_productQuantity' + itemIdFromCookie);
			var input_productPrice = document.getElementById('input_productPrice' + itemIdFromCookie);
			var paragraph_productPurchasePrice = document.getElementById('paragraph_productPurchasePrice' + itemIdFromCookie);
			paragraph_productQuantity.innerHTML = itemQuantityFromCookie;
			var productPurchasePrice = parseFloat(input_productPrice.value) * itemQuantityFromCookie;
			priceSum += productPurchasePrice;
			quantitySum += itemQuantityFromCookie;
			paragraph_productPurchasePrice.innerHTML = productPurchasePrice + "$";
		}
		paragraph_purchaseTotalPrice.innerHTML = 'Total price: ' + priceSum + "$";
		span_shoppingCartItemsCount_MOBILE.innerHTML = quantitySum;
		span_shoppingCartItemsCount_DESKTOP.innerHTML = quantitySum;
	}
}

function incrementShoppingCartItemQuantity(productId) {
	var cookieValue = getCookieValue('shoppingCart_data');
	if (cookieValue != null) {
		var splittedCookieValueArray = cookieValue.split(',');
		var cookieNewValue = '';
		for (i = 0; i < splittedCookieValueArray.length - 1; i++) {
			var itemIdFromCookie = splittedCookieValueArray[i].split('*')[0];
			var itemQuantityFromCookie = splittedCookieValueArray[i].split('*')[1];
			if (itemIdFromCookie == productId)
				cookieNewValue += itemIdFromCookie + '*' + (parseInt(itemQuantityFromCookie) + 1) + ',';
			else
				cookieNewValue += splittedCookieValueArray[i] + ',';
		}
		addSelfDestroyCookie('shoppingCart_data', cookieNewValue, 2592000000); // 2,592,000,000ms = 30days
	}
	updatePricesAndQuantities();
}

function decrementShoppingCartItemQuantity(productId) {
	var cookieValue = getCookieValue('shoppingCart_data');
	if (cookieValue != null) {
		var splittedCookieValueArray = cookieValue.split(',');
		var cookieNewValue = '';
		for (i = 0; i < splittedCookieValueArray.length - 1; i++) {
			var itemIdFromCookie = splittedCookieValueArray[i].split('*')[0];
			var itemQuantityFromCookie = splittedCookieValueArray[i].split('*')[1];
			if (itemIdFromCookie == productId && itemQuantityFromCookie > 1)
				cookieNewValue += itemIdFromCookie + '*' + (parseInt(itemQuantityFromCookie) - 1) + ',';
			else
				cookieNewValue += splittedCookieValueArray[i] + ',';
		}
		addSelfDestroyCookie('shoppingCart_data', cookieNewValue, 2592000000); // 2,592,000,000ms = 30days
	}
	updatePricesAndQuantities();
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
