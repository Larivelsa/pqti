<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<title>Cadastro de estabilizador/nobreak</title>
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

<section class="cadastro_usuario">

<form action = "../sql/cadastra_estabilizador_sql.php" = method="post">

<fieldset>
<legend>Cadastro de estabilizador/nobreak</legend>

<label>Tipo</label>
<select name="tipo" >
<option value="estabilizador">Estabilizador</option>
<option value="nobreak">Nobreak</option>
<select><br><br>

<label>Marca</label>
<input type="text" name = "marca" id = "marca"><br><br>

<label>Modelo</label>
<input type="text" name = "modelo" id = "modelo"><br><br>

<label>Potência</label>
<input type="text" name = "potencia" id = "potencia"><br><br>

<label>Voltagem</label>
<select name="voltagem">
<option value="110">110</option>
<option value="220">220</option>
<option value="bivolt">Bivolt</option>
<select><br><br>


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
