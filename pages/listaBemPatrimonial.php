<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
 
$departamento = $_GET['idDepartamento'];
 
$sql = mysql_query("SELECT maquinaDesktop.*, departamento.* 
FROM maquinaDesktop 
INNER JOIN departamento ON departamento.idDepartamento = maquinaDesktop.departamentoID
WHERE maquinaDesktop.departamentoID = '$departamento' ORDER BY departamento.nome");
 
echo "<label>BEM PATRIMONIAL</label>
<select name='bemPatrimonial' id='bemPatrimonial'>";
while($m = mysql_fetch_object($sql)){
    echo "<option value='$m->bemPatrimonial'>$m->bemPatrimonial</option>";
	}

echo "</select>";

 
?>



