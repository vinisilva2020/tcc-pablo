<?php
include("conexao/conectar.php");
session_start();
if(!isset($_SESSION['u_id'])){
    die("Não tem acesso!");
}
$idUsuario = $_SESSION['u_id'];
if(!isset($_POST['descricao'])){
    die("Erro de formulário");
}
$carrinho = unserialize($_COOKIE['carrinho']);

$descricao = $_POST['descricao'];
$sql = "INSERT INTO pedido (u_id,descricao,pedido_status) VALUES ('$idUsuario','$descricao','0')";
$query = mysqli_query($db, $sql);
if(!$query){
    die("Cadastro Pedido Erro " . mysqli_error($db));
}
$sql = mysqli_query($db,"SELECT pedido_id FROM pedido ORDER BY pedido_id DESC LIMIT 1");
$query = mysqli_fetch_assoc($sql);
$idPedido = $query['pedido_id'];
foreach($carrinho as $key => $value){
    for($i = 0; $i<$value; $i++){
    $sql = mysqli_query($db, "INSERT INTO pagamento (produto_id, pedido_id) VALUES ($key, $idPedido)");
    if(!$sql){
        die("Problema no cadastro de pagamento");
    }
  }
}
$_SESSION['alert'] = "alert-success";
$_SESSION['msg'] = "Cadastrado com sucesso";
require_once('deletarCookies.php');
header("location:index.php");