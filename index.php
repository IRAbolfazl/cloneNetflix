<?php

require_once ("includes/header.php");
$preview = new PreviewProvider($con,$username);
echo $preview->createPreviewVideo(null);


$containers = new CategoryContainers($con,$username);
echo $containers->showAllCategory();
?> 
