<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idImpressora = $_GET["idImpressora"];

$sql = ("UPDATE impressora SET status='0' 
WHERE idImpressora='".$idImpressora."'");
$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/impressora.php');


?>