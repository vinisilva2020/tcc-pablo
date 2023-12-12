<?php
include("conexao/conectar.php");

session_start();
if (isset($_SESSION['u_id']) && $_SESSION['permissao'] == 1) {
    $u_id = $_SESSION['u_id'];
    $admin = $_SESSION['nomeusuario'];
} else {
    header("location:index.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Administrativa</title>
    <!-- Adicione a ligação para o Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="container mt-5">

    <h1 class="mb-4">Administração</h1>

    <p>Bem-vindo,
        <?php echo $admin; ?>, à área administrativa do site.
    </p>


    <a class="btn btn-danger" href="index.php">Tela de início</a>
    <!-- Formulário para cadastrar produto -->
    <form action="processa_produtos.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Produto</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição do Produto</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Preço do Produto</label>
            <input type="number" class="form-control" id="preco" name="preco" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem do Produto</label>
            <input type="file" class="form-control" id="imagem" name="imagem" required>
        </div>
        <input type="submit" name="cadastro" class="btn btn-primary">
    </form>

    <!-- Tabela para visualizar pagamentos -->
    <h2 class="mt-5">Produtos</h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome do Produto</th>
                <th scope="col">Descrição</th>
                <th scope="col">Preço</th>
                <th scope="col">imagem</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $sql_banco = "SELECT * FROM produtos";
                $banco = mysqli_query($db, $sql_banco);
                while ($dados_produto = mysqli_fetch_assoc($banco)) {

                    ?>
                    <td>
                        <?php echo $dados_produto['produto_id']; ?>
                    </td>
                    <td>
                        <?php echo $dados_produto['produto_nome']; ?>
                    </td>
                    <td>
                        <?php echo $dados_produto['descricao']; ?>
                    </td>
                    <td>
                        <?php echo $dados_produto['produto_preco']; ?>
                    </td>
                    <td><img height="40" src="<?php echo $dados_produto['produto_img']; ?>" alt=""></td>
                    <td><a href="admin1.php?id=<?php echo $dados_produto['produto_id']; ?>">Editar</a></td>
                    <td><a href="excluir_produto.php?id=<?php echo $dados_produto['produto_id']; ?>">Excluir</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Adicione a ligação para o Bootstrap JS e o jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"
        integrity="sha384-dZd0AovlQsGGgiqeiK5a6C2HqyTSej6qR5bOELC2w9xTK3UqPPDPpHdEU2H5QW5J"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-bFRR5YRn4knXRoVlhNdNKE5r2vjDUq6f5Yuc9vXM5X3JxQfS7xkgpD4x7lgp85/l"
        crossorigin="anonymous"></script>

</body>

</html>