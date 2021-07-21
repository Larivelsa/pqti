<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Gerenciamento</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
</head>
<script src="../js/script.js" type = "text/javascript"></script>


<body>
<header>
<?php
include "header.php";
?>
</header>
<!--conteúdo, aqui que ficará formulário de cadastro-->
<section id = "conteudo">

<section class="cadastro">
<fieldset>
<legend>Gerenciamento de pcs</legend>
<a href="maquinaDesktop.php">Computador</a>
<a href="monitor.php">Monitor</a>
</fieldset>


<fieldset>
<legend>Gerenciamento de componentes</legend>
<a href="estabilizador.php">Estabilizadores/Nobreaks</a>
<a href="hd.php">HardDisks</a>
<a href="impressora.php">Impressoras</a>
<a href="memoria.php">Memórias</a>
<a href="placaMae.php">Placas-mãe</a>
<a href="processador.php">Processadores</a>
<a href="SO.php">Sistemas operacionais</a>
</fieldset>


<fieldset>
<legend>Gerenciamento administrativo</legend>
<a href="departamento.php">Departamentos</a>
<a href="fornecedor.php">Fornecedores</a>
<a href="montadora.php">Marca/Montadora</a>
<a href="usuario.php">Usuários</a>
</fieldset>

</section>
</section>
<!--rodapé-->
<footer>
<?php

?>
</footer>
</body>
</html>
