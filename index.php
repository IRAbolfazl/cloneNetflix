<?php
require_once ("includes/config.php");
require_once ("includes/classes/PreviewProvider.php");

if (!isset($_SESSION["userLoggedIn"])){
	header("Location: register.php");
}

$username = $_SESSION["userLoggedIn"];
$preview = new PreviewProvider($con,$username);

echo $preview->createPreviewVideo(null);
?> 
