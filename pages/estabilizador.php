<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<title>Gerenciamento de estabilizadores/nobreaks</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
</head>
<script src="../js/script.js" type = "text/javascript"></script>

<body>
<header>
<?php
include "header.php";
?>
</header>

<section id = "conteudo">

	<a href="cadastra_estabilizador.php">Cadastrar estabilizadores/nobreaks</a>
	
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscar"> 
	<input type="text" name="conteudoBusca" placeholder="Digite o modelo para pesquisar" /> 
	<input type="submit" value="Buscar" /> 
	</form>
	
	
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscar") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['conteudoBusca']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	$sql = mysql_query("SELECT * FROM estabilizador WHERE modelo LIKE '%".$conteudoBusca."%' AND status = '1' ORDER BY modelo");   
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>

	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Marca</th>
	<th>Modelo</th>	
	<th>Voltagem</th>
	<th>Potencia</th>		
	</tr>
	
	<?php while ($estabilizadores = mysql_fetch_object($sql)) {	
	?>
	
	<tr>
    <td header="header_marca" ><?php echo $estabilizadores->marca;?></td>	
	<td header="header_modelo"><?php echo $estabilizadores->modelo;?></td>
	<td header="header_voltagem"><?php echo $estabilizadores->voltagem;?></td>
	<td header="header_potencia"><?php echo $estabilizadores->potencia;?></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "Nenhum estabilizador foi encontrado com o modelo ".$conteudoBusca.""; } 
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
