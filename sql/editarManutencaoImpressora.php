<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Manutenção de pc</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
</head>
<script src="../js/script.js" type = "text/javascript"></script>


<body>
<header>
<?php
include "header.php";
?>
</header>

<?php 
$idManutencaoImpressora = $_GET['idManutencaoImpressora']; // Recebendo o valor vindo do link
$resultado = mysql_query("SELECT * FROM manutencaoImpressora WHERE idManutencaoImpressora = '".$idManutencaoImpressora."'"); 

// Há variável $resultado faz uma consulta em nossa tabela selecionando somente o registro desejado
while($linha = mysql_fetch_array($resultado)) //Já a instrução while faz um loop entre todos os registros e armazena seus valores na variável $linha
{ 
?>
<form action = "../sql/edita_manutencaoImpressora_sql.php" = method="post" id="mi">
	
	<fieldset>
	<legend>Alterar registro manutenção externa de impressora</legend>
	<input type="hidden" name="idManutencaoImpressora" value="<?php echo $linha->idManutencaoImpressora; ?>"/> 
	
	<label>Bem Patrimonial</label><label><?php echo $linha->bemPatrimonial; ?></label><br><br>
	
	<label>Fornecedor</label> 
	<select name="empresa">
	<option value="<?php echo $linha->empresa;?>"><?php echo $linha->empresa;?></option>
	<?php 
	$sql = mysql_query("SELECT fantasia FROM fornecedor WHERE status = '1' ORDER BY fantasia"); 
	while($empresa = mysql_fetch_array($sql)){ ?>
	<option value="<?php echo $empresa->fantasia;?>"><?php echo $empresa->fantasia;?></option>
	<?php } ?>	
	</select><br><br>
	
	<label>Ordem de serviço</label>
	<input type="text" name = "ordemServico" id = "ordemServico" value="<?php echo $linha->ordemServico;?>">
	<br><br>

	
	<label>Nota fiscal</label>
	<input type="text" name = "notaFiscal" id = "notaFiscal" value="<?php echo $linha->notaFiscal;?>">
	<br><br>

	<label>Status da Nota Fiscal</label>
	<label><input type="radio" name = "statusNotaFiscal" value="naoEnviada" id = "statusNotaFiscal">Não enviada</label>
	<label><input type="radio" name = "statusNotaFiscal" value="enviada" id = "statusNotaFiscal">Enviada</label><br><br>
	
	<label>Valor</label>
	<input type="text" name = "valor" id = "valor" value="<?php echo $linha->valor;?>"><br><br>
	
	<label>Autorização de fornecimento</label>
	<input type="text" name = "autorizacaoFornecimento" id = "autorizacaoFornecimento" value="<?php echo $linha->autorizacaoFornecimento;?>"><br><br>
	
	<label>Data de envio</label>
	<input type="date" name = "dataEnvio" id = "dataEnvio" value="<?php echo $linha->dataEnvio;?>"><br><br>
	
	<label>Data de chegada</label>
	<input type="date" name = "dataChegada" id = "dataChegada" value="<?php echo $linha->dataChegada;?>"><br><br>	
	
	<label>Tempo de garantia (em meses) </label>
	<input type="text" name = "tempoGarantia" id = "tempoGarantia" value="<?php echo $linha->tempoGarantia;?>"><br><br>
	
	<label>Status do serviço</label>
	<label><input type="radio" name = "statusServico" value="andamento" id = "statusServico">Em andamento</label>
	<label><input type="radio" name = "statusServico" value="finalizado" id = "statusServico">Finalizado</label><br><br>
	
	<label>Descrição</label>
	<textarea name="descricao" form="mi" value="<?php echo $linha->descricao;?>"></textarea><br><br>
	

	
	<input type="submit" value="Editar"/>

	</fieldset>
	
</form>

<?php
} // fim do while
?> 
</body>
</html>