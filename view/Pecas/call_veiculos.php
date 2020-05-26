    <?php

    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest") {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');
        $ufid = filter_input(INPUT_POST, 'ufid', FILTER_SANITIZE_STRING);

        $con = Conexao::abrirConexao();

        $query = "SELECT codigo, nome, modelo, anoinicial, anofinal
            FROM veiculos 
            where montadoras_codigo = '" . $ufid . "'";

        $stmt = $con->prepare($query);

        $stmt->execute();

        echo json_encode($stmt->fetchAll());
        return;
    }
    echo NULL;
