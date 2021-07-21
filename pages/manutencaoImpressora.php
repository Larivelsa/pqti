<?php
$media=0;
$total=0;
$numRegistros=0;
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Manutenção de externa de impressora</title>
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



<fieldset id="pesquisa">
	<legend>Registrar manutenção externa em impressoras</legend>
<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscarBemPatrimonial"> 

	<label>Bem Patrimonial</label>
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
	
	
	<label>Se a manutenção de impressora não estiver no sistema, <a href="cadastra_manutencaoImpressora.php">registre a manutenção de impressora.</a></label>
	
</fieldset>	







<!-- busca através de histórico -->

<?php
	$p = $_GET["p"];
	
	if (isset($p)){
	 
	
	$sql = mysql_query
	("SELECT manutencaoImpressora.idManutencaoImpressora, impressora.marca, impressora.modelo, manutencaoImpressora.empresa, manutencaoImpressora.item, manutencaoImpressora.ordemServico, manutencaoImpressora.notaFiscal, manutencaoImpressora.statusNotaFiscal, manutencaoImpressora.valor,
	manutencaoImpressora.autorizacaoFornecimento, manutencaoImpressora.dataEnvio, manutencaoImpressora.dataChegada, manutencaoImpressora.tempoGarantia, manutencaoImpressora.statusServico, manutencaoImpressora.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM manutencaoImpressora
	INNER JOIN impressora ON impressora.bemPatrimonial=manutencaoImpressora.item
	INNER JOIN departamento ON departamento.idDepartamento=impressora.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=manutencaoImpressora.empresa
	WHERE manutencaoImpressora.item LIKE '%".$p."%' 
	AND manutencaoImpressora.status=1 ORDER BY impressora.marca"); 
	
	$numRegistros = mysql_num_rows($sql); 
	
	if ($numRegistros != 0) {
	?>

	
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Fornecedor</th>
	<th>Bem Patrimonial</th>
	<th>Marca</th>
	<th>Modelo</th>
	<th>Departamento</th>
	<th>Ordem de serviço</th>
	<th>Nota Fiscal</th>
	<th>Status Nota Fiscal</th>
	<th>Valor</th>
	<th>AF</th>
	<th>Data de envio</th>
	<th>Data de chegada</th>
	<th>Tempo de garantia</th>
	<th>Status do serviço</th>
	<th>Descrição do serviço</th>
	</tr>
	
	<?php while ($manutencaoExternaImpressora = mysql_fetch_object($sql)) {	
	$total=$total+$manutencaoExternaImpressora->valor;
	
	?>

	
	<tr>
	<td><?php echo $manutencaoExternaImpressora->fornecedor;?></td>
	<td><?php echo $manutencaoExternaImpressora->item;?></td>
	<td><?php echo $manutencaoExternaImpressora->marca;?></td>
	<td><?php echo $manutencaoExternaImpressora->modelo;?></td>
	<td><?php echo $manutencaoExternaImpressora->departamento;?></td>
	<td><?php echo $manutencaoExternaImpressora->ordemServico;?></td>
	<td><?php echo $manutencaoExternaImpressora->notaFiscal;?></td>
	<td><?php echo $manutencaoExternaImpressora->statusNotaFiscal;?></td>
	<td><?php echo $manutencaoExternaImpressora->valor;?></td>
	<td><?php echo $manutencaoExternaImpressora->autorizacaoFornecimento;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaImpressora->dataEnvio));?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaImpressora->dataChegada));?></td>
	<td><?php echo $manutencaoExternaImpressora->tempoGarantia;?></td>	
	<td><?php echo $manutencaoExternaImpressora->statusServico;?></td>
	<td><?php echo $manutencaoExternaImpressora->descricao;?></td>
	<td><a href="editarManutencaoImpressora.php?idManutencaoImpressora=<?php echo $manutencaoExternaImpressora->idManutencaoImpressora; ?>">Editar</a></td> 
	<td><a href="../sql/deleta_manutencaoImpressora_sql.php?idManutencaoImpressora=<?php echo $manutencaoExternaImpressora->idManutencaoImpressora; ?> " onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	<?php
	
	}}
	$p=null;
	?>
	</table>

	<?php 	
	if ($numRegistros > 0){
	$media=$total / $numRegistros;
	echo "<fieldset><p id = 'textoPequeno'>Número de manutenções deste item: <b>$numRegistros</b></p>
	<p id = 'textoPequeno'>Valor investido em manutenções deste item: <b>R$ $total</b></p>
	<p id = 'textoPequeno'>Valor médio das manutenções deste item: <b>R$ $media</b></p>
	<br><br><br></fieldset>"; }}?>
	<!-- fim da busca através histórico-->





	
	<!-- busca por bem patrimonial-->
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscarBemPatrimonial") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['bemPatrimonial']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT manutencaoImpressora.idManutencaoImpressora, impressora.marca, impressora.modelo, manutencaoImpressora.empresa, manutencaoImpressora.item, manutencaoImpressora.ordemServico, manutencaoImpressora.notaFiscal, manutencaoImpressora.statusNotaFiscal, manutencaoImpressora.valor,
	manutencaoImpressora.autorizacaoFornecimento, manutencaoImpressora.dataEnvio, manutencaoImpressora.dataChegada, manutencaoImpressora.tempoGarantia, manutencaoImpressora.statusServico, manutencaoImpressora.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM manutencaoImpressora
	INNER JOIN impressora ON impressora.bemPatrimonial=manutencaoImpressora.item
	INNER JOIN departamento ON departamento.idDepartamento=impressora.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=manutencaoImpressora.empresa
	WHERE manutencaoImpressora.item LIKE '%".$conteudoBusca."%' 
	AND manutencaoImpressora.status=1 ORDER BY impressora.marca");   
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Fornecedor</th>
	<th>Bem Patrimonial</th>
	<th>Marca</th>
	<th>Modelo</th>
	<th>Departamento</th>
	<th>Ordem de serviço</th>
	<th>Nota Fiscal</th>
	<th>Status Nota Fiscal</th>
	<th>Valor</th>
	<th>AF</th>
	<th>Data de envio</th>
	<th>Data de chegada</th>
	<th>Tempo de garantia</th>
	<th>Status do serviço</th>
	<th>Descrição do serviço</th>
	</tr>
	
	<?php while ($manutencaoExternaImpressora = mysql_fetch_object($sql)) {	
	$total=$total+$manutencaoExternaImpressora->valor;
	
	?>

	
	<tr>
	<td><?php echo $manutencaoExternaImpressora->fornecedor;?></td>
	<td><?php echo $manutencaoExternaImpressora->item;?></td>
	<td><?php echo $manutencaoExternaImpressora->marca;?></td>
	<td><?php echo $manutencaoExternaImpressora->modelo;?></td>
	<td><?php echo $manutencaoExternaImpressora->departamento;?></td>
	<td><?php echo $manutencaoExternaImpressora->ordemServico;?></td>
	<td><?php echo $manutencaoExternaImpressora->notaFiscal;?></td>
	<td><?php echo $manutencaoExternaImpressora->statusNotaFiscal;?></td>
	<td><?php echo $manutencaoExternaImpressora->valor;?></td>
	<td><?php echo $manutencaoExternaImpressora->autorizacaoFornecimento;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaImpressora->dataEnvio));?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaImpressora->dataChegada));?></td>
	<td><?php echo $manutencaoExternaImpressora->tempoGarantia;?></td>	
	<td><?php echo $manutencaoExternaImpressora->statusServico;?></td>
	<td><?php echo $manutencaoExternaImpressora->descricao;?></td>
	<td><a href="editaManutencaoImpressora.php?idManutencaoImpressora=<?php echo $manutencaoExternaImpressora->idManutencaoImpressora; ?>">Editar</a></td> 
	<td><a href="../sql/deleta_manutencaoImpressora_sql.php?idManutencaoImpressora=<?php echo $manutencaoExternaImpressora->idManutencaoImpressora; ?> " onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	<?php
	
	}}
	$p=null;
	?>
	</table>

	<?php 	
	if ($numRegistros > 0){
	$media=$total / $numRegistros;
	echo "<fieldset><p id = 'textoPequeno'>Número de manutenções do(s) item(ns): <b>$numRegistros</b></p>
	<p id = 'textoPequeno'>Valor investido em manutenções do(s) item(ns): <b>R$ $total</b></p>
	<p id = 'textoPequeno'>Valor médio das manutenções do(s) item(ns): <b>R$ $media</b></p>
	<br><br><br></fieldset>"; }}?>
	<!-- fim da busca por bem patrimonial-->
	
	
	
	
	<!-- começo da busca por departamento-->
		<?php
	$a = $_GET['a'];
	
	if ($a == "buscarDepartamento") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['departamento']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT manutencaoImpressora.idManutencaoImpressora, impressora.marca, impressora.modelo, manutencaoImpressora.empresa, manutencaoImpressora.item, manutencaoImpressora.ordemServico, manutencaoImpressora.notaFiscal, manutencaoImpressora.statusNotaFiscal, manutencaoImpressora.valor,
	manutencaoImpressora.autorizacaoFornecimento, manutencaoImpressora.dataEnvio, manutencaoImpressora.dataChegada, manutencaoImpressora.tempoGarantia, manutencaoImpressora.statusServico, manutencaoImpressora.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM manutencaoImpressora
	INNER JOIN impressora ON impressora.bemPatrimonial=manutencaoImpressora.item
	INNER JOIN departamento ON departamento.idDepartamento=impressora.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=manutencaoImpressora.empresa
	WHERE impressora.departamentoID	LIKE '%".$conteudoBusca."%' 
	AND manutencaoImpressora.status=1 ORDER BY impressora.marca");    
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Fornecedor</th>
	<th>Bem Patrimonial</th>
	<th>Marca</th>
	<th>Modelo</th>
	<th>Departamento</th>
	<th>Ordem de serviço</th>
	<th>Nota Fiscal</th>
	<th>Status Nota Fiscal</th>
	<th>Valor</th>
	<th>AF</th>
	<th>Data de envio</th>
	<th>Data de chegada</th>
	<th>Tempo de garantia</th>
	<th>Status do serviço</th>
	<th>Descrição do serviço</th>
	</tr>
	
		<?php while ($manutencaoExternaImpressora = mysql_fetch_object($sql)) {	
	$total=$total+$manutencaoExternaImpressora->valor;
	
	?>

	
	<tr>
	<td><?php echo $manutencaoExternaImpressora->fornecedor;?></td>
	<td><?php echo $manutencaoExternaImpressora->item;?></td>
	<td><?php echo $manutencaoExternaImpressora->marca;?></td>
	<td><?php echo $manutencaoExternaImpressora->modelo;?></td>
	<td><?php echo $dep=$manutencaoExternaImpressora->departamento;?></td>
	<td><?php echo $manutencaoExternaImpressora->ordemServico;?></td>
	<td><?php echo $manutencaoExternaImpressora->notaFiscal;?></td>
	<td><?php echo $manutencaoExternaImpressora->statusNotaFiscal;?></td>
	<td><?php echo $manutencaoExternaImpressora->valor;?></td>
	<td><?php echo $manutencaoExternaImpressora->autorizacaoFornecimento;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaImpressora->dataEnvio));?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaImpressora->dataChegada));?></td>
	<td><?php echo $manutencaoExternaImpressora->tempoGarantia;?></td>	
	<td><?php echo $manutencaoExternaImpressora->statusServico;?></td>
	<td><?php echo $manutencaoExternaImpressora->descricao;?></td>
	<td><a href="editaManutencaoImpressora.php?idManutencaoImpressora=<?php echo $manutencaoExternaImpressora->idManutencaoImpressora; ?>">Editar</a></td> 
	<td><a href="../sql/deleta_manutencaoImpressora_sql.php?idManutencaoImpressora=<?php echo $manutencaoExternaImpressora->idManutencaoImpressora; ?> " onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	<?php
	
	}}
	$p=null;
	?>
	</table>

	<?php 	
	if ($numRegistros > 0){
	$media=$total / $numRegistros;
	echo "<fieldset><p id = 'textoPequeno'>Número de manutenções do departamento $dep: <b>$numRegistros</b></p>
	<p id = 'textoPequeno'>Valor investido em manutenções do departamento $dep: <b>R$ $total</b></p>
	<p id = 'textoPequeno'>Valor médio das manutenções do departamento $dep: <b>R$ $media</b></p>
	<br><br><br></fieldset>"; }}?>
	<!-- fim da busca por departamento-->
	
	
	
	
	
	<!-- começo da busca por status do serviço-->
		<?php
	$a = $_GET['a'];
	
	if ($a == "buscarStatusServico") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['statusServico']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT manutencaoImpressora.idManutencaoImpressora, impressora.marca, impressora.modelo, manutencaoImpressora.empresa, manutencaoImpressora.item, manutencaoImpressora.ordemServico, manutencaoImpressora.notaFiscal, manutencaoImpressora.statusNotaFiscal, manutencaoImpressora.valor,
	manutencaoImpressora.autorizacaoFornecimento, manutencaoImpressora.dataEnvio, manutencaoImpressora.dataChegada, manutencaoImpressora.tempoGarantia, manutencaoImpressora.statusServico, manutencaoImpressora.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM manutencaoImpressora
	INNER JOIN impressora ON impressora.bemPatrimonial=manutencaoImpressora.item
	INNER JOIN departamento ON departamento.idDepartamento=impressora.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=manutencaoImpressora.empresa
	WHERE manutencaoImpressora.statusServico LIKE '%".$conteudoBusca."%' 
	AND manutencaoImpressora.status=1 ORDER BY impressora.marca");  
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Fornecedor</th>
	<th>Bem Patrimonial</th>
	<th>Marca</th>
	<th>Modelo</th>
	<th>Departamento</th>
	<th>Ordem de serviço</th>
	<th>Nota Fiscal</th>
	<th>Status Nota Fiscal</th>
	<th>Valor</th>
	<th>AF</th>
	<th>Data de envio</th>
	<th>Data de chegada</th>
	<th>Tempo de garantia</th>
	<th>Status do serviço</th>
	<th>Descrição do serviço</th>
	</tr>
	
	<?php while ($manutencaoExternaImpressora = mysql_fetch_object($sql)) {	
	$total=$total+$manutencaoExternaImpressora->valor;
	?>
	
	<tr>
	<td><?php echo $manutencaoExternaImpressora->fornecedor;?></td>
	<td><?php echo $manutencaoExternaImpressora->item;?></td>
	<td><?php echo $manutencaoExternaImpressora->marca;?></td>
	<td><?php echo $manutencaoExternaImpressora->modelo;?></td>
	<td><?php echo $manutencaoExternaImpressora->departamento;?></td>
	<td><?php echo $manutencaoExternaImpressora->ordemServico;?></td>
	<td><?php echo $manutencaoExternaImpressora->notaFiscal;?></td>
	<td><?php echo $manutencaoExternaImpressora->statusNotaFiscal;?></td>
	<td><?php echo $manutencaoExternaImpressora->valor;?></td>
	<td><?php echo $manutencaoExternaImpressora->autorizacaoFornecimento;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaImpressora->dataEnvio));?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaImpressora->dataChegada));?></td>
	<td><?php echo $manutencaoExternaImpressora->tempoGarantia;?></td>	
	<td><?php echo $manutencaoExternaImpressora->statusServico;?></td>
	<td><?php echo $manutencaoExternaImpressora->descricao;?></td>
	<td><a href="editaManutencaoImpressora.php?idManutencaoImpressora=<?php echo $manutencaoExternaImpressora->idManutencaoImpressora; ?>">Editar</a></td> 
	<td><a href="../sql/deleta_manutencaoImpressora_sql.php?idManutencaoImpressora=<?php echo $manutencaoExternaImpressora->idManutencaoImpressora; ?> " onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	<?php
	
	}}
	$p=null;
	?>
	</table>

	<?php }?>
	<!-- fim da busca por status serviço-->
	
	
	
	
	<!-- começo da busca por status do nota fiscal-->
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscarStatusNotaFiscal") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['statusNotaFiscal']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT manutencaoImpressora.idManutencaoImpressora, impressora.marca, impressora.modelo, manutencaoImpressora.empresa, manutencaoImpressora.item, manutencaoImpressora.ordemServico, manutencaoImpressora.notaFiscal, manutencaoImpressora.statusNotaFiscal, manutencaoImpressora.valor,
	manutencaoImpressora.autorizacaoFornecimento, manutencaoImpressora.dataEnvio, manutencaoImpressora.dataChegada, manutencaoImpressora.tempoGarantia, manutencaoImpressora.statusServico, manutencaoImpressora.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM manutencaoImpressora
	INNER JOIN impressora ON impressora.bemPatrimonial=manutencaoImpressora.item
	INNER JOIN departamento ON departamento.idDepartamento=impressora.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=manutencaoImpressora.empresa
	WHERE manutencaoImpressora.statusNotaFiscal = '".$conteudoBusca."' 
	AND manutencaoImpressora.status=1 ORDER BY impressora.marca");  
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Fornecedor</th>
	<th>Bem Patrimonial</th>
	<th>Marca</th>
	<th>Modelo</th>
	<th>Departamento</th>
	<th>Ordem de serviço</th>
	<th>Nota Fiscal</th>
	<th>Status Nota Fiscal</th>
	<th>Valor</th>
	<th>AF</th>
	<th>Data de envio</th>
	<th>Data de chegada</th>
	<th>Tempo de garantia</th>
	<th>Status do serviço</th>
	<th>Descrição do serviço</th>
	</tr>
	
		<?php while ($manutencaoExternaImpressora = mysql_fetch_object($sql)) {	
	$total=$total+$manutencaoExternaImpressora->valor;
	
	?>

	
	<tr>
	<td><?php echo $manutencaoExternaImpressora->fornecedor;?></td>
	<td><?php echo $manutencaoExternaImpressora->item;?></td>
	<td><?php echo $manutencaoExternaImpressora->marca;?></td>
	<td><?php echo $manutencaoExternaImpressora->modelo;?></td>
	<td><?php echo $manutencaoExternaImpressora->departamento;?></td>
	<td><?php echo $manutencaoExternaImpressora->ordemServico;?></td>
	<td><?php echo $manutencaoExternaImpressora->notaFiscal;?></td>
	<td><?php echo $manutencaoExternaImpressora->statusNotaFiscal;?></td>
	<td><?php echo $manutencaoExternaImpressora->valor;?></td>
	<td><?php echo $manutencaoExternaImpressora->autorizacaoFornecimento;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaImpressora->dataEnvio));?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaImpressora->dataChegada));?></td>
	<td><?php echo $manutencaoExternaImpressora->tempoGarantia;?></td>	
	<td><?php echo $manutencaoExternaImpressora->statusServico;?></td>
	<td><?php echo $manutencaoExternaImpressora->descricao;?></td>
	<td><a href="editaManutencaoImpressora.php?idManutencaoImpressora=<?php echo $manutencaoExternaImpressora->idManutencaoImpressora; ?>">Editar</a></td> 
	<td><a href="../sql/deleta_manutencaoImpressora_sql.php?idManutencaoImpressora=<?php echo $manutencaoExternaImpressora->idManutencaoImpressora; ?> " onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	<?php
	
	}}
	$p=null;
	?>
	</table>

	<?php 	
	}?>
	<!-- fim da busca por status nota fiscal-->
	
	
	
	
	
	<!-- começo da busca por fornecedor-->
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscarFornecedor") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['empresa']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT manutencaoImpressora.idManutencaoImpressora, impressora.marca, impressora.modelo, manutencaoImpressora.empresa, manutencaoImpressora.item, manutencaoImpressora.ordemServico, manutencaoImpressora.notaFiscal, manutencaoImpressora.statusNotaFiscal, manutencaoImpressora.valor,
	manutencaoImpressora.autorizacaoFornecimento, manutencaoImpressora.dataEnvio, manutencaoImpressora.dataChegada, manutencaoImpressora.tempoGarantia, manutencaoImpressora.statusServico, manutencaoImpressora.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM manutencaoImpressora
	INNER JOIN impressora ON impressora.bemPatrimonial=manutencaoImpressora.item
	INNER JOIN departamento ON departamento.idDepartamento=impressora.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=manutencaoImpressora.empresa
	WHERE manutencaoImpressora.empresa LIKE '%".$conteudoBusca."%' 
	AND manutencaoImpressora.status=1 ORDER BY impressora.marca");  
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Fornecedor</th>
	<th>Bem Patrimonial</th>
	<th>Marca</th>
	<th>Modelo</th>
	<th>Departamento</th>
	<th>Ordem de serviço</th>
	<th>Nota Fiscal</th>
	<th>Status Nota Fiscal</th>
	<th>Valor</th>
	<th>AF</th>
	<th>Data de envio</th>
	<th>Data de chegada</th>
	<th>Tempo de garantia</th>
	<th>Status do serviço</th>
	<th>Descrição do serviço</th>
	</tr>
	
		<?php while ($manutencaoExternaImpressora = mysql_fetch_object($sql)) {	
	$total=$total+$manutencaoExternaImpressora->valor;
	
	?>

	
	<tr>
	<td><?php echo $forn=$manutencaoExternaImpressora->fornecedor;?></td>
	<td><?php echo $manutencaoExternaImpressora->item;?></td>
	<td><?php echo $manutencaoExternaImpressora->marca;?></td>
	<td><?php echo $manutencaoExternaImpressora->modelo;?></td>
	<td><?php echo $manutencaoExternaImpressora->departamento;?></td>
	<td><?php echo $manutencaoExternaImpressora->ordemServico;?></td>
	<td><?php echo $manutencaoExternaImpressora->notaFiscal;?></td>
	<td><?php echo $manutencaoExternaImpressora->statusNotaFiscal;?></td>
	<td><?php echo $manutencaoExternaImpressora->valor;?></td>
	<td><?php echo $manutencaoExternaImpressora->autorizacaoFornecimento;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaImpressora->dataEnvio));?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoExternaImpressora->dataChegada));?></td>
	<td><?php echo $manutencaoExternaImpressora->tempoGarantia;?></td>	
	<td><?php echo $manutencaoExternaImpressora->statusServico;?></td>
	<td><?php echo $manutencaoExternaImpressora->descricao;?></td>
	<td><a href="editaManutencaoImpressora.php?idManutencaoImpressora=<?php echo $manutencaoExternaImpressora->idManutencaoImpressora; ?>">Editar</a></td> 
	<td><a href="../sql/deleta_manutencaoImpressora_sql.php?idManutencaoImpressora=<?php echo $manutencaoExternaImpressora->idManutencaoImpressora; ?> " onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	<?php
	
	}}
	$p=null;
	?>
	</table>

	<?php 
	if ($numRegistros > 0){
	$media=$total / $numRegistros;
	echo "<fieldset><p id = 'textoPequeno'>Número de manutenções de impressora do fornecedor $forn: <b>$numRegistros</b></p>
	<p id = 'textoPequeno'>Valor investido em manutenções de impressora do  fornecedor $forn: <b>R$ $total</b></p>
	<p id = 'textoPequeno'>Valor médio das manutenções de impressora do fornecedor $forn: <b>R$ $media</b></p>
	<br><br><br></fieldset>"; }}?>
	<!-- fim da busca por fornecedor-->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	</section>

<!--rodapé-->
<footer>
<?php

?>
</footer>
</body>
</html>
