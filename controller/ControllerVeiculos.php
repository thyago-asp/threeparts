<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Veiculo.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;

if (!session_status()) {
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
        case 'cadEmMassa':
            (new ControllerVeiculos())->cadastrarEmMassa();
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

    function cadastrarEmMassa()
    {

        $spreadsheet = IOFactory::load($_FILES["imagem"]['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        // var_dump($sheetData);


        $lista_veiculos = array();

        for ($i = 1; $i < count($sheetData); $i++) {
            $veiculo = new Veiculo();

            $veiculo->setCodigo($sheetData[$i + 1]["A"]);
            $veiculo->setCodigo_montadora($sheetData[$i + 1]["B"]);
            $veiculo->setNome($sheetData[$i + 1]["C"]);
            $veiculo->setModelo($sheetData[$i + 1]["D"]);
            $veiculo->setAnoinicial($sheetData[$i + 1]["E"]);
            $veiculo->setAnofinal($sheetData[$i + 1]["F"]);
            //  echo $sheetData[$i+1]["A"];
            $lista_veiculos[$i - 1] = $veiculo;
        }

        //  print_r($lista_veiculos);

        $retorno = $veiculo->cadastrarEmMassa($lista_veiculos);
        //print_r($retorno);
        if ($retorno[0] == 1) {
            header('Location:../view/Veiculos/cadastrar/?r=2');
        } else  if ($retorno[0] == 23000) {
            header('Location:../view/Veiculos/cadastrar/?r=3&cod_erro=' . $retorno[1]);
        }
    }

    function listar()
    {

        $Veiculo = new Veiculo();

        $listaVeiculo = $Veiculo->listar();

        return $listaVeiculo;
    }

    function excluir()
    {
        $codigoVeiculo = $_REQUEST["id_Veiculo"];

        $m = new Veiculo();

        $m->setCodigo($codigoVeiculo);

        $retorno = $m->deletar($m);

        if ($retorno > 0) {
            header("Location:../view/Veiculos/listar/?r=3");
        }
    }

    function alterar()
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

        $retorno = $veiculo->alterar($veiculo);

        if ($retorno == 1) {
            header('Location:../view/Veiculos/listar/?r=1');
        } else {
            header('Location:../view/Veiculos/listar/?r=0');
        }
    }
}
