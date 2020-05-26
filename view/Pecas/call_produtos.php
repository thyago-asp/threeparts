   <?php

    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest") {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');
        $pecas = filter_input(INPUT_POST, 'idpeca', FILTER_SANITIZE_STRING);
        // echo $montadora;

       
        $con = Conexao::abrirConexao();

        $query = "SELECT * FROM imagem where pecas_idpecas = '" . $pecas . "'";

        $stmt = $con->prepare($query);

        $result = $stmt->execute();

        echo json_encode($stmt->fetchAll());
        return;
    }
    echo NULL;
