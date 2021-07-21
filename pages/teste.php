<?php
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";

$sql = mysql_query("SELECT * FROM departamento ORDER BY departamento");

?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
  <head>
    <link href = "../css/style.css" rel = "stylesheet" type="text/css">
    <title>Atualizando combos com jquery</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script type="text/javascript" src="../js/jquery-1.6.4.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#departamento').change(function(){
            $('#marca').load('listaMarca.php?departamento='+$('#departamento').val());
        });
    });
    </script>
  </head>
  <body>
  <h1>Atualizando combos com jquery</h1>
    <label>Departamento:</label>
    <select name="departamento" id="departamento">
    <?php while($reg = mysql_fetch_object($sql)): ?>
        <option value="<?php echo $reg->departamento ?>"><?php echo $reg->departamento?></option>
    <?php endwhile; ?>
    </select>
    <br /><br />
    <div id="marca"></div>
  </body>
</html>