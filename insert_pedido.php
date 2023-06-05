<?php
include('connexion.php');

$id_produto = $_POST['produto_id'];
$id_comprador = $_GET['id_comprador'];
$qtd_comprada = $_POST['qtd'];
$sql_preco = "SELECT preco_unitario FROM anuncio_infos WHERE id_anuncio = $id_produto";

$result = $conn->query($sql_preco);
$row_preco = $result->fetch_assoc();
$preco_total = $row_preco['preco_unitario'] * $qtd_comprada;



$sql = "INSERT INTO pedido(id_comprador, id_Anuncio, qtd_escolhida,preco_total,data_pedido) values ('$id_comprador','$id_produto','$qtd_comprada','$preco_total',now())";

$atualizando_estoque = "UPDATE anuncio_infos SET qtd_produto = qtd_produto - '$qtd_comprada' WHERE id_anuncio = '$id_produto'";

if ($conn->query($sql) === TRUE) {
    if ($conn->query($atualizando_estoque) === TRUE) {
        session_start();
        $_SESSION['comprado']= True;
        header('Location: produtos.php');
    } else {
        echo "Erro ao atualizar o estoque: " . $conn->error;
    }
} else {
    echo "Erro ao inserir o pedido: " . $conn->error;
}

$conn->close();
?>