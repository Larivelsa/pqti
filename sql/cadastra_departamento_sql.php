<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$nome = $_POST["nome"];
$observacao = $_POST["observacao"];

$sql = "INSERT INTO departamento (nome, observacao) 
VALUES ('".$nome."','".$observacao."')";

$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_departamento.php');

?>