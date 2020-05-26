<?php

session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

if (isset($_SESSION["listaAtual"])) {
    $lista = $_SESSION["listaAtual"];
} else {
    header("Location:/view/Pecas/listar/?r=2");
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
//$sheet->setCellValue('A1', 'Hello World !');


// Set document properties
$spreadsheet->getProperties()->setCreator("Thyago Pereira")
        ->setLastModifiedBy("Thyago Pereira")
        ->setTitle("Office 2007 XLSX Test Document")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");

        

// Add some data
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . (string) (1), 'Status GTIN (*)')
        ->setCellValue('B' . (string) (1), 'GTIN')
        ->setCellValue('C' . (string) (1), 'Marca (*)')
        ->setCellValue('D' . (string) (1), 'Número do Modelo')
        ->setCellValue('E' . (string) (1), 'Descrição do Produto (*)')
        ->setCellValue('F' . (string) (1), 'NCM (*)')
        ->setCellValue('G' . (string) (1), 'CEST')
        ->setCellValue('H' . (string) (1), 'Segmento Produto (*)')
        ->setCellValue('I' . (string) (1), 'Família Produto (*)')
        ->setCellValue('J' . (string) (1), 'Classe Produto (*)')
        ->setCellValue('K' . (string) (1), 'Sub Classe Produto (*)')
        ->setCellValue('L' . (string) (1), 'Número de Identificação Alternativa 1')
        ->setCellValue('M' . (string) (1), 'Agência Reguladora 1')
        ->setCellValue('N' . (string) (1), 'Número de Identificação Alternativa 2')
        ->setCellValue('O' . (string) (1), 'Agência Reguladora 2')
        ->setCellValue('P' . (string) (1), 'Número de Identificação Alternativa 3')
        ->setCellValue('Q' . (string) (1), 'Agência Reguladora 3')
        ->setCellValue('R' . (string) (1), 'Número de Identificação Alternativa 4')
        ->setCellValue('S' . (string) (1), 'Agência Reguladora 4')
        ->setCellValue('T' . (string) (1), 'Número de Identificação Alternativa 5')
        ->setCellValue('U' . (string) (1), 'Agência Reguladora 5')
        ->setCellValue('V' . (string) (1), 'País/Mercado de Destino (*)')
        ->setCellValue('W' . (string) (1), 'País de Origem (*)')
        ->setCellValue('X' . (string) (1), 'Estado')
        ->setCellValue('Y' . (string) (1), 'Altura')
        ->setCellValue('Z' . (string) (1), 'Altura - UN Medida')
        ->setCellValue('AA' . (string) (1), 'Largura')
        ->setCellValue('AB' . (string) (1), 'Largura - UN Medida')
        ->setCellValue('AC' . (string) (1), 'Profundidade')
        ->setCellValue('AD' . (string) (1), 'Profundidade - UN Medida')
        ->setCellValue('AE' . (string) (1), 'Conteúdo Líquido')
        ->setCellValue('AF' . (string) (1), 'Cont. Liq. - UN Medida - UN Medida')
        ->setCellValue('AG' . (string) (1), 'Peso Bruto (*)')
        ->setCellValue('AH' . (string) (1), 'Peso Bruto - UN Medida (*)')
        ->setCellValue('AI' . (string) (1), 'Peso Líquido')
        ->setCellValue('AJ' . (string) (1), 'Peso Líq. - UN Medida')
        ->setCellValue('AK' . (string) (1), 'Tempo mínimo (dias) de vida útil do produto após produção')
        ->setCellValue('AL' . (string) (1), 'Compartilha Dados?')
        ->setCellValue('AM' . (string) (1), 'Observação')
        ->setCellValue('AN' . (string) (1), 'Tipo de Produto')
        ->setCellValue('AO' . (string) (1), 'Tipo de Pallet')
        ->setCellValue('AP' . (string) (1), 'Fator de Empilhamento')
        ->setCellValue('AQ' . (string) (1), 'Quantidade de Camadas por Pallet')
        ->setCellValue('AR' . (string) (1), 'Quantidade de Itens Comerciais em uma Única Camada')
        ->setCellValue('AS' . (string) (1), 'Quantidade de Itens Comerciais uma Camada Completa')
        ->setCellValue('AT' . (string) (1), 'Quantidade de Camadas Completas em Item Comercial')
        ->setCellValue('AU' . (string) (1), 'GTIN Inferior')
        ->setCellValue('AV' . (string) (1), 'Quantidade')
        ->setCellValue('AW' . (string) (1), 'Alíquota de Impostos IPI')
        ->setCellValue('AX' . (string) (1), 'Nome URL 1 (*)')
        ->setCellValue('AY' . (string) (1), 'URL 1 (*)')
        ->setCellValue('AZ' . (string) (1), 'Tipo de URL 1 (*)')
        ->setCellValue('BA' . (string) (1), 'Nome URL 2 (*)')
        ->setCellValue('BB' . (string) (1), 'URL 2 (*)')
        ->setCellValue('BC' . (string) (1), 'Tipo de URL 2 (*)')
        ->setCellValue('BD' . (string) (1), 'Nome URL 3 (*)')
        ->setCellValue('BE' . (string) (1), 'URL 3 (*)')
        ->setCellValue('BF' . (string) (1), 'Tipo de URL 3 (*)')
        ->setCellValue('BG' . (string) (1), 'Item Comercial é um modelo')
        ->setCellValue('BH' . (string) (1), 'Unidade de Medida do Pedido')
        ->setCellValue('BI' . (string) (1), 'Múltiplo da Quantidade para Pedido')
        ->setCellValue('BJ' . (string) (1), 'Quantidade Mínima para Pedido')
        ->setCellValue('BK' . (string) (1), 'Tipo da Embalagem')
        ->setCellValue('BL' . (string) (1), 'Temperatura Mínima de Armazenamento/manuseio')
        ->setCellValue('BM' . (string) (1), 'Unidade de Medida da Temperatura de Armazenamento/manuseio Mínima')
        ->setCellValue('BN' . (string) (1), 'Temperatura Máxima de Armazenamento/manuseio')
        ->setCellValue('BO' . (string) (1), 'Unidade de Medida da Temperatura Armazenamento/manuseio Máxima')
        ->setCellValue('BP' . (string) (1), 'Indicador de Mercadorias Perigosas');

$count = 2;

$object = (object) $lista;

//print_r($object);
foreach ($object as $peca) {

    //print_r($peca);
    $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . (string) ($count), 'ATIVO')
            ->setCellValue('B' . (string) ($count), '')
            ->setCellValue('C' . (string) ($count), 'ThreeParts')
            ->setCellValue('D' . (string) ($count), 'Número do Modelo')
            ->setCellValue('E' . (string) ($count), $peca["descricao"] . "-" . $peca["montadora"])
            ->setCellValue('F' . (string) ($count), '8302.30.00')
            ->setCellValue('G' . (string) ($count), '')
            ->setCellValue('H' . (string) ($count), '77000000')
            ->setCellValue('I' . (string) ($count), '77010000')
            ->setCellValue('J' . (string) ($count), '77011900')
            ->setCellValue('K' . (string) ($count), '10002869')
            ->setCellValue('L' . (string) ($count), $peca["cod_interno"])
            ->setCellValue('M' . (string) ($count), '')
            ->setCellValue('N' . (string) ($count), '')
            ->setCellValue('O' . (string) ($count), '')
            ->setCellValue('P' . (string) ($count), '')
            ->setCellValue('Q' . (string) ($count), '')
            ->setCellValue('R' . (string) ($count), '')
            ->setCellValue('S' . (string) ($count), '')
            ->setCellValue('T' . (string) ($count), '')
            ->setCellValue('U' . (string) ($count), '')
            ->setCellValue('V' . (string) ($count), '76')
            ->setCellValue('W' . (string) ($count), '76')
            ->setCellValue('X' . (string) ($count), 'Paraná')
            ->setCellValue('Y' . (string) ($count), '')
            ->setCellValue('Z' . (string) ($count), '')
            ->setCellValue('AA' . (string) ($count), '')
            ->setCellValue('AB' . (string) ($count), '')
            ->setCellValue('AC' . (string) ($count), '')
            ->setCellValue('AD' . (string) ($count), '')
            ->setCellValue('AE' . (string) ($count), '')
            ->setCellValue('AF' . (string) ($count), '')
            ->setCellValue('AG' . (string) ($count), '100')
            ->setCellValue('AH' . (string) ($count), 'g')
            ->setCellValue('AI' . (string) ($count), '')
            ->setCellValue('AJ' . (string) ($count), '')
            ->setCellValue('AK' . (string) ($count), '')
            ->setCellValue('AL' . (string) ($count), '')
            ->setCellValue('AM' . (string) ($count), '')
            ->setCellValue('AN' . (string) ($count), '')
            ->setCellValue('AO' . (string) ($count), '')
            ->setCellValue('AP' . (string) ($count), '')
            ->setCellValue('AQ' . (string) ($count), '')
            ->setCellValue('AR' . (string) ($count), '')
            ->setCellValue('AS' . (string) ($count), '')
            ->setCellValue('AT' . (string) ($count), '')
            ->setCellValue('AU' . (string) ($count), '')
            ->setCellValue('AV' . (string) ($count), '')
            ->setCellValue('AW' . (string) ($count), '')
            ->setCellValue('AX' . (string) ($count), '')
            ->setCellValue('AY' . (string) ($count), '')
            ->setCellValue('AZ' . (string) ($count), $peca["produto_imagem"])
            ->setCellValue('BA' . (string) ($count), '')
            ->setCellValue('BB' . (string) ($count), '')
            ->setCellValue('BC' . (string) ($count), '')
            ->setCellValue('BD' . (string) ($count), '')
            ->setCellValue('BE' . (string) ($count), '')
            ->setCellValue('BF' . (string) ($count), '')
            ->setCellValue('BG' . (string) ($count), '')
            ->setCellValue('BH' . (string) ($count), '')
            ->setCellValue('BI' . (string) ($count), '')
            ->setCellValue('BJ' . (string) ($count), '')
            ->setCellValue('BK' . (string) ($count), '')
            ->setCellValue('BL' . (string) ($count), '')
            ->setCellValue('BM' . (string) ($count), '')
            ->setCellValue('BN' . (string) ($count), '')
            ->setCellValue('BO' . (string) ($count), '')
            ->setCellValue('BP' . (string) ($count), '');
    $count++;
}



// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('GTIN-13');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Excel5)

$writer = new Xlsx($spreadsheet);
date_default_timezone_set('America/Sao_Paulo');
$nomeArquivo = date("d-m-Y-h-i-s");
$writer->save($_SERVER['DOCUMENT_ROOT'] . './GTIN_13/' . $nomeArquivo . ".xlsx");

header("Location:/view/Pecas/listar/?r=4&c=".$_SERVER['DOCUMENT_ROOT'] . '/GTIN_13/' .$nomeArquivo . ".xlsx");
