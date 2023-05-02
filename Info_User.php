<?php
session_start();

if($_SESSION['is_produtor']){
    $nome_empresa=isset($_SESSION['infos_pessoa_prod']['nome_empresa']) ? $_SESSION['infos_pessoa_prod']['nome_empresa'] : "N/A" ;
    $email_prod = isset($_SESSION['infos_pessoa_prod']['email_prod']) ? $_SESSION['infos_pessoa_prod']['email_prod'] : "N/A" ;
   $fone_prod= isset($_SESSION['infos_pessoa_prod']['fone_prod']) ? $_SESSION['infos_pessoa_prod']['fone_prod'] : "N/A" ;
}
else{
$first_name =  isset($_SESSION['infos_pessoa']['first_name']) ? $_SESSION['infos_pessoa']['first_name'] : "N/A" ;
$last_name =  isset($_SESSION['infos_pessoa']['last_name']) ? $_SESSION['infos_pessoa']['last_name'] : "N/A" ;
$email =  isset($_SESSION['infos_pessoa']['email']) ? $_SESSION['infos_pessoa']['email'] : "N/A" ;
$phone =  isset($_SESSION['infos_pessoa']['phone']) ? $_SESSION['infos_pessoa']['phone'] : "N/A" ;}
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
               

  </div>
  
            </header>
            <section class="home" id="home">
<?php if($_SESSION['is_produtor']){ ?>
    <div style="display:block;">
<div style="display: flex;">
<div style="background-color: green;font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif; border-radius: 2px;align-items:center;color:white;"><h1>Nome Empresa : <?php echo $nome_empresa ?></h1></div> <button style="margin-left : 30px;font-size:15px; font-family:Verdana, Geneva, Tahoma, sans-serif;cursor:pointer;"><h1>Edit Nome Empresa</h1></button>

</div> <br>




<div style="display: flex;">
<div style="background-color: green;font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif; border-radius: 2px;align-items:center;color:white;"><h1>Email : <?php echo $email_prod; ?></h1></div> <button style="margin-left : 30px;font-size:15px;font-family:Verdana, Geneva, Tahoma, sans-serif;cursor:pointer;"><h1>Edit Email</h1></button>

</div> <br>

<div style="display: flex;">
<div style="background-color: green;font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif; border-radius: 2px;align-items:center;color:white;"><h1>Phone : <?php echo $fone_prod; ?></h1></div> <button style="margin-left : 30px;font-size:15px;font-family:Verdana, Geneva, Tahoma, sans-serif;cursor:pointer;"><h1>Edit Phone</h1></button>

</div> <br>

<button style="margin : 30px;font-size:15px;font-family:Verdana, Geneva, Tahoma, sans-serif; background-color: red;border-radius: 3px;cursor:pointer;" onclick="delete_acc();"><h1>Delete Account</h1></button>
</div>




    <?php } else{ ?>
<div style="display:block;">
<div style="display: flex;">
<div style="background-color: green;font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif; border-radius: 2px;align-items:center;color:white;"><h1>First Name : <?php echo $first_name ?></h1></div> <button style="margin-left : 30px;font-size:15px; font-family:Verdana, Geneva, Tahoma, sans-serif; cursor:pointer;"><h1>Edit First Name</h1></button>

</div> <br>

<div style="display: flex;">
<div style="background-color: green;font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif; border-radius: 2px;align-items:center;color:white;"><h1>Last Name : <?php echo $last_name ?></h1></div> <button style="margin-left : 30px;font-size:15px;font-family:Verdana, Geneva, Tahoma, sans-serif;cursor:pointer;"><h1>Edit Last Name</h1></button>

</div> <br>
<div style="display: flex;">
<div style="background-color: green;font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif; border-radius: 2px;align-items:center;color:white;"><h1>Email : <?php echo $email; ?></div></h1> <button style="margin-left : 30px;font-size:15px;font-family:Verdana, Geneva, Tahoma, sans-serif;cursor:pointer;"><h1>Edit Email</h1></button>

</div> <br>

<div style="display: flex;">
<div style="background-color: green;font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif; border-radius: 2px;align-items:center;color:white;"><h1>Phone : <?php echo $phone; ?></h1></div> <button style="margin-left : 30px;font-size:15px;font-family:Verdana, Geneva, Tahoma, sans-serif;cursor:pointer;"><h1>Edit Phone</h1></button>

</div> <br>

<button style="margin : 30px;font-size:15px;font-family:Verdana, Geneva, Tahoma, sans-serif; background-color: red;border-radius: 3px;cursor:pointer;" onclick="delete_acc();">Delete Account</button>
</div>
</body>
<?php } ?>
<script>
    function delete_acc(){
        if(confirm('Are you sure you want to delete this account?')){
        window.location.href='Delete_account.php';
    }
    // hello
    }
</script>
</html>