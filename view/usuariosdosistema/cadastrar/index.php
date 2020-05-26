<?php
session_start();
require_once("../../../estrutura/controleLogin.php");
$retorno_cadastro = "";

if (isset($_REQUEST["r"])) {
    // Verifico se o retorno do cadastro do usuario deu certo.
    // 1 = sucesso.
    // 0 = erro - email já cadastrado.
    if ($_REQUEST["r"] == "1") {
        $retorno_cadastro = "sucesso";
    } else if ($_REQUEST["r"] == "0") {
        $retorno_cadastro = "email_cadastrado";
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<?php
$pagina = "sub3";
include '../../../estrutura/head.php';
?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include '../../../estrutura/menulateral.php'; ?>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include '../../../estrutura/barratopo.php'; ?>
                <!-- Begin Page Content -->

                <div class="card">
                    <?php
                    if ($retorno_cadastro == "sucesso") {
                    ?>
                        <div class="alert alert-success text-center" role="alert">
                           Cadastro realizado com sucesso.
                        </div>
                    <?php
                    } else if ($retorno_cadastro == "email_cadastrado") {
                    ?>
                        <div class="alert alert-danger text-center" role="alert">
                            Não foi possivel cadastrar. E-mail já está sendo utilizado.
                        </div>
                    <?php
                    }

                    ?>
                    <div class="card-header text-center h5">
                        Cadastrar usuarios no sistema
                    </div>
                    <div class="card-body">
                        <form action="../../../controller/ControllerUsuario.php?acao=cad" method="post">
                            <label class="form-label">Nome completo</label>
                            <input type="text" class="form-control" name="n_nome" required>

                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="n_email" required>

                            <label class="form-label">Senha </label>
                            <input type="password" class="form-control" aria-describedby="senhaHelp" name="n_senha" id="n_senha" />
                            <small id="senhaHelp" class="form-text text-muted">A senha será redefinida no primeiro acesso pelo usuario.</small>

                            <div class="form-group">
                                <label for="s_pefil">Perfil</label>
                                <select id="s_pefil" class="custom-select" name="n_perfil">
                                    <option value="basico">Básico</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>



                            <button type="submit" class="btn btn-success w-100">Cadastrar</button>
                        </form>
                    </div>
                </div>

            </div>


            <!-- Footer -->
            <?php include '../../../estrutura/footer.php'; ?>
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
    include '../../../estrutura/painelLogout.php';
    ?>

    <!-- Bootstrap core JavaScript-->
    <?php
    include '../../../estrutura/importJS.php';
    ?>
</body>

</html>