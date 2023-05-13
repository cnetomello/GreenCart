<?php
session_start();

include('connexion.php');

$new_nome_produto = $_POST['new_nome_produto'];
$new_qtd = $_POST['new_qtd'];
$new_descricao = $_POST['new_descricao'];
$new_data_colheta = $_POST['new_data_colheta'];
$new_preco_unitario = $_POST['new_preco_unitario'];

$id_anuncio = $_GET['id'];

$sql = "UPDATE anuncio_infos SET nome_produto='$new_nome_produto', qtd_produto='$new_qtd', descricao='$new_descricao', data_colheta='$new_data_colheta', preco_unitario='$new_preco_unitario' WHERE id_anuncio=' $id_anuncio'";

$result = $conn->query($sql);

if ($result) {
    echo "Atualização realizada com sucesso!";
    header('location: Editar_anuncio.php');
} else {
    echo "Erro ao atualizar registro: " . $conn->error;
}
$conn->close();



