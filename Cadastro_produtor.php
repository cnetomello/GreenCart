<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="CSS/style.css">
    <title>Formulário</title>
</head>
<?php
session_start();
if(isset($_SESSION['duplicate'])){
?>
<script>
    alert('Email already registered.')

</script>
 <?php
    unset($_SESSION['duplicate']);    }

        ?>

<body>
<div class="container">
    <div class="form-image">
        <img src="images\greencart_carrinho-removebg-preview.png" alt="GreenCart">
    </div>
    <div class="form">
        <form action="Insert_info_produtor.php" method="post" onsubmit="return validate();">
            <div class="form-header">
                <div class="title">
                    <h1>Cadastre-se</h1>
                </div>
                <div class="login-button">
                    <button><a href="Login_test.php">Voltar pra Login</a></button>
                </div>
            </div>

            <div class="input-group">
                <div class="input-box">
                    <label for="nome_empresa">Nome Empresa</label>
                    <input id="nome_empresa" type="text" name="nome_empresa" placeholder="Digite o nome da empresa" required>
                    <p id="error-name-empresa" style="font-size: 10px; display: none">
                        *O nome da empresa nao pode conter numeros e caracteres especiais<br>
                        *O nome deve possouir mais que 3 caracteres
                    </p>
                </div>

            
                <div class="input-box">
                    <label for="email">E-mail</label>
                    <input id="email" type="text" name="email" placeholder="Digite seu e-mail" required>
                    <p id="error-email" style="font-size: 10px; display: none">
                        *Digite um email valido<br>

                    </p>
                </div>

                <div class="input-box">
                    <label for="number">Celular</label>
                    <input id="number" type="text" name="phone" placeholder="(xx) xxxx-xxxx" required>
                    <p id="error-phone" style="font-size: 10px; display: none">
                        *Digite um telefone valido<br>

                    </p>
                </div>

                <div class="input-box">
                    <label for="CNPJ">CNPJ</label>
                    <input id="CNPJ" type="text" name="cnpj" placeholder="00.000.000/0000-00" required>
                    <p id="error-cnpj" style="font-size: 10px; display: none">
                        *Digite um CNPJ valido<br>

                    </p>
                </div>

                <div class="input-box">
                    <label for="password">Senha</label>
                    <input id="password" type="password" name="pass" placeholder="Digite sua senha" required>
                    <p id="error-password" style="font-size: 10px; display: none">
                        *a senha deve conter pelo menos um caracter maiusculo<br>
                        *a senha deve conter pelo menos um caractere especial<br>
                        *a senha deve ter pelo menos 6 digitos
                    </p>
                </div>


                <div class="input-box">
                    <label for="confirmPassword">Confirme sua Senha</label>
                    <input id="confirmPassword" type="password" name="confirmPassword" placeholder="Digite sua senha novamente" required>
                    <p id="error-confirmPassword" style="font-size: 10px; display: none">
                        *as senhas devem ser igual<br>
                    </p>
                </div>

            </div>

            <div class="continue-button">
                <input type="submit" value="Continuar">
            </div>
        </form>
    </div>
</div>
<script>
    function isEmail(text) {
        const regex =/^[A-Za-z0-9_!#$%&'*+\/=?`{|}~^.-]+@[A-Za-z0-9.-]+$/;
        if(regex.test(text)){
            return true;
        }
        return false;
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
    function validarCNPJ(cnpj) {
 
 cnpj = cnpj.replace(/[^\d]+/g,'');

 if(cnpj == '') return false;
  
 if (cnpj.length != 14)
     return false;


 if (cnpj == "00000000000000" ||
     cnpj == "11111111111111" || 
     cnpj == "22222222222222" || 
     cnpj == "33333333333333" || 
     cnpj == "44444444444444" || 
     cnpj == "55555555555555" || 
     cnpj == "66666666666666" || 
     cnpj == "77777777777777" || 
     cnpj == "88888888888888" || 
     cnpj == "99999999999999")
     return false;
      
 // Valida DVs
 tamanho = cnpj.length - 2
 numeros = cnpj.substring(0,tamanho);
 digitos = cnpj.substring(tamanho);
 soma = 0;
 pos = tamanho - 7;
 for (i = tamanho; i >= 1; i--) {
   soma += numeros.charAt(tamanho - i) * pos--;
   if (pos < 2)
         pos = 9;
 }
 resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
 if (resultado != digitos.charAt(0))
     return false;
      
 tamanho = tamanho + 1;
 numeros = cnpj.substring(0,tamanho);
 soma = 0;
 pos = tamanho - 7;
 for (i = tamanho; i >= 1; i--) {
   soma += numeros.charAt(tamanho - i) * pos--;
   if (pos < 2)
         pos = 9;
 }
 resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
 if (resultado != digitos.charAt(1))
       return false;
        
 return true;
 
}

    const first=document.getElementById('nome_empresa');
    const email=document.getElementById('email');
    const phone=document.getElementById('number');
    const password=document.getElementById('password');
    const cnpj = document.getElementById('CNPJ');
    const confirm_pass = document.getElementById('confirmPassword');

    function validate(){
//----------------------------------------validando nome-empresa--------------------------------------------------
        if (first.value.length<3 || !allLetter(first)){
            var NameEmpresaInput = document.querySelector('.input-box input[type="text"][name="nome_empresa"]');
            NameEmpresaInput.style.borderColor = 'red'
            var errorNomeEmpresa = document.querySelector("#error-name-empresa")
            errorNomeEmpresa.style.display = 'block'
            first.focus();
            return false;
        }else {
            var NameEmpresaInput = document.querySelector('.input-box input[type="text"][name="nome_empresa"]');
            NameEmpresaInput.style.borderColor = '';
            var errorNomeEmpresa = document.querySelector("#error-name-empresa");
            errorNomeEmpresa.style.display = 'none';
        }

        //----------------------------------------validando CNPJ--------------------------------------------------
        if (!validarCNPJ(cnpj.value)){
            var cnpjInput = document.querySelector('.input-box input[type="text"][name="cnpj"]');
            cnpjInput.style.borderColor = 'red'
            var errorCnpj = document.querySelector("#error-cnpj")
            errorCnpj.style.display = 'block'
            first.focus();
            return false;
        }else {
            var cnpjInput = document.querySelector('.input-box input[type="text"][name="cnpj"]');
            cnpjInput.style.borderColor = '';
            var errorCnpj = document.querySelector("#error-cnpj");
            errorCnpj.style.display = 'none';
        }

        //----------------------------------------validando email--------------------------------------------------
        if(!isEmail(email.value)){
            var emailInput = document.querySelector('.input-box input[type="text"][name="email"]');
            emailInput.style.borderColor = 'red'
            var errorEmail = document.querySelector("#error-email")
            errorEmail.style.display = 'block'
            first.focus();
            return false;
        }else {
            var emailInput = document.querySelector('.input-box input[type="text"][name="email"]');
            emailInput.style.borderColor = '';
            var errorEmail = document.querySelector("#error-email");
            errorEmail.style.display = 'none';
        }

        //----------------------------------------validando telefone--------------------------------------------------
        if(!isPhone(phone.value)){
            var phoneInput = document.querySelector('.input-box input[type="text"][name="phone"]');
            phoneInput.style.borderColor = 'red'
            var errorPhone = document.querySelector("#error-phone")
            errorPhone.style.display = 'block'
            first.focus();
            return false;
        }else {
            var phoneInput = document.querySelector('.input-box input[type="text"][name="phone"]');
            phoneInput.style.borderColor = '';
            var errorPhone = document.querySelector("#error-phone");
            errorPhone.style.display = 'none';
        }

        //----------------------------------------validando password--------------------------------------------------
        if(!isPassword(password.value)){
            var passwordInput = document.querySelector('.input-box input[type="password"][name="pass"]');
            passwordInput.style.borderColor = 'red'
            var errorPassword = document.querySelector("#error-password")
            errorPassword.style.display = 'block'
            password.focus();
            password.value='';
            return false;
        }else {
            var passwordInput = document.querySelector('.input-box input[type="password"][name="pass"]');
            passwordInput.style.borderColor = '';
            var errorPassword = document.querySelector("#error-password");
            errorPassword.style.display = 'none';
        }

        //----------------------------------------validando senhas iguais--------------------------------------------------
        if(password.value != confirm_pass.value){
            var confirmPasswordInput = document.querySelector('.input-box input[type="password"][name="confirmPassword"]');
            confirmPasswordInput.style.borderColor = 'red'
            var errorConfirmPassword = document.querySelector("#error-confirmPassword")
            errorConfirmPassword.style.display = 'block'
            password.focus();
            confirm_pass.value='';
            return false
        }else{
            var confirmPasswordInput = document.querySelector('.input-box input[type="password"][name="confirmPassword"]');
            confirmPasswordInput.style.borderColor = '';
            var errorConfirmPassword = document.querySelector("#error-confirmPassword");
            errorConfirmPassword.style.display = 'none';
        }

        return true;

    }


</script>

</body>

</html>