<?php
session_start();

   $id_comprador = $_SESSION['infos_pessoa']['id'];

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
    <link rel="stylesheet" href="CSS/view_compras.css">
    <style>
        table {
            border-collapse: collapse;
            width: 300%;
            max-width: 1000%;
            margin: 0 auto;

        }

        th, td {
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
        .btn-excluir {
            background-color: gold;
            border: none;
            color: white;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 4px 2px;
            cursor: pointer;
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
        <a href="#" class="fas fa-heart"></a>
        <a href="carrinho.php" class="fas fa-shopping-cart"></a>
        <a href="User.php" data-modal-target="#modal" class="fas fa-user"></a>

    </div>


    </div>

</header>
<section class="home" id="home">
    <!--aqui vai ficar a tabela q vai mostrar os PEDIDOS feitos pelo comprador-->
    <div class="content">
    <?php
        include('connexion.php');
        $sql_pedido = "SELECT * FROM pedido WHERE id_comprador = '$id_comprador'";
        $result = $conn->query($sql_pedido);
        
       

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<thead><tr>
                <th>Id Pedido</th>
                <th>Nome Produto</th>
                <th>Preco Total</th>
                <th>Data do Pedido</th>
                <th></th>
                
          </tr></thead>";
        while ($row = $result->fetch_assoc()) {
            $sql_nome_produto = "SELECT * FROM anuncio_infos WHERE id_anuncio = '$row[id_Anuncio]'" ;
            $result_anuncio = $conn->query($sql_nome_produto);
            $row_anuncio = $result_anuncio->fetch_assoc();

            echo "<tr>";

            echo "<td>" . $row["id_pedido"] . "</td>";
            echo "<td>" . $row_anuncio["nome_produto"] . "</td>";
            echo "<td>" . "R$" .  $row["preco_total"] ."</td>";
            echo "<td>" . $row["data_pedido"] . "</td>";
            echo "<td> <a href='avaliar_pedido.php?id=" . $row['id_pedido'] . "' class='btn-excluir'>Avaliar Pedido</a> </td>";
            

            echo "</tr>";
        }
        echo "</table>";
       ?>
       <script>
    function ret(){
         let c= confirm('Are you sure you want to return ?');
          if(c){
              window.location.href='User.php';
          }
       }
    </script>
        <button style="font-size:30px;background:green;border-radius:30px;color:aliceblue;cursor:pointer; margin-top: 30px; width:300px; margin-left: 600px;padding:10px;" onclick="ret();" id='return_user' >Return to User Page</button>
       
    <?php
    } else {
            echo "<div style='font-family:Verdana, Geneva, Tahoma, sans-serif; font-size: 30px;width:1000px;margin-left:500px;'>" ."Voce ainda nao fez nenhum pedido" . "</div>";
        


    ?>
    <script>
    function ret(){
         let c= confirm('Are you sure you want to return ?');
          if(c){
              window.location.href='User.php';
          }
       }
    </script>
    
    <button style="font-size:30px;background:green;border-radius:30px;color:aliceblue;cursor:pointer; margin-top: 30px; width:300px; margin-left: 600px;padding:10px;" onclick="ret();" id='return_user' >Return to User Page</button>
</div>
<?php } ?>
    </div>
</section>
</body>

</html>
