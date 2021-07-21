<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";


$fantasia = $_POST["fantasia"];
$razaoSocial = $_POST["razaoSocial"];
$cnpj = $_POST["cnpj"];
$ie = $_POST["ie"];
$contato = $_POST["contato"];
$telefone = $_POST["telefone"];
$email = $_POST["email"];
$rua = $_POST["rua"];
$numero = $_POST["numero"];
$bairro = $_POST["bairro"];
$complemento = $_POST["complemento"];
$uf = $_POST["uf"];
$cidade = $_POST["cidade"];
$observacao = $_POST["observacao"];



$sql = "INSERT INTO fornecedor (fantasia, razaoSocial, cnpj, ie, contato, telefone, email, rua, numero, bairro, complemento, uf, cidade, observacao) 
VALUES ('".$fantasia."','".$razaoSocial."','".$cnpj."','".$ie."','".$contato."','".$telefone."','".$email."','".$rua."','".$numero."','".$bairro."','".$complemento."','".$uf."','".$cidade."','".$observacao."')";


$sql = mysqlexecuta($id,$sql);

header('Location: ../pages/cadastra_fornecedor.php');

?>
