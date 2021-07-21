<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idManutencaoInternaImpressora = $_GET["idManutencaoInternaImpressora"];

$sql = ("UPDATE manutencaoInternaImpressora SET status='0' 
WHERE idManutencaoInternaImpressora='".$idManutencaoInternaImpressora."'");
$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/manutencaoInternaImpressora.php');


?>