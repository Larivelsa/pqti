<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idMaquinaDesktop = $_GET["idMaquinaDesktop"];

$sql = ("UPDATE maquinaDesktop SET status='0' 
WHERE idMaquinaDesktop='".$idMaquinaDesktop."'");
$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/maquinaDesktop.php');


?>