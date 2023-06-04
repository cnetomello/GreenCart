<?php
include('connexion.php');
session_start();


if($_SESSION['is_produtor']){
    $first_name_prod =  isset($_SESSION['infos_pessoa_prod']['nome_empresa']) ? $_SESSION['infos_pessoa_prod']['nome_empresa'] : "" ;
}
else{
    $id_comprador =  isset($_SESSION['infos_pessoa']['id']) ? $_SESSION['infos_pessoa']['id'] : "" ;
    echo $id_comprador;
}


$sql = "SELECT * FROM anuncio_infos WHERE  qtd_produto >0";
$sql_nome = "SELECT * FROM infos_prod";
$result = $conn->query($sql);

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
            <link rel="stylesheet" href="CSS/produtos.css">
            
                    
                    
                
            <style>
                .card {
                    width: 30%;
                    margin-right: 2%;
                    margin-bottom: 2%;
                    border: 1px solid #ddd;
                    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
                    padding: 10px;
                    display: inline-flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    font-size: 15px;;
                }

                .card img {
                    display: block;
                    margin: 0 auto;
                }

                .card h3{
                    text-align: center;
                    font-size: 150%;
                    color:#73AB44;
                    font-weight: bolder;
                }
                .card p {
                    text-align: center;


                }
                .price{
                    font-size: 200%;
                    color:#73AB44;
                    font-weight: bolder;
                    padding-top: 1rem;
                }

                .comprar-botao {
                    display: block;
                    width: 100%;
                    padding: 10px 0;
                    background-color: #4CAF50;
                    color: white;
                    text-align: center;
                    text-decoration: none;
                    font-size: 16px;
                    border: none;
                    cursor: pointer;
                    margin-top: 10px;
                    border-radius: 5px;
                }

                .comprar-botao:hover {
                    background-color: #45a049;
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
                    height: 300px;
                    max-width: 90%;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 4px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                }
            </style>




        </head>
        <body>
            <?php 
            if($_SESSION['comprado']){
                ?> <script>alert("Compra efetuada com sucesso.")</script> <?php
            unset($_SESSION['comprado']); 
            }
             
            ?>

            <header>

                <input type="checkbox" name="" id="toggler">
                <label for="toggler" class="fas fa-bars"></label>
            
                <a href="index.php" class="logo">
                    <img src="images\greencart_carrinho-removebg-preview.png" style="width: 300px;;"></img>
                    </a>
            
                <nav class="navbar">
                    <a href="index.php">Home</a>
                    <a href="index.php">Sobre</a>
                    <a href="#products">Produtos</a>
                    <a href="avaliacoes.php">Avaliações</a>
                    <a href="index.php">Contato</a>
                </nav>
            
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="carrinho.php" class="fas fa-shopping-cart"></a>
                    <a href="User.php" class="fas fa-user"></a>
                </div>
            
            </header>
            
            <pre>
            </pre>

            

            <section class="products" id="products" >
                <h1 class="heading"> Produtos <span>disponíveis</span> </h1>
            <div style="display: inline-block; width:500px; margin-bottom:20px; ">
                <form  method="post" action="search_products.php">
                   <input type="text" name="search" placeholder="Search Products" id="search_products" style="height: 20px;width:60%; border: 2px solid grey; font-family:Verdana, Geneva, Tahoma, sans-serif; font-size:large; padding:3%; border-radius: 10px;">


                </form>
            </div>
            <div id="searchresult">

            </div>
                <!--pop-up-->
                <div id="popup1" class="popup" style="display: none">
                    <div class="popup-card">
                        <h2 id="popup-produto-nome" style="font-size: 20px;"></h2>
                        <form method="post" action="insert_pedido.php?id_comprador=<?php echo $id_comprador;?> " onsubmit="" style="margin:50px 20px 0px 20px; display:inline; ">
                            <label style="font-size:20px;">Quantidade:</label>
                            <input id="qtd_produto" type="number" name="qtd" placeholder="" min="1"  style="font-family:Verdana, Geneva, Tahoma, sans-serif; font-size: 20px; width:20%; margin:30px; border: 1px solid black;align-items:center;" required >
                            <div style="margin:60px 0px 0px 100px; display: flex;justify-content:space-between; width:50%;">
                            <input type="hidden" name="produto_id" id="produto_id" value="" >
                            <input type="submit" value="Comprar" style="font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif;background-color:#45a049;padding:10px;border-radius: 10px;color:white; cursor:pointer;">
                            <input type="button" id="botao_voltar" onclick="voltar();" style="font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif;background-color:red;padding:10px;border-radius: 10px;color:white;cursor:pointer;" value="Voltar"></input>
                        </form>
                        
                        
            </div>
                    </div>
                </div>

                <?php
                if ($result->num_rows > 0) {
                    $count = 0;
                    echo '<div id="products_list" style="display: block;">';
                    while ($row = $result->fetch_assoc()) {
                        $sql_nome = "SELECT nome_empresa FROM infos_prod WHERE id_prod = $row[id_prod_an]";
                        $result_nome = $conn->query($sql_nome);
                        $row_nome = $result_nome->fetch_assoc();

                        
                        if ($count % 3 == 0) {
                            echo '<div class="row">';
                        }
                        echo '<div class="card">';
                        echo '<h1 style="margin-bottom: 10px;color: green; font-size:20px; "> Vendido por : '. $row_nome['nome_empresa'] . '</h1>';
                        echo '<img src="data:image/' . $row['tipo_foto'] . ';charset=utf8;base64,' . base64_encode($row['foto_produto']) . '" width="35%" height="150px">';
                        echo '<h3>' . $row["nome_produto"] . '</h3>';
                        echo $row["descricao"] . '<br>';
                        echo '<div class="price">';
                        echo 'R$:' . $row["preco_unitario"];
                        
                        
                        echo '<input type="hidden" name="produto_id" id="produto_id_' . $row["id_anuncio"] . '" value="' . $row["id_anuncio"] . '">';
                        echo '<input type="hidden" name="qtd_produto" id="qtd_produto_' . $row["qtd_produto"] . '" value="' . $row["qtd_produto"] . '">';



                        echo '</div>';
                        if(! $_SESSION['is_produtor']){
                        echo '<button class="comprar-botao" onclick="popup()" data-target="popup1" 
                        data-product-nome="' . $row["nome_produto"] . '"                    
                        data-product-id="' . $row["id_anuncio"] . '"
                        data-product-qtd="' . $row["qtd_produto"] . '" 
                        >Comprar</button>';}
                        echo '</div>';
                        $count++;
                        if ($count % 1 != 0) {
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                }
                ?>

                







                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script type="text/javascript">

                    
                    $(document).ready(function(){
                       $("#search_products").keyup(function(){
                        
                        var input = $(this).val();
                        
                        if (input != ""){
                            $("#products_list").css("display" , "none");
                            $("#searchresult").css("display" , "block");
                          $.ajax({

                            url:"search_products.php",
                            method:"POST",
                            data: {input:input},
                            
                            success:function(data){
                                $("#searchresult").html(data);
                                
                            }
                          });
                          

                        }else{
                            $("#searchresult").css("display" , "none");
                            $("#products_list").css("display" , "block");
                        }

                       });

                    });
                    
                </script>
                <script src="js/popup_produtos.js" type="text/javascript" ></script>

            </section>


        </body>

    </html>