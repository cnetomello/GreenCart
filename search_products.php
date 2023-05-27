<?php
include("connexion.php");
if(isset($_POST['input'])){

    $input = $_POST['input'];

    $sql = "SELECT * FROM anuncio_infos WHERE (nome_produto LIKE '%{$input}%') OR (descricao LIKE '%{$input}%')  ";

    $result = $conn->query($sql);

    if($result-> num_rows >0){
        if ($result->num_rows > 0 ){
            $count = 0;
            
            while ($row = $result->fetch_assoc()){
                
                if($count % 3 == 0){
                    echo '<div class="row">';
                }
                echo '<div class="card">';
                echo '<img  src="data:image/'. $row['tipo_foto'] . ';charset=utf8;base64,'. base64_encode($row['foto_produto']) .'"  width="35%" height="150px">';
                echo '<h3>' . $row["nome_produto"] . '</h3>';
                echo $row["descricao"] . '<br>';
                echo '<div class="price">';
                echo 'R$:' . $row["preco_unitario"] ;
                echo '</div>';
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
}

?>