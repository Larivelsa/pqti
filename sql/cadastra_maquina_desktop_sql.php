<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";


$bemPatrimonial = $_POST["patrimonial"];
$empresa = $_POST["empresa"];
$notaFiscal = $_POST["notaFiscal"];
$valor = $_POST["valor"];
$dataAquisicao = $_POST["dataAquisicao"];
$tempoGarantia = $_POST["tempoGarantia"];
$departamento = $_POST["departamento"];
$marca = $_POST["marca"];
$sistemaOperacional = $_POST["sistemaOperacional"];
$placaMae = $_POST["placaMae"];
$processador = $_POST["processador"];
$hd = $_POST["hd"];
$slot1 = $_POST["slot1"];
$slot2 = $_POST["slot2"];
$fonte = $_POST["fonte"];
$descricao = $_POST["descricao"];

$sql = "INSERT INTO maquinaDesktop (bemPatrimonial, empresaID, notaFiscal, valor, dataAquisicao, tempoGarantia, departamentoID, marcaID, sistemaOperacional, placaMae, processador, hd, slot1, slot2, fonte, descricao) VALUES ('".$bemPatrimonial."','".$empresa."','".$notaFiscal."','".$valor."','".$dataAquisicao."','".$tempoGarantia."','".$departamento."','".$marca."','".$sistemaOperacional."','".$placaMae."','".$processador."','".$hd."','".$slot1."','".$slot2."','".$fonte."','".$descricao."')";

$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_maquinaDesktop.php');

?>
