<?php
session_start();
if($_SESSION['is_produtor']){
    $first_name_prod =  isset($_SESSION['infos_pessoa_prod']['nome_empresa']) ? $_SESSION['infos_pessoa_prod']['nome_empresa'] : "" ;
    $id_prod = isset($_SESSION['infos_pessoa_prod']['id']) ? $_SESSION['infos_pessoa_prod']['id'] : "" ;

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
    <link rel="stylesheet" href="CSS/edit_anuncios.css">
    <style>
    table {
        border-collapse: collapse;
        width: 300%;
        max-width: 1000%;
        margin: 0 auto;

    }

    th,
    td {
        text-align: center;
        padding: 8px;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
        font-weight: bold;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .btn-excluir,
    .btn-editar {
        background-color: #f44336;
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 15px;
        margin: 4px 2px;
        cursor: pointer;
    }

    .btn-editar {
        background-color: #4CAF50;
    }

    .btn-excluir:hover {
        background-color: #555;
    }

    .btn-editar:hover {
        background-color: #555;
    }
    </style>



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
            <a href="User.php" data-modal-target="#modal" class="fas fa-user"></a>

        </div>


        </div>

    </header>
    <section class="home" id="home">
        <!--aqui vai ficar a tabela q vai mostrar os anuncios do usuario produtor-->
        <div class="content">
            <?php
        include('connexion.php');
        $sql = "SELECT * FROM anuncio_infos WHERE id_prod_an = '$id_prod'";
        $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<thead><tr>
                <th>Nome do produto</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Data da colheita</th>
                <th>Preço unitário</th>
                <th></th>
                <th></th>
          </tr></thead>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";

            echo "<td>" . $row["nome_produto"] . "</td>";
            echo "<td>" . $row["descricao"] . "</td>";
            echo "<td>" .  $row["qtd_produto"] . " und"."</td>";
            echo "<td>" . $row["data_colheta"] . "</td>";
            echo "<td>" . "R$ " . $row["preco_unitario"] . "</td>";

            echo "<td> <a href='excluir_anuncio.php?id=" . $row['id_anuncio'] . "' class='btn-excluir'>Excluir</a> </td>";
            echo "<td> <a href='editar.php?id=" .$row['id_anuncio'] . "' class='btn-editar'>Editar</a>  </td>";

            echo "</tr>";
        }
        echo "</table>";
       ?>
            <script>
            function ret() {
                let c = confirm('Deseja retornar a aba anterior?');
                if (c) {
                    window.location.href = 'User.php';
                }
            }
            </script>
            <button
                style="font-size:30px;background:green;border-radius:30px;color:aliceblue;cursor:pointer; margin-top: 30px; width:300px; margin-left: 600px;padding:10px;"
                onclick="ret();" id='return_user'>Return to User Page</button>

            <?php
    } else {
            echo "<div style='font-family:Verdana, Geneva, Tahoma, sans-serif; font-size: 30px;width:1000px;margin-left:500px;'>" ."Voce ainda nao tem nenhum produto cadastrado." . "</div>";
        


    ?>
            <script>
            function ret() {
                let c = confirm('Deseja retornar a aba anterior?');
                if (c) {
                    window.location.href = 'User.php';
                }
            }
            </script>

            <button
                style="font-size:30px;background:green;border-radius:30px;color:aliceblue;cursor:pointer; margin-top: 30px; width:300px; margin-left: 600px;padding:10px;"
                onclick="ret();" id='return_user'>Return to User Page</button>
        </div>
        <?php } ?>
        </div>
    </section>
</body>

</html>