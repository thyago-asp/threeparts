<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/controller/ControllerUsuario.php');
require_once('../../../estrutura/controleLogin.php');
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
    }else if ($_REQUEST["r"] == "3") {
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
                    <h5 class="modal-title" id="modalEdicaoLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerUsuario.php?acao=alterar" method="post">
                    <div class="modal-body">

                        <input type="hidden" id="id_usuario" name="id_usuario">


                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nome usuario:</label>
                            <input type="text" class="form-control" id="n_nome_editado" name="n_nome_editado">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">E-mail</label>
                            <input type="text" class="form-control" id="n_email_editado" name="n_email_editado" disabled>

                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="perfil_editado">Perfil</label>
                                <select id="perfil_editado" class="form-control" name="n_perfil_editado">
                                    <option value="admin">Administrador</option>
                                    <option value="basico">Basico</option>
                                </select>
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

    <div class="modal fade" id="modalResetar" tabindex="-1" role="dialog" aria-labelledby="modalResetarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalResetarLabel">Resetar senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../../../controller/ControllerUsuario.php?acao=resetar" method="post">
                    <div class="modal-body">

                        <input type="hidden" id="id_usuario" name="id_usuario">
                        <label> A senha será alterada para senha padrão: "123456" . E deverá ser alterada assim que entrar novamente no sistema.</label>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Resetar senha</button>
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
                <form action="../../../controller/ControllerUsuario.php?acao=excluirUsuario" method="post">
                    <div class="modal-body">

                        <input type="hidden" id="id_usuario" name="id_usuario">
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
                    }else if ($retorno_edicao == "usuario_excluido") {
                        ?>
                            <div class="alert alert-success text-center" role="alert">
                                Exclusão realizada com sucesso.
                            </div>
                        <?php
                        }
                    ?>


                    <div class="card-header text-center h5">
                        Lista de usuarios cadastrados
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Perfil</th>
                                        <th>Ações</th>

                                    </tr>
                                </thead>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Perfil</th>

                                        <th>Ações</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $lista_usuarios = (new ControllerUsuario())->listarUsuarios();

                                    //print_r($lista_usuarios);
                                    foreach ($lista_usuarios as $usuario) {


                                    ?>

                                        <tr>
                                            <td><?php echo $usuario->nome ?></td>
                                            <td><?php echo $usuario->email ?></td>
                                            <td><?php echo $usuario->perfil ?></td>
                                            <td class="text-center">
                                                <div class="btn-group text-center" role="group" aria-label="Button group">
                                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalEdicao" data-nome="<?php echo $usuario->nome ?>" data-email="<?php echo $usuario->email ?>" data-idusuario="<?php echo $usuario->idt_usuarios ?>" data-perfil="<?php echo $usuario->perfil ?>">Editar</button>
                                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modalResetar" data-idusuario="<?php echo $usuario->idt_usuarios ?>" data-nome="<?php echo $usuario->nome ?>">Resetar</button>
                                                    <button class="btn btn-danger" type="button"  data-toggle="modal"data-target="#modalExcluir" data-idusuario="<?php echo $usuario->idt_usuarios ?>" data-nome="<?php echo $usuario->nome ?>">Excluir</button>

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
                var idusuario = button.data('idusuario') // Extract info from data-* attributes
                var nome = button.data('nome')
                var email = button.data('email')
                var perfil = button.data('perfil')

                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Editar o usuario ' + email)
                modal.find('#n_nome_editado').val(nome)
                modal.find('#n_email_editado').val(email)
                modal.find('#n_perfil_editado').val(perfil)
                modal.find('#id_usuario').val(idusuario)
            });

            $('#modalResetar').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var idusuario = button.data('idusuario') // Extract info from data-* attributes
                var nome = button.data('nome')
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Resetar a senha do ' + nome)

                modal.find('#id_usuario').val(idusuario)

            });

            $('#modalExcluir').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var idusuario = button.data('idusuario') // Extract info from data-* attributes
                var nome = button.data('nome')
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('Confirmar exclusão')
                modal.find('#texto_excluir').text("Tem certeza que desaja excluir o usuario do " + nome + " do sistema ?")
                modal.find('#id_usuario').val(idusuario)
                
            });
        </script>
</body>

</html>