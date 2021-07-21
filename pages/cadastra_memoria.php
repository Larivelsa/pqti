<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<title>Cadastro de memória</title>
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
<!--conteúdo, aqui que ficará formulário de cadastro-->


<section class="cadastro">

<form action = "../sql/cadastra_memoria_sql.php" = method="post">

<fieldset>
<legend>Cadastro de memória</legend>

<label>Marca</label>
<input type="text" name="marca" id="marca"><br><br>

<label>Tipo</label>
<input type="text" name="tipo" id="tipo"><br><br>

<label>Capacidade</label>
<input type="text" name="capacidade" id="capacidade"><br><br>


<input type="submit" value="Cadastrar">
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
