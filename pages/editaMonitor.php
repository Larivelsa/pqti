<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Alterar especificações de monitor</title>
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
$idMonitor = $_GET['idMonitor']; // Recebendo o valor vindo do link
$sql = mysql_query("SELECT monitor.*, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS empresa, montadora.idMontadora, montadora.nome AS marca
	FROM monitor
	INNER JOIN departamento ON departamento.idDepartamento=monitor.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=monitor.empresaID
	INNER JOIN montadora ON montadora.idMontadora=monitor.marcaID
	WHERE monitor.idMonitor = '".$idMonitor."'
	AND monitor.status=1 ORDER BY monitor.bemPatrimonial"); 

// Há variável $resultado faz uma consulta em nossa tabela selecionando somente o registro desejado
while($linha = mysql_fetch_object($sql)) //Já a instrução while faz um loop entre todos os registros e armazena seus valores na variável $linha
{ 
?>
<form action = "../sql/edita_monitor_sql.php" = method="post" id="mi">
	
	<fieldset>
	<legend>Alterar registro de monitor</legend>
	<input type="hidden" name="idMonitor" value="<?php echo $linha->idMonitor; ?>"/> 
	
	<label>Bem Patrimonial  </label><input type="text" name = "bemPatrimonial" id = "bemPatrimonial" value="<?php echo $linha->bemPatrimonial;?>"><br><br>
	
	<label>Fornecedor</label> 
	<select name="empresa">
	<option value="<?php echo $linha->empresaID;?>"><?php echo $linha->empresa;?></option>
	<?php 
	$sql = mysql_query("SELECT idFornecedor,fantasia FROM fornecedor WHERE status = '1' ORDER BY fantasia"); 
	while($empresa = mysql_fetch_object($sql)){ ?>
	<option value="<?php echo $empresa->idFornecedor;?>"><?php echo $empresa->fantasia;?></option>
	<?php } ?>	
	</select><br><br>
	
	<label>Nº Nota Fiscal</label>
	<input type="text" name = "notaFiscal" id = "notaFiscal" value="<?php echo $linha->notaFiscal;?>">
	<br><br>
	
	<label>Valor</label>
	<input type="text" name = "valor" id = "valor" value="<?php echo $linha->valor;?>">
	<br><br>
	
	<label>Data de aquisição</label>
	<input type="date" name="dataAquisicao" id="dataAquisicao" value="<?php echo $linha->dataAquisicao;?>"><br><br>
	
	<label>Tempo de garantia em meses</label>
	<input type="text" name="tempoGarantia" id="tempoGarantia" value="<?php echo $linha->tempoGarantia;?>"><br><br>
	
	<label>Departamento</label>
	<select name="departamento">
	<option value="<?php echo $linha->departamentoID;?>"><?php echo $linha->departamento;?></option>
	<?php 
	$sql = mysql_query("SELECT idDepartamento, nome FROM departamento WHERE status = '1' ORDER BY nome");  
	while($departamento = mysql_fetch_array($sql)) { ?>
	<option value="<?php echo $departamento['idDepartamento'] ?>"><?php echo $departamento['nome'] ?></option>
	<?php } 
	?>

	</select><br><br>
	
	
	<label>Marca da montadora</label>
	<select name="marca">
	<option value="<?php echo $linha->marcaID;?>"><?php echo $linha->marca;?></option>
	<?php 
	$sql = mysql_query("SELECT idMontadora, nome FROM montadora WHERE status = '1' ORDER BY nome");  
	while($montadora = mysql_fetch_array($sql)) { ?>
	<option value="<?php echo $montadora['idMontadora'] ?>"><?php echo $montadora['nome'] ?></option>
	<?php } 
	?>
	</select><br><br>
	
	<label>Modelo</label>
	<input type="text" name="modelo" id="modelo" value="<?php echo $linha->modelo;?>"><br><br>		

	
	<input type="submit" value="Editar"/>
	<input type="button" value="Voltar" onclick="location.href= 'monitor.php'">

	</fieldset>
	
</form>
</section>

<?php
} // fim do while
?> 
</body>
</html>