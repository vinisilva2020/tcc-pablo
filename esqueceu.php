<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


include("conexao/conectar.php");
error_reporting(0);
session_start();
?>
<?php

if (isset($_POST['login'])) {

    $email = $_POST['email'];


    $sql = "SELECT * FROM usuarios WHERE email ='$email';";
    $resultado = mysqli_query($db, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
        $email = $dados['email'];

        echo $email;

        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = 'vinicius.2021318590@aluno.iffar.edu.br'; // Insira aqui o seu email do Gmail
        $mail->Password = 'Viniciusadministrador262219710708'; // Insira aqui a senha do seu email do Gmail



        $mail->setFrom("$email");
        $mail->isHTML(true);
        $mail->Subject = "Email automatico - Recuperar sua Senha";
        $mail->addAddress($email);
        // clica no teu site e coloca o caminho do arquivo
        $mail->Body = "Recupere Sua senha <a href='http://localhost/versao-nova/recuperar.php'>Clique aqui</a>";

        if ($mail->send()) {
            $_SESSION['id_recuperar'] = $dados['u_id'];
            echo "E-mail enviado ";
        } else {
            $erro_Mensagem = "Erro ao enviar email";
        }
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
                                    <input type="text" name="email" placeholder="Nome de Usuário"
                                        class="form-control form-control-lg" />
                                    <label class="form-label" name="usuario">E-mail</label>
                                </div>
                                <!-- <div class="form-check d-flex justify-content-start mb-4">
                                <input type="text" placeholder="sua nova senha"/>
                                <label type="submit" class="btn" name="esqueceu" value="Confirmar"> Recuperar Senha </label>
                            </div> -->
                                <input class="btn btn-danger btn-lg btn-block" type="submit" name="login">
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