<?php
include('connexion.php');
session_start();

if($_SESSION['is_produtor']){
    $prod_id =isset($_SESSION['infos_pessoa_prod']['id']) ? $_SESSION['infos_pessoa_prod']['id'] : "N/A" ;
    $id_anuncio = $_GET["id"];

    $sql = "UPDATE  anuncio_infos SET qtd_produto = 0  WHERE id_anuncio = $id_anuncio AND id_prod_an = $prod_id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro deletado com sucesso!";
    }
    $conn->close();
    header('location: Editar_anuncio.php');

}





