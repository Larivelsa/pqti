<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";


$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$interfacee = $_POST["interfacee"];
$capacidade = $_POST["capacidade"];
$velocidade = $_POST["velocidade"];
$cache = $_POST["cache"];


$sql = "INSERT INTO hd (marca, modelo, interfacee, capacidade, velocidade, cache) 
VALUES ('".$marca."','".$modelo."','".$interfacee."','".$capacidade."','".$velocidade."','".$cache."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_hd.php');

?>
