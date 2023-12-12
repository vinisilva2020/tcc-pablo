<?php

session_start();

include("conexao/conectar.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $pedido = mysqli_query($db,"UPDATE pedido SET pedido_status = 1 WHERE pedido_id = '$id'");

    if ($pedido) {
        header("location:index.php");
    }else {
        echo "Erro ao alterar pedido";
    }
}