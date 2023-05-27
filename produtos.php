
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
                    width: 400px;
                    max-width: 90%;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 4px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                }
            </style>



        </head>
        <body>

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
                <?php
                include('connexion.php');
                session_start();

                $sql = "SELECT * FROM anuncio_infos";
                $result = $conn->query($sql);

                ?>
                

                    <?php
                    if ($result->num_rows > 0 ){
                        $count = 0;
                        echo '<div id="products_list" style="display: block;">';
                        while ($row = $result->fetch_assoc()){
                            
                            if($count % 3 == 0){
                                echo '<div class="row">';
                            }
                            echo '<div class="card">';
                            echo '<img  src="data:image/'. $row['tipo_foto'] . ';charset=utf8;base64,'. base64_encode($row['foto_produto']) .'"  width="35%" height="150px">';
                            echo '<h3>' . $row["nome_produto"] . '</h3>';
                            echo $row["descricao"] . '<br>';
                            echo '<div class="price">';
                            echo 'R$:' . $row["preco_unitario"] ;
                            echo '</div>';
                            echo '<button class="comprar-botao" data-target="popup1">Comprar</button>';
                            echo '</div>';
                            $count ++;
                            if ($count % 1 != 0){
                                echo '</div>';
                            }
                          
                        }
                        echo '</div>';
                    }
                    $conn->close();
                    ?>
                <script>
                    var comprarBotoes = document.querySelectorAll('.comprar-botao');
                    comprarBotoes.forEach(function(button) {
                        button.addEventListener('click', function() {
                            var target = this.dataset.target;
                            var popup = document.getElementById(target);
                            if (popup) {
                                popup.style.display = 'block';
                            }
                        });
                    });
                </script>
                <div id="popup1" class="popup" style="display: none">
                    <div class="popup-card">
                        testando popup
                    </div>
                </div>


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

            </section>

        </body>
    
    </html>