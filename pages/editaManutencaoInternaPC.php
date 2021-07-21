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
$idManutencaoInterna = $_GET['idManutencaoInterna']; // Recebendo o valor vindo do link

$sql = mysql_query("SELECT manutencaoInternaPC.idManutencaoInterna, manutencaoInternaPC.departamentoID, manutencaoInternaPC.bemPatrimonial, manutencaoInternaPC.dataEntrada, manutencaoInternaPC.dataSaida, manutencaoInternaPC.responsavel, manutencaoInternaPC.descricao, departamento.idDepartamento, departamento.nome AS departamento
	FROM manutencaoInternaPC
	INNER JOIN departamento ON departamento.idDepartamento=manutencaoInternaPC.departamentoID
	WHERE idManutencaoInterna = '".$idManutencaoInterna."'
	AND manutencaoInternaPC.status=1"); 

// Há variável $resultado faz uma consulta em nossa tabela selecionando somente o registro desejado
while($linha = mysql_fetch_object($sql)) //Já a instrução while faz um loop entre todos os registros e armazena seus valores na variável $linha
{ 
?>


	<form action = "../sql/edita_manutencaoInternaPC_sql.php" = method="post" id="mp">

		<fieldset>
		
		<legend>Edita manutenção interna de PC</legend>
		<input type="hidden" name="idManutencaoInterna" value="<?php echo $linha->idManutencaoInterna; ?>"/> 

			<label>Bem Patrimonial  </label><label id = "bemPatrimonial" name = "bemPatrimonial"><?php echo $linha->bemPatrimonial;?></label><br><br>
		
			<label>Departamento</label>
			<label id = "departamento" name = "departamento"><?php echo $linha->departamento;?></label><br><br>

			

			<label>Data de entrada</label>
			<input type="date" name = "dataEntrada" id = "dataEntrada" value="<?php echo $linha->dataEntrada;?>"><br><br>

			<label>Data de saída</label>
			<input type="date" name = "dataSaida" id = "dataSaida" value="<?php echo $linha->dataSaida;?>"><br><br>

			<label>Responsável</label>
			<select name="responsavel">
			<option value="<?php echo $linha->responsavel;?>"><?php echo $linha->responsavel;?></option>
			<?php 
			$sql = mysql_query("SELECT nome FROM usuario WHERE status = '1' ORDER BY nome");  
			while($usuario = mysql_fetch_array($sql)) { ?>
			<option value="<?php echo $usuario['nome'] ?>"><?php echo $usuario['nome'] ?></option>
			<?php } ?>
			</select><br><br>


			<label>Descrição</label>
			<textarea name="descricao" form="mp"><?php echo $linha->descricao;?></textarea><br><br>

			<input type="submit" value="Alterar">
			<input type="button" value="Voltar" onclick="location.href= 'manutencaoInternaPC.php'">
			
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