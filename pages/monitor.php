<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Monitores</title>
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
	<legend>Escolha um dos termos para pesquisar monitor</legend>
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscarBemPatrimonial"> 
	<label>Bem Patrimonial ou serial</label>
	<input type="text" name="bemPatrimonial"/>
	<input type="submit" value="Pesquisar" /> 
	</form> 
	
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscarDepartamento"> 
	<label>Departamento</label>
	<select name="departamento">
	<option value="...">Selecione...</option>
	<?php 
	$sql = mysql_query("SELECT idDepartamento, nome FROM departamento WHERE status = '1' ORDER BY nome");  
	while($departamento = mysql_fetch_array($sql)) { ?>
	<option value="<?php echo $departamento['idDepartamento'] ?>"><?php echo $departamento['nome'] ?></option>
	<?php } ?>
	</select>
	<input type="submit" value="Pesquisar" /> 
	</form>
	
	
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscarMarca"> 
	<label>Marca</label>
	<select name="marca">
	<option value="...">Selecione...</option>
	<?php 
	$sql = mysql_query("SELECT idMontadora, nome FROM montadora WHERE status = '1' ORDER BY nome");  
	while($marca = mysql_fetch_array($sql)) { ?>
	<option value="<?php echo $marca['idMontadora'] ?>"><?php echo $marca['nome'] ?></option>
	<?php } ?>
	</select>
	<input type="submit" value="Pesquisar" /> 
	</form>
	
	
<label>Se o monitor não estiver inserido, <a href="cadastra_monitor.php">faça o cadastro do item.</a></label>
</fieldset>
		
	
	
	
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscarBemPatrimonial") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['bemPatrimonial']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT monitor.*, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS empresa, montadora.idMontadora, montadora.nome AS marca
	FROM monitor
	INNER JOIN departamento ON departamento.idDepartamento=monitor.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=monitor.empresaID
	INNER JOIN montadora ON montadora.idMontadora=monitor.marcaID
	WHERE monitor.bemPatrimonial LIKE '%".$conteudoBusca."%'
	AND monitor.status=1 ORDER BY monitor.bemPatrimonial");
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Bem patrimonial</th>
	<th>Fornecedor</th>
	<th>Nota Fiscal</th>
	<th>Valor</th>
	<th>Data de aquisição</th>
	<th>Tempo de garantia</th>
	<th>Departamento</th>
	<th>Marca</th>
	<th>Modelo</th>
	</tr>
	
	<?php while ($monitor = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $monitor->bemPatrimonial;?></td>
	<td><?php echo $monitor->empresa;?></td>
	<td><?php echo $monitor->notaFiscal;?></td>
	<td><?php echo $monitor->valor;?></td>
	<td><?php echo date('d/m/Y',strtotime($monitor->dataAquisicao));?></td>
	<td><?php echo $monitor->tempoGarantia;?></td>
	<td><?php echo $monitor->departamento;?></td>
	<td><?php echo $monitor->marca;?></td>
	<td><?php echo $monitor->modelo;?></td>
	<td><a href="editaMonitor.php?idMonitor=<?php echo $monitor->idMonitor; ?>">Editar</a></td> 
	<td><a href="../sql/deletaMonitor_sql.php?idMonitor=<?php echo $monitor->idMonitor; ?>" onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "<fieldset><p id ='textoPequeno'>Nenhum monitor foi encontrado com o bem patrimonial ".$conteudoBusca.".</p><br><br><br></fieldset>"; } 
	} ?>
    </table>
	
	
	
	
	
	<?php if ($a == "buscarDepartamento") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['departamento']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT monitor.*, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS empresa, montadora.idMontadora, montadora.nome AS marca
	FROM monitor
	INNER JOIN departamento ON departamento.idDepartamento=monitor.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=monitor.empresaID
	INNER JOIN montadora ON montadora.idMontadora=monitor.marcaID
	WHERE monitor.departamentoID LIKE '%".$conteudoBusca."%'
	AND monitor.status=1 ORDER BY monitor.bemPatrimonial");   
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Bem patrimonial</th>
	<th>Fornecedor</th>
	<th>Nota Fiscal</th>
	<th>Valor</th>
	<th>Data de aquisição</th>
	<th>Tempo de garantia</th>
	<th>Departamento</th>
	<th>Marca</th>
	<th>Modelo</th>
	</tr>
	
	<?php while ($monitor = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $monitor->bemPatrimonial;?></td>
	<td><?php echo $monitor->empresa;?></td>
	<td><?php echo $monitor->notaFiscal;?></td>
	<td><?php echo $monitor->valor;?></td>
	<td><?php echo date('d/m/Y',strtotime($monitor->dataAquisicao));?></td>
	<td><?php echo $monitor->tempoGarantia;?></td>
	<td><?php echo $monitor->departamento;?></td>
	<td><?php echo $monitor->marca;?></td>
	<td><?php echo $monitor->modelo;?></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "<fieldset><p id ='textoPequeno'>Nenhum monitor foi encontrado com esta especificação.</p><br><br><br></fieldset>"; } 
	} ?>
    </table>
	
	
	
	
		<?php if ($a == "buscarMarca") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['marca']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT monitor.*, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS empresa, montadora.idMontadora, montadora.nome AS marca
	FROM monitor
	INNER JOIN departamento ON departamento.idDepartamento=monitor.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=monitor.empresaID
	INNER JOIN montadora ON montadora.idMontadora=monitor.marcaID
	WHERE monitor.marcaID LIKE '%".$conteudoBusca."%'
	AND monitor.status=1 ORDER BY monitor.bemPatrimonial");   
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Bem patrimonial</th>
	<th>Fornecedor</th>
	<th>Nota Fiscal</th>
	<th>Valor</th>
	<th>Data de aquisição</th>
	<th>Tempo de garantia</th>
	<th>Departamento</th>
	<th>Marca</th>
	<th>Modelo</th>
	</tr>
	
	<?php while ($monitor = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $monitor->bemPatrimonial;?></td>
	<td><?php echo $monitor->empresa;?></td>
	<td><?php echo $monitor->notaFiscal;?></td>
	<td><?php echo $monitor->valor;?></td>
	<td><?php echo date('d/m/Y',strtotime($monitor->dataAquisicao));?></td>
	<td><?php echo $monitor->tempoGarantia;?></td>
	<td><?php echo $monitor->departamento;?></td>
	<td><?php echo $monitor->marca;?></td>
	<td><?php echo $monitor->modelo;?></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "<fieldset><p id ='textoPequeno'>Nenhum monitor foi encontrado esta especificação.</p><br><br><br></fieldset>"; } 
	} ?>
    </table>
	
	
	
	<?php if ($numRegistros != 0) {
	?> 
	<p id = "textoPequeno">Número de monitores encontrados: <b><?php echo $numRegistros;?></b></p>
	<?php }?>
	

	
</section>

<!--rodapé-->
<footer>
<?php

?>
</footer>
</body>
</html>
