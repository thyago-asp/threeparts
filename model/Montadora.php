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
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Montadora.php');




class Montadora
{

    private $idMontadora;
    private $codigo;
    private $montadora;

    function getMontadora()
    {
        return $this->montadora;
    }

    function setMontadora($montadora)
    {
        $this->montadora = $montadora;
    }

    function getCodigo()
    {
        return $this->codigo;
    }

    function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    function getIdMontadora()
    {
        return $this->idMontadora;
    }

    function setIdMontadora($idMontadora)
    {
        $this->idMontadora = $idMontadora;
    }

    //put your code here

    public function inserir(Montadora $montadora)
    {
        $con = Conexao::abrirConexao();

        try {
            $query = "INSERT INTO montadoras (codigo, montadora)
             VALUES (:codigo, :montadora)";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':codigo', $montadora->getCodigo());
            $stmt->bindValue(':montadora', $montadora->getMontadora());

            return $stmt->execute();

        } catch (PDOException $e) {
            return $e->getCode();
            
        }
        
    }

    public function listar()
    {

        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM montadoras";

        $stmt = $con->prepare($query);

        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;

    }

    public function deletar(Montadora $mont)
    {

        try {
            $con = Conexao::abrirConexao();

            $sql = "DELETE FROM montadoras WHERE codigo =:codigo";
            $stmt = $con->prepare($sql);

            $stmt->bindValue(':codigo', $mont->codigo);

            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function buscarMontadora($id)
    {



       // $res = $db->prepare("SELECT * FROM sucod681_threeparts.montadoras WHERE codigo='$id'");
      //  $res->execute();

        // set the resulting array to associative
      //  $result = $res->fetchAll(PDO::FETCH_OBJ);

    }

    public function alterar(Montadora $montadora)
    {


        $con = Conexao::abrirConexao();

        $query = "UPDATE montadoras
        SET montadora = :montadora
        WHERE codigo = :codigo";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':montadora', $montadora->getMontadora());
        $stmt->bindValue(':codigo', $montadora->getCodigo());

        $result = $stmt->execute();

        return $result;
    }
}
