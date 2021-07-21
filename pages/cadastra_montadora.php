<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<title>Cadastro de marca/montadora</title>
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

<section class="cadastro">

<form action = "../sql/cadastra_montadora_sql.php" = method="post">

<fieldset>
<legend>Cadastro de marca/montadora</legend>


<label>Marca</label>
<input type="text" name="nome" id="nome"><br><br>


<label>Nacionalidade</label>
<input type="text" name="nacionalidade" id="nacionalidade"><br><br>

<label>Observação</label>
<input type="text" name="observacao" id="observacao"><br><br>

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
