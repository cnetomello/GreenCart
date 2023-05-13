<?php
session_start();

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
            <link rel="stylesheet" href="CSS/profile.css">
            
           

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
            
            <form action="insert_anuncio.php" class="form-update-infos-produtor" enctype="multipart/form-data" method="POST"  onsubmit="return validar();"  style="display: block; margin-top:100px; margin-left: auto; margin-right:auto; padding: 20px; width: 30%;height:500px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f8f8;">
        <label for="nome_produto">Nome Produto:</label>
        <input type="text" id="nome_produto" name="nome_produto" style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;" required>
        <p style="color:red;margin-bottom:10px;display:none;" id="nome_erro"> ** Nome de produto errado </p>
        
        <label for="qtd_produto">Quantidade Produto:</label>
        <input type="text" id="qtd_produto" name="qtd_produto"  style="display: block; margin-bottom: 10px;margin-top:10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 30%; box-sizing: border-box; align-content:flex-start;" required>
        <p style="color:red;margin-bottom:10px;display:none;" id="qtd_erro"> ** Quantidade de produto errado (0-100) </p>
        
        <label for="descricao_produto">Descricao:</label>
        <input type="text" id="descricao_produto" name="descricao_produto"  style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;height:50px;" required>
        <p style="color:red;margin-bottom:10px;display:none;" id="desc_erro"> ** Numero de carateres errado (10-500) </p>
        
        <label for="preco_unitario">Preco por unidade:</label>
        <input type="text" id="preco_produto" placeholder="EX: 0.1 (R$)" name="preco_produto"  style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 30%; box-sizing: border-box;" required>
        <p style="color:red;margin-bottom:10px;display:none;" id="preco_erro"> ** Formato de Preco errado (R$ 0.10 com 2 digitos depois do ponto) </p>
        
        <label for="data_colheta_produto">Data de colheta:</label>
        <input type="date" id="data_colheta" name="data_colheta" min="2023-04-21" max="<?= date('Y-m-d'); ?>"  style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;" required>
        
        <label for="foto_produto">Foto Produto:</label>
        <input type="file" id="foto" name="foto_produto"  style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;" id="foto_prod" onchange="return fileValidation();" required>

        <input type="submit" value="Registrar Anuncio" style="background-color: #4CAF50; color: #fff; border: none; border-radius: 3px; padding: 10px 15px; cursor: pointer; font-size: 16px; margin-left: auto; margin-top: 50px; margin-right: auto; display: block;">
    </form>



</section>
<script>
    function fileValidation() {
            var fileInput =
                document.getElementById('foto');
             
            var filePath = fileInput.value;
         
            // Allowing file type
            var allowedExtensions =
/(\.jpeg)$/i;
             
            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type (only jpeg)');
                fileInput.value = '';
                return false;
            }
        }

    function allLetter(inputtxt)
    {
        var letters = /^[A-Za-z,\s,\.,\-]+$/;
        if(inputtxt.value.match(letters))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    

    function erro(objeto){
        objeto.style.borderColor="red";
        setTimeout(function(){objeto.style.borderColor="black"},5000);
        objeto.value="";
        objeto.focus();
    }
    function validar(){
        
        const nome_prod = document.getElementById('nome_produto');
        const qtd_prod = document.getElementById('qtd_produto');
        const desc_prod = document.getElementById('descricao_produto');
        const data_colheta = document.getElementById('data_colheta');
        const preco_prod = document.getElementById('preco_produto');
        const erro_nome = document.getElementById('nome_erro');
        const erro_qtd = document.getElementById('qtd_erro');
        const erro_desc = document.getElementById('desc_erro');
        const erro_preco = document.getElementById('preco_erro');

        if(nome_prod.value.length <3 || !allLetter(nome_prod)){
            erro(nome_prod);
            erro_nome.style.display="block";
            setTimeout(function(){erro_nome.style.display="none"},15000);
            
            return false;
        }
        if( !qtd_prod.value.match(/^([1-9]|[1-9][0-9]|100)$/)){
            erro(qtd_prod);
            erro_qtd.style.display="block";
            setTimeout(function(){erro_qtd.style.display="none"},15000);
            
            return false;
        }
        if(desc_prod.value.length>500 || desc_prod.value.length<10){
            erro(desc_prod);
            erro_desc.style.display="block";
            setTimeout(function(){erro_desc.style.display="none"},15000);
            
            return false;

        }
        if(!preco_prod.value.match(/^\d+\.\d{1,2}$/)){
            erro(preco_prod);
            erro_preco.style.display="block";
            setTimeout(function(){erro_preco.style.display="none"},15000);
            
            return false;
        }

        
    
    return true;
        

        
    }
    function ret(){
        if(confirm('Are you sure you want to return?'))
        window.location.href='User.php';
    }
    
   
</script>
<div style="display: flex;justify-content:center;align-items:center;margin-top:20px;">
<button style="font-size:30px;background:green;border-radius:3px;color:aliceblue;cursor:pointer;" onclick="ret();" id='return_user' >Return to User Page</button>
</div>


        </body>
    </html>