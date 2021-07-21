<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Cadastro de monitor</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
</head>
<script src="../js/script.js" type = "text/javascript"></script>
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
<!--conteúdo, aqui que ficará formulário de cadastro-->
<section id = "conteudo">

<section class="cadastro">

	<form action = "../sql/cadastra_monitor_sql.php" = method="post">

			<fieldset>
			<legend>Cadastro de monitor</legend>
			<label>Bem patrimonial ou serial</label>
			<input type="text" name = "bemPatrimonial" id = "bemPatrimonial"><br><br>


			<label>Fornecedor</label>
			<select name="empresa">
			<option value="23">Selecione...</option>
			<?php 
			$sql = mysql_query("SELECT idFornecedor, fantasia FROM fornecedor WHERE status = '1' ORDER BY fantasia"); 
			while($empresa = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $empresa['idFornecedor'] ?>"><?php echo $empresa['fantasia'] ?></option>
			<?php } ?>
			</select><br><br>

			<label>Nº Nota Fiscal</label>
			<input type="text" name = "notaFiscal" id = "notaFiscal"><br><br>

			<label>Valor</label>
			<input type="text" name="valor" id="valor"><br><br>

			<label>Data de aquisição</label>
			<input type="date" name="dataAquisicao" id="dataAquisicao"><br><br>

			<label>Tempo de garantia em meses</label>
			<input type="text" name="tempoGarantia" id="tempoGarantia"><br><br>

			<label>Departamento</label>
			<select name="departamento">
			<option value="...">Selecione...</option><br><br>
			<?php 
			$sql = mysql_query("SELECT idDepartamento, nome FROM departamento WHERE status = '1' ORDER BY nome");  
			while($departamento = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $departamento['idDepartamento'] ?>"><?php echo $departamento['nome'] ?></option>
			<?php } 
			?>
			</select><br><br>

			<label>Marca da montadora</label>
			<select name="marca">
			<option value="...">Selecione...</option>
			<?php 
			$sql = mysql_query("SELECT idMontadora, nome FROM montadora WHERE status = '1' ORDER BY nome");  
			while($montadora = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $montadora['idMontadora'] ?>"><?php echo $montadora['nome'] ?></option>
			<?php } 
			?>
			</select><br><br>

			<label>Modelo</label>
			<input type="text" name = "modelo" id = "modelo"><br><br>

			<input type="submit" value="Cadastrar">
			<input type="button" value="Voltar" onclick="location.href= 'monitor.php'">
			</fieldset>
			</form>


		</section>
</section>
<!--rodapé-->
<footer>
<?php

?>
</footer>
</body>
</html>
