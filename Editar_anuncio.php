<?php
session_start();
if($_SESSION['is_produtor']){
    $first_name_prod =  isset($_SESSION['infos_pessoa_prod']['nome_empresa']) ? $_SESSION['infos_pessoa_prod']['nome_empresa'] : "" ;
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
    <link rel="stylesheet" href="CSS/edit_anuncios.css">


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


    </div>

</header>
<section class="home" id="home">
    <!--aqui vai ficar a tabela q vai mostrar os anuncios do usuario produtor-->
    <div class="content">

    </div>
</section>



