<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<head>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<title>Manutenção de Interna de Impressora</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
<script src="../js/script.js" type = "text/javascript"></script>
</head>

<body>
<header>
<?php
include "header.php";
?>
</header>

<section id = "conteudo">


<fieldset id="pesquisa">
	<legend>Pesquise ou registre manutenção interna de impressora</legend>
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscar"> 
	<input type="text" name="conteudoBusca" placeholder="Digite o bem patrimonial para pesquisar" /> 
	<input type="submit" value="Buscar" /> 
	</form>
	
	<label>Se a manutenção não estiver no sistema, <a href="cadastra_manutencaoInternaImpressora.php">registre a manutenção de impressora.</a></label>
	
</fieldset>		





<?php
	$p = $_GET["p"];
	
	if (isset($p)){
	 
	
	$sql = mysql_query("SELECT manutencaoInternaImpressora.idManutencaoInternaImpressora, manutencaoInternaImpressora.departamentoID, manutencaoInternaImpressora.bemPatrimonial, manutencaoInternaImpressora.dataEntrada, manutencaoInternaImpressora.dataSaida, manutencaoInternaImpressora.responsavel, manutencaoInternaImpressora.descricao, departamento.idDepartamento, departamento.nome AS departamento
	FROM manutencaoInternaImpressora 
	INNER JOIN departamento ON departamento.idDepartamento=manutencaoInternaImpressora.departamentoID
	WHERE manutencaoInternaImpressora.bemPatrimonial LIKE '%".$p."%' 
	AND manutencaoInternaImpressora.status=1
	ORDER BY manutencaoInternaImpressora.bemPatrimonial");
	
	$numRegistros = mysql_num_rows($sql); 
	
	if ($numRegistros != 0) {
	?>
	

	
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Departamento</th>
	<th>Bem Patrimonial</th>	
	<th>Data de entrada</th>
	<th>Data de saída</th>
	<th>Responsável</th>
	<th>Descrição</th>
	</tr>
	
	<?php while ($manutencaoInternaImpressora = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $manutencaoInternaImpressora->departamento;?></td>
	<td><?php echo $manutencaoInternaImpressora->bemPatrimonial;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoInternaImpressora->dataEntrada));?></td>	
	<td><?php echo date('d/m/Y',strtotime($manutencaoInternaImpressora->dataSaida));?></td>	
	<td><?php echo $manutencaoInternaImpressora->responsavel;?></td>
	<td><?php echo $manutencaoInternaImpressora->descricao;?></td>
	<td><a href="editaManutencaoInternaImpressora.php?idManutencaoInternaImpressora=<?php echo $manutencaoInternaImpressora->idManutencaoInternaImpressora;?>">Editar</a></td> 
	<td><a href="../sql/deletaManutencaoInternaImpressora_sql.php?idManutencaoInternaImpressora=<?php echo $manutencaoInternaImpressora->idManutencaoInternaImpressora; ?>" onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	<?php
	}}
	$p=null;
	?>
	</table>

	<?php }?>
	
	

	
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscar") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['conteudoBusca']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT manutencaoInternaImpressora.idManutencaoInternaImpressora, manutencaoInternaImpressora.departamentoID, manutencaoInternaImpressora.bemPatrimonial, manutencaoInternaImpressora.dataEntrada, manutencaoInternaImpressora.dataSaida, manutencaoInternaImpressora.responsavel, manutencaoInternaImpressora.descricao, departamento.idDepartamento, departamento.nome AS departamento
	FROM manutencaoInternaImpressora 
	INNER JOIN departamento ON departamento.idDepartamento=manutencaoInternaImpressora.departamentoID
	WHERE manutencaoInternaImpressora.bemPatrimonial LIKE '%".$conteudoBusca."%' 
	AND manutencaoInternaImpressora.status=1
	ORDER BY manutencaoInternaImpressora.bemPatrimonial");   
	

	$numRegistros = mysql_num_rows($sql);   

	if ($numRegistros != 0) {
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Departamento</th>
	<th>Bem Patrimonial</th>	
	<th>Data de entrada</th>
	<th>Data de saída</th>
	<th>Responsável</th>
	<th>Descrição</th>
	</tr>
	
	<?php while ($manutencaoInternaImpressora = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $manutencaoInternaImpressora->departamento;?></td>
	<td><?php echo $manutencaoInternaImpressora->bemPatrimonial;?></td>
	<td><?php echo date('d/m/Y',strtotime($manutencaoInternaImpressora->dataEntrada));?></td>	
	<td><?php echo date('d/m/Y',strtotime($manutencaoInternaImpressora->dataSaida));?></td>	
	<td><?php echo $manutencaoInternaImpressora->responsavel;?></td>
	<td><?php echo $manutencaoInternaImpressora->descricao;?></td>
	<td><a href="editaManutencaoInternaImpressora.php?idManutencaoInternaImpressora=<?php echo $manutencaoInternaImpressora->idManutencaoInternaImpressora; ?>">Editar</a></td> 
	<td><a href="../sql/deletaManutencaoInternaImpressora_sql.php?idManutencaoInternaImpressora=<?php echo $manutencaoInternaImpressora->idManutencaoInternaImpressora; ?>" onclick="return confirm('Confirma exclusão do registro?')">Excluir</a></td>
	</tr>	
	




	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "<fieldset><p id = 'textoPequeno'>Nenhuma manutenção interna de máquina foi encontrado com esta especificação.</p><br><br><br></fieldset>"; } 
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