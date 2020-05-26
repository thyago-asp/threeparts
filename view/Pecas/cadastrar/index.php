<?php
session_start();
//require_once("../../../estrutura/controleLogin.php");
require_once("../../../controller/ControllerMontadoras.php");
require_once("../../../controller/ControllerProdutos.php");
//require_once(');
$retorno_cadastro = "";

if (isset($_REQUEST["r"])) {
    // Verifico se o retorno do cadastro do usuario deu certo.
    // 1 = sucesso.
    // 0 = erro - email já cadastrado.
    if ($_REQUEST["r"] == "1") {
        $retorno_cadastro = "sucesso";
    } else if ($_REQUEST["r"] == "0") {
        $retorno_cadastro = "Veiculo_cadastrada";
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
                    }

                    ?>

                    <div class="card-body">
                        <h4 class="header-title text-center">Cadastro de Veiculos</h4>
                        <p class="text-muted font-14 mb-4 text-center">Realize o cadastro de um Veiculo e de qual ano pertence</p>
                        <form id="formProdutos" method="post" action="../../../controller/ControllerPecas.php?acao=cad" enctype="multipart/form-data">
                            <div class="form-group">
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
                            </div>
                            <div class="form-group">
                                <label for="marca_carro_input" class="col-form-label">Veiculos</label>

                                <select class="form-control" id="id_combo_veiculo" name="id_combo_veiculo">
                                </select>


                            </div>
                            <input type="hidden" id="anoInicialVeiculo" name="anoInicialVeiculo" />

                            <div class="form-group">
                                <label for="nome_marca" class="col-form-label">Cor</label><br />
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" checked id="customRadio4" name="corpeca[]" class="custom-control-input" value="BLK">
                                    <label class="custom-control-label" for="customRadio4">Preto</label>
                                </div>
                                <div class="custom-control  custom-checkbox custom-control-inline">
                                    <input type="checkbox" checked id="customRadio5" name="corpeca[]" class="custom-control-input" value="SIL">
                                    <label class="custom-control-label" for="customRadio5">Prata</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nome_layout" class="col-form-label">Produtos</label>

                                <div class="form-check custom-checkbox">
                                    <input type="checkbox" checked class="custom-control-input" id="marcarDesmarcar" name="marcarDesmarcar" />
                                    <label class="custom-control-label" style="margin-left: 5px;" for="marcarDesmarcar">Marcar/Desmarcar todos os produtos</label>
                                </div>


                                <?php
                                $lista_produtos = (new ControllerProdutos)->listar();

                                foreach ($lista_produtos as $produto) {
                                ?>

                                    <div class="container">
                                        <div class="custom-control custom-checkbox">
                                            <div class="row" style="margin-top:10px">
                                                <div class="col-4">
                                                    <input type="checkbox" checked value="<?= $produto->codigo ?>" class="custom-control-input checkProduto" id="custom<?= $produto->codigo ?>" name="produtoselecionado[]" />
                                                    <label class="custom-control-label" style="margin-left: 5px;" for="custom<?= $produto->codigo ?>"><?= $produto->descricao ?></label>
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-line">

                                                        <div class="col-10">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input upload-black" id="BcustomFileB<?= $produto->codigo ?>" name="arquivosBlack<?= $produto->codigo ?>[]" multiple>
                                                                <label class="custom-file-label" for="customFile<?= $produto->codigo ?>" id="BcustomFileB<?= $produto->codigo ?>label">Preto</label>

                                                            </div>
                                                            <br/> <br/>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input  upload-silver" id="ScustomFile<?= $produto->codigo ?>" name="arquivosSilver<?= $produto->codigo ?>[]" multiple>
                                                                <label class="custom-file-label" for="ScustomFile<?= $produto->codigo ?>" id="ScustomFile<?= $produto->codigo ?>label">Prata</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
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

    <script>
        $(document).ready(function() {
           
            $("#marcarDesmarcar").change(function() {
       
                if ($(this).is(':checked')) {
                    $('.checkProduto').prop("checked", true);
                } else {
                    $('.checkProduto').prop("checked", false);
                }
            });

            $(".upload-black").on("change", function() {

                readURL(this, "black");
            });

            $(".upload-silver").on("change", function() {
                readURL(this, "silver");
            });

            function readURL(input, cor) {

                if (input.files && input.files[0]) {
                    if (input.files.length > 1) {
                        var nomeArquivo = "";
                        for (let i = 0; i < input.files.length; i++) {

                            nomeArquivo += input.files[i].name;

                            nomeArquivo += " , ";
                        }

                        if (cor == "black") {

                            $('#' + input.id + 'label').html(nomeArquivo);
                        } else {

                            $('#' + input.id + 'label').html(nomeArquivo);
                        }

                    } else {
                        for (let i = 0; i < input.files.length; i++) {
                            if (cor == "black") {
                                $('#' + input.id + 'label').html(input.files[i].name);
                            } else {
                                $('#' + input.id + 'label').html(input.files[i].name);
                            }
                        }
                    }
                }
            }



            $("#id_combo_veiculo").change(function() {
                var option = $(this).find("option:selected");
                var anoinicial = option.data('anoinicial');

                $("#anoInicialVeiculo").val(anoinicial);

            });



            $('#idmontadora').change(function(e) {
                $('#id_combo_veiculo').empty();
                var id = $(this).val();

                $.post('/view/Pecas/call_veiculos.php', {
                    ufid: id
                }, function(data) {
                    //mostrando o retorno do post
                    //console.error(this.props.url, status, err.toString());
                    var cmb = '<option value="">Selecione um veiculo</option>';

                    //  var cmb = '<option value="">Selecione a Cidade</option>';
                    $.each(JSON.parse(data), function(index, value) {

                        var modelo = "";
                        var ano = "";

                        if (value.modelo != "") {
                            var nome = value.nome + " - ";
                            var modelo = value.modelo + " - ";
                        } else {
                            var nome = value.nome + " - ";
                        }

                        if (value.anofinal != "") {
                            var ano = value.anoinicial + " até " + value.anofinal;
                        }

                        cmb = cmb + '<option value="' + value.codigo + '" data-anoinicial="' + value.anoinicial + '">' + nome + modelo + ano + '</option>';
                    });

                    $('#id_combo_veiculo').html(cmb);
                })
            });
        });
    </script>
</body>

</html>