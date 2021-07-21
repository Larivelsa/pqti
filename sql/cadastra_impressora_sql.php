<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";


$bemPatrimonial = $_POST["bemPatrimonial"];
$empresa = $_POST["empresa"];
$notaFiscal = $_POST["notaFiscal"];
$valor = $_POST["valor"];
$dataAquisicao = $_POST["dataAquisicao"];
$tempoGarantia = $_POST["tempoGarantia"];
$departamento = $_POST["departamento"];
$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$tipo = $_POST["tipo"];
$conectividade = $_POST["conectividade"];
$voltagem = $_POST["voltagem"];


$sql = "INSERT INTO impressora (bemPatrimonial, empresa, notaFiscal, valor, dataAquisicao, tempoGarantia, departamentoID, marca, modelo, tipo, conectividade, voltagem) 
VALUES ('".$bemPatrimonial."','".$empresa."','".$notaFiscal."','".$valor."','".$dataAquisicao."','".$tempoGarantia."','".$departamento."','".$marca."','".$modelo."','".$tipo."','".$conectividade."','".$voltagem."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_impressora.php');

?>
