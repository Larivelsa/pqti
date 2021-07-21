<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idImpressora = $_POST["idImpressora"];
$departamento = $_POST["departamento"];
$bemPatrimonial = $_POST["bemPatrimonial"];
$dataEntrada = $_POST["dataEntrada"];
$dataSaida = $_POST["dataSaida"];
$responsavel = $_POST["responsavel"];
$descricao = $_POST["descricao"];


$sql = "INSERT INTO manutencaoInternaImpressora (departamentoID,idImpressora, bemPatrimonial, dataEntrada, dataSaida, responsavel, descricao) 
VALUES ('".$departamento."','".$idImpressora."','".$bemPatrimonial."','".$dataEntrada."','".$dataSaida."','".$responsavel."','".$descricao."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_manutencaoInternaImpressora.php');

?>
