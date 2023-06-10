
<?php
include('connexion.php');
session_start();

$id_comprador = $_GET['id_comprador'];
$dinheiro = $_POST['dinheiro'];
$sql_balance = "SELECT balance FROM infos WHERE id ='$id_comprador'";
$result = $conn->query($sql_balance);
$row = $result->fetch_assoc();
$balance_before = $row['balance'];
$new_balance = $balance_before + $dinheiro;



$sql = "UPDATE infos SET balance='$new_balance' WHERE id = '$id_comprador'";

 if ($conn->query($sql) === TRUE) {
     session_start();
     $_SESSION['balance_added']=True;
     header('Location: User.php');


     }
 else{
    session_start();
    $_SESSION['balance_added']=False;
    header('Location: User.php');
 }
 $conn->close();

?>





