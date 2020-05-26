<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/ControllerMontadoras.php');
//require_once('../../../estrutura/controleLogin.php');
$retorno_edicao = "";

if (isset($_REQUEST["r"])) {
    // Verifico se o retorno do cadastro do montadora deu certo.
    // 1 = sucesso.
    // 0 = erro - email já cadastrado.
    if ($_REQUEST["r"] == "1") {
        $retorno_edicao = "sucesso";
    } else if ($_REQUEST["r"] == "0") {
        $retorno_edicao = "email_cadastrado";
    } else if ($_REQUEST["r"] == "2") {
        $retorno_edicao = "montadora_alterada";
    } else if ($_REQUEST["r"] == "3") {
        $retorno_edicao = "montadora_excluido";
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<?php
$pagina = "sub3";
include $_SERVER['DOCUMENT_ROOT'] . '/estrutura/head.php';

?>


<body id="page-top">
    <div class="modal fade" id="modalEdicao" tabindex="-1" role="dialog" aria-labelledby="modalEdicaoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEdicaoLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerMontadoras.php?acao=alterar" method="post">
                    <div class="modal-body">

                        <input type="hidden" id="id_Montadora" name="id_Montadora">

                                <div class="form-group">
                                    <label for="nome_montadora_input" class="col-form-label">Nome da Montadora</label>
                                    <input class="form-control" autofocus="true" type="text"  name="nome_montadora_input" id="nome_montadora_input" aria-describedby="nomeMarcaHelp">
                                    <small id="nomeMarcaHelp" class="form-text text-muted">
                                        Nome da montadora de carro. 
                                    </small>
                                </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExcluirLabel">Excluir montadora</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerMontadoras.php?acao=excluirMontadora" method="post">
                    <div class="modal-body">

                        <input type="hidden" id="id_Montadora" name="id_Montadora">


                        <label id="texto_excluir"></label>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                    if ($retorno_edicao == "sucesso") {
                    ?>
                        <div class="alert alert-success text-center" role="alert">
                            Alteração realizada com sucesso.
                        </div>
                    <?php
                    } else if ($retorno_edicao == "montadora_alterada") {
                    ?>
                        <div class="alert alert-success text-center" role="alert">
                            Montadora atualizada com sucesso.
                        </div>
                    <?php
                    } else if ($retorno_edicao == "montadora_excluido") {
                    ?>
                        <div class="alert alert-success text-center" role="alert">
                            Exclusão realizada com sucesso.
                        </div>
                    <?php
                    }
                    ?>

                    <div class="card-header text-center h5">
                        Lista de montadoras cadastrados
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Código montadora</th>
                                        <th>Montadora</th>

                                        <th>Ações</th>

                                    </tr>
                                </thead>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Código montadora</th>
                                        <th>Montadora</th>

                                        <th>Ações</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $lista_montadoras = (new ControllerMontadoras())->listar();

                                    //print_r($lista_montadoras);
                                    foreach ($lista_montadoras as $montadora) {


                                    ?>

                                        <tr>
                                            <td><?php echo $montadora->codigo ?></td>
                                            <td><?php echo $montadora->montadora ?></td>

                                            <td class="text-center">
                                                <div class="btn-group text-center" role="group" aria-label="Button group">
                                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalEdicao" data-codigo="<?php echo $montadora->codigo ?>" data-montadora="<?php echo $montadora->montadora ?>">Editar</button>
                                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalExcluir" data-codigo="<?php echo $montadora->codigo ?>" data-montadora="<?php echo $montadora->montadora ?>">Excluir</button>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php

                                    }

                                    ?>




                                </tbody>
                            </table>


                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <?php include '../../../estrutura/footer.php'; ?>
                    <!-- End of Footer -->
                </div>
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
        <script>
            $('#modalEdicao').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var codigo = button.data('codigo') // Extract info from data-* attributes
                var montadora = button.data('montadora')

                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Editar montadora')
                
                modal.find('#nome_montadora_input').val(montadora);
                modal.find('#id_Montadora').val(codigo)
            });
            $('#modalExcluir').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var codigo = button.data('codigo') // Extract info from data-* attributes
                var montadora = button.data('montadora')
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Confirmar exclusão')
                modal.find('#texto_excluir').text("Tem certeza que deseja excluir a " + montadora + " do sistema ?")
                modal.find('#id_Montadora').val(codigo)

            });
        </script>
</body>

</html>