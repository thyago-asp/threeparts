<?php
session_start();
//require_once("../../../estrutura/controleLogin.php");
$retorno_cadastro = "";

if (isset($_REQUEST["r"])) {
    // Verifico se o retorno do cadastro do usuario deu certo.
    // 1 = sucesso.
    // 0 = erro - email já cadastrado.
    if ($_REQUEST["r"] == "1") {
        $retorno_cadastro = "sucesso";
    } else if ($_REQUEST["r"] == "0") {
        $retorno_cadastro = "montadora_cadastrada";
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
                    } else if ($retorno_cadastro == "montadora_cadastrada") {
                    ?>
                        <div class="alert alert-danger text-center" role="alert">
                            Não foi possivel cadastrar. Código da montadora já está sendo utilizado.
                        </div>
                    <?php
                    }

                    ?>
                    <div class="card-header text-center h5">
                        
                    </div>
                    <div class="card-body">
                            <h4 class="header-title text-center">Cadastro de montadoras</h4>
                            <p class="text-muted font-14 mb-4 text-center">Realize o cadastro de uma nova montadora e de qual ano pertence</p>
                            <form id="formMontadora" method="post" action="../../../controller/ControllerMontadoras.php?acao=cad">

                                <div class="form-group">
                                    <label for="nome_montadora_input" class="col-form-label">Código da Montadora</label>
                                    <input class="form-control" autofocus="true" type="text"  name="codigo_montadora_input" id="codigo_montadora_input" aria-describedby="nomeMarcaHelp">
                                    <small id="nomeMarcaHelp" class="form-text text-muted">
                                        Código interno da montadora de carro. 
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="nome_montadora_input" class="col-form-label">Nome da Montadora</label>
                                    <input class="form-control" autofocus="true" type="text"  name="nome_montadora_input" id="nome_marca_input" aria-describedby="nomeMarcaHelp">
                                    <small id="nomeMarcaHelp" class="form-text text-muted">
                                        Nome da montadora de carro. 
                                    </small>
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