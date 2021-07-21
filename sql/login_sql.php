<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";


$email = $_POST["email"];
$senha = $_POST["senha"];




$sql = "INSERT INTO usuario (email, senha) 
VALUES ('".$email."','".$senha."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../index.php');

?>
