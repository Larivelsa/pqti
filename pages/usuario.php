<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Usuário</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
</head>
<script src="js/script.js" type = "text/javascript"></script>


<body>
<header>
<?php
include "header.php";
?>
</header>

<section id = "conteudo">

	<a href="cadastra_usuario.php">Registrar usuário</a>
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscar"> 
	<input type="text" name="conteudoBusca" placeholder="Digite o item para pesquisar" /> 
	<input type="submit" value="Buscar" /> 
	</form>
	
	
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscar") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['conteudoBusca']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT * FROM usuario WHERE nome LIKE '%".$conteudoBusca."%' AND status = '1' ORDER BY nome");   
	
	// Descobrimos o total de registros encontrados 
	
	
	
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Nome</th>
	<th>Sobrenome</th>
	<th>E-mail</th>
	</tr>
	
	<?php while ($usuario = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $usuario->nome;?></td>
	<td><?php echo $usuario->sobrenome;?></td>	
	<td><?php echo $usuario->email;?></td>	
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "Nenhum usuário foi encontrado com o nome ".$conteudoBusca.""; } 
	} // fim do if
	
	?> 
    </table>
	
	</section>

<!--rodapé-->
<footer>
<?php

?>
</footer>
</body>
</html>
