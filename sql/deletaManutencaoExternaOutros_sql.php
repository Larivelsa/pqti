<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idManutencaoExternaOutros = $_GET["idManutencaoExternaOutros"];

$sql = ("UPDATE manutencaoExternaOutros SET status='0' 
WHERE idManutencaoExternaOutros='".$idManutencaoExternaOutros."'");
$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/manutencaoExternaOutros.php');


?>