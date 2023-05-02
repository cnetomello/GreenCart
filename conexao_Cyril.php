
<?php

//Cyril

$servername = "localhost:3306";
$username = "root@";
$password = "";
$dbname = "login_econ";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}



?>
