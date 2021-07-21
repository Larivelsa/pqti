<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";


$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$tipo = $_POST["tipo"];
$capacidade = $_POST["capacidade"];



$sql = "INSERT INTO memoria (marca, tipo, capacidade) 
VALUES ('".$marca."','".$tipo."','".$capacidade."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_memoria.php');

?>
