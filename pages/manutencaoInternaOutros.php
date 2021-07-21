<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Manutenção de interna em geral</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
</head>
<script src="../js/script.js" type = "text/javascript"></script>


<body>
<header>
<?php
include "header.php";
?>
</header>

<section id="conteudo">




<fieldset id="pesquisa">
	<legend>Pesquise ou registre manutenção interna geral</legend>
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscar"> 
	<input type="text" name="conteudoBusca" placeholder="Digite palavra-chave para pesquisar" /> 
	<input type="submit" value="Buscar"/> 
	</form>
	
	<label>Se a manutenção não estiver no sistema, <a href="cadastra_manutencaoInternaOutros.php">registre-a.</a></label><br><br><br>
	
</fieldset>	


	
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscar") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['conteudoBusca']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT manutencaoInternaOutros.idManutencaoInternaOutros, manutencaoInternaOutros.departamentoID, manutencaoInternaOutros.dataEntrada, manutencaoInternaOutros.dataSaida, manutencaoInternaOutros.responsavel, manutencaoInternaOutros.descricao, departamento.idDepartamento, departamento.nome AS departamento
	FROM manutencaoInternaOutros 
	INNER JOIN departamento ON departamento.idDepartamento=manutencaoInternaOutros.departamentoID
	WHERE manutencaoInternaOutros.descricao LIKE '%".$conteudoBusca."%' 
	AND manutencaoInternaOutros.status=1"); 
	
	$numRegistros = mysql_num_rows($sql);   

	if ($numRegistros != 0) {
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Departamento</th>
	<th>Data de entrada</th>
	<th>Data de saída</th>
	<th>Responsável</th>
	<th>Descrição</th>
	</tr>
	
	<?php while ($manutencaoInternaOutros = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $manutencaoInternaOutros->departamento;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoInternaOutros->dataEntrada));?></td>
	<td><?php echo 	date('d/m/Y',strtotime($manutencaoInternaOutros->dataSaida)); ?></td>	
	<td><?php echo $manutencaoInternaOutros->responsavel;?></td>
	<td><?php echo $manutencaoInternaOutros->descricao;?></td>	
	<td><a href="editaManutencaoInternaOutros.php?idManutencaoInternaOutros=<?php echo $manutencaoInternaOutros->idManutencaoInternaOutros; ?>">Editar</a></td> 
	<td><a href="../sql/deletaManutencaoInternaOutros_sql.php?idManutencaoInternaOutros=<?php echo $manutencaoInternaOutros->idManutencaoInternaOutros; ?>" onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>	
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "<fieldset><p id = 'textoPequeno'>Nenhuma manutenção foi encontrada com a palavra-chave ".$conteudoBusca."</p></fieldset>"; } 
	} // fim do if
	
	?> 
    </table>
	
			<?php if ($numRegistros != 0) {
	?> 
	<p id = "textoPequeno">Número de manutenções encontradas: <b><?php echo $numRegistros;?></b></p>
	<?php }?>
	
	
	
	</section>

<!--rodapé-->
<footer>
<?php

?>
</footer>
</body>
</html>
