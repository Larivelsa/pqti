<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Alterar especificações de máquina</title>
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
$idMaquinaDesktop = $_GET['idMaquinaDesktop']; // Recebendo o valor vindo do link
$sql = mysql_query("SELECT maquinaDesktop.idMaquinaDesktop, maquinaDesktop.bemPatrimonial, maquinaDesktop.empresaID, maquinaDesktop.notaFiscal, maquinaDesktop.valor, maquinaDesktop.dataAquisicao, maquinaDesktop.tempoGarantia, maquinaDesktop.departamentoID, maquinaDesktop.marcaID, maquinaDesktop.sistemaOperacional, maquinaDesktop.placaMae, maquinaDesktop.processador, maquinaDesktop.hd, maquinaDesktop.slot1, maquinaDesktop.slot2, maquinaDesktop.fonte, maquinaDesktop.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS empresa, montadora.idMontadora, montadora.nome AS marca
	FROM maquinaDesktop
	INNER JOIN departamento ON departamento.idDepartamento=maquinaDesktop.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=maquinaDesktop.empresaID
	INNER JOIN montadora ON montadora.idMontadora=maquinaDesktop.marcaID
	WHERE idMaquinaDesktop = '".$idMaquinaDesktop."'
	AND maquinaDesktop.status=1 ORDER BY maquinaDesktop.bemPatrimonial"); 


while($linha = mysql_fetch_object($sql)) //Já a instrução while faz um loop entre todos os registros e armazena seus valores na variável $linha
{ 
?>
<form action = "../sql/edita_maquinaDesktop_sql.php" = method="post" id="mi">
	
	<fieldset>
	<legend>Alterar registro de máquina</legend>
	<input type="hidden" name="idMaquinaDesktop" value="<?php echo $linha->idMaquinaDesktop; ?>"/> 
	
	<label>Bem Patrimonial  </label>
	<input type="text" name = "bemPatrimonial" id = "bemPatrimonial" value="<?php echo $linha->bemPatrimonial;?>"><br><br>
	
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
	
	<label>Placa mãe</label>
	<select name="placaMae">
	<option value="<?php echo $linha->placaMae;?>"><?php echo $linha->placaMae;?></option>
	<?php 
	$sql = mysql_query("SELECT marca, modelo FROM placaMae WHERE status = '1' ORDER BY marca"); 
	while($placaMae = mysql_fetch_array($sql)) { ?>
	<option value="<?php echo $placaMae['marca']." - ".$placaMae['modelo'] ?>"><?php echo $placaMae['marca']." - ".$placaMae['modelo'] ?></option>
	<?php 
	} ?>
	</select><br><br>
	
	<label>Sistema operacional</label>
	<select name="sistemaOperacional">
	<option value="<?php echo $linha->sistemaOperacional;?>"><?php echo $linha->sistemaOperacional;?></option>
	<?php 
	$sql = mysql_query("SELECT nome, versao FROM sistemaOperacional WHERE status = '1' ORDER BY nome"); 
	while($so = mysql_fetch_array($sql)) { ?>
	<option value="<?php echo $so['nome']." - ".$so['versao'] ?>"><?php echo $so['nome']." - ".$so['versao'] ?></option>
	<?php 
	} ?>
	</select><br><br>
	
	
	<label>Processador</label>
	<select name="processador">
	<option value="<?php echo $linha->processador;?>"><?php echo $linha->processador;?></option>
	<?php 
	$sql = mysql_query("SELECT marca, modelo FROM processador WHERE status = '1' ORDER BY marca"); 
	while($processador = mysql_fetch_array($sql)) { ?>
	<option value="<?php echo $processador['marca']." - ".$processador['modelo'] ?>"><?php echo $processador['marca']." - ".$processador['modelo'] ?></option>
	<?php 
	} ?>
	</select><br><br>

	<label>HD</label>
	<select name="hd">
	<option value="<?php echo $linha->hd;?>"><?php echo $linha->hd;?></option>
	<?php 
	$sql = mysql_query("SELECT marca, modelo, capacidade FROM hd WHERE status = '1' ORDER BY marca"); 
	while($hd = mysql_fetch_array($sql)) { ?>
	<option value="<?php echo $hd['marca']." - ".$hd['modelo']." - ".$hd['capacidade'] ?>"><?php echo $hd['marca']." - ".$hd['modelo']." - ".$hd['capacidade'] ?></option>
	<?php 
	} ?>
	</select><br><br>

	<label>Memória Slot 1</label>
	<select name="slot1">
	<option value="<?php echo $linha->slot1;?>"><?php echo $linha->slot1;?></option>
	<?php 
	$sql = mysql_query("SELECT marca, tipo, capacidade FROM memoria WHERE status = '1' ORDER BY marca"); 
	while($memoria = mysql_fetch_array($sql)) { ?>
	<option value="<?php echo $memoria['marca']." - ".$memoria['tipo']." - ".$memoria['capacidade'] ?>"><?php echo $memoria['marca']." - ".$memoria['tipo']." - ".$memoria['capacidade'] ?></option>
	<?php 
	} ?>
	</select><br><br>

	<label>Memória Slot 2</label>
	<select name="slot2">
	<option value="<?php echo $linha->slot2;?>"><?php echo $linha->slot2;?></option>
	<?php 
	$sql = mysql_query("SELECT marca, tipo, capacidade FROM memoria WHERE status = '1' ORDER BY marca"); 
	while($memoria = mysql_fetch_array($sql)) { ?>
	<option value="<?php echo $memoria['marca']." - ".$memoria['tipo']." - ".$memoria['capacidade'] ?>"><?php echo $memoria['marca']." - ".$memoria['tipo']." - ".$memoria['capacidade'] ?></option>
	<?php 
	} ?>
	</select><br><br>

	<label>Fonte</label>
	<input type="text" name = "fonte" id = "fonte" value="<?php echo $linha->fonte;?>"><br><br>
	
	
	
	<label>Descrição</label>
	<textarea name="descricao" form="mi"><?php echo $linha->descricao;?></textarea><br><br>
	

	
	<input type="submit" value="Alterar"/>
	<input type="button" value="Voltar" onclick="location.href= 'maquinaDesktop.php'">

	</fieldset>
	
</form>
</section>

<?php
} // fim do while
?> 
</body>
</html>