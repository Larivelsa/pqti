<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$idMonitor = $_GET["idMonitor"];

$sql = ("UPDATE monitor SET status='0' 
WHERE idMonitor='".$idMonitor."'");
$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/monitor.php');


?>