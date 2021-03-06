﻿<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Manutenção externa de impressora</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">

    <script type="text/javascript" src="../js/jquery-1.6.4.js"></script>
    <script type="text/javascript">
	
		
		$(document).ready(function(){
			$('#departamento').change(function(){
				$('#bemPatrimonial').load('listaBemPatrimonialImpressora.php?idDepartamento='+$('#departamento').val());
			});
		});
		
		
</script>


<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery.maskMoney.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function () {     

	$("#valor").maskMoney({showSymbol:true, symbol:"R$ ", decimal:"."});
	});
</script>



</head>	
<body>
	<header>
	<?php
	include "header.php";
	?>
	</header>
<!--conteúdo, aqui que ficará formulário de cadastro-->
		<section id = "conteudo">

		<section class="cadastro">

		<form action = "../sql/cadastra_manutencaoImpressora_sql.php" = method="post" id="mi">

				<fieldset>
				<legend>Registrar manutenção externa de impressora</legend>
				<label>Fornecedor</label>
				<select name="empresa">
				<option value="...">Selecione...</option>
				<?php 
				$sql = mysql_query("SELECT idFornecedor, fantasia FROM fornecedor WHERE status = '1' ORDER BY fantasia"); 
				while($empresa = mysql_fetch_array($sql)) { ?>
				<option value="<?php echo $empresa['idFornecedor'] ?>"><?php echo $empresa['fantasia'] ?></option>
				<?php } ?>
				</select><br><br>

				<label>Departamento</label>
				<select name='departamento' id='departamento'>
				<option value="...">Selecione...</option>
				<?php 

				$sql = mysql_query("SELECT idDepartamento, nome FROM departamento  WHERE status = '1' ORDER BY nome");
				while($reg = mysql_fetch_object($sql)): ?>
						<option value="<?php echo $reg->idDepartamento ?>"><?php echo $reg->nome?></option>
				<?php endwhile; ?>

				</select><br><br>
			
				<div id="bemPatrimonial"name="bemPatrimonial"></div><br><br>
			
				<label>Ordem de serviço</label>
				<input type="text" name = "ordemServico" id = "ordemServico"><br><br>

				<label>Nota Fiscal</label>
				<input type="text" name = "notaFiscal" id = "notaFiscal"><br><br>

				<label>Status da Nota Fiscal</label>
				<label><input type="radio" name = "statusNotaFiscal" value="naoEnviada" id = "statusNotaFiscal">Não enviada</label>
				<label><input type="radio" name = "statusNotaFiscal" value="enviada" id = "statusNotaFiscal">Enviada</label><br><br>

				<label>Valor</label>
				<input type="text" name = "valor" id = "valor"><br><br>

				<label>Autorização de fornecimento</label>
				<input type="text" name = "autorizacaoFornecimento" id = "autorizacaoFornecimento"><br><br>

				<label>Data de envio</label>
				<input type="date" name = "dataEnvio" id = "dataEnvio"><br><br>

				<label>Data de chegada</label>
				<input type="date" name = "dataChegada" id = "dataChegada"><br><br>

				<label>Tempo de garantia (em meses) </label>
				<input type="text" name = "tempoGarantia" id = "tempoGarantia"><br><br>

				<label>Status do serviço</label>
				<label><input type="radio" name = "statusServico" value="andamento" id = "statusServico">Em andamento</label>
				<label><input type="radio" name = "statusServico" value="finalizado" id = "statusServico">Finalizado</label><br><br>

				<label>Descrição</label>
				<textarea name="descricao" form="mi"></textarea><br><br>

				<input type="submit" value="Registrar">
				<input type="button" value="Voltar" onclick="location.href= 'manutencaoImpressora.php'">
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
