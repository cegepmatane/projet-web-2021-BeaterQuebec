<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class BaseDeDonnees{
    public static function getConnexion(){
        $usager = 'BeaterQuebec';
        $motdepasse = 'BeaterQuebec12!';
        $hote = 'localhost';
        $base = 'BeaterQuebec';

        $dsn = 'mysql:dbname='.$base.';host=' . $hote;
        $basededonnees = new PDO($dsn, $usager, $motdepasse);
        return $basededonnees;
    }
}
?>
