<?php

    session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/ControllerVeiculos.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/ControllerMontadoras.php');
//require_once('../../../estrutura/controleLogin.php');
$retorno_edicao = "";

if (isset($_REQUEST["r"])) {
    // Verifico se o retorno do cadastro do usuario deu certo.
    // 1 = sucesso.
    // 0 = erro - email já cadastrado.
    if ($_REQUEST["r"] == "1") {
        $retorno_edicao = "sucesso";
    } else if ($_REQUEST["r"] == "0") {
        $retorno_edicao = "email_cadastrado";
    } else if ($_REQUEST["r"] == "2") {
        $retorno_edicao = "senha_alterada";
    } else if ($_REQUEST["r"] == "3") {
        $retorno_edicao = "usuario_excluido";
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
                <form action="../../../controller/ControllerVeiculos.php?acao=alterar" method="post">
                    <div class="modal-body">

                        <input type="hidden" id="id_veiculo" name="id_veiculo">


                        <div class="form-group">
                                <label for="modelo_veiculo_input" class="col-form-label">Código</label>
                                <input class="form-control" autofocus="true" type="text" name="codigo_veiculo" id="codigo_veiculo"  readonly="readonly" >
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
                                <input class="form-control" autofocus="true" type="text" name="nomeveiculo" id="nome">
                            </div>
                            <div class="form-group">
                                <label for="modelo_veiculo_input" class="col-form-label">Modelo</label>
                                <input class="form-control" autofocus="true" type="text" name="modeloveiculo" id="modelo">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Ano</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="anoinicial" id="anoinicial" placeholder="Ano inicial" aria-describedby="anoInicialHelp">
                                        <small id="anoInicialHelp" class="form-text text-muted">
                                            Essa é a data inicial do modelo do carro para as peças que serão criadas para esse carro.
                                        </small>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="anofinal" id="anofinal" placeholder="Ano final" aria-describedby="anoFinalHelp">
                                        <small id="anoFinalHelp" class="form-text text-muted">
                                            Essa é a data final do modelo do carro para as peças que serão criadas para esse carro.
                                        </small>
                                    </div>
                                </div>
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
                <form action="../../../controller/ControllerVeiculos.php?acao=excluirVeiculo" method="post">
                    <div class="modal-body">

                        <input type="hidden" id="id_Veiculo" name="id_Veiculo">


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
                    } else if ($retorno_edicao == "senha_alterada") {
                    ?>
                        <div class="alert alert-success text-center" role="alert">
                            Senha atualizada com sucesso.
                        </div>
                    <?php
                    } else if ($retorno_edicao == "usuario_excluido") {
                    ?>
                        <div class="alert alert-success text-center" role="alert">
                            Exclusão realizada com sucesso.
                        </div>
                    <?php
                    }
                    ?>


                    <div class="card-header text-center h5">
                        Lista de veiculos cadastrados
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                    <th class="text-center" scope="col">Codigo</th>
                                        <th class="text-center" scope="col">Nome</th>
                                        <th class="text-center" scope="col">Montadora</th>
                                        <th class="text-center" scope="col">Modelo</th>
                                        <th class="text-center" scope="col">Ano inicial</th>
                                        <th class="text-center" scope="col">Ano final</th>
                                        <th class="text-center" scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tfoot class="text-center">
                                    <tr>
                                    <th class="text-center" scope="col">Codigo</th>
                                        <th class="text-center" scope="col">Nome</th>
                                        <th class="text-center" scope="col">Montadora</th>
                                        <th class="text-center" scope="col">Modelo</th>
                                        <th class="text-center" scope="col">Ano inicial</th>
                                        <th class="text-center" scope="col">Ano final</th>
                                        <th class="text-center" scope="col">Ações</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $lista_veiculos = (new ControllerVeiculos())->listar();

                                    //print_r($lista_usuarios);
                                    foreach ($lista_veiculos as $veiculo) {


                                    ?>

                                        <tr>
                                        <td><?php echo $veiculo->codigo ?></td>
                                            <td><?php echo $veiculo->nome ?></td>
                                            <td><?php echo $veiculo->montadora ?></td>
                                            <td><?php echo $veiculo->modelo ?></td>
                                            <td><?php echo $veiculo->anoinicial ?></td>
                                            <td><?php echo $veiculo->anofinal ?></td>
                                            
                                            
                                            <td class="text-center">
                                                <div class="btn-group text-center" role="group" aria-label="Button group">
                                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalEdicao" 
                                                    data-codigo_veiculo="<?php echo $veiculo->codigo ?>" data-montadoras_codigo="<?php echo $veiculo->montadoras_codigo ?>" 
                                                    data-nome="<?php echo $veiculo->nome ?>" data-modelo="<?php echo $veiculo->modelo ?>"
                                                    data-anoinicial="<?php echo $veiculo->anoinicial ?>" data-anofinal="<?php echo $veiculo->anofinal ?>">Editar</button>
                                            
                                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#modalExcluir" data-codigo="<?php echo $veiculo->codigo ?>" data-nome="<?php echo $veiculo->nome ?>">Excluir</button>
                                                  
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
                var codigo_veiculo = button.data('codigo_veiculo') // Extract info from data-* attributes
                var idmontadora = button.data('montadoras_codigo')
                var nome = button.data('nome')
                var modelo = button.data('modelo')
                var anoinicial = button.data('anoinicial')
                var anofinal = button.data('anofinal')

                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Editar o veiculo ' + nome)
                modal.find('#codigo_veiculo').val(codigo_veiculo)
                modal.find('#idmontadora').val(idmontadora).change();
                modal.find('#nome').val(nome)
                modal.find('#modelo').val(modelo)
                modal.find('#anoinicial').val(anoinicial)
                modal.find('#anofinal').val(anofinal)
            });


            $('#modalExcluir').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var codigo = button.data('codigo') // Extract info from data-* attributes
                var nome = button.data('nome')
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Confirmar exclusão')
                modal.find('#texto_excluir').text("Tem certeza que desaja excluir o veiculo " + nome + " do sistema ?")
                modal.find('#id_Veiculo').val(codigo)

            });
        </script>
</body>

</html>