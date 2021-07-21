<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$marca = $_POST["marca"];
$modelo = $_POST["modelo"];

$sql = "INSERT INTO placaMae (marca, modelo) 
VALUES ('".$marca."','".$modelo."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_placaMae.php');

?>
