<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Veiculo.php');
if(!session_status()){
    session_start();
}

if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {
        case 'cad':
            (new ControllerVeiculos())->cadastrar();
            break;
 
        case 'alterar':

            (new ControllerVeiculos())->alterar();
            break;
        case 'resetar':

            //(new ControllerVeiculos())->resetarSenha();
            break;
        case 'alterarSenha':
           // (new ControllerVeiculos())->altararSenha();
            break;
        case 'excluirVeiculo':
               (new ControllerVeiculos())->excluir();
                break;
    }
}

/**
 * Description of ControlUsuario
 *
 * @author Thyago
 */
class ControllerVeiculos
{
    //put your code here

    function cadastrar()
    {
        $codigo = $_REQUEST['codigo_veiculo'];
        $nomeveiculo = $_REQUEST['nomeveiculo'];
        $anoinicial = $_REQUEST['anoinicial'];
        $anofinal = $_REQUEST['anofinal'];
        $idmontadora = $_REQUEST['idmontadora'];
        $modelo = $_REQUEST['modeloveiculo'];

        $veiculo = new Veiculo();

        $veiculo->setCodigo($codigo);
        $veiculo->setNome($nomeveiculo);
        $veiculo->setAnoinicial($anoinicial);
        $veiculo->setAnofinal($anofinal);
        $veiculo->setCodigo_montadora($idmontadora);
        $veiculo->setModelo($modelo);

        $retorno = $veiculo->inserir($veiculo);
   
        if ($retorno == 1) {
            header('Location:../view/Veiculos/cadastrar/?r=1');
        } else {
            header('Location:../view/Veiculos/cadastrar/?r=0');
        }
    }

    function listar(){

        $Veiculo = new Veiculo();

       $listaVeiculo = $Veiculo->listar();

       return $listaVeiculo;
        
    }

    function excluir(){
        $codigoVeiculo = $_REQUEST["id_Veiculo"];

        $m = new Veiculo();

        $m->setCodigo($codigoVeiculo);

        $retorno = $m->deletar($m);

        if ($retorno > 0) {
            header("Location:../view/Veiculos/listar/?r=3");
        }
    }

    function alterar(){
        $codigo = $_REQUEST['codigo_veiculo'];
        $nomeveiculo = $_REQUEST['nomeveiculo'];
        $anoinicial = $_REQUEST['anoinicial'];
        $anofinal = $_REQUEST['anofinal'];
        $idmontadora = $_REQUEST['idmontadora'];
        $modelo = $_REQUEST['modeloveiculo'];

        $veiculo = new Veiculo();

        $veiculo->setCodigo($codigo);
        $veiculo->setNome($nomeveiculo);
        $veiculo->setAnoinicial($anoinicial);
        $veiculo->setAnofinal($anofinal);
        $veiculo->setCodigo_montadora($idmontadora);
        $veiculo->setModelo($modelo);

        $retorno = $veiculo->alterar($veiculo);
   
        if ($retorno == 1) {
            header('Location:../view/Veiculos/listar/?r=1');
        } else {
            header('Location:../view/Veiculos/listar/?r=0');
        }

    }
}
