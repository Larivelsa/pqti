<?php session_start("login_usuario"); 
session_destroy(); 
header("Location: login.php"); exit; ?>
