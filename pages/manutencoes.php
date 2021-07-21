<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Manutenções</title>
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

<section class="manutencoes">


<fieldset>
<legend>Gerenciamento de manutenção interna</legend>
<a href="manutencaoInternaPC.php">Manutenções de pcs</a><br>
<a href="manutencaoInternaImpressora.php">Manutenções internas de impressoras</a><br>
<a href="manutencaoInternaOutros.php">Manutenções internas em geral</a>
</fieldset>


<fieldset>
<legend>Gerenciamento de manutenção externa (por outras empresas)</legend>
<a href="manutencaoImpressora.php">Manutenções de impressoras</a><br>
<a href="manutencaoExternaOutros.php">Manutenções externas em geral</a>
</fieldset>

</section>
</section>



<footer>
<?php

?>
</footer>
</body>
</html>
