<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Manutenção externa em geral</title>
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

	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscarItem"> 
	<label>Item</label>
	<input type="text" name="item" placeholder="Digite o item para pesquisar" /> 
	<input type="submit" value="Pesquisar" /> 
	</form>
	
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscarOrdemServico"> 
	<label>Ordem de serviço</label>
	<input type="text" name="ordemServico" placeholder="Digite a ordem de serviço para pesquisar" /> 
	<input type="submit" value="Pesquisar" /> 
	</form>
	
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscarDescricao"> 
	<label>Descrição</label>
	<input type="text" name="descricao" placeholder="Digite a descrição para pesquisar" /> 
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
	
	
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscarStatusServico"> 
	<label>Status do serviço</label>
		
	<label><input type="radio" name = "statusServico" value="andamento" id = "statusServico">Em andamento</label>
	<label><input type="radio" name = "statusServico" value="finalizado" id = "statusServico">Finalizado</label>
	<input type="submit" value="Pesquisar" /> 
	</form>

	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscarStatusNotaFiscal"> 
	<label>Status nota fiscal</label>
	<label><input type="radio" name = "statusNotaFiscal" value="naoEnviada" id = "statusNotaFiscal">Não enviada</label>
	<label><input type="radio" name = "statusNotaFiscal" value="enviada" id = "statusNotaFiscal">Enviada</label>
	<input type="submit" value="Pesquisar" /> 
	</form>
	
	
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscarFornecedor"> 
	<label>Fornecedor</label>
	<select name="empresa">
	<option value="...">Selecione...</option>
	<?php 
	$sql = mysql_query("SELECT idFornecedor, fantasia FROM fornecedor WHERE status = '1' ORDER BY fantasia"); 
	while($empresa = mysql_fetch_array($sql)) { ?>
	<option value="<?php echo $empresa['idFornecedor'] ?>"><?php echo $empresa['fantasia'] ?></option>
	<?php } ?>
	</select>
	<input type="submit" value="Pesquisar" /> 
	</form>

	
<label>Se a manutenção do item não estiver no sistema, <a href="cadastra_manutencaoExternaOutros.php">registre-a</a>.</label>

</fieldset>	
	
<!-- buscar por item -->
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscarItem") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['item']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	
	$sql = mysql_query("SELECT manutencaoExternaOutros.idManutencaoExternaOutros, manutencaoExternaOutros.empresa, manutencaoExternaOutros.item, manutencaoExternaOutros.descricao, manutencaoExternaOutros.ordemServico, manutencaoExternaOutros.notaFiscal, manutencaoExternaOutros.statusNotaFiscal, manutencaoExternaOutros.valor, manutencaoExternaOutros.autorizacaoFornecimento, manutencaoExternaOutros.dataEnvio, manutencaoExternaOutros.dataChegada, manutencaoExternaOutros.tempoGarantia, manutencaoExternaOutros.statusServico, manutencaoExternaOutros.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM manutencaoExternaOutros
	INNER JOIN departamento ON departamento.idDepartamento=manutencaoExternaOutros.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=manutencaoExternaOutros.empresa
	WHERE manutencaoExternaOutros.item LIKE '%".$conteudoBusca."%' 
	AND manutencaoExternaOutros.status=1 ORDER BY manutencaoExternaOutros.item"); 
	 
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Fornecedor</th>
	<th>Departamento</th>
	<th>Item</th>
	<th>Ordem de serviço</th>
	<th>Nota Fiscal</th>
	<th>Status Nota Fiscal</th>
	<th>Valor</th>
	<th>AF</th>
	<th>Data de envio</th>
	<th>Data de chegada</th>
	<th>Tempo de garantia</th>
	<th>Status do serviço</th>
	<th>Descrição</th>
	</tr>
	
	<?php while ($manutencaoExternaOutros = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $manutencaoExternaOutros->fornecedor;?></td>
	<td><?php echo $manutencaoExternaOutros->departamento;?></td>
	<td><?php echo $manutencaoExternaOutros->item;?></td>
	<td><?php echo $manutencaoExternaOutros->ordemServico;?></td>
	<td><?php echo $manutencaoExternaOutros->notaFiscal;?></td>
	<td><?php echo $manutencaoExternaOutros->statusNotaFiscal;?></td>
	<td><?php echo $manutencaoExternaOutros->valor;?></td>
	<td><?php echo $manutencaoExternaOutros->autorizacaoFornecimento;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaOutros->dataEnvio));?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaOutros->dataChegada));?></td>
	<td><?php echo $manutencaoExternaOutros->tempoGarantia;?></td>	
	<td><?php echo $manutencaoExternaOutros->statusServico;?></td>
	<td><?php echo $manutencaoExternaOutros->descricao;?></td>		
	<td><a href="editaManutencaoExternaOutros.php?idManutencaoExternaOutros=<?php echo $manutencaoExternaOutros->idManutencaoExternaOutros; ?>">Editar</a></td> 
	<td><a href="../sql/deletaManutencaoExternaOutros_sql.php?idManutencaoExternaOutros=<?php echo $manutencaoExternaOutros->idManutencaoExternaOutros; ?> " onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "Nenhum item de manutenção externa em geral foi encontrado com a palavra ".$conteudoBusca.""; } 
	} // fim do if
	
	?> 
    </table>
	
<!-- fim da busca por item -->	


<!-- começo da busca por ordem de serviço -->	
<?php
	if ($a == "buscarOrdemServico") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['ordemServico']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	
	$sql = mysql_query("SELECT manutencaoExternaOutros.idManutencaoExternaOutros, manutencaoExternaOutros.empresa, manutencaoExternaOutros.item, manutencaoExternaOutros.descricao, manutencaoExternaOutros.ordemServico, manutencaoExternaOutros.notaFiscal, manutencaoExternaOutros.statusNotaFiscal, manutencaoExternaOutros.valor, manutencaoExternaOutros.autorizacaoFornecimento, manutencaoExternaOutros.dataEnvio, manutencaoExternaOutros.dataChegada, manutencaoExternaOutros.tempoGarantia, manutencaoExternaOutros.statusServico, manutencaoExternaOutros.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM manutencaoExternaOutros
	INNER JOIN departamento ON departamento.idDepartamento=manutencaoExternaOutros.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=manutencaoExternaOutros.empresa
	WHERE manutencaoExternaOutros.ordemServico LIKE '%".$conteudoBusca."%' 
	AND manutencaoExternaOutros.status=1 ORDER BY manutencaoExternaOutros.ordemServico"); 
	 
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Fornecedor</th>
	<th>Departamento</th>
	<th>Item</th>
	<th>Ordem de serviço</th>
	<th>Nota Fiscal</th>
	<th>Status Nota Fiscal</th>
	<th>Valor</th>
	<th>AF</th>
	<th>Data de envio</th>
	<th>Data de chegada</th>
	<th>Tempo de garantia</th>
	<th>Status do serviço</th>
	<th>Descrição</th>
	</tr>
	
	<?php while ($manutencaoExternaOutros = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $manutencaoExternaOutros->fornecedor;?></td>
	<td><?php echo $manutencaoExternaOutros->departamento;?></td>
	<td><?php echo $manutencaoExternaOutros->item;?></td>
	<td><?php echo $manutencaoExternaOutros->ordemServico;?></td>
	<td><?php echo $manutencaoExternaOutros->notaFiscal;?></td>
	<td><?php echo $manutencaoExternaOutros->statusNotaFiscal;?></td>
	<td><?php echo $manutencaoExternaOutros->valor;?></td>
	<td><?php echo $manutencaoExternaOutros->autorizacaoFornecimento;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaOutros->dataEnvio));?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaOutros->dataChegada));?></td>
	<td><?php echo $manutencaoExternaOutros->tempoGarantia;?></td>	
	<td><?php echo $manutencaoExternaOutros->statusServico;?></td>
	<td><?php echo $manutencaoExternaOutros->descricao;?></td>		
	<td><a href="editaManutencaoExternaOutros.php?idManutencaoExternaOutros=<?php echo $manutencaoExternaOutros->idManutencaoExternaOutros; ?>">Editar</a></td> 
	<td><a href="../sql/deletaManutencaoExternaOutros_sql.php?idManutencaoExternaOutros=<?php echo $manutencaoExternaOutros->idManutencaoExternaOutros; ?> " onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "Nenhum item de manutenção externa em geral foi encontrado com a palavra ".$conteudoBusca.""; } 
	} // fim do if
	
	?> 
    </table>
	
<!-- fim da busca por item -->	





<!-- buscar por descrição -->
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscarDescricao") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['descricao']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	
	$sql = mysql_query("SELECT manutencaoExternaOutros.idManutencaoExternaOutros, manutencaoExternaOutros.empresa, manutencaoExternaOutros.item, manutencaoExternaOutros.descricao, manutencaoExternaOutros.ordemServico, manutencaoExternaOutros.notaFiscal, manutencaoExternaOutros.statusNotaFiscal, manutencaoExternaOutros.valor, manutencaoExternaOutros.autorizacaoFornecimento, manutencaoExternaOutros.dataEnvio, manutencaoExternaOutros.dataChegada, manutencaoExternaOutros.tempoGarantia, manutencaoExternaOutros.statusServico, manutencaoExternaOutros.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM manutencaoExternaOutros
	INNER JOIN departamento ON departamento.idDepartamento=manutencaoExternaOutros.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=manutencaoExternaOutros.empresa
	WHERE manutencaoExternaOutros.descricao LIKE '%".$conteudoBusca."%' 
	AND manutencaoExternaOutros.status=1 ORDER BY manutencaoExternaOutros.descricao"); 
	
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Fornecedor</th>
	<th>Departamento</th>
	<th>Item</th>
	<th>Ordem de serviço</th>
	<th>Nota Fiscal</th>
	<th>Status Nota Fiscal</th>
	<th>Valor</th>
	<th>AF</th>
	<th>Data de envio</th>
	<th>Data de chegada</th>
	<th>Tempo de garantia</th>
	<th>Status do serviço</th>
	<th>Descrição</th>
	</tr>
	
	<?php while ($manutencaoExternaOutros = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $manutencaoExternaOutros->fornecedor;?></td>
	<td><?php echo $manutencaoExternaOutros->departamento;?></td>
	<td><?php echo $manutencaoExternaOutros->item;?></td>
	<td><?php echo $manutencaoExternaOutros->ordemServico;?></td>
	<td><?php echo $manutencaoExternaOutros->notaFiscal;?></td>
	<td><?php echo $manutencaoExternaOutros->statusNotaFiscal;?></td>
	<td><?php echo $manutencaoExternaOutros->valor;?></td>
	<td><?php echo $manutencaoExternaOutros->autorizacaoFornecimento;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaOutros->dataEnvio));?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaOutros->dataChegada));?></td>
	<td><?php echo $manutencaoExternaOutros->tempoGarantia;?></td>	
	<td><?php echo $manutencaoExternaOutros->statusServico;?></td>
	<td><?php echo $manutencaoExternaOutros->descricao;?></td>		
	<td><a href="editaManutencaoExternaOutros.php?idManutencaoExternaOutros=<?php echo $manutencaoExternaOutros->idManutencaoExternaOutros; ?>">Editar</a></td> 
	<td><a href="../sql/deleta_manutencaoExternaOutros_sql.php?idManutencaoExternaOutros=<?php echo $manutencaoExternaOutros->idManutencaoExternaOutros; ?> " onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "Nenhum item de manutenção externa em geral foi encontrado com a palavra ".$conteudoBusca.""; } 
	} // fim do if
	
	?> 
    </table>
	
<!-- fim da busca por descrição -->	







<!-- buscar por fornecedor -->
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscarFornecedor") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['empresa']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	
	$sql = mysql_query("SELECT manutencaoExternaOutros.idManutencaoExternaOutros, manutencaoExternaOutros.empresa, manutencaoExternaOutros.item, manutencaoExternaOutros.descricao, manutencaoExternaOutros.ordemServico, manutencaoExternaOutros.notaFiscal, manutencaoExternaOutros.statusNotaFiscal, manutencaoExternaOutros.valor, manutencaoExternaOutros.autorizacaoFornecimento, manutencaoExternaOutros.dataEnvio, manutencaoExternaOutros.dataChegada, manutencaoExternaOutros.tempoGarantia, manutencaoExternaOutros.statusServico, manutencaoExternaOutros.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM manutencaoExternaOutros
	INNER JOIN departamento ON departamento.idDepartamento=manutencaoExternaOutros.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=manutencaoExternaOutros.empresa 
	WHERE manutencaoExternaOutros.empresa LIKE '%".$conteudoBusca."%' 
	AND manutencaoExternaOutros.status=1 ORDER BY fornecedor.fantasia"); 
		
	echo $conteudoBusca;
	
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Fornecedor</th>
	<th>Departamento</th>
	<th>Item</th>
	<th>Ordem de serviço</th>
	<th>Nota Fiscal</th>
	<th>Status Nota Fiscal</th>
	<th>Valor</th>
	<th>AF</th>
	<th>Data de envio</th>
	<th>Data de chegada</th>
	<th>Tempo de garantia</th>
	<th>Status do serviço</th>
	<th>Descrição</th>
	</tr>
	
	<?php while ($manutencaoExternaOutros = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $manutencaoExternaOutros->fornecedor;?></td>
	<td><?php echo $manutencaoExternaOutros->departamento;?></td>
	<td><?php echo $manutencaoExternaOutros->item;?></td>
	<td><?php echo $manutencaoExternaOutros->ordemServico;?></td>
	<td><?php echo $manutencaoExternaOutros->notaFiscal;?></td>
	<td><?php echo $manutencaoExternaOutros->statusNotaFiscal;?></td>
	<td><?php echo $manutencaoExternaOutros->valor;?></td>
	<td><?php echo $manutencaoExternaOutros->autorizacaoFornecimento;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaOutros->dataEnvio));?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaOutros->dataChegada));?></td>
	<td><?php echo $manutencaoExternaOutros->tempoGarantia;?></td>	
	<td><?php echo $manutencaoExternaOutros->statusServico;?></td>
	<td><?php echo $manutencaoExternaOutros->descricao;?></td>		
	<td><a href="editaManutencaoExternaOutros.php?idManutencaoExternaOutros=<?php echo $manutencaoExternaOutros->idManutencaoExternaOutros; ?>">Editar</a></td> 
	<td><a href="../sql/deleta_manutencaoExternaOutros_sql.php?idManutencaoExternaOutros=<?php echo $manutencaoExternaOutros->idManutencaoExternaOutros; ?> " onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	

	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "Nenhum item de manutenção externa em geral foi encontrado com este fornecedor."; } 
	} // fim do if
	
	?> 
    </table>
	
<!-- fim da busca por fornecedor -->	




<!-- buscar por status da nota fiscal -->
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscarStatusNotaFiscal") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['statusNotaFiscal']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	
	$sql = mysql_query("SELECT manutencaoExternaOutros.idManutencaoExternaOutros, manutencaoExternaOutros.empresa, manutencaoExternaOutros.item, manutencaoExternaOutros.descricao, manutencaoExternaOutros.ordemServico, manutencaoExternaOutros.notaFiscal, manutencaoExternaOutros.statusNotaFiscal, manutencaoExternaOutros.valor, manutencaoExternaOutros.autorizacaoFornecimento, manutencaoExternaOutros.dataEnvio, manutencaoExternaOutros.dataChegada, manutencaoExternaOutros.tempoGarantia, manutencaoExternaOutros.statusServico, manutencaoExternaOutros.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM manutencaoExternaOutros
	INNER JOIN departamento ON departamento.idDepartamento=manutencaoExternaOutros.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=manutencaoExternaOutros.empresa
	WHERE manutencaoExternaOutros.statusNotaFiscal LIKE '%".$conteudoBusca."%' 
	AND manutencaoExternaOutros.status=1 ORDER BY manutencaoExternaOutros.statusNotaFiscal"); 
	
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Fornecedor</th>
	<th>Departamento</th>
	<th>Item</th>
	<th>Ordem de serviço</th>
	<th>Nota Fiscal</th>
	<th>Status Nota Fiscal</th>
	<th>Valor</th>
	<th>AF</th>
	<th>Data de envio</th>
	<th>Data de chegada</th>
	<th>Tempo de garantia</th>
	<th>Status do serviço</th>
	<th>Descrição</th>
	</tr>
	
	<?php while ($manutencaoExternaOutros = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $manutencaoExternaOutros->fornecedor;?></td>
	<td><?php echo $manutencaoExternaOutros->departamento;?></td>
	<td><?php echo $manutencaoExternaOutros->item;?></td>
	<td><?php echo $manutencaoExternaOutros->ordemServico;?></td>
	<td><?php echo $manutencaoExternaOutros->notaFiscal;?></td>
	<td><?php echo $manutencaoExternaOutros->statusNotaFiscal;?></td>
	<td><?php echo $manutencaoExternaOutros->valor;?></td>
	<td><?php echo $manutencaoExternaOutros->autorizacaoFornecimento;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaOutros->dataEnvio));?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaOutros->dataChegada));?></td>
	<td><?php echo $manutencaoExternaOutros->tempoGarantia;?></td>	
	<td><?php echo $manutencaoExternaOutros->statusServico;?></td>
	<td><?php echo $manutencaoExternaOutros->descricao;?></td>		
	<td><a href="editaManutencaoExternaOutros.php?idManutencaoExternaOutros=<?php echo $manutencaoExternaOutros->idManutencaoExternaOutros; ?>">Editar</a></td> 
	<td><a href="../sql/deleta_manutencaoExternaOutros_sql.php?idManutencaoExternaOutros=<?php echo $manutencaoExternaOutros->idManutencaoExternaOutros; ?> " onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "Nenhum item de manutenção externa em geral foi encontrado com a palavra ".$conteudoBusca.""; } 
	} // fim do if
	
	?> 
    </table>
	
<!-- fim da busca por status nota fiscal -->	


<!-- buscar por status do serviço -->
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscarStatusServico") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['statusServico']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	
	$sql = mysql_query("SELECT manutencaoExternaOutros.idManutencaoExternaOutros, manutencaoExternaOutros.empresa, manutencaoExternaOutros.item, manutencaoExternaOutros.descricao, manutencaoExternaOutros.ordemServico, manutencaoExternaOutros.notaFiscal, manutencaoExternaOutros.statusNotaFiscal, manutencaoExternaOutros.valor, manutencaoExternaOutros.autorizacaoFornecimento, manutencaoExternaOutros.dataEnvio, manutencaoExternaOutros.dataChegada, manutencaoExternaOutros.tempoGarantia, manutencaoExternaOutros.statusServico, manutencaoExternaOutros.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM manutencaoExternaOutros
	INNER JOIN departamento ON departamento.idDepartamento=manutencaoExternaOutros.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=manutencaoExternaOutros.empresa
	WHERE manutencaoExternaOutros.statusServico LIKE '%".$conteudoBusca."%' 
	AND manutencaoExternaOutros.status=1 ORDER BY manutencaoExternaOutros.statusServico");
	
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Fornecedor</th>
	<th>Departamento</th>
	<th>Item</th>
	<th>Ordem de serviço</th>
	<th>Nota Fiscal</th>
	<th>Status Nota Fiscal</th>
	<th>Valor</th>
	<th>AF</th>
	<th>Data de envio</th>
	<th>Data de chegada</th>
	<th>Tempo de garantia</th>
	<th>Status do serviço</th>
	<th>Descrição</th>
	</tr>
	
	<?php while ($manutencaoExternaOutros = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $manutencaoExternaOutros->fornecedor;?></td>
	<td><?php echo $manutencaoExternaOutros->departamento;?></td>
	<td><?php echo $manutencaoExternaOutros->item;?></td>
	<td><?php echo $manutencaoExternaOutros->ordemServico;?></td>
	<td><?php echo $manutencaoExternaOutros->notaFiscal;?></td>
	<td><?php echo $manutencaoExternaOutros->statusNotaFiscal;?></td>
	<td><?php echo $manutencaoExternaOutros->valor;?></td>
	<td><?php echo $manutencaoExternaOutros->autorizacaoFornecimento;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaOutros->dataEnvio));?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaOutros->dataChegada));?></td>
	<td><?php echo $manutencaoExternaOutros->tempoGarantia;?></td>	
	<td><?php echo $manutencaoExternaOutros->statusServico;?></td>
	<td><?php echo $manutencaoExternaOutros->descricao;?></td>		
	<td><a href="editaManutencaoExternaOutros.php?idManutencaoExternaOutros=<?php echo $manutencaoExternaOutros->idManutencaoExternaOutros; ?>">Editar</a></td> 
	<td><a href="../sql/deleta_manutencaoExternaOutros_sql.php?idManutencaoExternaOutros=<?php echo $manutencaoExternaOutros->idManutencaoExternaOutros; ?> " onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "Nenhum item de manutenção externa em geral foi encontrado com a palavra ".$conteudoBusca.""; } 
	} // fim do if
	
	?> 
    </table>
	
<!-- fim da busca por status do serviço -->	



	

	
</section>

<!--rodapé-->
<footer>
<?php

?>
</footer>
</body>
</html>
