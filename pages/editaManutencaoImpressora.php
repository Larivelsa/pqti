<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Alterar manutenção de impressora</title>
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

<?php 
$idManutencaoImpressora = $_GET['idManutencaoImpressora']; // Recebendo o valor vindo do link

$sql = mysql_query("SELECT impressora.marca, impressora.modelo, manutencaoImpressora.empresa, manutencaoImpressora.item, manutencaoImpressora.ordemServico, manutencaoImpressora.notaFiscal, manutencaoImpressora.statusNotaFiscal, manutencaoImpressora.valor,
	manutencaoImpressora.autorizacaoFornecimento, manutencaoImpressora.dataEnvio, manutencaoImpressora.dataChegada, manutencaoImpressora.tempoGarantia, manutencaoImpressora.statusServico, manutencaoImpressora.descricao, departamento.idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM manutencaoImpressora
	INNER JOIN impressora ON impressora.bemPatrimonial=manutencaoImpressora.item
	INNER JOIN departamento ON departamento.idDepartamento=impressora.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=manutencaoImpressora.empresa
	WHERE idManutencaoImpressora = '".$idManutencaoImpressora."'
	AND manutencaoImpressora.status=1 ORDER BY impressora.marca"); 

// Há variável $resultado faz uma consulta em nossa tabela selecionando somente o registro desejado
while($linha = mysql_fetch_object($sql)) //Já a instrução while faz um loop entre todos os registros e armazena seus valores na variável $linha
{ 
?>
<form action = "../sql/edita_manutencaoImpressora_sql.php" = method="post" id="mi">
	
	<fieldset>
	<legend>Alterar registro manutenção externa de impressora</legend>
	<input type="hidden" name="idManutencaoImpressora" value="<?php echo $linha->idManutencaoImpressora; ?>"/> 
	
	<label>Bem Patrimonial   </label><label><?php echo $linha->item; ?></label><br><br>
	
	<label>Fornecedor</label> 
	<select name="empresa">
	<option value="<?php echo $linha->empresa;?>"><?php echo $linha->fornecedor;?></option>
	<?php 
	$sql = mysql_query("SELECT idFornecedor, fantasia FROM fornecedor WHERE status = '1' ORDER BY fantasia"); 
	while($empresa = mysql_fetch_object($sql)){ ?>
	<option value="<?php echo $empresa->idFornecedor;?>"><?php echo $empresa->fantasia;?></option>
	<?php } ?>	
	</select><br><br>
	
	<label>Ordem de serviço</label>
	<input type="text" name = "ordemServico" id = "ordemServico" value="<?php echo $linha->ordemServico;?>">
	<br><br>

	
	<label>Nota fiscal</label>
	<input type="text" name = "notaFiscal" id = "notaFiscal" value="<?php echo $linha->notaFiscal;?>">
	<br><br>

	<label>Status da Nota Fiscal</label>
	
	
	<?php
	if ($linha->statusNotaFiscal=="enviada"){?>
	<script type="text/javascript">
	
	$(document).ready(function () {                            
    $("#statusNotaFiscal2").prop('checked', true);        
	});
	</script>

	<?php
	}
	
	if ($linha->statusNotaFiscal=="naoEnviada"){?>
	<script type="text/javascript">
	$(document).ready(function () {                            
    $("#statusNotaFiscal1").prop('checked', true);        
	});
	</script>	
	<?php		
	
	}
	
	?>

	<label><input type="radio" name = "statusNotaFiscal" value="naoEnviada" id = "statusNotaFiscal1">Não enviada</label>
	<label><input type="radio" name = "statusNotaFiscal" value="enviada" id = "statusNotaFiscal2">Enviada</label><br><br>
	
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
	<?php
	if ($linha->statusServico=="andamento"){?>
	<script type="text/javascript">
	
	$(document).ready(function () {                            
    $("#statusServico1").prop('checked', true);        
	});
	</script>

	<?php
	}
	
	if ($linha->statusServico=="finalizado"){?>
	<script type="text/javascript">
	$(document).ready(function () {                            
    $("#statusServico2").prop('checked', true);        
	});
	</script>	
	<?php		
	
	}
	
	?>
	
	
	<label><input type="radio" name = "statusServico" value="andamento" id = "statusServico1">Em andamento</label>
	<label><input type="radio" name = "statusServico" value="finalizado" id = "statusServico2">Finalizado</label><br><br>
	
	<label>Descrição</label>
	<textarea name="descricao" form="mi"><?php echo $linha->descricao;?></textarea><br><br>
	

	
	<input type="submit" value="Editar"/>

	</fieldset>
	
</form>

<?php
} // fim do while
?> 
</body>
</html>