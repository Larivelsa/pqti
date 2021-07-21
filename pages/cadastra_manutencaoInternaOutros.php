<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Manutenção interna geral</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery-1.6.4.js"></script>



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


<form action = "../sql/cadastra_manutencaoInternaOutros_sql.php" = method="post" id="mp">

<fieldset>
<legend>Registrar manutenção interna em geral</legend>


			<label>Data de entrada</label>
			<input type="date" name = "dataEntrada" id = "data"><br><br>

			<label>Data de saída</label>
			<input type="date" name = "dataSaida" id = "data"><br><br>

			<label>Departamento</label>
			<select name='departamento' id='departamento'>
			<option value="...">Selecione...</option>
			<?php 

			$sql = mysql_query("SELECT * FROM departamento ORDER BY nome");
			while($reg = mysql_fetch_object($sql)): ?>
					<option value="<?php echo $reg->idDepartamento ?>"><?php echo $reg->nome?></option>
			<?php endwhile; ?>

			</select><br><br>

			
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
			<textarea name="descricao" form="mp"></textarea><br>
			<p id="aviso">A descrição deverá conter palavras-chave ou o bem patrimonial, caso possua. Veja os exemplos. "Substituição de cooler de apoio de notebook, bem patrimonial XXXXX" ou "Trocar de fonte de alimentação do switch, marca XPTO" ou "Reestrutura da rede, sala da coordenação"</p>


			<input type="submit" value="Registrar">
			<input type="button" value="Voltar" onclick="location.href= 'manutencaoInternaOutros.php'">
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
