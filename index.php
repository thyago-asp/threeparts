<?php
session_start();

$erro = 0;
if (isset($_REQUEST["r"])) {
    switch ($_REQUEST["r"]) {
        case '0':
            $erro = 1;
            break;
        case '2':
            $erro = 2;
            break;
    }
}   
?>

<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Threeparts Acessórios Automotivos</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">

</head>

<body class="fundo_login">

    <div class="container">

        <div class="row justify-content-center">
            <div class="text-center card-login-img">
                <h1 class="h4  mb-4"> <img src="https://yata-apix-b7294009-f84d-4d92-933b-620abbcc7c47.lss.locawebcorp.com.br/6e2e9672bc7c4339aca538bbe002e108.png" id="img_logo" /></h1>
            </div>
        </div>
        <div class="row justify-content-center">

            <div class="card o-hidden border-0 shadow-lg my-5 card-login">
                <div class="card-body p-0 ">

                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">

                                <?php
                                if ($erro == 1) {
                                ?>
                                    <div class="alert alert-danger text-center h8" role="alert">
                                        Usuario ou senha incorreto.
                                    </div>

                                <?php
                                } else if ($erro == 2) {
                                ?>
                                    <div class="alert alert-danger text-center h8" role="alert">
                                       Erro de conexão. Por favor entrar em contato com o administrador do sistema.
                                    </div>
                                <?php


                                }
                                ?>
                                <form class="user" action="./controller/ControllerUsuario.php?acao=log" method="post">
                                    <div class="form-group">

                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user icon-login"></i></span>
                                        </div>
                                        <input type="email" class="form-control " id="login" name="login" aria-describedby="emailHelp" placeholder="E-mail">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-key icon-login"></i></span>
                                        </div>
                                        <input type="password" class="form-control " id="senha" name="senha" placeholder="Senha">
                                    </div>

                                    <button type="submit" class="btn btn-success w-100">Entrar </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>