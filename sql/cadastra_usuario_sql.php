<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";


$nome = $_POST["nome"];
$sobrenome = $_POST["sobrenome"];
$email = $_POST["email"];
$senha = $_POST["senha"];

$sql = "INSERT INTO usuario (nome,sobrenome,email,senha) VALUES ('".$nome."','".$sobrenome."','".$email."','".$senha."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_usuario.php');

?>
