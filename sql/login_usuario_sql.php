<?php
include("login_usuario.class.php");

$email = addslashes($_POST['email']);
$senha = addslashes($_POST['senha']);

logar_usuario($email,$senha);

header("Location: ../index.php");

?>