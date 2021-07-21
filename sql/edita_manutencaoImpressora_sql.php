<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idManutencaoImpressora = $_POST["idManutencaoImpressora"];
$empresa = $_POST["empresa"];
$ordemServico = $_POST["ordemServico"];
$notaFiscal = $_POST["notaFiscal"];
$statusNotaFiscal = $_POST["statusNotaFiscal"];
$valor = $_POST["valor"];
$autorizacaoFornecimento = $_POST["autorizacaoFornecimento"];
$dataEnvio = $_POST["dataEnvio"];
$dataChegada = $_POST["dataChegada"];
$tempoGarantia = $_POST["tempoGarantia"];
$statusServico = $_POST["statusServico"];
$descricao = $_POST["descricao"];


$sql = ("UPDATE manutencaoImpressora SET empresa='".$empresa."', ordemServico='".$ordemServico."', notaFiscal='".$notaFiscal."', statusNotaFiscal='".$statusNotaFiscal."', valor='".$valor."', autorizacaoFornecimento='".$autorizacaoFornecimento."', dataEnvio='".$dataEnvio."', dataChegada='".$dataChegada."', tempoGarantia='".$tempoGarantia."', statusServico='".$statusServico."', descricao='".$descricao."' 
WHERE idManutencaoImpressora='".$idManutencaoImpressora."'");
$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/manutencaoImpressora.php');


?>