<?
// Este arquivo conecta um banco de dados MySQL - Servidor = localhost
$dbname = "prefeituravgsul5"; 	// Indique o nome do banco de dados que ser� aberto
$usuario = "prefeituravgsul5"; 	// Indique o nome do usu�rio que tem acesso
$password	 = "prodav2000"; // Indique a senha do usu�rio
$servidor	 = "mysql07.vgsul.sp.gov.br";

//1� passo - Conecta ao servidor MySQL
if(!($id = mysql_connect($servidor,$usuario,$password))) {
	echo "N�o foi poss�vel estabelecer uma conex�o!";
	exit;
}

//2� passo - Seleciona o Banco de Dados
if(!($con=mysql_select_db($dbname,$id))) {
	echo "N�o foi poss�vel estabelecer uma conex�o.";
	exit;
}
?>