<?php
include('connexion.php');

$id_produto = $_POST['produto_id'];
$id_comprador = $_GET['id_comprador'];
$qtd_comprada = $_POST['qtd'];

$sql = "INSERT INTO pedido(id_comprador, id_Anuncio, qtd_escolhida) values ('$id_comprador','$id_produto','$qtd_comprada')";

$atualizando_estoque = "UPDATE anuncio_infos SET qtd_produto = qtd_produto - '$qtd_comprada' WHERE id_anuncio = '$id_produto'";

if ($conn->query($sql) === TRUE) {
    if ($conn->query($atualizando_estoque) === TRUE) {
        echo "Pedido inserido e estoque atualizado com sucesso.";
        header('Location: produtos.php');
    } else {
        echo "Erro ao atualizar o estoque: " . $conn->error;
    }
} else {
    echo "Erro ao inserir o pedido: " . $conn->error;
}

$conn->close();
?>