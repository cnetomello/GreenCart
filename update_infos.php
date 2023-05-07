<?php
session_start();

include('connexion.php');

if($_SESSION['is_produtor']){

    $prod_id =isset($_SESSION['infos_pessoa_prod']['id']) ? $_SESSION['infos_pessoa_prod']['id'] : "N/A" ;

    $new_nome_empresa = $_POST['new_nome_empresa'];
    $new_email = $_POST['new_email'];
    $new_phone = $_POST['new_phone'];


    $sql = "UPDATE infos_prod SET nome_empresa='$new_nome_empresa', email_prod='$new_email', fone_prod='$new_phone' WHERE id_prod='$prod_id'";

    if($conn->query($sql) === TRUE){?>
        <script>
            alert( "Dados atualizados com sucesso");
         </script>  <?php
         $_SESSION['infos_pessoa_prod']['nome_empresa']=$new_nome_empresa ;
         $_SESSION['infos_pessoa_prod']['email_prod']= $new_email ;
         $_SESSION['infos_pessoa_prod']['fone_prod']= $new_phone ;
         $_SESSION['update']=true;
    } else {?>
        <script>
        alert( "Erro ao atualizar dados: " <?php echo $conn->error;?>);
     </script>
     <?php
      $_SESSION['update']=false;
    }
    $conn->close();
    header('location: User.php');


}
else {
    $comprador_id = isset($_SESSION['infos_pessoa']['id']) ? $_SESSION['infos_pessoa']['id'] : "N/A";

    $new_first_name = $_POST['new_first_name'];
    $new_last_name = $_POST['new_last_name'];
    $new_email = $_POST['new_email'];
    $new_phone = $_POST['new_phone'];

    $sql = "UPDATE infos SET first_name='$new_first_name', last_name='$new_last_name' , email='$new_email', phone='$new_phone' WHERE id='$comprador_id'";

    if($conn->query($sql) === TRUE){ ?>
    <script>
        alert( "Dados atualizados com sucesso");
     </script>  
     <?php  
        $_SESSION['infos_pessoa']['first_name'] =$new_first_name ;
        $_SESSION['infos_pessoa']['last_name'] = $new_last_name ;
        $_SESSION['infos_pessoa']['email'] = $new_email  ;
        $_SESSION['infos_pessoa']['phone'] = $new_phone ;
        $_SESSION['update']=true;
    } else {?>
        <script>
           
        alert( "Erro ao atualizar dados: " <?php echo $conn->error;?>);
     </script>
     <?php
      $_SESSION['update']=false;
    }
    $conn->close();
   
    header('location: User.php');


}
?>
