<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Pecas.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Produto.php');

if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {
        case 'cad':
            (new ControllerPecas())->cadastrar();
            break;

        case 'alterar':

            (new ControllerPecas())->editar();
            break;
        case 'resetar':

            //(new ControllerMontadoras())->resetarSenha();
            break;
        case 'alterarSenha':
            // (new ControllerMontadoras())->altararSenha();
            break;
        case 'excluir':
            (new ControllerPecas())->excluir();
            break;
    }
}





class ControllerPecas
{   
    private $caminhoDaPastaCriada = "";
    
    function arquivos($arq, $id_produto)
    {
        $arquivos[] = null;

        $arqLocal[] = null;
        $arqNome[] = null;
        $extencoes = [
            'jpg',
            'jpeg',
            'docx',
            'png'
        ];


        $pastaCriada = false;

        if ($arq['name'] != "") {
            $arquivos[0] = $id_produto;
            for ($i = 0; $i < count($arq['name']); $i++) {

                $arqExtencao = pathinfo(strtolower($arq['name'][$i]), PATHINFO_EXTENSION);
                if ($arqExtencao != "") {
                    $arqNome[] = pathinfo(strtolower($arq['name'][$i]), PATHINFO_FILENAME);

                    
                    if (in_array($arqExtencao, $extencoes)) {

                        if ($pastaCriada == false) {
                            $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '\\uploads\\' . md5(uniqid()) . "\\";

                            if (!is_dir($uploaddir)) {
                                mkdir($uploaddir);
                                $arquivos[$i + 1] = $uploaddir;
                            }

                            $pastaCriada = true;
                        }

                        $temp = $arq['tmp_name'][$i];
                        $novoNome = $i . ".$arqExtencao";
                        $dirImg = $uploaddir . $novoNome;
                        move_uploaded_file($temp, $dirImg);
                        $arquivos[$i + 2] = $dirImg;
                    } else {
                        echo "arquivo invalido";
                    }
                }
            }

            return $arquivos;
        } else {
            return "";
        }
    }

    function arquivosEditar($arq)
    {
        $arquivos[] = null;

        $arqLocal[] = null;
        $arqNome[] = null;
        $extencoes = [
            'jpg',
            'jpeg',
            'docx',
            'png'
        ];

        $dir = "../uploads/";
        // echo count($arq['arquivos']['name']);
        //  print_r($arq['arquivos']['name']);
        if ($arq['name'] != "") {

            for ($i = 0; $i < count($arq['name']); $i++) {

                $arqExtencao = pathinfo(strtolower($arq['name'][$i]), PATHINFO_EXTENSION);
                if ($arqExtencao != "") {
                    $arqNome[] = pathinfo(strtolower($arq['name'][$i]), PATHINFO_FILENAME);

                    if (in_array($arqExtencao, $extencoes)) {
                        $temp = $arq['tmp_name'][$i];
                        $novoNome = uniqid() . ".$arqExtencao";
                        $dirImg = $dir . $novoNome;
                        move_uploaded_file($temp, $dirImg);
                        $arquivos[$i] = $dirImg;
                    } else {
                        echo "arquivo invalido";
                    }
                }
            }

            return $arquivos;
        } else {
            return "";
        }
    }


    function cadastrar()
    {

        $montadora_input = $_REQUEST['idmontadora'];
        $veiculo_input = $_REQUEST['id_combo_veiculo'];

        $cor_radio = $_REQUEST['corpeca'];

        $produtos_check = $_REQUEST['produtoselecionado'];
        //  $informacao_adicional = $_REQUEST['informacaoadicional'];
        $anoInicialVeiculo = $_REQUEST['anoInicialVeiculo'];

        $codigo_interno = "";

        $peca = new Pecas();

        $produtos[] = "";

        for ($i = 0; $i < count($produtos_check); $i++) {
            //print_r($this->arquivos($_FILES['arquivos' . $produtos_check[$i]], $produtos_check[$i]));
            $filesBlack = $_FILES['arquivosBlack' . $produtos_check[$i]];
            $filesSilver = $_FILES['arquivosSilver' . $produtos_check[$i]];
            
            $produtosBlack[$i] = $this->arquivos($filesBlack, $produtos_check[$i]);
            $produtosSilver[$i] = $this->arquivos($filesSilver, $produtos_check[$i]);
        }

        $peca->setArquivoBlack($produtosBlack);
        $peca->setArquivoSilver($produtosSilver);

        $peca->setMontadora($montadora_input);
        $peca->setVeiculo($veiculo_input);
        $peca->setCor($cor_radio);

        $peca->setAnoinicial($anoInicialVeiculo);
        $peca->setCodInterno($codigo_interno);

        $retorno = $peca->inserir($peca);

        if ($retorno) {
            header('Location:../view/Pecas/cadastrar/?r=1');
        } else {
            header('Location:../view/Pecas/cadastrar/?r=2');
        }

    }

    public function excluir()
    {
        $codigoPeca = $_REQUEST["idprodutoexcluir"];

        $p = new Pecas();

        $retorno = $p->deletar($codigoPeca);

        echo $retorno;
        if ($retorno) {
            header("Location:/view/Pecas/listar/?r=3");
        }
    }

    public function editar()
    {
        $idpecas_editar = $_REQUEST["pecas_editar"];
        $idanoinicial_editar = $_REQUEST['idanoinicial_editar'];
        $idcod_barra_editar = $_REQUEST['idcod_barra_editar'];

        $p = new Pecas();

        $files = $_FILES['arquivosEditar'];

        $imagens = $this->arquivosEditar($files);

        $p->setIdpecas($idpecas_editar);
        $p->setAnoinicial($idanoinicial_editar);
        $p->setCodBarra($idcod_barra_editar);
        $p->setArquivosEditar($imagens);

        $result = $p->alterar($p);

        if ($result) {
            header("Location:/view/Pecas/listar/?r=2");
        }
    }
}
