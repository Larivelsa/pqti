<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Gerenciamento de impressora</title>
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

<fieldset id="pesquisa">
	<legend>Escolha um dos termos para pesquisar impressora</legend>
	<label>Bem Patrimonial</label>
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscarBemPatrimonial"> 
	<input type="text" name="bemPatrimonial"/> 
	<input type="submit" value="Buscar" /> 
	</form>
	
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscarDepartamento"> 
	<label>Departamento</label>
	<select name="departamento">
	<option value="85">Selecione...</option>
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
		<option value="Bematech">Bematech</option>
		<option value="Brother">Brother</option>
		<option value="Canon">Canon</option>
		<option value="Chronos">Chronos</option>
		<option value="CIS">CIS</option>
		<option value="Daruma">Daruma</option>
		<option value="Dymo">Dymo</option>
		<option value="Elgin">Elgin</option>
		<option value="Epson">Epson</option>
		<option value="HP">HP</option>
		<option value="Lexmark">Lexmark</option>
		<option value="Mecaf">Mecaf</option>
		<option value="Okidata">Okidata</option>
		<option value="Olivetti">Olivetti</option>
		<option value="Pertocheck">Pertocheck</option>
		<option value="Ricoh">Ricoh</option>
		<option value="Samsung">Samsung</option>
		<option value="Sharp">Sharp</option>
		<option value="Sweda">Sweda</option>
		<option value="Toshiba">Toshiba</option>
		<option value="Xerox">Xerox</option>
		<option value="Zebra">Zebra</option>
		<option value="Não especificada">Não especificada</option>
	<input type="submit" value="Pesquisar" /> 
	</form>

	<label>Se a impressora não estiver inserida, <a href="cadastra_impressora.php">faça o cadastro do item.</a></label>
</fieldset>		
	
	
	<!-- busca por bem patrimonial-->
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscarBemPatrimonial") {
	
	$conteudoBusca = trim($_POST['bemPatrimonial']);   
	
	$sql = mysql_query
	("SELECT impressora.idImpressora, impressora.bemPatrimonial, impressora.empresa, impressora.notaFiscal, impressora.valor, impressora.dataAquisicao, impressora.tempoGarantia, impressora.departamentoID, impressora.marca, impressora.modelo, impressora.tipo, impressora.conectividade, impressora.voltagem, idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM impressora
	INNER JOIN departamento ON departamento.idDepartamento=impressora.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=impressora.empresa
	WHERE impressora.bemPatrimonial LIKE '%".$conteudoBusca."%' 
	AND impressora.status=1 ORDER BY impressora.bemPatrimonial");    
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
		<tr>
	<th>Bem patrimonial</th>
	<th>Departamento</th>	
	<th>Fornecedor</th>
	<th>Nota Fiscal</th>
	<th>Valor</th>	
	<th>Data de compra</th>	
	<th>Garantia (em meses)</th>
	<th>Marca</th>
	<th>Modelo</th>	
	<th>Tipo</th>
	<th>Conectividade</th>	
	<th>Voltagem</th>		
	</tr><br><br>
	
	<?php while ($impressoras = mysql_fetch_object($sql)) {	
	?>
	<tr>
	<td><?php echo $impressoras->bemPatrimonial;?></td>	
	<td><?php echo $impressoras->departamento;?></td>	
	<td><?php echo $impressoras->fornecedor;?></td>
	<td><?php echo $impressoras->notaFiscal;?></td>	
	<td><?php echo $impressoras->valor;?></td>	
	<td><?php echo date('d/m/Y',strtotime($impressoras->dataAquisicao));?></td>	
	<td><?php echo $impressoras->tempoGarantia;?></td>	
    <td><?php echo $impressoras->marca;?></td>	
	<td><?php echo $impressoras->modelo;?></td>
	<td><?php echo $impressoras->tipo;?></td>
	<td><?php echo $impressoras->conectividade;?></td> 
	<td><?php echo $impressoras->voltagem;?></td> 
	<td><a href="manutencaoImpressora.php?p=<?php echo $impressoras->bemPatrimonial; ?>">+histórico</a></td>
	<td><a href="editaImpressora.php?idImpressora=<?php echo $impressoras->idImpressora; ?>">Editar</a></td> 
	<td><a href="../sql/deletaImpressora_sql.php?idImpressora=<?php echo $impressoras->idImpressora; ?>" onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "Nenhum modelo de impressora foi encontrado com o bem patrimonial ".$conteudoBusca.""; } 
	} // fim do if
	
	?> 
    </table>
<!-- fim da busca por bem patrimonial-->	


<!-- busca por departamento-->

<?php
	$a = $_GET['a'];
	
	if ($a == "buscarDepartamento") {
	
	$conteudoBusca = trim($_POST['departamento']);   
	
	$sql = mysql_query
	("SELECT impressora.idImpressora, impressora.bemPatrimonial, impressora.empresa, impressora.notaFiscal, impressora.valor, impressora.dataAquisicao, impressora.tempoGarantia, impressora.departamentoID, impressora.marca, impressora.modelo, impressora.tipo, impressora.conectividade, impressora.voltagem, idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM impressora
	INNER JOIN departamento ON departamento.idDepartamento=impressora.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=impressora.empresa
	WHERE impressora.departamentoID LIKE '%".$conteudoBusca."%' 
	AND impressora.status=1 ORDER BY impressora.bemPatrimonial");    
	
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
	<th>Data de compra</th>	
	<th>Garantia (em meses)</th>
	<th>Departamento</th>	
	<th>Marca</th>
	<th>Modelo</th>	
	<th>Tipo</th>
	<th>Conectividade</th>	
	<th>Voltagem</th>		
	</tr><br><br>
	
	<?php while ($impressoras = mysql_fetch_object($sql)) {	
	?>
	<tr>
	<td><?php echo $impressoras->bemPatrimonial;?></td>	
	<td><?php echo $impressoras->fornecedor;?></td>
	<td><?php echo $impressoras->notaFiscal;?></td>	
	<td><?php echo $impressoras->valor;?></td>	
	<td><?php echo date('d/m/Y',strtotime($impressoras->dataAquisicao));?></td>	
	<td><?php echo $impressoras->tempoGarantia;?></td>	
	<td><?php echo $impressoras->departamento;?></td>	
    <td><?php echo $impressoras->marca;?></td>	
	<td><?php echo $impressoras->modelo;?></td>
	<td><?php echo $impressoras->tipo;?></td>
	<td><?php echo $impressoras->conectividade;?></td> 
	<td><?php echo $impressoras->voltagem;?></td> 
	<td><a href="editaImpressora.php?idImpressora=<?php echo $impressoras->idImpressora; ?>">Editar</a></td> 
	<td><a href="../sql/deletaImpressora_sql.php?idImpressora=<?php echo $impressoras->idImpressora; ?>" onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "Nenhum modelo de impressora foi encontrado com esta especificação"; } 
	} // fim do if
	
	?> 
    </table>


<!-- fim da busca por departamento-->	
	
	
<!-- busca por marca-->

<?php
	$a = $_GET['a'];
	
	if ($a == "buscarMarca") {
	
	$conteudoBusca = trim($_POST['marca']);   
	
	$sql = mysql_query
	("SELECT impressora.idImpressora, impressora.bemPatrimonial, impressora.empresa, impressora.notaFiscal, impressora.valor, impressora.dataAquisicao, impressora.tempoGarantia, impressora.departamentoID, impressora.marca, impressora.modelo, impressora.tipo, impressora.conectividade, impressora.voltagem, idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM impressora
	INNER JOIN departamento ON departamento.idDepartamento=impressora.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=impressora.empresa
	WHERE impressora.marca LIKE '%".$conteudoBusca."%' 
	AND impressora.status=1 ORDER BY impressora.bemPatrimonial");    
	
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
	<th>Data de compra</th>	
	<th>Garantia (em meses)</th>
	<th>Departamento</th>	
	<th>Marca</th>
	<th>Modelo</th>	
	<th>Tipo</th>
	<th>Conectividade</th>	
	<th>Voltagem</th>		
	</tr><br><br>
	
	<?php while ($impressoras = mysql_fetch_object($sql)) {	
	?>
	<tr>
	<td><?php echo $impressoras->bemPatrimonial;?></td>	
	<td><?php echo $impressoras->fornecedor;?></td>
	<td><?php echo $impressoras->notaFiscal;?></td>	
	<td><?php echo $impressoras->valor;?></td>	
	<td><?php echo date('d/m/Y',strtotime($impressoras->dataAquisicao));?></td>	
	<td><?php echo $impressoras->tempoGarantia;?></td>	
	<td><?php echo $impressoras->departamento;?></td>	
    <td><?php echo $impressoras->marca;?></td>	
	<td><?php echo $impressoras->modelo;?></td>
	<td><?php echo $impressoras->tipo;?></td>
	<td><?php echo $impressoras->conectividade;?></td> 
	<td><?php echo $impressoras->voltagem;?></td> 
	<td><a href="editaImpressora.php?idImpressora=<?php echo $impressoras->idImpressora; ?>">Editar</a></td> 
	<td><a href="../sql/deletaImpressora_sql.php?idImpressora=<?php echo $impressoras->idImpressora; ?>" onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "Nenhum modelo de impressora foi encontrado com esta especificação"; } 
	} // fim do if
	
	?> 
    </table>


<!-- fim da busca por marca-->	
	
	
	
	
	
	
	
	
	
	
	
	</section>

<!--rodapé-->
<footer>
<?php

?>
</footer>
</body>
</html>
