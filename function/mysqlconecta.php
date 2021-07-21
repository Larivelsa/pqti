<?
// Este arquivo conecta um banco de dados MySQL - Servidor = localhost
$dbname = "prefeituravgsul5"; 	// Indique o nome do banco de dados que será aberto
$usuario = "prefeituravgsul5"; 	// Indique o nome do usuário que tem acesso
$password	 = "prodav2000"; // Indique a senha do usuário
$servidor	 = "mysql07.vgsul.sp.gov.br";

//1º passo - Conecta ao servidor MySQL
if(!($id = mysql_connect($servidor,$usuario,$password))) {
	echo "Não foi possível estabelecer uma conexão!";
	exit;
}

//2º passo - Seleciona o Banco de Dados
if(!($con=mysql_select_db($dbname,$id))) {
	echo "Não foi possível estabelecer uma conexão.";
	exit;
}
?>