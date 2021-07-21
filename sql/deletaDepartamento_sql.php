<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idDepartamento = $_GET["idDepartamento"];

$sql = ("UPDATE departamento SET status='0' 
WHERE idDepartamento='".$idDepartamento."'");

$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/departamento.php');


?>