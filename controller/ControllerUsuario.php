<?php

    session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Usuario.php');


if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {
        case 'cad':
            (new ControllerUsuario())->cadastrar();
            break;
        case 'log':

            (new ControllerUsuario())->login();
            break;

        case 'alterar':

            (new ControllerUsuario())->alterar();
            break;
        case 'resetar':

            (new ControllerUsuario())->resetarSenha();
            break;
        case 'alterarSenha':
            (new ControllerUsuario())->altararSenha();
            break;
        case 'excluirUsuario':
                (new ControllerUsuario())->excluirUsuario();
                break;
    }
}

/**
 * Description of ControlUsuario
 *
 * @author Thyago
 */
class ControllerUsuario
{
    //put your code here

    function cadastrar()
    {
        $usuario = new Usuario();

        $usuario->setNome($_POST["n_nome"]);
        $usuario->setEmail($_POST["n_email"]);
        $usuario->setSenha(md5($_POST["n_senha"]));
        $usuario->setPerfil($_POST["n_perfil"]);

        $retorno = $usuario->cadastrarUsuario($usuario);

        // retorno 1 - mostra a mensagem que deu certo - sucesso
        // retorno 23000 - mostra a mensagem que já existe o email no banco
        if ($retorno == 1) {
            header('Location:/view/usuariosdosistema/cadastrar/?r=1');
        } else if ($retorno == 23000) {
            header('Location:/view/usuariosdosistema/cadastrar/?r=0');
        }
    }

    function login()
    {
        $usuario = new Usuario();

        $login = $_POST["login"];
        $senha = $_POST["senha"];

        $usuario->setEmail($login);
        $usuario->setSenha(md5($senha));

        $retorno = $usuario->realizarLogin($usuario);

        if ($retorno->conectado == 1) {
            
            $_SESSION["conectado"] = "1";
            $_SESSION["sessao"] = md5(session_id());
            $_SESSION["email"] = $usuario->getEmail();
            $_SESSION["nome"] = $retorno->nome;
            $_SESSION["perfil"] = $retorno->perfil;
            $_SESSION["id_usuario"] = $retorno->idt_usuarios;
            $_SESSION["primeiro_acesso"] = $retorno->primeiro_acesso;

            header("Location:/view/main/");
        } else {

            header("Location:/index.php?r=0");
        }
    }

    public function listarUsuarios()
    {
        $usuario = new Usuario();
        $lista_de_usuarios = $usuario->listarUsuarios();

        return $lista_de_usuarios;
    }

    public function alterar()
    {

        $usuario = new Usuario();

        $usuario->setId_usuario($_POST["id_usuario"]);
        $usuario->setNome($_POST["n_nome_editado"]);
        $usuario->setPerfil($_POST["n_perfil_editado"]);

        $result = $usuario->alterar($usuario);

        if ($result > 0) {

            if ($_SESSION["id_usuario"] == $_POST["id_usuario"]) {

                $_SESSION["nome"] = $_POST["n_nome_editado"];
                $_SESSION["perfil"] = $_POST["n_perfil_editado"];
            }

            header("Location:/view/usuariosdosistema/listar/?r=1");
        }
    }
    
    public function resetarSenha()
    {
        $idUsuario = $_REQUEST["id_usuario"];

        $usuario = new Usuario();

        $retorno = $usuario->resetarSenha($idUsuario);

        if ($retorno > 0) {
            header("Location:/view/usuariosdosistema/listar/?r=2");
        }
    }

    public function altararSenha()
    {
        $idUsuario = $_SESSION["id_usuario"];
        $senha = $_REQUEST["senha1"];

        $usuario = new Usuario();

        $usuario->setId_usuario($idUsuario);
        $usuario->setSenha(md5($senha));

        $retorno = $usuario->alterarSenha($usuario);

        if ($retorno > 0) {
            $_SESSION["primeiro_acesso"] = "0";
            header("Location:/view/main?r=1");
        }
    }

    public function excluirUsuario(){

        $idUsuario = $_REQUEST["id_usuario"];

        $usuario = new Usuario();

        $usuario->setId_usuario($idUsuario);

        $retorno = $usuario->excluirUsuario($usuario);

        if ($retorno > 0) {
            header("Location:/view/usuariosdosistema/listar/?r=3");
        }

    }
}
