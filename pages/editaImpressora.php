﻿<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Manutenção interna de PC</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">

    <script type="text/javascript" src="../js/jquery-1.6.4.js"></script>
    <script type="text/javascript">
		
		
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

<?php 
$idImpressora = $_GET['idImpressora']; // Recebendo o valor vindo do link

$sql = mysql_query("SELECT impressora.idImpressora, impressora.bemPatrimonial, impressora.empresa, impressora.notaFiscal, impressora.valor, impressora.dataAquisicao, impressora.tempoGarantia, impressora.departamentoID, impressora.marca, impressora.modelo, impressora.tipo, impressora.conectividade, impressora.voltagem, idDepartamento, departamento.nome AS departamento, fornecedor.idFornecedor, fornecedor.fantasia AS fornecedor
	FROM impressora
	INNER JOIN departamento ON departamento.idDepartamento=impressora.departamentoID
	INNER JOIN fornecedor ON fornecedor.idFornecedor=impressora.empresa
	WHERE idImpressora = '".$idImpressora."'
	AND impressora.status=1"); 

// Há variável $resultado faz uma consulta em nossa tabela selecionando somente o registro desejado
while($linha = mysql_fetch_object($sql)) //Já a instrução while faz um loop entre todos os registros e armazena seus valores na variável $linha
{ 
?>


	<form action = "../sql/edita_impressora_sql.php" = method="post" id="mp">

		<fieldset>
		
		<legend>Edita manutenção interna de PC</legend>
		<input type="hidden" name="idImpressora" value="<?php echo $linha->idImpressora; ?>"/> 

			<label>Bem Patrimonial  </label><label id = "bemPatrimonial" name = "bemPatrimonial"><?php echo $linha->bemPatrimonial;?></label><br><br>


			<label>Fornecedor</label>
			<select name="empresa">
			<option value="<?php echo $linha->empresa; ?>"><?php echo $linha->fornecedor; ?></option>
			<?php 
			$sql = mysql_query("SELECT idFornecedor, fantasia FROM fornecedor WHERE status = '1' ORDER BY fantasia"); 
			while($empresa = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $empresa['idFornecedor'] ?>"><?php echo $empresa['fantasia'] ?></option>
			<?php } ?>
			</select><br><br>

			<label>Nº Nota Fiscal</label>
			<input type="text" name = "notaFiscal" id = "notaFiscal" value="<?php echo $linha->notaFiscal; ?>"><br><br>

			<label>Valor R$</label>
			<input type="text" name="valor" id="valor" class="valor" value="<?php echo $linha->valor; ?>"><br><br>
			
			<label>Data de aquisição</label>
			<input type="date" name="dataAquisicao" id="dataAquisicao" value="<?php echo $linha->dataAquisicao; ?>"><br><br>
			
			<label>Tempo de garantia em meses</label>
			<input type="text" name="tempoGarantia" id="tempoGarantia" value="<?php echo $linha->tempoGarantia; ?>" ><br><br>
			
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
			
					<label>Marca</label>
		<select name=marca>
		<option value="<?php echo $linha->marca; ?>"><?php echo $linha->marca;?></option>
		<option value="Bematech">Bematech</option>
		<option value="Brother">Brother</option>
		<option value="Canon">Canon</option>
		<option value="Chronos">Chronos</option>
		<option value="CIS">CIS</option>
		<option value="Daruma">Daruma</option>
		<option value="Dymo">Dymo</option>
		<option value="Elgin">Elgin</option>
		<option value="Epson">Epson</option>
		<option value="HP">HP</option>
		<option value="Lexmark">Lexmark</option>
		<option value="Mecaf">Mecaf</option>
		<option value="Okidata">Okidata</option>
		<option value="Olivetti">Olivetti</option>
		<option value="Pertocheck">Pertocheck</option>
		<option value="Ricoh">Ricoh</option>
		<option value="Samsung">Samsung</option>
		<option value="Sharp">Sharp</option>
		<option value="Sweda">Sweda</option>
		<option value="Toshiba">Toshiba</option>
		<option value="Xerox">Xerox</option>
		<option value="Zebra">Zebra</option>
		<option value="Não especificada">Não especificada</option>
		<select><br><br>
			
		<label>Modelo</label>
		<input type="text" name="modelo" id="modelo" value="<?php echo $linha->modelo; ?>"><br><br>	
		
		<label>Tipo</label>
		<select name=tipo>
		<option value="<?php echo $linha->tipo; ?>"><?php echo $linha->tipo; ?></option>
		<option value="tinta">Jato de tinta</option>
		<option value="laser/monocolor">Laser monocolor</option>
		<option value="laser/colorida">Laser colorido</option>
		<option value="plotter">Plotter</option>
		<option value="térmica">Térmica</option>
		<option value="sublimação">Sublimação</option>
		<select><br><br>
		
		<label>Conectividade</label>
		<select name=conectividade>
		<option value="<?php echo $linha->conectividade; ?>"><?php echo $linha->conectividade; ?></option>
		<option value="rede">Rede</option>
		<option value="USB">USB</option>
		<select><br><br>

		<label>Voltagem</label>
		<select name=voltagem>
		<option value="<?php echo $linha->voltagem; ?>"><?php echo $linha->voltagem;?></option>
		<option value="110">110</option>
		<option value="220">220</option>
		<option value="bivolt">Bivolt</option>
		<select><br><br>


			<input type="submit" value="Alterar">
			<input type="button" value="Voltar" onclick="location.href= 'impressora.php'">
			
		</fieldset>
		
	</form>



<?php
}
?>
</section>
<!--rodapé-->
<footer>
</footer>
</body>
</html>