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


$sql = "INSERT INTO monitor (bemPatrimonial, empresaID, notaFiscal, valor, dataAquisicao, tempoGarantia, departamentoID, marcaID, modelo) 
VALUES ('".$bemPatrimonial."','".$empresa."','".$notaFiscal."','".$valor."','".$dataAquisicao."','".$tempoGarantia."','".$departamento."','".$marca."','".$modelo."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_monitor.php');

?>
