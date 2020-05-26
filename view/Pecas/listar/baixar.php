<?php
$arquivo = $_GET["arquivo"];
   if(isset($arquivo) && file_exists($arquivo)){ 
   // faz o teste se a variavel não esta vazia e se o arquivo realmente existe

        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.basename($arquivo));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($arquivo));
        readfile($arquivo);
   }
