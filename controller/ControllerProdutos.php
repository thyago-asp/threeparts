<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Produto.php');


if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {
        case 'cad':
            (new ControllerProdutos())->cadastrar();
            break;
 
        case 'alterar':

            (new ControllerProdutos())->alterar();
            break;
        case 'resetar':

            //(new ControllerProdutos())->resetarSenha();
            break;
        case 'alterarSenha':
           // (new ControllerProdutos())->altararSenha();
            break;
        case 'excluirProduto':
               (new ControllerProdutos())->excluir();
                break;
    }
}

/**
 * Description of ControlUsuario
 *
 * @author Thyago
 */
class ControllerProdutos
{
    //put your code here

    function cadastrar()
    {
        $codigo_Produto_input = $_REQUEST['codigo_Produto_input'];
        $nome_Produto_input = $_REQUEST['nome_Produto_input'];

        $objProduto = new Produto();

        $objProduto->setProduto($nome_Produto_input);
        $objProduto->setCodigo($codigo_Produto_input);

        $ProdutoDAO = new Produto();

        $retorno = $ProdutoDAO->inserir($objProduto);
   
        if ($retorno == 1) {
            header('Location:../view/Produtos/cadastrar/?r=1');
        } else {
            header('Location:../view/Produtos/cadastrar/?r=0');
        }
    }

    function listar(){

        $Produto = new Produto();

       $listaProduto = $Produto->listar();

       return $listaProduto;
        
    }

    function excluir(){
        $codigoProduto = $_REQUEST["id_Produto"];

        $m = new Produto();

        $m->setCodigo($codigoProduto);

        $retorno = $m->deletar($m);

        if ($retorno > 0) {
            header("Location:/view/Produtos/listar/?r=3");
        }
    }

    function alterar(){
        $codigo_produto = $_REQUEST['codigo_produto'];
        $descricao_produto = $_REQUEST['descricao_produto'];

        $objProduto = new Produto();

        $objProduto->setCodigo($codigo_produto);
        $objProduto->setProduto($descricao_produto);
       
        $ProdutoDAO = new Produto();

        $retorno = $ProdutoDAO->alterar($objProduto);
        
        if ($retorno > 0) {
            header('Location:../view/Produtos/listar/?r=1');
        } else {
            header('Location:../view/Produtos/listar/?r=0');
        }

    }
}
