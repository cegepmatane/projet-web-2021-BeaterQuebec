<?php
session_start();
session_unset();
session_destroy();

header("Location: membre.php?lang=".$_GET['lang']);
die();	
?>