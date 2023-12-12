<?php
include("conexao/conectar.php");
error_reporting(0);
session_start();
?>
<?php

if (isset($_POST['login'])) {

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];


    $sql = "SELECT * FROM usuarios WHERE nomeusuario ='$usuario';";
    $resultado = mysqli_query($db, $sql);

    if (mysqli_num_rows($resultado) > 0) {

        $dados = mysqli_fetch_assoc($resultado);
        if (password_verify($senha, $dados['senha'])) {
            session_start();
            $_SESSION["u_id"] = $dados['u_id'];
            $_SESSION["nomeusuario"] = $dados['nomeusuario'];
            $_SESSION["permissao"] = $dados['permissao'];


            if ($_SESSION['permissao'] == 1) {
                header("location:admin.php");
            } else {
                header("location:index.php");
            }
        }
    } else {
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>LOGIN</title>
</head>

<body>


    <section class="vh-100" style="background-color: #8B0000;">
        <form method="post">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <h3 class="mb-5">Login</h3>

                                <div class="form-outline mb-4">
                                    <input type="text" name="usuario" placeholder="Nome de Usuário"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" name="usuario">Usuário</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" name="senha" placeholder="•••••••••"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" name="senha">Senha</label>
                                </div>
                                <!-- <div class="form-check d-flex justify-content-start mb-4">
                                <input type="text" placeholder="sua nova senha"/>
                                <label type="submit" class="btn" name="esqueceu" value="Confirmar"> Recuperar Senha </label>
                            </div> -->
                                <input class="btn btn-danger btn-lg btn-block" type="submit" name="login">
                                <div class="cta">Não está registrado?<a href="registrar.php" style="color:#5c4ac7;">Crie
                                        uma
                                        conta</a></div>

                                <a href="esqueceu.php">Esqueceu sua senha</a>
                            </div>
                        </div>
                    </div>
                </div>

        </form>
        </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.nets/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>