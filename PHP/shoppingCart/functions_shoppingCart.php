<?php
	function addItemToShoppingCart($itemId) {
		if (isset($_COOKIE['shoppingCart_data'])) {
			$cookieValue = $_COOKIE['shoppingCart_data'];
			setcookie("shoppingCart_data", $cookieValue . '' . $itemId . '*1,', time() + 2592000, "/"); // 2,592,000s = 30days // Default quantity is 1
		} else
			setcookie("shoppingCart_data", '' . $itemId . '*1,', time() + 2592000, "/"); // 2,592,000s = 30days // Default quantity is 1
	}
	
	function deleteAllItemsFromShoppingCart() {
		if (isset($_COOKIE['shoppingCart_data']))
			setcookie("shoppingCart_data", '', time() - 100000, "/");
	}
	
	function deleteItemFromShoppingCart($itemId) {
		if (isset($_COOKIE['shoppingCart_data'])) {
			$cookieValue = $_COOKIE['shoppingCart_data'];
			$splittedCookieValueArray = explode(',', $cookieValue);
			$cookieNewValue = '';
			for ($i = 0; $i < count($splittedCookieValueArray) - 1; $i++) {
				$itemIdFromCookie = explode('*', $splittedCookieValueArray[$i])[0];
				if ($itemIdFromCookie != $itemId)
					$cookieNewValue .= $splittedCookieValueArray[$i] . ',';
			}
			setcookie("shoppingCart_data", $cookieNewValue, time() + 2592000, "/"); // 2,592,000s = 30days
		}
	}
	
	function isItemAlreadyInShoppingCart($itemId) {
		if (isset($_COOKIE['shoppingCart_data'])) {
			$cookieValue = $_COOKIE['shoppingCart_data'];
			$splittedCookieValueArray = explode(',', $cookieValue);
			for ($i = 0; $i < count($splittedCookieValueArray) - 1; $i++) {
				$itemIdFromCookie = explode('*', $splittedCookieValueArray[$i])[0];
				if ($itemIdFromCookie == $itemId)
					return true;
			}
		}
		return false;
	}
	
	function getSqlWhereConditionStringOfShoppingCartItems() {
		if (isset($_COOKIE['shoppingCart_data'])) {
			$shoppingCartItemsString = '';
			$cookieValue = $_COOKIE['shoppingCart_data'];
			$splittedCookieValueArray = explode(',', $cookieValue);
			for ($i = 0; $i < count($splittedCookieValueArray) - 1; $i++) {
				$itemIdFromCookie = explode('*', $splittedCookieValueArray[$i])[0];
				if ($i == count($splittedCookieValueArray) - 2)
					$shoppingCartItemsString .= 'product_number=' . $itemIdFromCookie;
				else
					$shoppingCartItemsString .= 'product_number=' . $itemIdFromCookie . ' OR ';
			}
			return $shoppingCartItemsString;
		}
		return null;
	}
	
	function getShoppingCartItemsCount() {
		if (isset($_COOKIE['shoppingCart_data'])) {
			$cookieValue = $_COOKIE['shoppingCart_data'];
			$splittedCookieValueArray = explode(',', $cookieValue);
			$count = 0;
			for ($i = 0; $i < count($splittedCookieValueArray) - 1; $i++) {
				$itemQuantityFromCookie = explode('*', $splittedCookieValueArray[$i])[1];
				$count += $itemQuantityFromCookie;
			}
			return $count;
		}
		return 0;
	}
?>
