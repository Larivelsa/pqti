<?php
include "function/mysqlconecta.php";
include "function/mysqlexecuta.php";


            session_start("login_usuario");
            
            if(empty($_SESSION['email'])){
                header("location: pages/login.php");
            }
			$nome=$_SESSION['nome'];
        ?>

<!doctype html>
<head>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
<title>Bem-vindo ao PqTI</title>
<link href = "css/style.css" rel = "stylesheet" type="text/css">
<script src="js/script.js" type = "text/javascript"></script>
</head>


	
<body>

	<header>
	<?php
	include "header_index.php";
	?>
		
	</header>
	
	<section id = "conteudo">
	<label>Olá, <?php echo $nome;?>!</label><br><br>
	<fieldset>
	<legend>Acesso direto</legend>
	<ul>
	<li><a href="pages/cadastra_manutencaoInternaPC.php">REGISTRAR MANUTENÇÃO INTERNA EM COMPUTADOR</a></li>
	<li><a href="pages/cadastra_manutencaoInternaImpressora.php">REGISTRAR MANUTENÇÃO EM IMPRESSORA</a></li>
	<li><a href="pages/cadastra_manutencaoInternaOutros.php">REGISTRAR MANUTENÇÃO INTERNA GERAL</a></li>
	<li><a href="pages/cadastra_manutencaoImpressora.php">REGISTRAR MANUTENÇÃO EXTERNA IMPRESSORA</a></li>
	<li><a href="pages/cadastra_manutencaoExternaOutros.php">REGISTRAR MANUTENÇÃO EXTERNA GERAL</a></li>
	</ul>
	</fieldset>
	</section>

	<footer>
	<?php
	//include "pages/rodape.php";
	?>
	</footer>
</body>
	
	
</html>
