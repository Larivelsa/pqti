<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$nome = $_POST["nome"];
$nacionalidade = $_POST["nacionalidade"];
$observacao = $_POST["observacao"];

$sql = "INSERT INTO montadora (nome, nacionalidade, observacao) 
VALUES ('".$nome."','".$nacionalidade."','".$observacao."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_montadora.php');

?>
