<?php 
include("connexion.php");
$id_comprador = $_GET['id_comprador'];
$id_pedido = $_POST['idPedido_avaliacao'];
$numero_estrelas = $_POST['number_stars'];
$descricao = $_POST['paragraph_description'];

$sql = "INSERT INTO avaliacao(id_pedido,id_comprador,num_estrela,descricao_avaliacao) VALUES ('$id_pedido','$id_comprador','$numero_estrelas','$descricao')";

if($conn->query($sql)=== TRUE){
    session_start();
    $_SESSION['avaliar']=True;
    header("Location: Compras.php");
}
else{
    session_start();
    $_SESSION['avaliar']=False;
    header("Location: Compras.php");
}


?>