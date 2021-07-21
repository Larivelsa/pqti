<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idManutencaoInterna = $_GET["idManutencaoInterna"];

$sql = ("UPDATE manutencaoInternaPC SET status='0' 
WHERE idManutencaoInterna='".$idManutencaoInterna."'");
$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/manutencaoInternaPC.php');


?>