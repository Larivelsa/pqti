<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idManutencaoInternaOutros = $_POST["idManutencaoInternaOutros"];
$dataEntrada = $_POST["dataEntrada"];
$dataSaida = $_POST["dataSaida"];
$responsavel = $_POST["responsavel"];
$descricao = $_POST["descricao"];


$sql = ("UPDATE manutencaoInternaOutros SET dataEntrada='".$dataEntrada."', dataSaida='".$dataSaida."', responsavel='".$responsavel."', descricao='".$descricao."'
WHERE idManutencaoInternaOutros='".$idManutencaoInternaOutros."'");

$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/manutencaoInternaOutros.php');

?>