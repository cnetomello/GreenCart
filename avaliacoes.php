<?php
include("connexion.php");
session_start();

if (!(isset($_SESSION['infos_pessoa_prod'])) && !(isset($_SESSION['infos_pessoa']))) {
    header('Location: Login_test.php');
}







?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenCart - Produtos orgânicos aqui e agora!</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/avaliacoes.css">

</head>

<body>
    <!-- header section starts  -->

    <header>

        <input type="checkbox" name="" id="toggler">
        <label for="toggler" class="fas fa-bars"></label>

        <a href="index.php" class="logo">
            <img src="images\greencart_carrinho-removebg-preview.png" style="width: 300px;;"></img>
        </a>

        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="index.php">Sobre</a>
            <a href="produtos.php">Produtos</a>
            <a href="#review">Avaliações</a>
            <a href="index.php">Contato</a>
        </nav>

        <div class="icons">
            <a href="#" class="fas fa-heart"></a>
            <a href="User.php" class="fas fa-user"></a>
        </div>

    </header>

    <pre>



                <!-- criar espaco-->



            </pre>
    <h1 class="heading"> Avaliações de <span>usuários</span> </h1>

    <?php
    if (isset($_SESSION['infos_pessoa_prod'])) {
        $id_produtor = $_SESSION['infos_pessoa_prod']['id'];
        $sql_anuncio = "SELECT * 
                    FROM avaliacao
                    WHERE id_pedido IN
                        (SELECT id_pedido
                        FROM pedido
                        WHERE id_Anuncio IN
                            (SELECT id_anuncio 
                            FROM anuncio_infos
                            WHERE id_prod_an IN 
                                (SELECT id_prod
                                FROM infos_prod
                                WHERE id_prod = '$id_produtor')))
                    ";
        $result_produtor = $conn->query($sql_anuncio);
        if ($result_produtor->num_rows > 0) {
            $count = 0;


            while ($row_produtor = $result_produtor->fetch_assoc()) {
                $sql_get_comprador = "SELECT * FROM infos WHERE id IN (SELECT id_comprador FROM pedido WHERE id_pedido IN (SELECT id_pedido FROM avaliacao WHERE id_avaliacao = '$row_produtor[id_avaliacao]'))";
                $sql_get_anuncio = "SELECT * FROM anuncio_infos WHERE id_prod_an = '$id_produtor' AND id_anuncio IN (SELECT id_Anuncio FROM pedido where id_pedido IN ( SELECT id_pedido FROM avaliacao WHERE id_avaliacao = '$row_produtor[id_avaliacao]'))";
                $sql_get_pedido = "SELECT * FROM pedido WHERE id_pedido IN (SELECT id_pedido FROM avaliacao WHERE id_avaliacao = '$row_produtor[id_avaliacao]') ";
                $result_get_anuncio = $conn->query($sql_get_anuncio);
                $result_get_comprador = $conn->query($sql_get_comprador);
                $result_get_pedido = $conn->query($sql_get_pedido);
                $row_get_pedido = $result_get_pedido->fetch_assoc();
                $row_get_comprador = $result_get_comprador->fetch_assoc();
                $row_get_anuncio = $result_get_anuncio->fetch_assoc();
                $date=date_create(substr($row_get_pedido["data_pedido"],0));
               
                $date_yes = date_format($date,"d/m/Y H:i");


                if ($count % 3 == 0) {
                    echo '<section class="review" id="review">';
                    echo '<div class="box-container">';
                }

                echo   '<div class="box">';
                echo '<h3 style=" color:#73AB44;font-size: 2.5rem;padding:0 0;margin-bottom:2rem;">Produtor: Voce</h3>';
                echo '<h3 style=" color:#73AB44;font-size: 2.5rem;padding:0 0;margin-bottom:2rem;">Produto: ' . $row_get_anuncio["nome_produto"] . '</h3>';
                echo '<h3 style=" color:#73AB44;font-size: 2.5rem;padding:0 0;margin-bottom:2rem;">Data Pedido: ' . $date_yes . '</h3>';
                echo       '<div class="stars">';
                for ($i = $row_produtor['num_estrela']; $i > 0; $i--) {

                    echo           '<i class="fa fa-star checked"></i>';
                }
                for ($i = 5 - $row_produtor['num_estrela']; $i > 0; $i--) {
                    echo           '<i class="fa fa-star"></i>';
                }
                echo       '</div>';
                echo '<img src="data:image/' . $row_get_anuncio['tipo_foto'] . ';charset=utf8;base64,' . base64_encode($row_get_anuncio['foto_produto']) . '" width="150em" height="150px" style="margin:20px 0px 10px 150px;">';
                echo       '<p style="font-size:20px;border: 1px solid black;padding:10px;width:100%; box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.1);
            border-radius: .5rem;
            border:.1rem solid rgba(0,0,0,.1);">Comentario: <br>' . $row_produtor["descricao_avaliacao"] . '</p>';
                echo       '<div class="user">';

                echo           '<div class="user-info">';
                echo               '<h3 style="color:#73AB44;"> Comprador: ' . $row_get_comprador["first_name"] . '  ' . $row_get_comprador["last_name"] . ' </h3>';

                echo           '</div>';
                echo       '</div>';

                echo   '</div>';

                $count++;
                if ($count % 3 == 0) {
                    echo '</div>';
                    echo '</section>';
                } else if ($result_produtor->num_rows == $count) {
                    echo '</div>';
                    echo '</section>';
                }
            }
        }
        else{
            
            echo '<h1 style="margin: 100px 0px 0px 600px;"> Nao tem nenhuma avaliacao referente a seu anuncio ainda. </h1>';
        }
    } else {
        $sql = "SELECT * FROM avaliacao";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $count = 0;
            while ($row = $result->fetch_assoc()) {
                $sql_get_comprador = "SELECT * FROM infos WHERE id IN (SELECT id_comprador FROM pedido WHERE id_pedido IN (SELECT id_pedido FROM avaliacao WHERE id_avaliacao = '$row[id_avaliacao]')) ";
                $sql_get_anuncio = "SELECT * FROM anuncio_infos WHERE  id_anuncio IN (SELECT id_Anuncio FROM pedido WHERE id_pedido IN ( SELECT id_pedido FROM avaliacao WHERE id_avaliacao = '$row[id_avaliacao]' ))";
                $sql_get_produtor = "SELECT * FROM infos_prod WHERE id_prod IN (SELECT id_prod_an FROM anuncio_infos WHERE id_anuncio IN (SELECT id_Anuncio FROM pedido WHERE id_pedido IN (SELECT id_pedido FROM avaliacao WHERE id_avaliacao = '$row[id_avaliacao]'))) ";
                $sql_get_pedido = "SELECT * FROM pedido WHERE id_pedido IN (SELECT id_pedido FROM avaliacao WHERE id_avaliacao = '$row[id_avaliacao]') ";
                $result_get_anuncio = $conn->query($sql_get_anuncio);
                $result_get_comprador = $conn->query($sql_get_comprador);
                $result_get_produtor = $conn->query($sql_get_produtor);
                $result_get_pedido = $conn->query($sql_get_pedido);
                $row_get_pedido = $result_get_pedido->fetch_assoc();
                $row_get_comprador = $result_get_comprador->fetch_assoc();
                $row_get_anuncio = $result_get_anuncio->fetch_assoc();
                $row_get_produtor = $result_get_produtor->fetch_assoc();
                


                if ($count % 3 == 0) {
                    echo '<section class="review" id="review">';
                    echo '<div class="box-container">';
                }
                $date=date_create(substr($row_get_pedido["data_pedido"],0));
               
                $date_yes = date_format($date,"d/m/Y H:i");
                echo   '<div class="box">';
                echo '<h3 style=" color:#73AB44;font-size: 2.5rem;padding:0 0;margin-bottom:2rem;">Produtor: '.$row_get_produtor["nome_empresa"]. '</h3>';
                echo '<h3 style=" color:#73AB44;font-size: 2.5rem;padding:0 0;margin-bottom:2rem;">Produto: ' . $row_get_anuncio["nome_produto"] . '</h3>';
                echo '<h3 style=" color:#73AB44;font-size: 2.0rem;padding:0 0;margin-bottom:2rem;">Data Pedido: ' . $date_yes . '</h3>';
                echo       '<div class="stars">';
                for ($i = $row['num_estrela']; $i > 0; $i--) {

                    echo           '<i class="fa fa-star checked"></i>';
                }
                for ($i = 5 - $row['num_estrela']; $i > 0; $i--) {
                    echo           '<i class="fa fa-star"></i>';
                }
                echo       '</div>';
                echo '<img src="data:image/' . $row_get_anuncio['tipo_foto'] . ';charset=utf8;base64,' . base64_encode($row_get_anuncio['foto_produto']) . '" width="150em" height="150px" style="margin:20px 0px 10px 150px;">';
                echo       '<p style="font-size:20px;border: 1px solid black;padding:10px;width:100%; box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.1);
            border-radius: .5rem;
            border:.1rem solid rgba(0,0,0,.1);">Comentario: <br>' . $row["descricao_avaliacao"] . '</p>';
                echo       '<div class="user">';

                echo           '<div class="user-info">';
                echo               '<h3 style="color:#73AB44;"> Comprador: ' . $row_get_comprador["first_name"] . '  ' . $row_get_comprador["last_name"] . ' </h3>';

                echo           '</div>';
                echo       '</div>';

                echo   '</div>';

                $count++;
                if ($count % 3 == 0) {
                    echo '</div>';
                    echo '</section>';
                } else if ($result->num_rows == $count) {
                    echo '</div>';
                    echo '</section>';
                }

            }
        }
        else{
            
            echo '<h1 style="margin: 100px 0px 0px 700px;"> Nao tem nenhuma avaliacao ainda. </h1>';
        }
    }
    ?>

    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>Links rápidos</h3>
                <a href="index.php">Home</a>
                <a href="index.php">Sobre</a>
                <a href="produtos.php">Produtos</a>
                <a href="index.php">Contato</a>
            </div>

            <div class="box">
                <h3>Links extras</h3>
                <a href="#">Minha conta</a>
                <a href="#">Meu pedido</a>
                <a href="#">Favoritos</a>
            </div>

            <div class="box">
                <h3>Locais</h3>
                <a href="#">Paraná</a>
                <a href="#">Santa Catarina</a>
                <a href="#">Mato Grosso do Sul</a>
            </div>

            <div class="box">
                <h3>Informações para contato</h3>
                <a href="#">+55 (41) 99830-3237</a>
                <a href="#">contato@GreenCart.com</a>
                <a href="#">Curitiba > Paraná > Brasil - 37847654</a>
            </div>
        </div>
    </section>

</body>

</html>