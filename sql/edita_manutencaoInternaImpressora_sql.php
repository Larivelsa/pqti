<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idManutencaoInterna = $_POST["idManutencaoInternaImpressora"];
$dataEntrada = $_POST["dataEntrada"];
$dataSaida = $_POST["dataSaida"];
$responsavel = $_POST["responsavel"];
$descricao = $_POST["descricao"];


$sql = ("UPDATE manutencaoInternaImpressora SET dataEntrada='".$dataEntrada."', dataSaida='".$dataSaida."', responsavel='".$responsavel."', descricao='".$descricao."'
WHERE idManutencaoInternaImpressora='".$idManutencaoInternaImpressora."'");

$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/manutencaoInternaImpressora.php');

?>