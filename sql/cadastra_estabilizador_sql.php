<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$tipo = $_POST["tipo"];
$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$potencia = $_POST["potencia"];
$voltagem = $_POST["voltagem"];


$sql = "INSERT INTO estabilizador (tipo, marca, modelo, potencia, voltagem) 
VALUES ('".$tipo."','".$marca."','".$modelo."','".$potencia."','".$voltagem."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_estabilizador.php');

?>
