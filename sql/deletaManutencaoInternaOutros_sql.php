<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idManutencaoInternaOutros = $_GET["idManutencaoInternaOutros"];

$sql = ("UPDATE manutencaoInternaOutros SET status='0' 
WHERE idManutencaoInternaOutros='".$idManutencaoInternaOutros."'");
$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/manutencaoInternaOutros.php');


?>