<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";


$departamento = $_POST["departamento"];
$dataEntrada = $_POST["dataEntrada"];
$dataSaida = $_POST["dataSaida"];
$responsavel = $_POST["responsavel"];
$descricao = $_POST["descricao"];



$sql = "INSERT INTO manutencaoInternaOutros (departamentoID, dataEntrada, dataSaida, responsavel, descricao) 
VALUES ('".$departamento."','".$dataEntrada."','".$dataSaida."','".$responsavel."','".$descricao."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_manutencaoInternaOutros.php');

?>