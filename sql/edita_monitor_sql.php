<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idMonitor = $_POST["idMonitor"];
$bemPatrimonial = $_POST["bemPatrimonial"];
$empresa = $_POST["empresa"];
$notaFiscal = $_POST["notaFiscal"];
$valor = $_POST["valor"];
$dataAquisicao = $_POST["dataAquisicao"];
$tempoGarantia = $_POST["tempoGarantia"];
$departamento = $_POST["departamento"];
$marca = $_POST["marca"];
$modelo = $_POST["modelo"];


$sql = ("UPDATE monitor SET bemPatrimonial='".$bemPatrimonial."', empresaID='".$empresa."', notaFiscal='".$notaFiscal."', valor='".$valor."', dataAquisicao='".$dataAquisicao."', tempoGarantia='".$tempoGarantia."', departamentoID='".$departamento."', marcaID='".$marca."', modelo='".$modelo."' WHERE idMonitor='".$idMonitor."'");
$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/monitor.php');

?>