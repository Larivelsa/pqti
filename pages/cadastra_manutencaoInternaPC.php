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
	
		
		$(document).ready(function(){
		$('#departamento').change(function(){
		$('#bemPatrimonial').load('listaBemPatrimonial.php?idDepartamento='+$('#departamento').val());
		});
		});
		
		
		
			
		$(document).ready(function(){
		$('#bemPatrimonial').change(function(){
		$('#processador').load('listaProcessador.php?bemPatrimonial='+$('#bemPatrimonial').val());
		});
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


	<form action = "../sql/cadastra_manutencaoInternaPC_sql.php" = method="post" id="mp">

		<fieldset>
		
		<legend>Registrar manutenção interna de PC</legend>

			<label>Departamento</label>
			<select name='departamento' id='departamento'>
			<option value="...">Selecione...</option>
			<?php 

			$sql = mysql_query("SELECT * FROM departamento WHERE status='1' ORDER BY nome");
			while($departamento = mysql_fetch_object($sql)): ?>
					<option value="<?php echo $departamento->idDepartamento ?>"><?php echo $departamento->nome?></option>
			<?php endwhile; ?>

			</select><br><br>
			
			<div id="bemPatrimonial"name="bemPatrimonial"></div><br>
		
			<!--<div id="processador"name="processador"></div><br><br>-->

			<label>Data de entrada</label>
			<input type="date" name = "dataEntrada" id = "dataEntrada"><br><br>

			<label>Data de saída</label>
			<input type="date" name = "dataSaida" id = "dataSaida"><br><br>

			<label>Responsável</label>
			<select name="responsavel">
			<option value="...">Selecione...</option>
			<?php 
			$sql = mysql_query("SELECT nome FROM usuario WHERE status = '1' ORDER BY nome");  
			while($usuario = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $usuario['nome'] ?>"><?php echo $usuario['nome'] ?></option>
			<?php } ?>
			</select><br><br>


			<label>Descrição</label>
			<textarea name="descricao" form="mp"></textarea><br><br>

			<input type="submit" value="Registrar">
			<input type="button" value="Voltar" onclick="location.href= 'manutencaoInternaPC.php'">
			
		</fieldset>
		
	</form>




</section>
<!--rodapé-->
<footer>
<?php

?>
</footer>
</body>
</html>