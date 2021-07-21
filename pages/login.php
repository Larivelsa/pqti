<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

session_start("login");
if (isset($_SESSION['email'])){
header('Location:../index.php');
}
?>

<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>

<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<title>Área de login</title>
<link href = "../css/style.css" rel = "stylesheet" type="text/css">
</head>
<script src="../js/script.js" type = "text/javascript"></script>
<script type="text/javascript" src="../js/jquery-1.6.4.js"></script>


<body id="corpoLogin">
<!--conteúdo, aqui que ficará formulário de cadastro-->
<section id = "conteudoLogin">
<section id="logo_login">
<img src="../img/logo.png" alt="logotipo PqTI" />
</section>


<section id="login">
<form action = "../sql/login_usuario_sql.php" = method="post">
<input placeholder="Digite o e-mail cadastrado" type="email" name = "email" id = "emailLogar"><br>
<input placeholder="Digite sua senha" type="password" name = "senha" id = "senhaLogar"><br>
<input id="btLogin" type="submit" value="Iniciar sessão">
</form>
</section>


</section>
<!--rodapé-->
<footer>
</footer>
</body>
</html>
