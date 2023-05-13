<?php
include('connexion.php');
session_start();

$id_prod = $_SESSION['infos_pessoa_prod']['id'];

$nome_prod = $_POST['nome_produto'];
$qtd_produto = $_POST['qtd_produto'];
$desc_produto = $_POST['descricao_produto'];
$preco_produto = $_POST['preco_produto'];
$data_colheta = $_POST['data_colheta'];
$foto_produto = $_POST['foto_produto'];

$sql = "INSERT INTO anuncio_infos(id_prod_an,nome_produto,qtd_produto,descricao,data_colheta,preco_unitario,foto_produto) values ('$id_prod','$nome_prod','$qtd_produto','$desc_produto','$data_colheta','$preco_produto','$foto_produto')";

 if ($conn->query($sql) === TRUE) {
     session_start();
     $_SESSION['anuncio_criado']=True;
     header('Location: User.php');


     }
 else{
    session_start();
    $_SESSION['anuncio_criado']=False;
    header('Location: User.php');
 }
 $conn->close();

?>



?>