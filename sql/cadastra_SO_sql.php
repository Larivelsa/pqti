<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";


$desenvolvedora = $_POST["desenvolvedora"];
$nome = $_POST["nome"];
$versao = $_POST["versao"];
$ano = $_POST["ano"];

$sql = "INSERT INTO sistemaOperacional (desenvolvedora, nome, versao, ano) 
VALUES ('".$desenvolvedora."','".$nome."','".$versao."','".$ano."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_SO.php');

?>
