<?php
include('connexion.php');

$nome_empresa=$_POST['nome_empresa'];
$cnpj= $_POST['cnpj'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$password=$_POST['pass'];
$insta_prod=$_POST['insta_prod'];



$sql1= "Select email_prod from infos_prod where email_prod='$email'";
$sql2=  "Select cnpj from infos_prod where cnpj='$cnpj'";
$result_email= $conn->query($sql1);
$result_cnpj= $conn->query($sql2);
if($result_email->num_rows >0){
        session_start();
        $_SESSION['duplicate_email']=True;
        header('Location: Cadastro_produtor.php');
}
elseif($result_cnpj->num_rows > 0){
    session_start();
    $_SESSION['duplicate_cnpj']=True;
    header('Location: Cadastro_produtor.php');
}

else{




$sql = "INSERT INTO infos_prod(nome_empresa,cnpj,email_prod,fone_prod,pass_prod,insta_prod) values ('$nome_empresa','$cnpj','$email','$phone','$password','$insta_prod')";
 if ($conn->query($sql) === TRUE) {
     session_start();
     $_SESSION['created']=True;
     header('Location: Login_test.php');


     }
 }
 $conn->close();

?>