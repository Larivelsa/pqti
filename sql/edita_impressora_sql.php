<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idImpressora = $_POST["idImpressora"];
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

$sql = ("UPDATE impressora SET empresa='".$empresa."', notaFiscal='".$notaFiscal."', dataAquisicao='".$dataAquisicao."', tempoGarantia='".$tempoGarantia."', departamentoID='".$departamento."', marca='".$marca."', modelo='".$modelo."', tipo='".$tipo."', conectividade='".$conectividade."', voltagem='".$voltagem."'
WHERE idImpressora='".$idImpressora."'");


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/impressora.php');

?>