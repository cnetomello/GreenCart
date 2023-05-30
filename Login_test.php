
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <link rel="stylesheet" href="CSS/login.css">
    <title>Login</title>
</head>
<body>
<div class="main-login">
    
    <div class="right-login">
    <img src="images/greencart_carrinho-removebg-preview.png" alt="GreenCart" class="left_image">
        <div class="card-login">
            <h1>Login</h1>

            <form action="login_php.php" method="post" class="form_login">
                <div class="textfield">
                    <label for="usuario">Email</label>
                    <input type="text" name="login" placeholder="Email">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Password">


                </div>
                <input type="submit" class="btn-login" value="Login">
                <a style="color:#ffffff">Crie sua conta de </a>
                <a href="Cadastro_test.php" class="criar_conta">Comprador</a>
                <a style="color:#ffffff"> ou </a>
                <a href="Cadastro_produtor.php" class="criar_conta">Produtor<a><br><br>
            </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
session_start();


if(isset($_SESSION['removed'])){
    ?>
    <script> alert('Account deleted.') </script>
    <?php
    unset($_SESSION['removed']);
}
if(isset($_SESSION['not_removed'])){
    ?>
    <script> alert('Account couldn\'t be deleted.') </script>
    <?php
    unset($SESSION['not_removed']);
}
  

if (isset($_SESSION['message'])){
    ?>
<script>
    alert('Account not found. Try again or create account.')
</script>
<?php
    unset($_SESSION['message']);
}
if(isset($_SESSION['created'])){
    ?>
<script >
    alert('Account created successfully. Log in please.')
</script>
<?php
    unset($_SESSION['created']);}
    
?>