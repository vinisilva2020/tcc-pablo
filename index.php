<?php
session_start();
error_reporting(0);
include("conexao/conectar.php");
if (isset($_COOKIE['carrinho'])) {
    $carrinho = unserialize($_COOKIE['carrinho']);
    $carrao = array();
    foreach ($carrinho as $key => $value) {
        $sql = "SELECT * FROM produtos WHERE produto_id = '$key'";
        $resultadoCarrinho = mysqli_query($db, $sql);
        $carrao[] = mysqli_fetch_assoc($resultadoCarrinho);
    }
    //var_dump($carrao);
}
if (isset($_GET['idCarrinho'])) {
    $nomeCookie = "carrinho";
    $expiracao = time() + 3600; // Expira em 1 hora
    $idCarrinho = $_GET['idCarrinho'];

    if (!isset($_COOKIE['carrinho'])) {
        $carrinho = array($idCarrinho => 1);
    } else {
        $carrinho = unserialize($_COOKIE['carrinho']);

        if (array_key_exists($idCarrinho, $carrinho)) {
            $carrinho[$idCarrinho]++;
        } else {
            $carrinho[$idCarrinho] = 1;
        }
    }

    setcookie($nomeCookie, serialize($carrinho), $expiracao);

    var_dump($carrinho);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quitutes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="css/estilo.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
</body>

</html>

<nav class="navbar navbar-expand-lg bg-body-tertiary"></nav>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="img/quitutes.png" alt="Bootstrap" width="85" height="75">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Novo Pedido</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Meus Pedidos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link active" href="#">Atualizar Dados</a>
                    <?php
                    if (isset($_SESSION['u_id'])) {
                        echo $_SESSION['nomeusuario'];
                    }
                    ?>
                </li>
            </ul>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a class="btn btn-link" href="registrar.php" role="button">Criar Conta</a>
                <a class="btn btn-outline-danger" href="login.php" type="button">Login</a>

                <a class="btn btn-outline-danger" href="perfil.php">Perfil</a>

                <a class="btn btn-outline-danger" href="sair.php">Sair</a>
                <?php
                if (isset($_SESSION['u_id']) and $_SESSION['permissao'] == 1) {

                    ?>
                    <a class="btn btn-outline-danger" href="admin.php" type="button">Admin</a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg bg-body-tertiary"></nav>

<!-- FIM DO CABEÇALHO -->

<!-- INICIO DO CONTEUDO -->
<section class="hero bg-image" data-image-src="img/fundo.png">
    <div class="hero-inner">
        <div class="container text-center font-white">
            <h1>Facilitando seu dia a dia </h1>
            <h1>Peça e receba onde estiver.</h1>
            <div class="banner-form">
                <form class="form-inline">
                </form>
            </div>
            <div class="steps">
                <div class="step-item step1">
                    <h4><span style="color:white;">1. </span>Escolha seu pedido</h4>
                </div>
                <div class="step-item step2">
                    <h4><span style="color:white;">2. </span>Adicione ao carrinho</h4>
                </div>
                <div class="step-item step3">
                    <h4><span style="color:white;">3. </span>Delivery ou busca</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<h1></h1>
<section class="popular">
    <div class="container">
        <div class="row">
            <?php
            if (isset($_SESSION['msg']) and $_SESSION['msg'] != "" and isset($_SESSION['alert']) and $_SESSION['alert'] != "") {
                ?>
                <div class="alert <?php echo $_SESSION['alert']; ?> alert-dismissible fade show" role="alert">
                    <strong>
                        <?php echo $_SESSION['msg'] ?>
                    </strong>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php }
            unset($_SESSION['msg']);
            unset($_SESSION['alert']);
            ?>

            <div class="col-xs-12 col-sm-6 col-md-3 food-item">
                <div class="widget-heading">
                    <h3 class="widget-title text-dark">
                        Seu Produtos
                    </h3>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                    <div class="container mt-4">


                        <div class="row">
                            <?php
                            $sql = "SELECT * FROM produtos";
                            $resultado = mysqli_query($db, $sql);
                            while ($dados = mysqli_fetch_assoc($resultado)) {
                                $id_produto = $dados['produto_id'];
                                $produto_nome = $dados['produto_nome'];
                                $descricao = $dados['descricao'];
                                $preco = $dados['produto_preco'];
                                $imagem = $dados['produto_img'];
                                ?>
                                <div class="col-md-12 m-2">
                                    <div class="card d-inline">
                                        <img src="<?php echo $imagem ?>" class="card-img-top"
                                            alt="<?php echo $produto_nome ?>">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?php echo $produto_nome ?>
                                            </h5>
                                            <p class="card-text">
                                                <?php echo $descricao ?>
                                            </p>
                                            <p class="card-text">Preço: $
                                                <?php echo $preco ?>
                                                <?php
                                                if (isset($_SESSION['u_id'])) {
                                                    ?>
                                                </p>
                                                <!-- Add any other information you want to display -->
                                                <a class="btn btn-success"
                                                    href="index.php?idCarrinho=<?= $id_produto ?>">Adicionar ao Carrinho</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>

                        </div>



                    </div>

                </div>
                <!-- INICIA CARRINHO -->
                <h3>Carrinho de compras</h3>
                <form action="fecharPedido.php" method="POST">
                    <?php
                    foreach ($carrao as $carrazinho) {
                        $carrinho = unserialize($_COOKIE['carrinho']);
                        $idProduto = $carrazinho['produto_id'];
                        echo "$carrinho[$idProduto] x ";
                        echo $carrazinho['produto_nome'];
                        echo "<br>";
                    }
                    ?>
                    <input name="descricao" type="text">
                    <button class="btn btn-primary">Fechar pedido</button>
                </form>
            </div>

        </div>
</section>

<hr style="margin-top: 200px;">

</section>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Acompanhar Pedido</h5>
                    <hr>
                    <div class="mb-6">
                        <ul class="list-group">
                            <?php
                            $id_sessao = $_SESSION['u_id'];

                            $acompanhar = mysqli_query($db, "SELECT * FROM pedido INNER JOIN pagamento ON pagamento.pedido_id = pedido.pedido_id INNER JOIN produtos ON produtos.produto_id = pagamento.produto_id ");
                            while ($row = mysqli_fetch_assoc($acompanhar)) {
                                $status_pedido = $row['pedido_status'];
                                $produto = $row['produto_nome'];
                                ?>
                                <li class="list-group-item">
                                    <strong>
                                        <?php echo $produto ?>
                                    </strong>;
                                </li>
                                <li>
                                    <?php
                                    if ($row['pedido_status'] == 0) {
                                        echo "Produto não finalizado";
                                    }
                                    ?>
                                </li>
                                <?php
                                if ($_SESSION['permissao'] == 1 and $row['pedido_status'] == 0) {
                                    ?>
                                    <a class="btn btn-success" href="atualizar_pedido?id=<?php echo $row['pedido_id']; ?>">Mudar
                                        pedido para pronto</a>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FIM DO CONTEÚDO -->

<!-- INÍCIO DO RODAPE -->
<section class="">
    <div class="container text-center text-md-start mt-5">
        <div class="row mt-3">
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold mb-4">
                    <i class="fas fa-gem me-3"></i>Quitutes da vivi
                </h6>
                <p>
                    lorem ipsul sei la oq la e oq lalalalalala.
                </p>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

                <h6 class="text-uppercase fw-bold mb-4">
                    Links Sociais
                </h6>
                <p>
                    <a href="#!" class="text-reset">Instagram</a>
                </p>
                <p>
                    <a href="#!" class="text-reset">Facebook</a>
                </p>
                <p>
                    <a href="#!" class="text-reset">Whatsapp</a>
                </p>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h6 class="text-uppercase fw-bold mb-4">Contate-nos</h6>
                <p><i class="fas fa-home me-3"></i> uruguaiana, prado lima 2031, BR</p>
                <p>
                    <i class="fas fa-envelope me-3"></i>
                    gmail@gmail.com
                </p>
                <p><i class="fas fa-phone me-3"></i> + 55 9 9999-9999</p>
                <p><i class="fas fa-print me-3"></i> + 55 9 9999-9999</p>
            </div>
            <div class="col-xs-12 col-sm-3 payment-options color-gray">
                <h6 class="text-uppercase fw-bold mb-4">
                    Opções de pagamento
                </h6>
                <ul>
                    <li>
                        <a href="#"> <img src="img/dinheiro.png" alt="Dinheiro"> </a>
                    </li>
                    <li>
                        <a href="#"> <img src="img/pix.png" alt="Pix"> </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<hr>

<div class="footer">
    <img src="img/quitutefooter.png" alt="Bootstrap" height="100%" />
    <span>© Copyright 2023 ....- <br />Todos os direitos reservados ....</span>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
</body>

</html>