<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Cadastro de computador</title>
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
<!--conteúdo, aqui que ficará formulário de cadastro-->
<section id = "conteudo">

<section class="cadastro">

		<form action = "../sql/cadastra_maquina_desktop_sql.php" = method="post" id="mq">

		<fieldset>
			<legend>Cadastro de computador</legend>
			<label>Bem patrimonial</label>
			<input type="text" name = "patrimonial" id = "patrimonial"><br><br>

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
			<input type="text" name="valor" id="valor" class="dinheiro"><br><br>

			<label>Data de aquisição</label>
			<input type="date" name="dataAquisicao" id="dataAquisicao"><br><br>

			<label>Tempo de garantia em meses</label>
			<input type="text" name="tempoGarantia" id="tempoGarantia"><br><br>

			<label>Departamento</label>
			<select name="departamento">
			<option value="85">Selecione...</option><br><br>
			<?php 
			$sql = mysql_query("SELECT idDepartamento, nome FROM departamento WHERE status = '1' ORDER BY nome");  
			while($departamento = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $departamento['idDepartamento'] ?>"><?php echo $departamento['nome'] ?></option>
			<?php } 
			?>

			</select><br><br>


			<label>Marca da montadora</label>
			<select name="marca">
			<option value="21">Selecione...</option>
			<?php 
			$sql = mysql_query("SELECT idMontadora, nome FROM montadora WHERE status = '1' ORDER BY nome");  
			while($montadora = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $montadora['idMontadora'] ?>"><?php echo $montadora['nome'] ?></option>
			<?php } 
			?>
			</select><br><br>

			<label>Sistema operacional</label>
			<select name="sistemaOperacional">
			<option value="...">Selecione...</option>
			<?php 
			$sql = mysql_query("SELECT nome, versao FROM sistemaOperacional WHERE status = '1' ORDER BY nome"); 
			while($so = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $so['nome']." - ".$so['versao']?>"><?php echo $so['nome']." - ".$so['versao'] ?></option>
			<?php 
			} ?>
			</select><br><br>

			<label>Placa mãe</label>
			<select name="placaMae">
			<option value="...">Selecione...</option>
			<?php 
			$sql = mysql_query("SELECT marca, modelo FROM placaMae WHERE status = '1' ORDER BY marca"); 
			while($placaMae = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $placaMae['marca']." - ".$placaMae['modelo']?>"><?php echo $placaMae['marca']." - ".$placaMae['modelo'] ?></option>
			<?php 
			} ?>
			</select><br><br>

			<label>Processador</label>
			<select name="processador">
			<option value="...">Selecione...</option>
			<?php 
			$sql = mysql_query("SELECT marca, modelo FROM processador WHERE status = '1' ORDER BY marca"); 
			while($processador = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $processador['marca']." - ".$processador['modelo'] ?>"><?php echo $processador['marca']." - ".$processador['modelo'] ?></option>
			<?php 
			} ?>
			</select><br><br>

			<label>HD</label>
			<select name="hd">
			<option value="...">Selecione...</option>
			<?php 
			$sql = mysql_query("SELECT marca, modelo, capacidade FROM hd WHERE status = '1' ORDER BY marca"); 
			while($hd = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $hd['marca']." - ".$hd['modelo']." - ".$hd['capacidade']?>"><?php echo $hd['marca']." - ".$hd['modelo']." - ".$hd['capacidade'] ?></option>
			<?php 
			} ?>
			</select><br><br>

			<label>Memória Slot 1</label>
			<select name="slot1">
			<option value="...">Selecione...</option>
			<?php 
			$sql = mysql_query("SELECT marca, tipo, capacidade FROM memoria WHERE status = '1' ORDER BY marca"); 
			while($memoria = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $memoria['marca']." - ".$memoria['tipo']." - ".$memoria['capacidade']?>"><?php echo $memoria['marca']." - ".$memoria['tipo']." - ".$memoria['capacidade'] ?></option>
			<?php 
			} ?>
			</select><br><br>

			<label>Memória Slot 2</label>
			<select name="slot2">
			<option value="...">Selecione...</option>
			<?php 
			$sql = mysql_query("SELECT marca, tipo, capacidade FROM memoria WHERE status = '1' ORDER BY marca"); 
			while($memoria = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $memoria['marca']." - ".$memoria['tipo']." - ".$memoria['capacidade']?>"><?php echo $memoria['marca']." - ".$memoria['tipo']." - ".$memoria['capacidade'] ?></option>
			<?php 
			} ?>
			</select><br><br>

			<label>Fonte</label>
			<input type="text" name="fonte" id="fonte"><br><br>

			<label>Descrição</label>
			<textarea name="descricao" form="mq"></textarea><br><br>
			
			


			<input type="submit" value="Cadastrar">
			<input type="button" value="Voltar" onclick="location.href= 'maquinaDesktop.php'">

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
