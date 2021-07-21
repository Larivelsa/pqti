<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idManutencaoInterna = $_POST["idManutencaoInterna"];
$dataEntrada = $_POST["dataEntrada"];
$dataSaida = $_POST["dataSaida"];
$responsavel = $_POST["responsavel"];
$descricao = $_POST["descricao"];


$sql = ("UPDATE manutencaoInternaPC SET dataEntrada='".$dataEntrada."', dataSaida='".$dataSaida."', responsavel='".$responsavel."', descricao='".$descricao."'
WHERE idManutencaoInterna='".$idManutencaoInterna."'");

$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/manutencaoInternaPC.php');

?>