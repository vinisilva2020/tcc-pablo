<?php
include_once('conexao/conectar.php');



if (isset($_POST['cadastro'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $foto = null;

    if (isset($_FILES['imagem'])) {

        echo "Existe imagem";


        $nome_arquivo = $_FILES['imagem']['name'];
        $tipo = $_FILES['imagem']['type'];

        $nome_temporario =  $_FILES['imagem']['tmp_name'];
        $destino = "imagens/". $_FILES['imagem']['name'];

        
        $foto = "imagens/" . $nome_arquivo;

        move_uploaded_file($nome_temporario, $destino);

      
        $query = "INSERT INTO produtos (produto_nome, descricao, produto_preco, produto_img) VALUES ('$nome', '$descricao', '$preco', '$foto')";
        // Execute a query
           $resultado = mysqli_query($db, $query);

         if ($resultado) {
             header("location:index.php");
        } else {
           echo "Erro ao cadastrar o produto: " . mysqli_error($db);
        }

    }

}

if (isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $foto = null;

    if (isset($_FILES['imagem']) AND $_FILES['imagem']['name'] != "") {

        echo "Existe imagem";


        $nome_arquivo = $_FILES['imagem']['name'];
        $tipo = $_FILES['imagem']['type'];

        $nome_temporario =  $_FILES['imagem']['tmp_name'];
        $destino = "imagens/". $_FILES['imagem']['name'];

        
        $foto = "imagens/" . $nome_arquivo;

        move_uploaded_file($nome_temporario, $destino);


        $query = "UPDATE  produtos SET produto_nome = '$nome', descricao = '$descricao', produto_preco = '$preco', produto_img = '$foto' WHERE produto_id = '$id' ";
        // Execute a query
           $resultado = mysqli_query($db, $query);

         if ($resultado) {
             header("location:admin.php");
        } else {
           echo "Erro ao cadastrar o produto: " . mysqli_error($db);
        }

    }else {
        $query = "UPDATE  produtos SET produto_nome = '$nome', descricao = '$descricao', produto_preco = '$preco' WHERE produto_id = '$id' ";
        // Execute a query
           $resultado = mysqli_query($db, $query);


         if ($resultado) {
             header("location:admin.php");
        } else {
           echo "Erro ao cadastrar o produto: " . mysqli_error($db);
        }

    }

}

 
?>