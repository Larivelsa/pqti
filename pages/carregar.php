<?php 
include "../function/mysqlconecta.php";
include "../function/mysqlexecuta.php";
 
 $sql = mysql_query("SELECT * FROM departamento WHERE status = '1' ORDER BY nome"); 
 $numRegistros = mysql_num_rows($sql);

?>

<select name="departamento" onchange="CarregaItens(this.value)">
  <?php for($i=0;$i&lt;$numRegistros;$i++){
     $dados = mysql_fetch_array($sql);
     ?>
</select>
 
<select name="departamento" onchange="CarregaItens(this.value)">
<option value="<? echo $dados['nome']?>"><? echo $dados['nome']?></option>
</select>

<select id="departamento" name="departamento" onchange="CarregaItens(this.value)"></select>

<script type="text/javascript" language="javascript">
function CarregaItens(nome)
{
	if(nome){
		var myAjax = new Ajax.Updater('itensAjax','carrega_itenss.php?nome='+nome,
		{
			method : 'get',
		}) ;
	}	
}
</script>

<?
 
$nome = $_GET['nome'];
 
$sql = mysql_query("SELECT marca FROM maquinaDesktop WHERE departamento=$nome");
$numRegistross = mysql_num_rows($sql);
 
?>
<select name="itens" id="itens">
<? for($j=0;$j<$numRegistross ;$j++){
	$dados = mysql_fetch_array($sql);
?>
	<option value="<? echo $dados['marca']?>"><? echo $dados['marca']?></option>
<? }?>
</select>