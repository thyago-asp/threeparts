<?php
session_start();
//require_once("../../estrutura/controleLogin.php");
$primeiro_acesso = "";
$retorno_alterarSenha = "";
// caso a senha do usuario seja resetada ou seja o seu primeiro acesso. 
// marcamos a variavel como verdadeira(1) para que o modalPrimeiroAcesso seja chamado
// e o usuario mude a sua senha. 

if (isset($_SESSION["primeiro_acesso"])) {
    if ($_SESSION["primeiro_acesso"] == 1) {
        $primeiro_acesso = "1";
     
    }
}

if (isset($_REQUEST["r"])) {
    // Verifico se o retorno do cadastro do usuario deu certo.
    // 1 = sucesso.
    if ($_REQUEST["r"] == "1") {
        $retorno_alterarSenha = "sucesso";
    }
}
?>
<!DOCTYPE html>

<html lang="pt">

<?php
$pagina = "sub";
include '../../estrutura/head.php';
?>

<body id="page-top">


    <!-- Modal -->
    <div class="modal fade" id="modalPrimeiroAcesso" tabindex="-1" role="dialog" aria-labelledby="modalPrimeiroAcessoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalPrimeiroAcessoLabel">Atualizar a senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerUsuario.php?acao=alterarSenha" method="post">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="senha">Nova senha</label>
                            <input type="password" class="form-control" name="senha1" id="senha1" onkeyup="validarSenha()">
                        </div>
                        <div class="form-group">
                            <label for="">Repita a nova senha</label>
                            <input type="password" class="form-control" name="senha2" id="senha2" onkeyup="validarSenha()">
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary" id="btn_salvarSenha" name="btn_salvarSenha">Salvar senha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
        include '../../estrutura/menulateral.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <?php
                include '../../estrutura/barratopo.php';
                ?>

               
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include '../../estrutura/footer.php';
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php
    include '../../estrutura/painelLogout.php';
    ?>

    <!-- Bootstrap core JavaScript-->
    <?php
    include '../../estrutura/importJS.php';
    ?>

    <?php
    if ($primeiro_acesso == "1") {


    ?>

        <script>
            $('#modalPrimeiroAcesso').modal('show');

            document.getElementById("btn_salvarSenha").disabled = true;

            function validarSenha() {
                var senha1 = document.getElementById("senha1").value;
                var senha2 = document.getElementById("senha2").value;

                if (senha1 == senha2) {
                    document.getElementById("btn_salvarSenha").disabled = false;
                } else {
                    document.getElementById("btn_salvarSenha").disabled = true;
                }
            }
        </script>
    <?php
    }

    ?>
</body>

</html>