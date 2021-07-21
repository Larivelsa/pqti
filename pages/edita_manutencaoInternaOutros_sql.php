<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idManutencaoInterna = $_POST["idManutencaoInternaOutros"];
$dataEntrada = $_POST["dataEntrada"];
$dataSaida = $_POST["dataSaida"];
$responsavel = $_POST["responsavel"];
$departamento = $_POST["departamento"];
$descricao = $_POST["descricao"];


$sql = ("UPDATE manutencaoInternaPC SET dataEntrada='".$dataEntrada."', dataSaida='".$dataSaida."', responsavel='".$responsavel."', descricao='".$descricao."', departamentoID='".$departamento."'
WHERE idManutencaoInternaOutros='".$idManutencaoInternaOutros."'");

$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/manutencaoInternaOutros.php');

?>