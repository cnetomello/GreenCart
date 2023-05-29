<?php
include('connexion.php');
session_start();

$id_anuncio = $_GET["id"];

$sql = "SELECT * FROM anuncio_infos WHERE id_anuncio = $id_anuncio";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
        $nome_produto = $row['nome_produto'];
        $qtd_produto = $row['qtd_produto'];
        $descricao = $row['descricao'];
        $data_colheita = $row['data_colheta'];
        $preco_unitario = $row['preco_unitario'];
    }
}

?>
<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>GreenCart -  Produtos orgânicos aqui e agora!</title>

            <!-- font awesome cdn link  -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

            <!-- custom css file link  -->
            <link rel="stylesheet" href="CSS/index.css">



        </head>
        <body>

        <!-- header section starts  -->

            <header>

                <input type="checkbox" name="" id="toggler">
                <label for="toggler" class="fas fa-bars"></label>

                <a href="index.php" class="logo">
                    <img src="images\greencart_carrinho-removebg-preview.png" width="300px;"></img>
                    </a>

                <nav class="navbar">
                    <a href="index.php">Home</a>
                    <a href="index.php">Sobre</a>
                    <a href="produtos.php">Produtos</a>
                    <a href="avaliacoes.php">Avaliações</a>
                    <a href="index.php">Contato</a>
                </nav>

                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="carrinho.php" class="fas fa-shopping-cart"></a>
                    <a href="User.php" data-modal-target="#modal" class="fas fa-user"></a>

                </div>
            </header>
        <section class="home" id="home">

<div class="content">
    <form class="form-update-infos-anuncio" method="POST" action="update_infos_anuncio.php?id=<?php echo $id_anuncio;?>" style=" margin: 20px; padding: 20px; width: 100%; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f8f8;">
        <label for="nome">Nome do Produto: </label>
        <input type="text" id="nome_produto" name="new_nome_produto" value="<?php echo $nome_produto ?>" style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;">

        <label for="qutd_produto">Quantidade (Unidades): </label>
        <input type="text" id="qtd_produto" name="new_qtd" value="<?php echo $qtd_produto ?>" style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;">

        <label for="descricao">Descrição do produto: </label>
        <input type="text" id="descricao" name="new_descricao" value="<?php echo $descricao ?>" style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;">

        <label for="data_colheta">Data da colheita: </label>
        <input type="date" id="data_colheta" name="new_data_colheta" value="<?php echo $data_colheita ?>" style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;">

        <label for="preco_unitario">Preço (por unidade): </label>
        <input type="text" id="preco_unitario" name="new_preco_unitario" value="<?php echo $preco_unitario ?>" style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;">

        <input type="submit" value="Salvar" style="background-color: #4CAF50; color: #fff; border: none; border-radius: 3px; padding: 10px 15px; cursor: pointer; font-size: 16px; margin-left: auto; margin-right: auto; display: block;">
    </form>
