<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Conexao::abrirConexao();
class Conexao
{

    public static function abrirConexao()
    {
        $ambiente = "dev";

        switch ($ambiente) {
            case 'dev':
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "fesper35_threeparts";
                break;
            case 'qas':
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "db_deputado_teste";
                break;
            case 'prd':
                $servername = "br12.hostgator.com.br";
                $username = "fesper35_admin";
                $password = "123123";
                $dbname = "fesper35_threeparts";
                break;
            default:
                # code...
                break;
        }

        try {
            $con = new PDO("mysql:host=$servername;dbname=$dbname", "$username", "$password");

            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
            header('Location:/?r=2');
        }
        return $con;
    }
}
