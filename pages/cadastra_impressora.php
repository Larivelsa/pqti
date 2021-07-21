<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
 
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
<title>Cadastro de impressora</title>
<link href = "css/style.css" rel = "stylesheet" type="text/css">
<script src="../js/script.js" type = "text/javascript"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery.maskMoney.js" type="text/javascript"></script>

<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery.maskMoney.js" type="text/javascript"></script>

<script type="text/javascript">
	$(document).ready(function () {     

	$("#valor").maskMoney({showSymbol:true, symbol:"R$ ", decimal:"."});
	});

        $(document).ready(function(){
              $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."});
        });
</script>

</head>




<body>
<header>
<?php
include "header.php";
?>
</header>



<body>
<!--conteúdo, aqui que ficará formulário de cadastro-->
<section id = "conteudo">

<section class="cadastro">
<form action = "../sql/cadastra_impressora_sql.php" = method="post"><br><br>

		<fieldset>
		<legend>Cadastro de impressora</legend>
		<label>Bem patrimonial</label>
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

		<label>Valor R$</label>
		<input type="text" name="valor" id="valor" class="valor"><br><br>

		<label>Data de aquisição</label>
		<input type="date" name="dataAquisicao" id="dataAquisicao"><br><br>

		<label>Tempo de garantia em meses</label>
		<input type="text" name="tempoGarantia" id="tempoGarantia"><br><br>

		<label>Departamento</label>
		<select name="departamento">
		<option value="85">Selecione...</option>
		<?php 
		$sql = mysql_query("SELECT idDepartamento, nome FROM departamento WHERE status = '1' ORDER BY nome");  
		while($departamento = mysql_fetch_array($sql)) { ?>
		<option value="<?php echo $departamento['idDepartamento'] ?>"><?php echo $departamento['nome'] ?></option>
		<?php } ?>
		</select><br><br>


		<label>Marca</label>
		<select name=marca>
		<option value="21">Selecione...</option>
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
		<input type="text" name="modelo" id="modelo"><br><br>

		<label>Tipo</label>
		<select name=tipo>
		<option value="...">Selecione...</option>
		<option value="tinta">Jato de tinta</option>
		<option value="laser/monocolor">Laser monocolor</option>
		<option value="laser/colorida">Laser colorido</option>
		<option value="plotter">Plotter</option>
		<option value="térmica">Térmica</option>
		<option value="sublimação">Sublimação</option>
		<select><br><br>

		<label>Conectividade</label>
		<select name=conectividade>
		<option value="...">Selecione...</option>
		<option value="rede">Rede</option>
		<option value="USB">USB</option>
		<select><br><br>

		<label>Voltagem</label>
		<select name=voltagem>
		<option value="...">Selecione...</option>
		<option value="110">110</option>
		<option value="220">220</option>
		<option value="bivolt">Bivolt</option>
		<select><br><br>

		<input type="submit" value="Cadastrar">
		<input type="button" value="Voltar" onclick="location.href= 'impressora.php'">
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
