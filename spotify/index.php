<?php 

if (isset($_GET['code'])) {
	header('Location: /spotify-auth/' . $_GET['code']);
	exit();
} else {
	die('No code');
}

?>