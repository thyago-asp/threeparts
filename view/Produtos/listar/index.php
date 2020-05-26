<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/ControllerProdutos.php');
//require_once('../../../estrutura/controleLogin.php');
$retorno_edicao = "";

if (isset($_REQUEST["r"])) {
    // Verifico se o retorno do cadastro do Produto deu certo.
    // 1 = sucesso.
    // 0 = erro - email já cadastrado.
    if ($_REQUEST["r"] == "1") {
        $retorno_edicao = "sucesso";
    } else if ($_REQUEST["r"] == "0") {
        $retorno_edicao = "email_cadastrado";
    } else if ($_REQUEST["r"] == "2") {
        $retorno_edicao = "Produto_alterada";
    } else if ($_REQUEST["r"] == "3") {
        $retorno_edicao = "Produto_excluido";
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
                <form action="../../../controller/ControllerProdutos.php?acao=alterar" method="post">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nome_Produto_input" class="col-form-label">Código</label>
                            <input class="form-control" autofocus="true" type="text" name="codigo_produto" id="codigo_produto" aria-describedby="nomeMarcaHelp" readonly>
                            <small id="nomeMarcaHelp" class="form-text text-muted">
                                Código interno do produto
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="nome_Produto_input" class="col-form-label">Descricao</label>
                            <input class="form-control" autofocus="true" type="text" name="descricao_produto" id="descricao_produto" aria-describedby="nomeMarcaHelp">
                            <small id="nomeMarcaHelp" class="form-text text-muted">
                                Descricao do produto
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
                    <h5 class="modal-title" id="modalExcluirLabel">Excluir Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerProdutos.php?acao=excluirProduto" method="post">
                    <div class="modal-body">

                        <input type="hidden" id="id_Produto" name="id_Produto">


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
                    } else if ($retorno_edicao == "Produto_alterada") {
                    ?>
                        <div class="alert alert-success text-center" role="alert">
                            Produto atualizada com sucesso.
                        </div>
                    <?php
                    } else if ($retorno_edicao == "Produto_excluido") {
                    ?>
                        <div class="alert alert-success text-center" role="alert">
                            Exclusão realizada com sucesso.
                        </div>
                    <?php
                    }
                    ?>

                    <div class="card-header text-center h5">
                        Lista de Produtos cadastrados
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Código Produto</th>
                                        <th>Produto</th>

                                        <th>Ações</th>

                                    </tr>
                                </thead>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Código Produto</th>
                                        <th>Produto</th>

                                        <th>Ações</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $lista_Produtos = (new ControllerProdutos())->listar();

                                    //print_r($lista_Produtos);
                                    foreach ($lista_Produtos as $produto) {


                                    ?>

                                        <tr>
                                            <td><?php echo $produto->codigo ?></td>
                                            <td><?php echo $produto->descricao ?></td>

                                            <td class="text-center">
                                                <div class="btn-group text-center" role="group" aria-label="Button group">
                                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalEdicao" data-codigo="<?php echo $produto->codigo ?>" data-descricao="<?php echo $produto->descricao ?>">Editar</button>
                                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalExcluir" data-codigo="<?php echo $produto->codigo ?>" data-descricao="<?php echo $produto->descricao ?>">Excluir</button>
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
                var descricao = button.data('descricao')

                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Editar Produto')

                modal.find('#descricao_produto').val(descricao);
                modal.find('#codigo_produto').val(codigo)
            });
            $('#modalExcluir').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var codigo = button.data('codigo') // Extract info from data-* attributes
                var descricao = button.data('descricao')
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Confirmar exclusão')
                modal.find('#texto_excluir').text("Tem certeza que deseja excluir a " + descricao + " do sistema ?")
                modal.find('#id_Produto').val(codigo)

            });
        </script>
</body>

</html>