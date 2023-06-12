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
            <link rel="stylesheet" href="CSS/profile.css">
        </head>
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
                <a href="User.php" data-modal-target="#modal" class="fas fa-user"></a>
            </div>

        </header>
        <body>
        <section class="home" id="home">
<?php
if($_SESSION['is_produtor']){ ?>

    <form class="form-update-infos-produtor" method="POST" action="update_infos.php" onsubmit="return validar_produtor()" style="display: none; margin: 20px; padding: 20px; width: 30%; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f8f8;">
        <label for="nome">Nome:</label>
        <input type="text" id="nome_empresa" name="new_nome_empresa" value="<?php echo $nome_empresa ?>" style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;">
        <p style="display: none; color:red; margin-bottom:10px;" id="error-name-empresa">
                        *O nome da empresa não deve conter números nem caracteres especiais.<br>
                        *O nome da empresa deve possuir mais que 3 caracteres.
                    </p>
        <label for="email">E-mail:</label>
        <input type="text" id="email_produtor" name="new_email" value="<?php echo $email_prod ?>" style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;">
        <p style="display: none; color:red; margin-bottom:10px;" id="error-email_empresa">
                        *Digite um email valido<br>

                    </p>
        <label for="telefone">Telefone:</label>
        <input type="text" id="phone_produtor" name="new_phone" value="<?php echo $fone_prod ?>" style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;">
        <p style="display: none; color:red; margin-bottom:10px;" id="error-phone">
                        *Digite um telefone valido<br>

                    </p>
        <input type="submit" value="Salvar" style="background-color: #4CAF50; color: #fff; border: none; border-radius: 3px; padding: 10px 15px; cursor: pointer; font-size: 16px; margin-left: auto; margin-right: auto; display: block;">
    </form>



    <table class="tabela-produtor">
                <tr class="label-name">
                    <th>Nome Empresa:</th>
                    <td><?php echo $nome_empresa?></td>
                </tr>
                <tr class="label-name">
                    <th>Email:</th>
                    <td><?php echo $email_prod?></td>
                </tr>
                <tr class="label-name">
                    <th>Phone:</th>
                    <td><?php echo $fone_prod?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="delete-btn" onclick="delete_acc()">Excluir Perfil</button>
                        <button class="edit-btn" onclick="edit_acc_prod()">Editar Perfil</button>
                    </td>
                </tr>
            </table>
        <?php } else{ ?>
            <form class="form-update-infos-comprador" method="POST" action="update_infos.php" onsubmit="return validate_comprador()" style="display: none; margin: 20px; width: 30% ; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f8f8f8;">
                <label for="nome">Primeiro Nome:</label>
                <input type="text" id="first_name" name="new_first_name" value="<?php echo $first_name ?>" style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;">
                <p style="display: none; color:red; margin-bottom:10px;" id="error-name">
                        *O nome nao pode conter numeros e simbolos<br>
                        *O nome deve possouir mais que 3 caracteres
                    </p>
                <label for="nome">Ultimo Nome:</label>
                <input type="text" id="last_name" name="new_last_name" value="<?php echo $last_name ?>" style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;">
                <p style="display: none; color:red;margin-bottom:10px;" id="error-last-name">
                        *O sobrenome nao pode conter numeros e simbolos<br>
                        *O sobrenome deve possuir mais que 3 caracteres
                    </p>
                <label for="email">E-mail:</label>
                <input type="text" id="email" name="new_email" value="<?php echo $email ?>" style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;">
                <p style="display: none; color:red;margin-bottom:10px;" id="error-email">
                        *Digite um email valido<br>
                    </p>
                <label for="telefone">Telefone:</label>
                <input type="text" id="phone" name="new_phone" value="<?php echo $phone ?>" style="display: block; margin-bottom: 10px; padding: 5px; border: 1px solid #ccc; border-radius: 3px; width: 100%; box-sizing: border-box;">
                <p style="display: none; color:red;margin-bottom:10px;"  id="error-phone">
                        *digite um telefone valido<br>
                    </p>
                <input type="submit" value="Salvar" style="background-color: #4CAF50; color: #fff; border: none; border-radius: 3px; padding: 10px 15px; cursor: pointer; font-size: 16px; margin-left: auto; margin-right: auto; display: block;">
            </form>


            <table class="tabela-comprador">
                <tr class="label-name">
                    <th>First Name:</th>
                    <td><?php echo $first_name?></td>
                </tr>
                <tr class="label-name">
                    <th>Last Name:</th>
                    <td><?php echo $last_name?></td> <!-- fazem atencao um de vcs  apagaram o td  nao tava mostrando o ultimo nome -->
                </tr>
                <tr class="label-name">
                    <th>Phone:</th>
                    <td><?php echo $phone?></td>
                </tr>
                <tr class="label-name">
                    <th>Email:</th>
                    <td><?php echo $email?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="delete-btn" onclick="delete_acc()">Excluir Perfil</button>
                        <button class="edit-btn" onclick="edit_acc_comprador()">Editar Perfil</button>
                    </td>
                </tr>
            </table>
        </body>
<?php } ?>

<script>
     function allLetter(inputtxt)
    {
        var letters = /^[A-Za-z,\s]+$/;
        if(inputtxt.value.match(letters))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function isPhone(inputtext){
        const ph=/^\+?[1-9][0-9]{7,14}$/;
        return ph.test(inputtext);
    }

    function isPassword(text){
        const  passw=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/; // no minimo um numero um maiusculo e um minusculo
        if(passw.test(text)){
            return true;
        }
        return false;
    }
    const first=document.getElementById('first_name');
    const last=document.getElementById('last_name');
    const email=document.getElementById('email');
    const phone=document.getElementById('phone');
    

    function validate_comprador(){
        //----------------------------------------validando first_name--------------------------------------------------
        if (first.value.length<3 || !allLetter(first)){
           
            first.style.borderColor = 'red'
            var errorName = document.querySelector("#error-name")
            errorName.style.display = 'block'
            first.focus();
            return false;
        }
        else {
           
            first.style.borderColor = '';
            var errorName = document.querySelector("#error-name");
            errorName.style.display = 'none';
        }

        //----------------------------------------validando last_name--------------------------------------------------
        if (last.value.length<3 || !allLetter(last)){
            
            last.style.borderColor = 'red'
            var errorLastName = document.querySelector("#error-last-name")
            errorLastName.style.display = 'block'
            last.focus();
            return false;
        }else{
            
            last.style.borderColor = '';
            var errorLastName = document.querySelector("#error-last-name");
            errorLastName.style.display = 'none';
        }


        //----------------------------------------validando email----------------------------------------------------
        if(!email.value.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)){
            
            email.style.borderColor = 'red'
            var errorEmail = document.querySelector("#error-email")
            errorEmail.style.display = 'block'
            email.focus();
            return false;
        }else{
            
            email.style.borderColor = '';
            var errorEmail = document.querySelector("#error-email");
            errorEmail.style.display = 'none';
        }


        //----------------------------------------validando telefone----------------------------------------------------
        if(!isPhone(phone.value)){
            
            phone.style.borderColor = 'red'
            var errorPhone = document.querySelector("#error-phone")
            errorPhone.style.display = 'block'
            email.focus();
            return false;
        }else{
            
            phone.style.borderColor = '';
            var errorPhone = document.querySelector("#error-phone");
            errorPhone.style.display = 'none';
        }

       

        return true;

    }
    function delete_acc(){
        if(confirm('Tem certeza que deseja deletar a conta?')){
        window.location.href='Delete_account.php';
        }
    }
    function edit_acc_prod(){
        
        
        tabelaProd = document.querySelector('.tabela-produtor')
        tabelaProd.style.display = 'none'
        formUpdate = document.querySelector('.form-update-infos-produtor')
        formUpdate.style.display = 'block'

    }
    function edit_acc_comprador(){
        
        tabelaComprador = document.querySelector('.tabela-comprador')
        tabelaComprador.style.display = 'none'
        formUpdateComprador = document.querySelector('.form-update-infos-comprador')
        formUpdateComprador.style.display = 'block'
        }
        function isEmail(text) {
        const regex =/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/;
        if(regex.test(text)){
            return true;
        }
        return false;
    }


    

    



    const nome_empresa=document.getElementById('nome_empresa');
    const email_empresa=document.getElementById('email_produtor');
    const phone_empresa=document.getElementById('phone_produtor');
    

    function validar_produtor(){
//----------------------------------------validando nome-empresa--------------------------------------------------
        if (nome_empresa.value.length<3 || !allLetter(nome_empresa)){
            nome_empresa.style.borderColor = 'red';
            var errorNomeEmpresa = document.querySelector("#error-name-empresa");
            errorNomeEmpresa.style.display = 'block';
            nome_empresa.focus();
            return false;
        
        }else {
            
            nome_empresa.style.borderColor = '';
            var errorNomeEmpresa = document.querySelector("#error-name-empresa");
            errorNomeEmpresa.style.display = 'none';
        }

      

        //----------------------------------------validando email--------------------------------------------------
        if(!isEmail(email_empresa.value)){
            
            email_empresa.style.borderColor = 'red'
            var errorEmail = document.querySelector("#error-email")
            errorEmail.style.display = 'block'
            email_empresa.focus();
            return false;
        }else {
            email_empresa.style.borderColor = '';
            var errorEmail = document.querySelector("#error-email");
            errorEmail.style.display = 'none';
        }

        //----------------------------------------validando telefone--------------------------------------------------
        if(!isPhone(phone_empresa.value)){
            phone_empresa.style.borderColor = 'red'
            var errorPhone = document.querySelector("#error-phone")
            errorPhone.style.display = 'block'
            phone_empresa.focus();
            return false;
        }else {
            phone_empresa.style.borderColor = '';
            var errorPhone = document.querySelector("#error-phone");
            errorPhone.style.display = 'none';
        }

        
       

        return true;

    }
</script>
</html>