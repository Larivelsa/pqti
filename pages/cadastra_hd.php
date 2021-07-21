<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<title>Cadastro de computador</title>
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

<form action = "../sql/cadastra_hd_sql.php" = method="post">

<fieldset>
<legend>Cadastro de HD</legend>

<label>Marca</label>
<input type="text" name="marca" id="marca"><br><br>

<label>Modelo</label>
<input type="text" name="modelo" id="modelo"><br><br>

<label>Interface</label>
<input type="text" name="interfacee" id="interfacee"><br><br>

<label>Capacidade</label>
<input type="text" name="capacidade" id="capacidade"><br><br>

<label>Velocidade</label>
<input type="text" name="velocidade" id="velocidade"><br><br>

<label>Cache</label>
<input type="text" name="cache" id="cache"><br><br>

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
