<?php
session_start();



require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/ControllerPecas.php');
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
        $retorno_edicao = "peca_alterada";
    } else if ($_REQUEST["r"] == "3") {
        $retorno_edicao = "usuario_excluido";
    } else if ($_REQUEST["r"] == "4") {
        $caminhoArquivoGerado = $_REQUEST["c"];

        $retorno_edicao = "gtin_gerado";
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
                    <h5 class="modal-title" id="modalEdicaoLabel">Editar peças</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerPecas.php?acao=alterar" method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="form-group">

                            <label for="recipient-name" class="col-form-label">Código da peça</label>
                            <input type="text" class="form-control" id="idpecas_editar" name="pecas_editar" readonly>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">Montadora</label>
                                    <input type="text" class="form-control" id="idmontadora_editar" name="idmontadora_editar" readonly>
                                </div>
                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">Veiculo</label>
                                    <input type="text" class="form-control" id="idveiculo_editar" name="idveiculo_editar" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">Produto</label>
                                    <input type="text" class="form-control" id="iddescricao_editar" name="iddescricao_editar" readonly>
                                </div>
                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">Cor</label>
                                    <input type="text" class="form-control" id="idcor_editar" name="idcor_editar" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Código interno</label>
                            <input type="text" class="form-control" id="idcod_interno_editar" name="idcod_interno_editar" readonly>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Ano inicial</label>
                            <input type="text" class="form-control" id="idanoinicial_editar" name="idanoinicial_editar">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Código de barra</label>
                            <input type="text" class="form-control" id="idcod_barra_editar" name="idcod_barra_editar">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Selecione as imagens</label>
                            <div class="custom-file">

                                <input type="file" multiple class="custom-file-input fileMultiplo" name="arquivosEditar[]" id="customFileMultiplo" data-toggle="tooltip" title="Selecione vários arquivos" required>
                                <span id="nome"></span>
                                <label class="custom-file-label" for="customFile"></label>
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

    <div class="modal fade" id="modalProduto" tabindex="-1" role="dialog" aria-labelledby="modalProdutoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProdutoLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div id="imagemProduto" class="carousel-inner">

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>


            </div>
        </div>
    </div>

    <div class="modal fade" id="modalExportar" tabindex="-1" role="dialog" aria-labelledby="modalExportarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/view/Pecas/exportarExcel.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Exportar excel GTIN-13</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-check" style="margin-top: 10px">
                            <input type="checkbox" class="form-check-input" id="check_registroComCodigo" name="check_registroComCodigo">
                            <label class="form-check-label" for="check_registroComCodigo">Exportar os registros com código de barras</label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn  btn-info">Exportar Excel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="modalExcluirLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExcluirLabel">Resetar senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerPecas.php?acao=excluir" method="post">
                    <div class="modal-body">


                        <label id="texto_excluir"></label>
                        <input id="idprodutoexcluir" name="idprodutoexcluir" type="hidden">
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
                    } else if ($retorno_edicao == "peca_alterada") {
                    ?>
                        <div class="alert alert-success text-center" role="alert">
                            Peça atualizada com sucesso.
                        </div>
                    <?php
                    } else if ($retorno_edicao == "usuario_excluido") {
                    ?>
                        <div class="alert alert-success text-center" role="alert">
                            Exclusão realizada com sucesso.
                        </div>
                    <?php
                    } else if ($retorno_edicao == "gtin_gerado") {
                    ?>
                        <div class="alert alert-success text-center" role="alert">
                            Arquivo gerado com sucesso. <a href="baixar
.php?arquivo=<?php echo $caminhoArquivoGerado ?>"> Clique aqui para ver </a>
                        </div>
                    <?php
                    }
                    ?>


                    <div class="card-header text-center h5">
                        Lista de peças cadastradas
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="marca_carro_input" class="col-form-label">Montadora</label>
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
                        </div>
                        <div class="table-responsive">
                            <button type="button" id="botao_exportar_excel" class="btn btn-primary" data-toggle="modal" data-target="#modalExportar">
                                Exportar para excel
                            </button>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center" scope="col">Montadora</th>

                                        <th class="text-center" scope="col">Veiculo</th>

                                        <th class="text-center" scope="col">Cor</th>

                                        <th class="text-center" scope="col">Produto</th>
                                        <!--                    <th class="text-center" scope="col">Informação adicional</th>-->


                                        <th class="text-center" scope="col">Código Interno</th>

                                        <th class="text-center" scope="col">Produtos</th>
                                        <th class="text-center" scope="col">Ações</th>


                                    </tr>
                                </thead>
                                <tfoot class="text-center">
                                    <tr>
                                        <th class="text-center" scope="col">Montadora</th>

                                        <th class="text-center" scope="col">Veiculo</th>

                                        <th class="text-center" scope="col">Cor</th>

                                        <th class="text-center" scope="col">Produto</th>
                                        <!--                    <th class="text-center" scope="col">Informação adicional</th>-->

                                        <th class="text-center" scope="col">Código Interno</th>

                                        <th class="text-center" scope="col">Produtos</th>

                                        <th class="text-center" scope="col">Ações</th>
                                    </tr>
                                </tfoot>

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
                var idpecas = button.data('codigo') // Extract info from data-* attributes
                var veiculo = button.data('veiculo')
                var montadora = button.data('montadora')
                var descricao = button.data('descricao')
                var cod_interno = button.data('cod_interno')
                var anoinicial = button.data('anoinicial')
                var cod_barra = button.data('cod_barra')
                var cor = button.data('cor')

                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Editar a peça do '.descricao)
                modal.find('#idpecas_editar').val(idpecas)
                modal.find('#idveiculo_editar').val(veiculo)
                modal.find('#idmontadora_editar').val(montadora)
                modal.find('#iddescricao_editar').val(descricao)
                modal.find('#idcod_interno_editar').val(cod_interno)
                modal.find('#idanoinicial_editar').val(anoinicial)
                modal.find('#idcod_barra_editar').val(cod_barra)
                modal.find('#idcor_editar').val(cor)
            });

            $('#modalProduto').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('idpeca')
                var veiculo = button.data('veiculo')
                var descricao = button.data('descricao')

                var modal = $(this)
                if (descricao != "CHAVEIRO") {
                    modal.find('.modal-title').text(descricao + ' do veiculo ' + veiculo)
                } else {
                    modal.find('.modal-title').text("Chaveiro")
                }


                //alert(id);
                $.post('/view/Pecas/call_produtos.php', {
                    idpeca: id
                }, function(data) {
                    img = "";
                    var cont = 0;
                    var ativo = "";
                    $.each(JSON.parse(data), function(index, value) {
                        if (cont == 0) {
                            ativo = "active";
                        } else {
                            ativo = "";
                        }
                        img += "<div class=\"carousel-item " + ativo + " \">";
                        img += "<img class=\"d-block w-100\" src=\"/" + value.caminho_imagem + "\" alt=\"First slide\">";
                        img += "</div>";

                        cont++;

                    });
                    //alert(img);
                    $("#imagemProduto").html(img);
                });




            });

            $('#modalExcluir').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var idmontadora = button.data('codigo') // Extract info from data-* attributes
                var produto = button.data('produto')
                //alert(idmontadora);
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Confirmar exclusão do produto ' + produto)
                modal.find('#texto_excluir').text("Tem certeza que desaja excluir o " + produto + " do sistema ?")
                modal.find('#idprodutoexcluir').val(idmontadora)

            });

            $(".custom-file-input").on("change", function() {
                readURL(this);
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    if (input.files.length > 1) {
                        var nomeArquivo = "";
                        for (let i = 0; i < input.files.length; i++) {

                            nomeArquivo += input.files[i].name;

                            nomeArquivo += " , ";
                        }

                        $('.custom-file-label').html(nomeArquivo);

                    } else {
                        for (let i = 0; i < input.files.length; i++) {

                            $('.custom-file-label').html(input.files[i].name);

                        }
                    }
                }
            }

            $('#idmontadora').change(function(e) {

                var id = $(this).val();
                //alert(id);
                $.post('/view/Pecas/call_pecas.php', {
                    montadora: id
                }, function(data) {

                    var cor = "";

                    var table = $('#dataTable').DataTable();
                    table
                        .clear()
                        .draw();

                    $.each(JSON.parse(data), function(index, value) {
                        var btnAcoes = "";
                        var btnProdutos = "";
                        if (value.cor_peca == "SIL") {
                            cor = 'Prata';
                        } else {
                            cor = 'Preto';
                        }


                        btnAcoes += "<td class=\"text-center\">";
                        btnAcoes += "<div class=\"btn-group text-center\" role=\"group\" aria-label=\"Button group\" > ";
                        btnAcoes += "<button class=\"btn btn-primary\" type=\"button\" data-toggle=\"modal\" data-target=\"#modalEdicao\" data-codigo=\"" + value.idpecas + "\" data-veiculo=\"" + value.nome + "\" data-montadora=\"" + value.montadora + "\"  data-descricao=\"" + value.descricao + "\" data-cod_interno=\"" + value.cod_interno + "\"  data-anoinicial=\"" + value.anoinicial + "\"  data-cod_barra=\"" + value.cod_barra + "\" data-cor=\"" + cor + "\">Editar</button>";
                        btnAcoes += "<button class=\"btn btn-danger\" type=\"button\" data-toggle=\"modal\" data-target=\"#modalExcluir\" data-codigo=\"" + value.idpecas + "\" data-produto=\"" + value.descricao + "\">Excluir</button>";
                        btnAcoes += "</div>";
                        btnAcoes += "</td>";

                        btnProdutos += "<td class=\"text-center\">";
                        btnProdutos += "<div class=\"btn-group text-center\" role=\"group\" aria-label=\"Button group\" > ";
                        btnProdutos += "<button class=\"btn btn-primary\" type=\"button\" data-toggle=\"modal\" data-target=\"#modalProduto\" data-idpeca=\"" + value.idpecas + "\" data-veiculo=\"" + value.nome + "\" data-descricao=\"" + value.descricao + "\">Produtos</button>";
                        btnProdutos += "</div>";
                        btnProdutos += "</td>";
                        // console.log(value);


                        table.row.add([
                            value.montadora,
                            value.nome,
                            cor,
                            value.descricao,
                            value.cod_interno,
                            btnProdutos,
                            btnAcoes
                        ]).draw();
                    });
                })
            });
        </script>
</body>

</html>