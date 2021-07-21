<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
$ll=null;
unset($ll);
 
$departamento = $_GET['nome'];
 
$sql = mysql_query("SELECT * FROM maquinaDesktop WHERE departamento = '$departamento' ORDER BY departamento");
 
echo "<label>BEM PATRIMONIAL</label>
<select name='bemPatrimonial' id='bemPatrimonial'>";
while($m = mysql_fetch_object($sql)){
    echo "<option value='$m->bemPatrimonial'>$m->bemPatrimonial</option>";
	$ll=$m->bemPatrimonial;
	$lm=$m->marca;
}

echo "</select>";
echo $ll;
echo $lm;
 
?>