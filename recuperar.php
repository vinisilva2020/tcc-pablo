<?php

include("conexao/conectar.php");
session_start();



if (!isset($_SESSION['id_recuperar'])) {
    header("location:index.php");
    die;
}


if (isset($_POST['login'])) {
    $id = $_POST['id'];
    $senha = $_POST['senha'];

   $hash = password_hash($senha,PASSWORD_DEFAULT);


    $sql_alterar = mysqli_query($db,"UPDATE usuarios SET senha = '$hash' WHERE u_id = '$id'");

    if ($sql_alterar) {
        header("location:index.php");
        die;
    }else {
        echo "ERRO".mysqli_error($db);
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
                                    <input type="hidden" name="id" value="<?php echo $_SESSION['id_recuperar']; ?>">
                                    <input type="text" name="senha" placeholder="Senha"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" name="usuario">Senha</label>
                                </div>
                                <input class="btn btn-danger btn-lg btn-block" type="submit" name="login">
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