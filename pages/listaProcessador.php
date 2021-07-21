<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
 
$bemPatrimonial = $_GET['bemPatrimonial'];
 
$sql = mysql_query("SELECT bemPatrimonial, processador
FROM maquinaDesktop
WHERE bemPatrimonial = '$bemPatrimonial'");
 
echo "<label>Processador</label>";
while($b = mysql_fetch_object($sql)){
    echo "<label id='processador'>$b->processador</label>";
}
?>