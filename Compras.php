<?php
session_start();

   $id_comprador = $_SESSION['infos_pessoa']['id'];
   if(isset($_SESSION['avaliar']) && $_SESSION['avaliar']){
    ?> <script>
alert("Avaliacao registrada com sucesso.")
</script><?php
    unset($_SESSION['avaliar']);

   }
   if(isset($_SESSION['avaliar']) && !$_SESSION['avaliar']){
    ?> <script>
alert("Avaliacao nao pode ser registrada atualmente.")
</script><?php
    unset($_SESSION['avaliar']);

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="CSS/view_compras.css">
    <style>
    table {
        border-collapse: collapse;
        width: 300%;
        max-width: 1000%;
        margin-top: 10em;

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

    .btn-avaliar {
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


    .btn-avaliar:hover {
        background-color: #555;
    }

    .btn-avaliar-disabled {
        background-color: grey;
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        margin: 4px 2px;
        cursor: pointer;
    }

    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    .popup-card {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;

        max-width: 90%;
        background-color: #fff;
        padding: 20px;
        border-radius: 4px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

    }

    .fa-star {
        width: 30px;
    }

    .checked {
        color: orange;
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
                <th>Data e Hora do Pedido</th>
                <th></th>
                
          </tr></thead>";
        while ($row = $result->fetch_assoc()) {
            $sql_nome_produto = "SELECT * FROM anuncio_infos WHERE id_anuncio = '$row[id_Anuncio]'" ;
            $result_anuncio = $conn->query($sql_nome_produto);
            $row_anuncio = $result_anuncio->fetch_assoc();
            $sql_check = "SELECT * FROM avaliacao WHERE id_comprador = '$id_comprador' AND id_pedido='$row[id_pedido]'";
        $result_check = $conn->query($sql_check);

            echo "<tr>";

            echo "<td>" . $row["id_pedido"] . "</td>";
            echo "<td>" . $row_anuncio["nome_produto"] . "</td>";
            echo "<td>" . "R$" .  $row["preco_total"] ."</td>";
            echo "<td>" . $row["data_pedido"] . "</td>";
            if($result_check->num_rows>0){
                echo "<td> <button class='btn-avaliar-disabled' id='avaliar'>Avaliar Pedido</button> </td>";
            }
            else{
            echo "<td> <button class='btn-avaliar' id='avaliar' data-target='popup-avaliar' data-id-pedido=".$row["id_pedido"]." data-id-comprador=".$id_comprador." data-nome-produto=" .$row_anuncio["nome_produto"] ." data-preco-pedido= ".$row["preco_total"] . " data-date-pedido=".$row["data_pedido"]." >Avaliar Pedido</button> </td>";
            }

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
            echo "<div style='font-family:Verdana, Geneva, Tahoma, sans-serif; font-size: 30px;width:1000px;margin-left:500px;'>" ."Voce ainda nao fez nenhum pedido" . "</div>";
        


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
        <div id="popup-avaliar" class="popup">
            <div class="popup-card">
                <h2 id="popup-produto-nome" style="font-size: 20px;display:flex;">Avaliar Pedido Numero:&nbsp;<p
                        id="id_pedido_popup"></p>
                </h2>
                <form method="post" action="insert_avaliacao.php?id_comprador=<?php echo $id_comprador;?> "
                    onsubmit="return validate();" style="margin:50px 20px 0px 20px; display:inline; "
                    name="form_avaliacao">
                    <label style="font-size:20px;">Preco-total: R$</label>

                    <input id="preco_value" type="number" name="preco_value" placeholder=""
                        style="font-family:Verdana, Geneva, Tahoma, sans-serif; font-size: 20px; width:20%; margin:20px;align-items:center;"
                        readonly><br>
                    <div style="margin-left: 20px; display:flex;margin-bottom:20px;">
                        <label style="font-size:20px;">Nome Produto:&nbsp; </label>
                        <h1 id="nome_prod_avaliacao" style="font-size: 20px;"></h1>
                    </div>
                    <div style="margin-left: 20px;margin-bottom:20px; display:flex;">
                        <label style="font-size:20px;">Data Pedido:&nbsp; </label>
                        <h1 id="data_pedido_avaliacao" style="font-size: 20px;"></h1>
                    </div>
                    <div style="margin-left: 20px;margin-bottom:10px; display:flex;">
                        <label style="font-size:20px;">Avaliar Pedido: </label>
                        <span class="fa fa-star fa-2x" onclick=" star(1);" id="one"
                            style="height:20px;margin-left:20px;"></span>
                        <span class="fa fa-star fa-2x" onclick=" star(2);" id="two"></span>
                        <span class="fa fa-star fa-2x" onclick=" star(3);" id="three"></span>
                        <span class="fa fa-star fa-2x" onclick=" star(4);" id="four"></span>
                        <span class="fa fa-star fa-2x" onclick=" star(5);" id="five"></span>
                        <div>
                            <p style="display: none;color:red;font-size:10px;" id="error_stars">*Voce tem que dar um
                                numero de estrelas</p>
                        </div>
                    </div>
                    <div style="margin-left: 20px;margin-bottom:20px; display:flex;">
                        <label style="font-size:20px;">Comentario: </label><br>
                        <textarea name="paragraph" id="comentario" cols="50" rows="10"
                            style="border: 1px solid black;resize:none;padding:3px;margin-left:2px;"></textarea>

                    </div>
                    <br>
                    <p style="display: none;color:red;font-size:10px;margin-left:200px;" id="error_comentario">*Voce tem
                        que colocar pelo menos 10 carateres</p>


                    <div style="margin:40px 0px 0px 100px; display: flex;justify-content:space-between; width:50%;">
                        <input type="hidden" name="idPedido_avaliacao" id="idPedido_avaliacao" value="">
                        <input type="hidden" name="produto_id" id="produto_id" value="">
                        <input type="hidden" name="number_stars" id="number_stars" value="">
                        <input type="hidden" name="paragraph_description" id="paragraph_description" value="">
                        <input type="submit" value="Postar"
                            style="font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif;background-color:#45a049;padding:10px;border-radius: 10px;color:white; cursor:pointer;">
                        <input type="button" id="botao_voltar" onclick="voltar();"
                            style="font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif;background-color:red;padding:10px;border-radius: 10px;color:white;cursor:pointer;"
                            value="Voltar"></input>
                </form>


            </div>
        </div>
        <script src="js/popup_avaliacao.js" type="text/javascript"></script>
    </section>
</body>
<script>
function star(number_stars) {

    document.getElementById('error_stars').style.display = "none";
    document.getElementById("number_stars").value = number_stars;
    console.log(document.getElementById("number_stars").value);
    document.getElementById("one").className = "fa fa-star fa-2x";
    document.getElementById("two").className = "fa fa-star fa-2x";
    document.getElementById("three").className = "fa fa-star fa-2x";
    document.getElementById("four").className = "fa fa-star fa-2x";
    document.getElementById("five").className = "fa fa-star fa-2x";
    var c = document.getElementsByClassName("fa fa-star fa-2x");
    for (i = 0; i < number_stars; i++) {
        c[i].className = "fa fa-star fa-2x checked";
    }

}

function validate() {
    if (document.getElementsByClassName("fa fa-star fa-2x checked").length === 0) {
        document.getElementById('error_stars').style.display = "block";
        return false;

    } else if (document.getElementById("comentario").value === "" || document.getElementById("comentario").value
        .length < 10) {
        document.getElementById("comentario").style.border = "1px solid red";
        document.getElementById('error_comentario').style.display = "block";
        return false;
    }
    document.getElementById("paragraph_description").value = document.getElementById("comentario").value;
    console.log(document.getElementById("comentario").value);
    return true;

}
</script>

</html>