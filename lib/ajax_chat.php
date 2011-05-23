<?php

session_start();

function getConnection() {
	$db = mysql_connect('localhost', 'ajax_chat', 'reiore04') or die('Could not connect: ' . mysql_error());
	mysql_select_db('ajax_chat', $db) or die('Could not select: ' . mysql_error());
	return $db;
}

function userExists($db, $username) {
	$sql = "select count(*) from user where username='" . mysql_real_escape_string($username) . "'";
	$result = mysql_query($sql, $db);
	$row = mysql_fetch_row($result);
	$retval = $row[0] == 1;
	mysql_free_result($result);
	
	return $retval;
}

function authUser($db, $username, $password) {
	$password_hash = sha1($password);
	$sql = "select id from user where username='" 
				. mysql_real_escape_string($username)
				. "' and password='" . $password_hash 
				. "'";
	$result = mysql_query($sql, $db);
	$row = mysql_fetch_row($result);
	$user_id = $row != null ? $row[0] : null;
	mysql_free_result($result);
	
	if($user_id != null) {
		$_SESSION['user_id'] = $user_id;
		$_SESSION['username'] = $username;
	}
	
	return $user_id;
}

function createUser($db, $username, $password) {
	$password_hash = sha1($password);
	$sql = "insert into user (username, password) values ('"
			. mysql_real_escape_string($username)
			. "', '"
			. $password_hash
			. "')";
	mysql_query($sql, $db);
	$user_id = mysql_insert_id($db);
	$_SESSION['user_id'] = $user_id;
	$_SESSION['username'] = $username;
	return $user_id;
}

function postMessage($db, $user_id, $message) {
	$sql = "insert into message (user_id, message) values ("
		. $user_id
		. ", '"
		. htmlspecialchars($message)
		. "')";
	mysql_query($sql, $db);
}

function updateMessages($db, $lastId) {
	$sql = "select message.id, user.username, message.message, message.create_time from message join user on user.id=message.user_id where message.id>'" 
				. mysql_real_escape_string($lastId)
				. "' order by message.id desc limit 20";
	$result = mysql_query($sql, $db);
	$retval = array();
	while($row = mysql_fetch_assoc($result)) {
		$retval[] = $row;
	}
	mysql_free_result($result);
	
	return $retval;
}

?>