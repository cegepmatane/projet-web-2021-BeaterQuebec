<?php

$connection = new mysqli("localhost","root","","pocpayment");

if ($connection->connect_errno){
    echo "Erreur connection : " . $connection->connect_error;
    exit();
}


?>