<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$usager = 'BeaterQuebec';
$motdepasse = 'BeaterQuebec12!';
$hote = 'localhost';
$base = 'BeaterQuebec';

$dsn = 'mysql:dbname='.$base.';host=' . $hote;
$basededonnees;
try
{
	$basededonnees = new PDO($dsn, $usager, $motdepasse);
}
catch(PDOException $exception)
{
	echo $e->getMessage();
}
?>