<?php
require_once 'sessione.php';
require_once 'controllaCookie.php';

if (!isset($loggedIn) || (!$loggedIn)) {
	echo '<script type="text/javascript">window.alert("Non sei loggato o è scaduta la sessione!");window.location.href = "../accedi.php?msg=SessioneScaduta";</script>';
} else {

	$_SESSION = array();

	if (session_id() != "" || isset($_COOKIE[session_name()]))
		setcookie(session_name(), '', time() - 2592000, '/');

	session_unset(); 	// empty session
	session_destroy();	// destroy session

	echo '<script type="text/javascript">window.location.href = "../index.php";</script>';

}

$loggedIn = false;
?>