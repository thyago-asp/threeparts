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
require_once($_SERVER['DOCUMENT_ROOT'] . '/model/Pecas.php');




class Pecas
{
    private $idpecas;
    private $montadora;
    private $veiculo;
    private $layout;
    private $cor;
    private $informacaoadicional;
    private $produto = array();
    private $anoinicial;
    private $caminhoImagem;
    private $codInterno;
    private $codBarra;

    private $arquivoBlack;
    private $arquivoSilver;

    private $arquivosEditar;

    function getMontadora()
    {
        return $this->montadora;
    }

    function getVeiculo()
    {
        return $this->veiculo;
    }

    function getLayout()
    {
        return $this->layout;
    }

    function getCor()
    {
        return $this->cor;
    }

    function getInformacaoadicional()
    {
        return $this->informacaoadicional;
    }

    function getProduto()
    {
        return $this->produto;
    }

    function setMontadora($montadora)
    {
        $this->montadora = $montadora;
    }

    function setVeiculo($veiculo)
    {
        $this->veiculo = $veiculo;
    }

    function setLayout($layout)
    {
        $this->layout = $layout;
    }

    function setCor($cor)
    {
        $this->cor = $cor;
    }

    function setInformacaoadicional($informacaoadicional)
    {
        $this->informacaoadicional = $informacaoadicional;
    }

    function setProduto($produto)
    {
        $this->produto = $produto;
    }


    function getCodInterno()
    {
        return $this->codInterno;
    }

    function getCodBarra()
    {
        return $this->codBarra;
    }

    function setCodInterno($codInterno)
    {
        $this->codInterno = $codInterno;
    }

    function setCodBarra($codBarra)
    {
        $this->codBarra = $codBarra;
    }


    function getAnoinicial()
    {
        return $this->anoinicial;
    }

    function setAnoinicial($anoinicial)
    {
        $this->anoinicial = $anoinicial;
    }

    function getArquivoBlack()
    {
        return $this->arquivoBlack;
    }

    function setArquivoBlack($arquivoBlack)
    {
        $this->arquivoBlack = $arquivoBlack;
    }

    function getArquivoSilver()
    {
        return $this->arquivoSilver;
    }

    function setArquivoSilver($arquivoSilver)
    {
        $this->arquivoSilver = $arquivoSilver;
    }

    function getArquivosEditar()
    {
        return $this->arquivosEditar;
    }

    function setArquivosEditar($arquivosEditar)
    {
        $this->arquivosEditar = $arquivosEditar;
    }

    function getIdpecas()
    {
        return $this->idpecas;
    }

    function setIdpecas($idpecas)
    {
        $this->idpecas = $idpecas;
    }

    function getCaminhoImagem()
    {
        return $this->caminhoImagem;
    }

    function setCaminhoImagem($caminhoImagem)
    {
        $this->caminhoImagem = $caminhoImagem;
    }
    //put your code here

    public function inserir(Pecas $peca)
    {
        $con = Conexao::abrirConexao();
        $codigo_interno = "";
        $query = "";

        try {

            $arquivosBlack = $peca->getArquivoBlack();
            $arquivosSilver = $peca->getArquivoSilver();

            foreach ($peca->getCor() as $cor) {

                if ($cor == "BLK") {
                    for ($i = 0; $i < count($arquivosBlack); $i++) {
                        //print_r($arquivosBlack[$i][0]);                        

                        $codigo_interno = $arquivosBlack[$i][0] . "-";
                        $codigo_interno .= $peca->getMontadora() . "-";
                        $codigo_interno .= $peca->getVeiculo() . "-";
                        $codigo_interno .= substr($peca->getAnoinicial(), -2) . "-";
                        $codigo_interno .= $cor;

                        $query = "INSERT INTO pecas (montadoras_codigo, veiculos_codigo, 
                        cor_peca, produtos_codigo, produto_imagem, info_adicionais, 
                        cod_interno, cod_barra, anoinicial, layout_codigo ,data_cadastro)
                        VALUES (:montadoras_codigo, :veiculos_codigo, 
                        :cor_peca, :produtos_codigo, :produto_imagem, :info_adicionais, 
                        :cod_interno, :cod_barra, :anoinicial, :layout_codigo, :data_cadastro);";

                        $stmt = $con->prepare($query);

                        $stmt->bindValue(':montadoras_codigo', $peca->getMontadora());
                        $stmt->bindValue(':veiculos_codigo', $peca->getVeiculo());
                        $stmt->bindValue(':cor_peca', $cor);
                        $stmt->bindValue(':produtos_codigo', $arquivosBlack[$i][0]);
                        if (array_key_exists($arquivosBlack[$i][1], $arquivosBlack[$i])) {
                            $stmt->bindValue(':produto_imagem', $arquivosBlack[$i][1]);
                        }else{
                            $stmt->bindValue(':produto_imagem', "");
                        }
                        $stmt->bindValue(':info_adicionais', $peca->getInformacaoadicional());
                        $stmt->bindValue(':cod_interno', $codigo_interno);
                        $stmt->bindValue(':cod_barra', $peca->getCodBarra());
                        $stmt->bindValue(':anoinicial', substr($peca->getAnoinicial(), -2));
                        $stmt->bindValue(':layout_codigo', null);
                        date_default_timezone_set('America/Sao_Paulo');
                        $stmt->bindValue(':data_cadastro', date('d/m/Y \- H:i:s'));

                        $retornoInsertPeca = $stmt->execute();

                        if ($retornoInsertPeca > 0) {
                            $idPeca = $con->lastInsertId();
                            $queryImagens = "";
                            if (count($arquivosBlack[$i]) > 1) {
                                for ($j = 2; $j < count($arquivosBlack[$i]); $j++) {
                                    $queryImagens = "INSERT INTO imagem (pecas_idpecas, caminho_imagem)
                                    VALUES (:pecas_idpecas, :caminho_imagem);";

                                    $stmt = $con->prepare($queryImagens);

                                    $stmt->bindValue(':pecas_idpecas', $idPeca);
                                    $stmt->bindValue(':caminho_imagem', $arquivosBlack[$i][$j]);

                                    $stmt->execute();
                                }
                            }
                        }
                    }
                } else if ($cor == "SIL") {
                    for ($i = 0; $i < count($arquivosSilver); $i++) {
                        //print_r($arquivosBlack[$i][0]);                        

                        $codigo_interno = $arquivosSilver[$i][0] . "-";
                        $codigo_interno .= $peca->getMontadora() . "-";
                        $codigo_interno .= $peca->getVeiculo() . "-";
                        $codigo_interno .= substr($peca->getAnoinicial(), -2) . "-";
                        $codigo_interno .= $cor;

                        $query = "INSERT INTO pecas (montadoras_codigo, veiculos_codigo, 
                        cor_peca, produtos_codigo, produto_imagem, info_adicionais, 
                        cod_interno, cod_barra, anoinicial, layout_codigo ,data_cadastro)
                        VALUES (:montadoras_codigo, :veiculos_codigo, 
                        :cor_peca, :produtos_codigo, :produto_imagem, :info_adicionais, 
                        :cod_interno, :cod_barra, :anoinicial, :layout_codigo, :data_cadastro);";

                        $stmt = $con->prepare($query);

                        $stmt->bindValue(':montadoras_codigo', $peca->getMontadora());
                        $stmt->bindValue(':veiculos_codigo', $peca->getVeiculo());
                        $stmt->bindValue(':cor_peca', $cor);
                        $stmt->bindValue(':produtos_codigo', $arquivosSilver[$i][0]);

                        if (array_key_exists($arquivosSilver[$i][1], $arquivosSilver[$i])) {
                            $stmt->bindValue(':produto_imagem', $arquivosSilver[$i][1]);
                        }else{
                            $stmt->bindValue(':produto_imagem', "");
                        }
                       
                        $stmt->bindValue(':info_adicionais', $peca->getInformacaoadicional());
                        $stmt->bindValue(':cod_interno', $codigo_interno);
                        $stmt->bindValue(':cod_barra', $peca->getCodBarra());
                        $stmt->bindValue(':anoinicial', substr($peca->getAnoinicial(), -2));
                        $stmt->bindValue(':layout_codigo', null);
                        date_default_timezone_set('America/Sao_Paulo');
                        $stmt->bindValue(':data_cadastro', date('d/m/Y \- H:i:s'));

                        $retornoInsertPeca = $stmt->execute();
                        //    echo "<br/><br/><br/>";
                        if ($retornoInsertPeca > 0) {
                            $idPecaPrata = $con->lastInsertId();
                            $queryImagens = "";
                            if (count($arquivosSilver[$i]) > 1) {
                                for ($j = 2; $j < count($arquivosSilver[$i]); $j++) {
                                    $queryImagens = "INSERT INTO imagem (pecas_idpecas, caminho_imagem)
                                    VALUES (:pecas_idpecas, :caminho_imagem);";

                                    $stmt = $con->prepare($queryImagens);

                                    $stmt->bindValue(':pecas_idpecas', $idPecaPrata);
                                    $stmt->bindValue(':caminho_imagem', $arquivosSilver[$i][$j]);

                                    $stmt->execute();
                                    //  echo $queryImagens;
                                    //echo "<br/>";
                                }
                            }
                        }
                    }
                }
            }
            return true;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function listar($montadora)
    {

        $con = Conexao::abrirConexao();

        $query = "SELECT idpecas, cor_peca, p.anoinicial, cod_interno, cod_barra, descricao, montadora, v.nome, p.montadoras_codigo FROM pecas p
        inner join produtos d on p.produtos_codigo = d.codigo
        inner join montadoras m on p.montadoras_codigo = m.codigo
        inner join veiculos v on p.veiculos_codigo = v.codigo
        where p.montadoras_codigo = '" . $montadora . "'";

        $stmt = $con->prepare($query);

        $result = $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    public function deletar($peca)
    {

        try {
            $con = Conexao::abrirConexao();

            $sql = "DELETE FROM pecas WHERE idpecas =:codigo";
            $stmt = $con->prepare($sql);

            $stmt->bindValue(':codigo', $peca);

            $result = $stmt->execute();

            if ($result > 0) {
                $sql = "DELETE FROM imagem WHERE pecas_idpecas =:codigo";
                $stmt = $con->prepare($sql);

                $stmt->bindValue(':codigo', $peca);

                $result = $stmt->execute();
            }

            return true;
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function alterar(Pecas $peca)
    {

        try {
            $con = Conexao::abrirConexao();

            $query = "UPDATE pecas
        SET anoinicial = :anoinicial, cod_barra = :cod_barra
        WHERE idpecas = :idpecas";

            $stmt = $con->prepare($query);

            $stmt->bindValue(':anoinicial', $peca->getAnoinicial());
            $stmt->bindValue(':cod_barra', $peca->getCodBarra());
            $stmt->bindValue(':idpecas', $peca->getIdpecas());

            $result = $stmt->execute();

            if ($result > 0) {
                for ($i = 0; $i < count($peca->getArquivosEditar()); $i++) {
                    $arquivos = $peca->getArquivosEditar();
                    $query = "INSERT INTO imagem (pecas_idpecas, caminho_imagem)
                VALUES (:pecas_idpecas, :caminho_imagem);";

                    $stmt = $con->prepare($query);

                    $stmt->bindValue(':pecas_idpecas', $peca->getIdpecas());
                    $stmt->bindValue(':caminho_imagem', $arquivos[$i]);

                    print_r($arquivos);

                    $stmt->execute();
                }
            }

            return true;
        } catch (PDOException $e) {
            print_r($e);
        }
    }


    private function inserirImagens()
    {
    }
}
