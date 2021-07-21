<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idMaquinaDesktop = $_POST["idMaquinaDesktop"];
$bemPatrimonial = $_POST["bemPatrimonial"];
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


$sql = ("UPDATE maquinaDesktop SET bemPatrimonial='".$bemPatrimonial."', empresaID='".$empresa."', notaFiscal='".$notaFiscal."', valor='".$valor."', dataAquisicao='".$dataAquisicao."', tempoGarantia='".$tempoGarantia."', departamentoID='".$departamento."', marcaID='".$marca."', sistemaOperacional='".$sistemaOperacional."', placaMae='".$placaMae."', processador='".$processador."', hd='".$hd."', slot1='".$slot1."', slot2='".$slot2."', fonte='".$fonte."', descricao='".$descricao."'
WHERE idMaquinaDesktop='".$idMaquinaDesktop."'");
$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/maquinaDesktop.php');

?>