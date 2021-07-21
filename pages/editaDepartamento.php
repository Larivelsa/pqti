<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Alterar especificações de máquina</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
</head>
<script src="../js/script.js" type = "text/javascript"></script>
<script src="../js/maskedinput.js" type="text/javascript"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery.maskMoney.js" type="text/javascript"></script>


<script type="text/javascript">
	$(document).ready(function () {     

	$("#valor").maskMoney({showSymbol:true, symbol:"R$ ", decimal:"."});
	});
</script>


<body>
<header>
<?php
include "header.php";
?>
</header>
<section id = "conteudo">
<?php 
$idDepartamento = $_GET['idDepartamento']; // Recebendo o valor vindo do link
$sql = mysql_query("SELECT * FROM departamento WHERE idDepartamento = '".$idDepartamento."'"); 

// Há variável $resultado faz uma consulta em nossa tabela selecionando somente o registro desejado
while($linha = mysql_fetch_object($sql)) //Já a instrução while faz um loop entre todos os registros e armazena seus valores na variável $linha
{ 
?>
<form action = "../sql/edita_departamento_sql.php" = method="post" id="mq">
	
	<fieldset>
	<legend>Alterar registro de departamento</legend>
	<input type="hidden" name="idDepartamento" value="<?php echo $linha->idDepartamento; ?>"/> 
	
	<label>Nome</label><input type="text" name = "nome" id = "nome" value="<?php echo $linha->nome;?>"><br><br>
	
	
	<label>Observação</label>
<textarea name="observacao" form="mq"><?php echo $linha->observacao;?></textarea><br><br>
	

	
	<input type="submit" value="Editar"/>

	</fieldset>
	
</form>
</section>

<?php
} // fim do while
?> 
</body>
</html>