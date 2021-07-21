<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Cadastro de usuário</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
<script src="../js/script.js" type = "text/javascript"></script>
<script src="../js/jquery.js" type = "text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" ></script>
<!-- Inclusão do Jquery Validate -->
<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.6/jquery.validate.js" ></script>
<script>
$(document).ready(function(){


				$('#formulario').validate({
					rules:{ 
						login:{ required: true, remote: 'verifica.php' }
					},
					messages:{
						login:{ required: 'Este Campo é obrigatorio' , remote: 'Este Login já está em uso.'}
					}
					
				});


	
  
  
  
  
  
$('form').submit(function() {

if($('#nome').val()=='') {
$("label[for='nome']").text('O campo nome deve ser preenchido.');
return false;
} else { $("label[for='nome']").text(''); }

if($('#email').val()=='') {
$("label[for='email']").text('O campo email deve ser preenchido.');
return false;
} else { $("label[for='email']").text(''); }

});
  
  
});



//verificar se alguns campos estão em branco

</script>
</head>



<body>



<header>
<?php
include "header.php";
?>
</header>
<!--conteúdo, aqui que ficará formulário de cadastro-->
<section id = "conteudo">

<section id ="aviso">
<?php
if (!empty($_GET["aviso"])){
echo "Cadastro realizado com sucesso!";
}

?>
</section>

<section class="cadastro_usuario">

<form id="formulario" action = "../sql/cadastra_usuario_sql.php" = method="post">

<fieldset>
<legend>Cadastro de usuário</legend>
<label>Nome</label>
<input type="text" name = "nome" id = "nome"><br><br>
<label id="alerta" for="nome"></label><br><br>

<label>Sobrenome</label>
<input type="text" name = "sobrenome" id = "sobrenome"><br><br>
<label id="alerta" for="sobrenome"></label><br><br>

<label>E-mail para login</label>
<input type="email" name = "email" id = "email"><br><br>
<label id="alerta" for="email"></label><br><br>

<label>Senha</label>
<input type="password" name="senha" id="senha"><br><br>
<label id="alerta" for="senha"></label><br><br>

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
