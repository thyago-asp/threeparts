<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Marca
 *
 * @author Thyago
 */
require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Produto.php');




class Produto
{

    private $idProduto;
    private $codigo;
    private $Produto;
    private $imagem;

    function getProduto()
    {
        return $this->Produto;
    }

    function setProduto($Produto)
    {
        $this->Produto = $Produto;
    }

    function getCodigo()
    {
        return $this->codigo;
    }

    function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    function getIdProduto()
    {
        return $this->idProduto;
    }

    function setIdProduto($idProduto)
    {
        $this->idProduto = $idProduto;
    }

    function getImagem()
    {
        return $this->imagem;
    }

    function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }

    //put your code here

    public function inserir(Produto $produto)
    {
        $con = Conexao::abrirConexao();

        try {
            $query = "INSERT INTO produtos (codigo, descricao)
             VALUES (:codigo, :descricao)";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':codigo', $produto->getCodigo());
            $stmt->bindValue(':descricao', $produto->getProduto());

            return $stmt->execute();

        } catch (PDOException $e) {
            return $e->getCode();
            
        }
        
    }

    public function listar()
    {

        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM produtos";

        $stmt = $con->prepare($query);

        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;

    }

    public function deletar(Produto $mont)
    {

        try {
            $con = Conexao::abrirConexao();

            $sql = "DELETE FROM produtos WHERE codigo =:codigo";
            $stmt = $con->prepare($sql);

            $stmt->bindValue(':codigo', $mont->codigo);

            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function buscarProduto($id)
    {



       // $res = $db->prepare("SELECT * FROM sucod681_threeparts.Produtos WHERE codigo='$id'");
      //  $res->execute();

        // set the resulting array to associative
      //  $result = $res->fetchAll(PDO::FETCH_OBJ);

    }

    public function alterar(Produto $Produto)
    {


        $con = Conexao::abrirConexao();

        $query = "UPDATE produtos
        SET descricao = :descricao
        WHERE codigo = :codigo";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':descricao', $Produto->getProduto());
        $stmt->bindValue(':codigo', $Produto->getCodigo());

        $result = $stmt->execute();

        return $result;
    }
}
