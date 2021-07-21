<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
$a=null;
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Máquinas desktop</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
</head>
<script src="../js/script.js" type = "text/javascript"></script>
<script type="text/javascript" src="../js/jquery-1.6.4.js"></script>

<body>
<header>
<?php
include "header.php";
?>
</header>

<section id="conteudo">





<fieldset id="pesquisa">


	<legend>Escolha um dos termos para pesquisar máquina</legend>
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


	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscarProcessador"> 
	<label>Processador</label>
	<select name="processador">
	<option value="...">Selecione...</option>
	<?php 
	$sql = mysql_query("SELECT idProcessador, modelo FROM processador WHERE status = '1' ORDER BY marca");  
	while($processador = mysql_fetch_array($sql)) { ?>
	<option value="<?php echo $processador['idProcessador'] ?>"><?php echo $processador['modelo'] ?></option>
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
	
	<label>Se a máquina não estiver inserida, <a href="cadastra_maquinaDesktop.php">faça o cadastro do item.</a></label>
	

	</fieldset>	

	
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscarBemPatrimonial") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['bemPatrimonial']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT maquinaDesktop.bemPatrimonial, maquinaDesktop.empresa, maquinaDesktop.notaFiscal, maquinaDesktop.valor, maquinaDesktop.dataAquisicao, maquinaDesktop.departamentoID, maquinaDesktop.marca, maquinaDesktop.sistemaOperacional, maquinaDesktop.placaMae, maquinaDesktop.processador, maquinaDesktop.hd, maquinaDesktop.slot1, maquinaDesktop.slot2, maquinaDesktop.fonte, maquinaDesktop.descricao, departamento.idDepartamento, departamento.nome 
	AS departamento
	FROM maquinaDesktop 
	INNER JOIN departamento
	ON departamento.idDepartamento=maquinaDesktop.departamentoID 
	WHERE maquinaDesktop.bemPatrimonial LIKE '%".$conteudoBusca."%' 
	AND maquinaDesktop.status=1 ORDER BY maquinaDesktop.bemPatrimonial");  

	$numRegistros = mysql_num_rows($sql);   
	
	if ($numRegistros != 0) {

	?>
	
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Bem patrimonial</th>
	<th>Fornecedor</th>
	<th>Nota Fiscal</th>
	<th>Valor</th>
	<th>Aquisição</th>
	<th>T. G.</th>
	<th>Departamento</th>
	<th>Marca</th>
	<th>Sistema operacional</th>
	<th>Placa-mãe</th>
	<th>Processador</th>
	<th>HD</th>
	<th>Mem. slot 1</th>
	<th>Mem. slot 2</th>
	<th>Fonte</th>
	<th>Descrição</th>
	</tr>
	
	<?php while ($pc = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $pc->bemPatrimonial;?></td>
	<td><?php echo $pc->empresa;?></td>
	<td><?php echo $pc->notaFiscal;?></td>
	<td><?php echo $pc->valor;?></td>
	<td><?php echo date('d/m/Y',strtotime($pc->dataAquisicao));?></td>
	<td><?php echo $pc->tempoGarantia;?></td>
	<td><?php echo $pc->departamento;?></td>
	<td><?php echo $pc->marca;?></td>
	<td><?php echo $pc->sistemaOperacional;?></td>
	<td><?php echo $pc->placaMae;?></td>
	<td><?php echo $pc->processador;?></td>	
	<td><?php echo $pc->hd;?></td>
	<td><?php echo $pc->slot1;?></td>		
	<td><?php echo $pc->slot2;?></td>	
	<td><?php echo $pc->fonte;?></td>	
	<td><?php echo $pc->descricao;?></td>	
	<td><a href="editaMaquinaDesktop.php?idMaquinaDesktop=<?php echo $pc->idMaquinaDesktop; ?>">Editar</a></td> 
	<td><a href="../sql/deletaMaquinaDesktop_sql.php?idMaquinaDesktop=<?php echo $pc->idMaquinaDesktop; ?>" onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "<fieldset><p id ='textoPequeno'>Nenhuma máquina foi encontrado com o bem patrimonial ".$conteudoBusca.".</p><br><br><br></fieldset>"; } 
	} ?>
    </table>

	
	
	<?php
	
	if ($a == "buscarDepartamento") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['departamento']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT * FROM maquinaDesktop WHERE departamento LIKE '%".$conteudoBusca."%' AND status = '1' ORDER BY bemPatrimonial");   
	
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
	<th>Aquisição</th>
	<th>T. G.</th>
	<th>Departamento</th>
	<th>Marca</th>
	<th>Sistema operacional</th>
	<th>Placa-mãe</th>
	<th>Processador</th>
	<th>HD</th>
	<th>Mem. slot 1</th>
	<th>Mem. slot 2</th>
	<th>Fonte</th>
	<th>Descrição</th>
	</tr>
	
	<?php while ($pc = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $pc->bemPatrimonial;?></td>
	<td><?php echo $pc->empresa;?></td>
	<td><?php echo $pc->notaFiscal;?></td>
	<td><?php echo $pc->valor;?></td>
	<td><?php echo date('d/m/Y',strtotime($pc->dataAquisicao));?></td>
	<td><?php echo $pc->tempoGarantia;?></td>
	<td><?php echo $pc->departamento;?></td>
	<td><?php echo $pc->marca;?></td>
	<td><?php echo $pc->sistemaOperacional;?></td>
	<td><?php echo $pc->placaMae;?></td>
	<td><?php echo $pc->processador;?></td>	
	<td><?php echo $pc->hd;?></td>
	<td><?php echo $pc->slot1;?></td>		
	<td><?php echo $pc->slot2;?></td>	
	<td><?php echo $pc->fonte;?></td>	
	<td><?php echo $pc->descricao;?></td>	
	<td><a href="editaMaquinaDesktop.php?idMaquinaDesktop=<?php echo $pc->idMaquinaDesktop; ?>">Editar</a></td> 
	<td><a href="../sql/deletaMaquinaDesktop_sql.php?idMaquinaDesktop=<?php echo $pc->idMaquinaDesktop; ?>" onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "<fieldset><p id = 'textoPequeno'>Nenhuma máquina foi encontrado com o departamento ".$conteudoBusca.".</p><br><br><br></fieldset>"; } 
	} // fim do if
	
	?> 
    </table>
	
	
	
	
	
	
	<?php
	
	if ($a == "buscarProcessador") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['processador']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT * FROM maquinaDesktop WHERE processador LIKE '%".$conteudoBusca."%' AND status = '1' ORDER BY bemPatrimonial");   
	
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
	<th>Aquisição</th>
	<th>T. G.</th>
	<th>Departamento</th>
	<th>Marca</th>
	<th>Sistema operacional</th>
	<th>Placa-mãe</th>
	<th>Processador</th>
	<th>HD</th>
	<th>Mem. slot 1</th>
	<th>Mem. slot 2</th>
	<th>Fonte</th>
	<th>Descrição</th>
	</tr>
	
	<?php while ($pc = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $pc->bemPatrimonial;?></td>
	<td><?php echo $pc->empresa;?></td>
	<td><?php echo $pc->notaFiscal;?></td>
	<td><?php echo $pc->valor;?></td>
	<td><?php echo date('d/m/Y',strtotime($pc->dataAquisicao));?></td>
	<td><?php echo $pc->tempoGarantia;?></td>
	<td><?php echo $pc->departamento;?></td>
	<td><?php echo $pc->marca;?></td>
	<td><?php echo $pc->sistemaOperacional;?></td>
	<td><?php echo $pc->placaMae;?></td>
	<td><?php echo $pc->processador;?></td>	
	<td><?php echo $pc->hd;?></td>
	<td><?php echo $pc->slot1;?></td>		
	<td><?php echo $pc->slot2;?></td>	
	<td><?php echo $pc->fonte;?></td>	
	<td><?php echo $pc->descricao;?></td>	
	<td><a href="editaMaquinaDesktop.php?idMaquinaDesktop=<?php echo $pc->idMaquinaDesktop; ?>">Editar</a></td> 
	<td><a href="../sql/deletaMaquinaDesktop_sql.php?idMaquinaDesktop=<?php echo $pc->idMaquinaDesktop; ?>" onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "<fieldset><p id = 'textoPequeno'>Nenhuma máquina foi encontrado com o processador ".$conteudoBusca.".</p><br><br><br></fieldset>"; } 
	} // fim do if
	
	?> 
    </table>
	

	<?php
	
	if ($a == "buscarMarca") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['marca']); 
	
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT * FROM maquinaDesktop WHERE marca LIKE '%".$conteudoBusca."%' AND status = '1' ORDER BY bemPatrimonial");   
	
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
	<th>Aquisição</th>
	<th>T. G.</th>
	<th>Departamento</th>
	<th>Marca</th>
	<th>Sistema operacional</th>
	<th>Placa-mãe</th>
	<th>Processador</th>
	<th>HD</th>
	<th>Mem. slot 1</th>
	<th>Mem. slot 2</th>
	<th>Fonte</th>
	<th>Descrição</th>
	</tr>
	
	<?php while ($pc = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $pc->bemPatrimonial;?></td>
	<td><?php echo $pc->empresa;?></td>
	<td><?php echo $pc->notaFiscal;?></td>
	<td><?php echo $pc->valor;?></td>
	<td><?php echo date('d/m/Y',strtotime($pc->dataAquisicao));?></td>
	<td><?php echo $pc->tempoGarantia;?></td>
	<td><?php echo $pc->departamento;?></td>
	<td><?php echo $pc->marca;?></td>
	<td><?php echo $pc->sistemaOperacional;?></td>
	<td><?php echo $pc->placaMae;?></td>
	<td><?php echo $pc->processador;?></td>	
	<td><?php echo $pc->hd;?></td>
	<td><?php echo $pc->slot1;?></td>		
	<td><?php echo $pc->slot2;?></td>	
	<td><?php echo $pc->fonte;?></td>	
	<td><?php echo $pc->descricao;?></td>	
	<td><a href="editaMaquinaDesktop.php?idMaquinaDesktop=<?php echo $pc->idMaquinaDesktop; ?>">Editar</a></td> 
	<td><a href="../sql/deletaMaquinaDesktop_sql.php?idMaquinaDesktop=<?php echo $pc->idMaquinaDesktop; ?>" onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "<fieldset><p id = 'textoPequeno'>Nenhuma máquina foi encontrado com a marca ".$conteudoBusca.".</p><br><br><br></fieldset>"; } 
	} // fim do if
	
	?> 
    </table>
	
	
	<?php if ($numRegistros != 0) {
	?> 
	<p id = "textoPequeno">Número de máquinas encontradas: <b><?php echo $numRegistros;?></b></p>
	<?php }?>


	
	
	
	
	
	
	
</section>

<!--rodapé-->
<footer>
<?php

?>
</footer>
</body>
</html>
