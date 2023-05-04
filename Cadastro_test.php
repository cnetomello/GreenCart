
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
        <form action="Insert_info.php" method="post" onsubmit="return validate();">
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
                    <label for="firstname">Primeiro Nome</label>
                    <input id="firstname" type="text" name="first_name" placeholder="Digite seu primeiro nome" required>
                    <p id="error-name" style="font-size: 10px; display: none">
                        *O nome nao pode conter numeros e simbolos<br>
                        *O nome deve possouir mais que 3 caracteres
                    </p>
                </div>

                <div class="input-box">
                    <label for="lastname">Sobrenome</label>
                    <input id="lastname" type="text" name="last_name" placeholder="Digite seu sobrenome" required>
                    <p id="error-last-name" style="font-size: 10px; display: none">
                        *O sobrenome nao pode conter numeros e simbolos<br>
                        *O sobrenome deve possuir mais que 3 caracteres
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
                    <input id="number" type="tel" name="phone" placeholder="(xx) xxxx-xxxx" required>
                    <p id="error-phone" style="font-size: 10px; display: none">
                        *digite um telefone valido<br>
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

            <div class="gender-inputs">
                <div class="gender-title">
                    <h6>Gênero</h6>
                </div>

                <div class="gender-group">
                    <div class="gender-input">
                        <input id="female" type="radio" name="gender" value="Feminino">
                        <label for="female">Feminino</label>
                    </div>

                    <div class="gender-input">
                        <input id="male" type="radio" name="gender" value="Masculino">
                        <label for="male">Masculino</label>
                    </div>

                    <div class="gender-input">
                        <input id="others" type="radio" name="gender" value="Outros">
                        <label for="others">Outros</label>
                    </div>
                </div>
                <p id="error-genero" style="font-size: 10px; display: none">
                    *por favor escolha pelo menos uma opcao<br>
                </p>

            </div>

            <div class="continue-button">
                <input type="submit" value="Continuar">
            </div>
        </form>
    </div>
</div>
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
    const first=document.getElementById('firstname');
    const last=document.getElementById('lastname');
    const email=document.getElementById('email');
    const phone=document.getElementById('number');
    const password=document.getElementById('password');
    const masculino = document.getElementById('male');
    const feminino = document.getElementById('female');
    const outros = document.getElementById('others');
    const confirm_pass = document.getElementById('confirmPassword');

    function validate(){
        //----------------------------------------validando first_name--------------------------------------------------
        if (first.value.length<3 || !allLetter(first)){
            var firstNameInput = document.querySelector('.input-box input[type="text"][name="first_name"]');
            firstNameInput.style.borderColor = 'red'
            var errorName = document.querySelector("#error-name")
            errorName.style.display = 'block'
            first.focus();
            return false;
        }
        else {
            var firstNameInput = document.querySelector('.input-box input[type="text"][name="first_name"]');
            firstNameInput.style.borderColor = '';
            var errorName = document.querySelector("#error-name");
            errorName.style.display = 'none';
        }

        //----------------------------------------validando last_name--------------------------------------------------
        if (last.value.length<3 || !allLetter(last)){
            var lastNameInput = document.querySelector('.input-box input[type="text"][name="last_name"]');
            lastNameInput.style.borderColor = 'red'
            var errorLastName = document.querySelector("#error-last-name")
            errorLastName.style.display = 'block'
            last.focus();
            return false;
        }else{
            var lastNameInput = document.querySelector('.input-box input[type="text"][name="last_name"]');
            lastNameInput.style.borderColor = '';
            var errorLastName = document.querySelector("#error-last-name");
            errorLastName.style.display = 'none';
        }


        //----------------------------------------validando email----------------------------------------------------
        if(!email.value.match(/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/)){
            var emailInput = document.querySelector('.input-box input[type="text"][name="email"]');
            emailInput.style.borderColor = 'red'
            var errorEmail = document.querySelector("#error-email")
            errorEmail.style.display = 'block'
            email.focus();
            return false;
        }else{
            var emailInput = document.querySelector('.input-box input[type="text"][name="email"]');
            emailInput.style.borderColor = '';
            var errorEmail = document.querySelector("#error-email");
            errorEmail.style.display = 'none';
        }


        //----------------------------------------validando telefone----------------------------------------------------
        if(!isPhone(phone.value)){
            var phoneInput = document.querySelector('.input-box input[type="tel"][name="phone"]');
            phoneInput.style.borderColor = 'red'
            var errorPhone = document.querySelector("#error-phone")
            errorPhone.style.display = 'block'
            email.focus();
            return false;
        }else{
            var phoneInput = document.querySelector('.input-box input[type="tel"][name="phone"]');
            phoneInput.style.borderColor = '';
            var errorPhone = document.querySelector("#error-email");
            errorPhone.style.display = 'none';
        }

        //----------------------------------------validando senha------------------------------------------------------
        if(!isPassword(password.value)){
            var passwordInput = document.querySelector('.input-box input[type="password"][name="pass"]');
            passwordInput.style.borderColor = 'red'
            var errorPassword = document.querySelector("#error-password")
            errorPassword.style.display = 'block'
            password.focus();
            password.value='';
            return false;
        }else{
            var passwordInput = document.querySelector('.input-box input[type="password"][name="pass"]');
            passwordInput.style.borderColor = '';
            var errorPassword = document.querySelector("#error-password");
            errorPassword.style.display = 'none';
        }


        //----------------------------------------validando genero------------------------------------------------------
        if(!(masculino.checked || feminino.checked || outros.checked)){
            var errorGender = document.querySelector("#error-genero");
            errorGender.style.display = 'block';
            return false

        }else{
            var errorGender = document.querySelector("#error-genero");
            errorGender.style.display = 'none';
        }
        //----------------------------------------validando senha iguais------------------------------------------------
        if(password.value != confirm_pass.value){
            var confirmPasswordInput = document.querySelector('.input-box input[type="password"][name="confirmPassword"]');
            confirmPasswordInput.style.borderColor = 'red'
            var errorConfirmPassword = document.querySelector("#error-confirmPassword")
            errorConfirmPassword.style.display = 'block'
            password.focus();
            confirm_pass.value='';
            return false;
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
