<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idManutencaoImpressora = $_GET["idManutencaoImpressora"];

$sql = ("UPDATE manutencaoImpressora SET status='0' 
WHERE idManutencaoImpressora='".$idManutencaoImpressora."'");
$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/manutencaoImpressora.php');


?>