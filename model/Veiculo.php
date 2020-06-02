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
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Veiculo.php');




class Veiculo
{

    private $codigo;
    private $nome;
    private $anoinicial;
    private $anofinal;
    private $codigo_montadora;
    private $modelo;

    function getNome()
    {
        return $this->nome;
    }

    function getAnoinicial()
    {
        return $this->anoinicial;
    }

    function getAnofinal()
    {
        return $this->anofinal;
    }

    function setNome($nome)
    {
        $this->nome = $nome;
    }

    function setAnoinicial($anoinicial)
    {
        $this->anoinicial = $anoinicial;
    }

    function setAnofinal($anofinal)
    {
        $this->anofinal = $anofinal;
    }
    function getCodigo_montadora()
    {
        return $this->codigo_montadora;
    }

    function setCodigo_montadora($codigo_montadora)
    {
        $this->codigo_montadora = $codigo_montadora;
    }


    function getModelo()
    {
        return $this->modelo;
    }

    function setModelo($modelo)
    {
        $this->modelo = $modelo;
    }
    function getCodigo()
    {
        return $this->codigo;
    }

    function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }


    //put your code here

    public function inserir(Veiculo $veiculo)
    {
        $con = Conexao::abrirConexao();

        try {
            $query = "INSERT INTO veiculos (codigo, nome, anoinicial, anofinal, montadoras_codigo, modelo)
             VALUES (:codigo, :nome, :anoinicial, :anofinal, :montadoras_codigo, :modelo)";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':codigo', $veiculo->getCodigo());
            $stmt->bindValue(':nome', $veiculo->getNome());
            $stmt->bindValue(':anoinicial', $veiculo->getAnoinicial());
            $stmt->bindValue(':anofinal', $veiculo->getAnofinal());
            $stmt->bindValue(':montadoras_codigo', $veiculo->getCodigo_montadora());
            $stmt->bindValue(':modelo', $veiculo->getModelo());

            return $stmt->execute();
        } catch (PDOException $e) {
            print_r($e->getCode());
        }
    }

    public function cadastrarEmMassa($lista_veiculos)
    {
        $retorno = array();
        $cod_atual = 0;
        $con = Conexao::abrirConexao();
        $con->beginTransaction();
        try {

            $query = "INSERT INTO veiculos (codigo, nome, anoinicial, anofinal, montadoras_codigo, modelo)
             VALUES (:codigo, :nome, :anoinicial, :anofinal, :montadoras_codigo, :modelo)";

            $stmt = $con->prepare($query);

            for ($i = 0; $i < count($lista_veiculos); $i++) {
                $cod_atual = $lista_veiculos[$i]->getCodigo();

                $stmt->bindValue(':codigo', $lista_veiculos[$i]->getCodigo());
                $stmt->bindValue(':nome', $lista_veiculos[$i]->getNome());
                $stmt->bindValue(':anoinicial', $lista_veiculos[$i]->getAnoinicial());
                $stmt->bindValue(':anofinal', $lista_veiculos[$i]->getAnofinal());
                $stmt->bindValue(':montadoras_codigo', $lista_veiculos[$i]->getCodigo_montadora());
                $stmt->bindValue(':modelo', $lista_veiculos[$i]->getModelo());

                $stmt->execute();

                
            }
            if ($con->commit()) {
                $retorno[0] = 1;
                return $retorno;
            }
        } catch (PDOException $e) {
            //    $con->rollBack();
            $retorno[0] = $e->getCode();
            $retorno[1] = $cod_atual;
            return $retorno;
           
        }
    }
    public function listar()
    {

        $con = Conexao::abrirConexao();

        $query = "SELECT veiculos.codigo, veiculos.nome, veiculos.anoinicial, veiculos.anofinal, veiculos.modelo, veiculos.montadoras_codigo, montadoras.montadora 
        FROM veiculos 
        INNER JOIN montadoras 
        ON veiculos.montadoras_codigo = montadoras.codigo";

        $stmt = $con->prepare($query);

        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    public function deletar(Veiculo $mont)
    {

        try {
            $con = Conexao::abrirConexao();

            $sql = "DELETE FROM veiculos WHERE codigo =:codigo";
            $stmt = $con->prepare($sql);

            $stmt->bindValue(':codigo', $mont->codigo);

            $result = $stmt->execute();

            return $result;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function buscarVeiculo($id)
    {



        // $res = $db->prepare("SELECT * FROM sucod681_threeparts.Veiculos WHERE codigo='$id'");
        //  $res->execute();

        // set the resulting array to associative
        //  $result = $res->fetchAll(PDO::FETCH_OBJ);

    }

    public function alterar(Veiculo $veiculo)
    {


        $con = Conexao::abrirConexao();

        $query = "UPDATE veiculos 
        SET nome = :nome, anoinicial = :anoinicial, anofinal = :anofinal, montadoras_codigo = :montadoras_codigo, modelo = :modelo
        WHERE codigo = :codigo";

        $stmt = $con->prepare($query);

        $stmt->bindValue(':codigo', $veiculo->getCodigo());
        $stmt->bindValue(':nome', $veiculo->getNome());
        $stmt->bindValue(':anoinicial', $veiculo->getAnoinicial());
        $stmt->bindValue(':anofinal', $veiculo->getAnofinal());
        $stmt->bindValue(':montadoras_codigo', $veiculo->getCodigo_montadora());
        $stmt->bindValue(':modelo', $veiculo->getModelo());

        $result = $stmt->execute();

        return $result;
    }
}
