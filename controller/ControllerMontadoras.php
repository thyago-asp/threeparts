<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Montadora.php');
if(!session_status()){
    session_start();
}

if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {
        case 'cad':
            (new ControllerMontadoras())->cadastrar();
            break;
 
        case 'alterar':

            (new ControllerMontadoras())->alterar();
            break;
        case 'resetar':

            //(new ControllerMontadoras())->resetarSenha();
            break;
        case 'alterarSenha':
           // (new ControllerMontadoras())->altararSenha();
            break;
        case 'excluirMontadora':
               (new ControllerMontadoras())->excluir();
                break;
    }
}

/**
 * Description of ControlUsuario
 *
 * @author Thyago
 */
class ControllerMontadoras
{
    //put your code here

    function cadastrar()
    {
        $codigo_montadora_input = $_REQUEST['codigo_montadora_input'];
        $nome_montadora_input = $_REQUEST['nome_montadora_input'];

        $objMontadora = new Montadora();

        $objMontadora->setMontadora($nome_montadora_input);
        $objMontadora->setCodigo($codigo_montadora_input);

        $montadoraDAO = new Montadora();

        $retorno = $montadoraDAO->inserir($objMontadora);
   
        if ($retorno == 1) {
            header('Location:../view/Montadoras/cadastrar/?r=1');
        } else {
            header('Location:../view/Montadoras/cadastrar/?r=0');
        }
    }

    function listar(){

        $montadora = new Montadora();

       $listaMontadora = $montadora->listar();

       return $listaMontadora;
        
    }

    function excluir(){
        $codigoMontadora = $_REQUEST["id_Montadora"];

        $m = new Montadora();

        $m->setCodigo($codigoMontadora);

        $retorno = $m->deletar($m);

        if ($retorno > 0) {
            header("Location:/view/Montadoras/listar/?r=3");
        }
    }

    function alterar(){
        $codigo_montadora_input = $_REQUEST['id_Montadora'];
        $nome_montadora_input = $_REQUEST['nome_montadora_input'];

        $objMontadora = new Montadora();

        $objMontadora->setMontadora($nome_montadora_input);
        $objMontadora->setCodigo($codigo_montadora_input);

        $montadoraDAO = new Montadora();

        $retorno = $montadoraDAO->alterar($objMontadora);
        
        if ($retorno > 0) {
            header('Location:../view/Montadoras/listar/?r=1');
        } else {
            header('Location:../view/Montadoras/listar/?r=0');
        }

    }
}
