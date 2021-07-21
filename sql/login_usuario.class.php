<?php

include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";


	
function logar_usuario($email, $senha){

$sql = mysql_query("SELECT * FROM usuario WHERE email = '".$email."' AND senha = '".$senha."'");
$rs	= mysql_fetch_array($sql);

if (empty($rs)){
header("Location: index.php?acao=ERRO");
}else{
session_start("login_usuario");
$_SESSION['email'] = $rs ['email'];    
$_SESSION['senha'] = $rs ['senha'];
$_SESSION['nome'] = $rs ['nome'];
$_SESSION['sobrenome'] = $rs ['sobrenome'];
$_SESSION['status'] = $rs ['status'];
}



if($_SESSION['nivel']==1){
header('Location:../pages/cadastros.php');

}
	return $res;
		
}

?>