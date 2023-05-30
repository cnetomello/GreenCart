<?php
include("connexion.php");
if(isset($_POST['input'])){

    $input = $_POST['input'];

    $sql = "SELECT * FROM anuncio_infos WHERE ((nome_produto LIKE '%{$input}%') OR (descricao LIKE '%{$input}%')) AND (qtd_produto > 0)  ";

    $result = $conn->query($sql);
    session_start();

    
        if ($result->num_rows > 0 ){
            $count = 0;
            
            
            while ($row = $result->fetch_assoc()){
                
                if($count % 3 == 0){
                    echo '<div class="row">';
                }
               
            echo '<div class="card">';
            echo '<img src="data:image/' . $row['tipo_foto'] . ';charset=utf8;base64,' . base64_encode($row['foto_produto']) . '" width="35%" height="150px">';
            echo '<h3>' . $row["nome_produto"] . '</h3>';
            echo $row["descricao"] . '<br>';
            echo '<div class="price">';
            echo 'R$:' . $row["preco_unitario"];
            

            if(! $_SESSION['is_produtor']){
                echo '<input type="hidden" name="produto_id" id="produto_id_' . $row["id_anuncio"] . '" value="' . $row["id_anuncio"] . '">';
                echo '<input type="hidden" name="qtd_produto" id="qtd_produto_' . $row["qtd_produto"] . '" value="' . $row["qtd_produto"] . '">';



                echo '</div>';
                echo '<button class="comprar-botao" data-target="popup1" 
                data-product-nome="' . $row["nome_produto"] . '"                    
                data-product-id="' . $row["id_anuncio"] . '"
                data-product-qtd="' . $row["qtd_produto"] . '" 
                >Comprar</button>';}
            echo '</div>';
                $count ++;
                if ($count % 1 != 0){
                    echo '</div>';
                }
              
            }
            
        }
        $conn->close();

    }
    else{
        echo "<h1> No data found </h1>";
    }


?>