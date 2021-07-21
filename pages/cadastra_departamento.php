<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Cadastro de departamentos</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
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

<form action = "../sql/cadastra_departamento_sql.php" = method="post" id="mq">

<fieldset>
<legend>Cadastrar departamento</legend>

<label>Nome</label>
<input type="text" name = "nome" id = "nome"><br><br>

<label>Observação</label>
<textarea name="observacao" form="mq"></textarea><br><br>


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
