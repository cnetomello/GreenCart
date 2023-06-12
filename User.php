<?php
session_start();
if(!(isset($_SESSION['infos_pessoa_prod'])) && !(isset($_SESSION['infos_pessoa']))){
    header('Location: Login_test.php');
}

$_SESSION['id_session']= session_id();



if(isset($_SESSION['anuncio_criado']) && $_SESSION['anuncio_criado']){
    ?><script>
alert('Anuncio registrado com sucesso.');
</script>
<?php
     unset($_SESSION['anuncio_criado']);
}


if(isset($_SESSION['anuncio_criado']) && !$_SESSION['anuncio_criado']){
    ?><script>
alert('Anuncio nao registrado por causa de uma falha');
</script>
<?php
     unset($_SESSION['anuncio_criado']);
}
if(isset($_SESSION['balance_added']) && $_SESSION['balance_added']){
    ?><script>
alert('Fundos adicionado com sucesso.');
</script>
<?php
     unset($_SESSION['balance_added']);
}
if(isset($_SESSION['balance_added']) && !$_SESSION['balance_added']){
    ?><script>
alert('Fundos nao adicionado por causa de um erro.');
</script>
<?php
     unset($_SESSION['balance_added']);
}


if(isset($_SESSION['update']) && $_SESSION['update']){
    ?><script>
alert('Informações atualizadas com sucesso');
</script>
<?php
     unset($_SESSION['update']);
}
if(isset($_SESSION['update']) && !$_SESSION['update']){
    ?><script>
alert('As informações não foram possíveis ser atualizadas.');
</script>
<?php
     unset($_SESSION['update']);
}

if($_SESSION['is_produtor']){
$first_name_prod =  isset($_SESSION['infos_pessoa_prod']['nome_empresa']) ? $_SESSION['infos_pessoa_prod']['nome_empresa'] : "" ;
}
else{
$first_name =  isset($_SESSION['infos_pessoa']['first_name']) ? $_SESSION['infos_pessoa']['first_name'] : "" ;
$last_name =  isset($_SESSION['infos_pessoa']['last_name']) ? $_SESSION['infos_pessoa']['last_name'] : "" ;
$id_comprador =  isset($_SESSION['infos_pessoa']['id']) ? $_SESSION['infos_pessoa']['id'] : "" ;}
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
            <a href="User.php" data-modal-target="#modal" class="fas fa-user"></a>

        </div>
    </header>
    <section class="home" id="home">


        <div class="content">
            <img src="img/images.jpg">
            <h1 style="margin-top:20px;font-size:20px;"><?php if($_SESSION['is_produtor']){

    
    echo 'Bem Vindo Produtor:  '.$first_name_prod;}
    else{ 
        echo 'Bem Vindo Comprador:  '.$first_name.' '.$last_name;
    } ?></h1>

            <div style="display:flex;margin-top:20px;">
                <button name="Edit Profile"
                    style="margin-right: 20px;font-size:20px;background:green;border-radius:10px;color:aliceblue;cursor:pointer;width: 150px; height: 60px"
                    onclick="toInfo()">Editar Perfil</button>
                <?php if(!$_SESSION['is_produtor']){?>
                <button name="Registrar Produto"
                    style="margin-right: 20px;font-size:20px;background:green;border-radius:10px;color:aliceblue;cursor:pointer;width: 150px; height: 60px"
                    onclick="toCompras()">Visualizar Compras</button>

                <?php    
}?>
                <?php if($_SESSION['is_produtor']){?>
                <button name="Registrar Produto"
                    style="margin-right: 20px;font-size:20px;background:green;border-radius:10px;color:aliceblue;cursor:pointer;width: 150px; height: 60px"
                    onclick="toAnuncio()">Registrar Anuncio</button>
                <button name="Editar Produtos"
                    style="margin-right: 20px;font-size:20px;background:green;border-radius:10px;color:aliceblue;cursor:pointer;width: 150px; height: 60px"
                    onclick="toEditAnuncio()">Editar Anuncio</button>
                <button name="Editar Produtos"
                    style="margin-right: 20px;font-size:20px;background:green;border-radius:10px;color:aliceblue;cursor:pointer;width: 150px; height: 60px"
                    onclick="toVisualizarVendas()">Visualizar Vendas</button>
                <?php }?>
            </div>


        </div>
        <?php if(!$_SESSION['is_produtor']){?>
        <div style="display:block;">
            <div class="container-balance">
                <h1 style="margin-left:300px;color:aliceblue;"> Balance: </h1>
                <h1 style="font-size: 10em;color:aliceblue;"><?php 
if(!isset($_SESSION['infos_pessoa']['balance'])){
    echo 'R$ 0.0';
}

else {
    include('connexion.php');
    $sql_balance = "SELECT balance FROM infos WHERE id ='$id_comprador'";
    $result = $conn->query($sql_balance);
$row = $result->fetch_assoc();
$balance = $row['balance'];
$_SESSION['infos_pessoa']['balance']=$balance;
    echo 'R$ '. $balance;


}}?>
                </h1>
            </div>
            <?php if(!$_SESSION['is_produtor']){?>
            <button id="adicionar_fundos"
                style="margin-left: 400px;margin-top:30px;font-size:20px;background:green;border-radius:10px;color:aliceblue;cursor:pointer;width: 150px; height: 60px;"
                onclick="popup">Adicionar Fundos</button>
            <?php } ?>
        </div>
        <div id="popup1" class="popup" style="display: none">
            <div class="popup-card">
                <h2 id="popup-produto-nome" style="font-size: 20px;"></h2>
                <form method="post" action="insert_fundos.php?id_comprador=<?php echo $id_comprador;?> " onsubmit=""
                    style="margin:50px 20px 0px 20px; display:inline; ">
                    <label style="font-size:20px;">Valor de fundos a adicionar:</label>
                    <input id="dinheiro" type="number" step="0.1" name="dinheiro" placeholder="" min="1"
                        style="font-family:Verdana, Geneva, Tahoma, sans-serif; font-size: 20px; width:20%; margin:30px; border: 1px solid black;align-items:center;"
                        required>
                    <div style="margin:60px 0px 0px 100px; display: flex;justify-content:space-between; width:50%;">
                        <input type="submit" value="Adicionar"
                            style="font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif;background-color:#45a049;padding:10px;border-radius: 10px;color:white; cursor:pointer;">
                        <input type="button" id="botao_voltar" onclick="voltar();"
                            style="font-size: 20px;font-family:Verdana, Geneva, Tahoma, sans-serif;background-color:red;padding:10px;border-radius: 10px;color:white;cursor:pointer;"
                            value="Voltar"></input>
                </form>


            </div>



    </section>
    <script>
    function ret() {
        let c = confirm('Tem certeza que deseja sair?');
        if (c) {
            window.location.href = 'unset_user.php';
        }
    }


    function toInfo() {
        window.location.href = 'Info_User.php';
    }

    function toAnuncio() {
        window.location.href = 'Registrar_anuncio.php'
    }

    function toEditAnuncio() {
        window.location.href = 'Editar_anuncio.php'
    }

    function toCompras() {
        window.location.href = 'Compras.php'
    }

    function toVisualizarVendas() {
        window.location.href = 'Vendas.php'
    }
    </script>
    <script src="js/popup_fundos.js"></script>
    <div style="display: flex;justify-content:center;align-items:center;margin-top:20px;">
        <button
            style="font-size:35px;background:green;border-radius:10px;color:aliceblue;cursor:pointer;width: 150px; height: 60px"
            onclick="ret();" id='logout'>Logout</button>
    </div>

</body>

</html>