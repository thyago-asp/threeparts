<?php

if (isset($_SESSION["conectado"])) {

    if ($_SESSION["conectado"] == "0" && $_SESSION["sessao"] = md5(session_id())) {
        header("Location:/");
    }
} else {
    header("Location:/");
}

?>