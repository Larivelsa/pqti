<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<title>Cadastro de fornecedor</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
</head>
<script src="../js/script.js" type = "text/javascript"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery.maskedinput-1.3.min.js"></script>

<script>
jQuery(function($){
       $("#telefone").mask("(999) 9999-9999");
       $("#cnpj").mask("99.999.999/9999-99");
});
</script>

<body>
<header>
<?php
include "header.php";
?>
</header>


<!--conteúdo, aqui que ficará formulário de cadastro-->
<section id = "conteudo">

		<section class="cadastro">

		<form action = "../sql/cadastra_fornecedor_sql.php" = method="post" id="mq">

		<fieldset>
		<legend>Cadastro de fornecedor</legend>
		<label>Nome fantasia</label>
		<input type="text" name = "fantasia" id = "fantasia"><br><br>

		<label>Razão Social</label>
		<input type="text" name = "razaoSocial" id = "razaoSocial"><br><br>

		<label>CNPJ</label>
		<input type="text" name = "cnpj" id = "cnpj"><br><br>

		<label>Inscrição Estadual</label>
		<input type="text" name="ie" id="ie"><br><br>

		<label>Contato</label>
		<input type="text" name="contato" id="contato"><br><br>

		<label>Telefone</label>
		<input type="text" name="telefone" id="telefone"><br><br>

		<label>E-mail</label>
		<input type="text" name="email" id="email"><br><br>


		<label>Rua</label>
		<input type="text" name="rua" id="rua"><br><br>

		<label>Número</label>
		<input type="text" name="numero" id="numero"><br><br>

		<label>Bairro</label>
		<input type="text" name="bairro" id="bairro"><br><br>

		<label>Complemento</label>
		<input type="text" name="complemento" id="complemento"><br><br>

		<label>UF</label>
		<input type="text" name="uf" id="uf"><br><br>

		<label>Cidade</label>
		<input type="text" name="cidade" id="cidade"><br><br>

		<label>Observação</label>
		<textarea name="descricao" form="mq"></textarea><br><br>

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
