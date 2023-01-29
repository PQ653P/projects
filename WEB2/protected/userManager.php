<?php 
function IsUserLoggedIn() {
	return $_SESSION  != null && array_key_exists('uid', $_SESSION) && is_numeric($_SESSION['uid']);
}

function UserLogout() {
	session_unset();
	session_destroy();
	header('Location: index.php');
}

function UserLogin($username, $password) {
	$query = "SELECT id, name, password, permission FROM felhasznalok WHERE name = :name AND password = :password";
	$params = [
		':name' => $username,
		':password' => $password
	]; 

	require_once DATABASE_CONTROLLER;
	$record = getRecord($query, $params);
	if(!empty($record)) {
		$_SESSION['uid'] = $record['id'];
		$_SESSION['username'] = $record['username'];
		$_SESSION['password'] = $record['password'];
		$_SESSION['permission'] = $record['permission'];
		header('Location: index.php');
	}
	return false;
}


?>