<?php

$servername = "localhost:3308";
$username = "root@";
$password = "";
$dbname = "greencart"; // para Cyril colocar greencart

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}



?>
