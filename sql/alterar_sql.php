<?php

include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$senha = addslashes($_POST['senha1']);
$email = addslashes($_POST['user']);

if(!empty($senha and $email) ){	
$sql = mysql_query("UPDATE pessoa SET senha='".$senha."' WHERE email = '".$email."'");
$sql = mysqlexecuta($id,$sql);


header("Location: ../pages/login.php?msg=Troca de senha feita com sucesso, utilize a nova senha para logar");
}else{
	header("Location: ../pages/login.php?msg_inc=Erro ao trocar senha. Tente novamente.");
}

?>