   <?php
    //session_start();
    if (isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest") {
        require_once($_SERVER['DOCUMENT_ROOT'] . '/bancodedados/Conexao.php');
        $montadora = filter_input(INPUT_POST, 'montadora', FILTER_SANITIZE_STRING);
        
        $con = Conexao::abrirConexao();

        $query = "SELECT idpecas, cor_peca, p.anoinicial, cod_interno, cod_barra, descricao, produto_imagem, montadora, v.nome, p.montadoras_codigo FROM pecas p
        inner join produtos d on p.produtos_codigo = d.codigo
        inner join montadoras m on p.montadoras_codigo = m.codigo
        inner join veiculos v on p.veiculos_codigo = v.codigo
        where p.montadoras_codigo = '" . $montadora . "'";

        $stmt = $con->prepare($query);

        $result = $stmt->execute();
      
        $_SESSION["listaAtual"] = $stmt->fetchAll();

        echo json_encode($_SESSION["listaAtual"]);
        return;
    }
    echo NULL;
