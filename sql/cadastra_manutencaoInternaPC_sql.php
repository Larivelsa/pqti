<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idMaquinaDesktop = $_POST["idMaquinaDesktop"];
$departamento = $_POST["departamento"];
$bemPatrimonial = $_POST["bemPatrimonial"];
$dataEntrada = $_POST["dataEntrada"];
$dataSaida = $_POST["dataSaida"];
$responsavel = $_POST["responsavel"];
$descricao = $_POST["descricao"];


$sql = "INSERT INTO manutencaoInternaPC (departamentoID,idMaquinaDesktop, bemPatrimonial, dataEntrada, dataSaida, responsavel, descricao) 
VALUES ('".$departamento."','".$idMaquinaDesktop."','".$bemPatrimonial."','".$dataEntrada."','".$dataSaida."','".$responsavel."','".$descricao."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_manutencaoInternaPC.php');

?>
