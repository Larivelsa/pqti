<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idDepartamento = $_POST["idDepartamento"];
$nome = $_POST["nome"];
$observacao = $_POST["observacao"];


$sql = ("UPDATE departamento SET nome='".$nome."', observacao='".$observacao."'
WHERE idDepartamento='".$idDepartamento."'");
$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/departamento.php');

?>