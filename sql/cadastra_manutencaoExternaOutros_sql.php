<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";


$empresa = $_POST["empresa"];
$departamento = $_POST["departamento"];
$item = $_POST["item"];
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


$sql = "INSERT INTO manutencaoExternaOutros (empresa, departamentoID, item, ordemServico, notaFiscal, statusNotaFiscal, valor, autorizacaoFornecimento, dataEnvio, dataChegada, tempoGarantia, statusServico, descricao) 
VALUES ('".$empresa."','".$departamento."','".$item."','".$ordemServico."','".$notaFiscal."','".$statusNotaFiscal."','".$valor."','".$autorizacaoFornecimento."','".$dataEnvio."','".$dataChegada."','".$tempoGarantia."','".$statusServico."','".$descricao."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_manutencaoExternaOutros.php');

?>
