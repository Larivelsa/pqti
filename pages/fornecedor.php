<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Fornecedor</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
</head>
<script src="../js/script.js" type = "text/javascript"></script>


<body>
<header>
<?php
include "header.php";
?>
</header>

<section id = "conteudo">


	<a href="cadastra_fornecedor.php">Registrar fornecedor</a>
	<form name="busca" method="post" action="<?php echo $_SERVER['PHP_SELF']?>?a=buscar"> 
	<input type="text" name="conteudoBusca" placeholder="Digite a empresa para pesquisar" /> 
	<input type="submit" value="Buscar" /> 
	</form>
	
	
	<?php
	$a = $_GET['a'];
	
	if ($a == "buscar") {
	
	// Pegamos a palavra 
	$conteudoBusca = trim($_POST['conteudoBusca']);   
	
	// Verificamos no banco de dados produtos equivalente a palavra digitada 
	
	$sql = mysql_query("SELECT * FROM fornecedor WHERE fantasia LIKE '%".$conteudoBusca."%' AND status = '1' ORDER BY fantasia");   
	
	// Descobrimos o total de registros encontrados 
	$numRegistros = mysql_num_rows($sql);   
	// Se houver pelo menos um registro, exibe-o 
	if ($numRegistros != 0) { // Exibe os produtos e seus respectivos preços 
	?>
	
	<!-- Lista resultados -->
	<table id="busca" name="busca" class="busca">	
	
	<tr>
	<th>Empresa</th>
	<th>Razão Social</th>
	<th>CNPJ</th>
	<th>Inscrição Estadual</th>
	<th>Nome do contato</th>
	<th>Telefone</th>
	<th>E-mail</th>
	<th>Rua</th>
	<th>Número</th>
	<th>Bairro</th>
	<th>Complemento</th>
	<th>UF</th>
	<th>Cidade</th>
	<th>Observações</th>
	</tr>
	
	<?php while ($fornecedor = mysql_fetch_object($sql)) {	
	?>

	
	<tr>
	<td><?php echo $fornecedor->fantasia;?></td>
	<td><?php echo $fornecedor->razaoSocial;?></td>	
	<td><?php echo $fornecedor->cnpj;?></td>
	<td><?php echo $fornecedor->ie;?></td>		
	<td><?php echo $fornecedor->contato;?></td>	
	<td><?php echo $fornecedor->telefone;?></td>	
	<td><?php echo $fornecedor->email;?></td>	
	<td><?php echo $fornecedor->rua;?></td>
	<td><?php echo $fornecedor->numero;?></td>
	<td><?php echo $fornecedor->bairro;?></td>
	<td><?php echo $fornecedor->complemento;?></td>
	<td><?php echo $fornecedor->uf;?></td>
	<td><?php echo $fornecedor->cidade;?></td>
	<td><?php echo $fornecedor->observacao;?></td>
	</tr>	
	



	<?php	
	}	
	// Se não houver registros 
	} else 
	
	{ 
	
	echo "Nenhum fornecedor foi encontrado com a palavra ".$conteudoBusca.""; } 
	} // fim do if
	
	?> 
    </table>
	
	</section>

<!--rodapé-->
<footer>
<?php

?>
</footer>
</body>
</html>
