<?php


include("conexao/conectar.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = mysqli_query($db,"DELETE FROM produtos WHERE produto_id = '$id'");

    if ($sql) {
    header("location:admin.php");
    }else {
        echo "ERRO ao excluir produto".mysqli_error($db);
    }

}



?>