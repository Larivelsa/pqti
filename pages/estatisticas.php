<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Estatísticas</title>
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

<section class="estatisticas">

	<?php
	$sql = mysql_query("SELECT idMaquinaDesktop FROM maquinaDesktop WHERE status=1"); 
	$numRegistros1 = mysql_num_rows($sql);?> 

	<label>Número de máquinas do parque de TI</label><br>
	<label><?php echo $numRegistros1;?></label><br><br>
	
	<?php $sql = mysql_query("SELECT idManutencaoInterna FROM manutencaoInternaPC WHERE status=1"); 
	$numRegistros2 = mysql_num_rows($sql);?> 
	
	<label>Número de manutenções em máquinas</label><br>
	<label><?php echo $numRegistros2;?></label>	

</section>
</section>



<footer>
<?php

?>
</footer>
</body>
</html>
