<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";


$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$clock = $_POST["clock"];
$soquete = $_POST["soquete"];


$sql = "INSERT INTO processador (marca, modelo, clock, soquete) 
VALUES ('".$marca."','".$modelo."','".$clock."','".$soquete."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_processador.php');

?>
