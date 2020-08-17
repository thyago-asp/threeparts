<?php
session_start();
//require_once("../../../estrutura/controleLogin.php");
require_once("../../../controller/ControllerMontadoras.php");
$retorno_cadastro = "";

if (isset($_REQUEST["r"])) {
    // Verifico se o retorno do cadastro do usuario deu certo.
    // 1 = sucesso.
    // 0 = erro - email já cadastrado.
    if ($_REQUEST["r"] == "1") {
        $retorno_cadastro = "sucesso";
    } else if ($_REQUEST["r"] == "0") {
        $retorno_cadastro = "Veiculo_cadastrada";
    } else if ($_REQUEST["r"] == "3") {
        $cod_erro = $_REQUEST["cod_erro"];
        $retorno_cadastro = "erro_cadastro_em_massa";
    } else if ($_REQUEST["r"] == "2") {
        $retorno_cadastro = "sucesso_emmassa";
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
                    } else if ($retorno_cadastro == "Veiculo_cadastrada") {
                    ?>
                        <div class="alert alert-danger text-center" role="alert">
                            Não foi possivel cadastrar. Código da Veiculo já está sendo utilizado.
                        </div>
                    <?php
                    } else if ($retorno_cadastro == "erro_cadastro_em_massa") {
                    ?>
                        <div class="alert alert-danger text-center" role="alert">
                            Não foi possivel cadastrar os códigos. O código <?php echo $cod_erro ?> já está cadastro.
                        </div>
                    <?php
                    } else if ($retorno_cadastro == "sucesso_emmassa") {
                    ?>
                        <div class="alert alert-success text-center" role="alert">
                            Todos os veiculos do excel foram cadastrados.
                        </div>
                    <?php
                    }

                    ?>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form id="formCadastroMassa" enctype="multipart/form-data" method="post" action="../../../controller/ControllerVeiculos.php?acao=cadEmMassa">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Importar arquivo excel</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="custom-file">

                                            <input type="file" name="imagem" id="imagemPF">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="header-title text-center">Cadastro de Veiculos</h4>
                        <p class="text-muted font-14 mb-4 text-center">Realize o cadastro de uma nova Veiculo e de qual ano pertence</p>
                        <button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#exampleModal">
                            Cadastro em massa
                        </button>
                        <form id="formVeiculo" method="post" action="../../../controller/ControllerVeiculos.php?acao=cad">

                            <div class="form-group">
                                <label for="modelo_veiculo_input" class="col-form-label">Código</label>
                                <input class="form-control" autofocus="true" type="text" name="codigo_veiculo" id="codigo_veiculo">
                            </div>
                            <label for="marca_carro_input" class="col-form-label">Montadora do veiculo</label>

                            <select class="form-control" id="idmontadora" name="idmontadora">
                                <option selected> Selecione uma montadora </option>
                                <?php
                                $listaMontadoras = (new ControllerMontadoras())->listar();

                                foreach ($listaMontadoras as $montadora) {
                                ?>

                                    <option value="<?= $montadora->codigo ?>"><?= $montadora->montadora ?>

                                    <?php
                                }
                                    ?>
                            </select>

                            <div class="form-group">
                                <label for="nome_carro_input" class="col-form-label">Nome do veiculo</label>
                                <input class="form-control" autofocus="true" type="text" name="nomeveiculo" id="nomecarro">
                            </div>
                            <div class="form-group">
                                <label for="modelo_veiculo_input" class="col-form-label">Modelo</label>
                                <input class="form-control" autofocus="true" type="text" name="modeloveiculo" id="modeloveiculo">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Ano</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="anoinicial" placeholder="Ano inicial" aria-describedby="anoInicialHelp">
                                        <small id="anoInicialHelp" class="form-text text-muted">
                                            Essa é a data inicial do modelo do carro para as peças que serão criadas para esse carro.
                                        </small>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="anofinal" placeholder="Ano final" aria-describedby="anoFinalHelp">
                                        <small id="anoFinalHelp" class="form-text text-muted">
                                            Essa é a data final do modelo do carro para as peças que serão criadas para esse carro.
                                        </small>
                                    </div>
                                </div>
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