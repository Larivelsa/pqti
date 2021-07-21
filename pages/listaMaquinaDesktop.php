			?>
			<table id="busca" name="busca" class="busca">	
			
			<tr>
			<th>Bem patrimonial</th>
			<th>Fornecedor</th>
			<th>Nota Fiscal</th>
			<th>Valor</th>
			<th>Data de aquisição</th>
			<th>Tempo de garantia</th>
			<th>Departamento</th>
			<th>Marca</th>
			<th>Sistema operacional</th>
			<th>Placa-mãe</th>
			<th>Processador</th>
			<th>HD</th>
			<th>Mem. slot 1</th>
			<th>Mem. slot 2</th>
			<th>Fonte</th>
			<th>Descrição</th>
			</tr>
			
			<?php while ($pc = mysql_fetch_object($sql)) {	
			?>

			
			<tr>
			<td><?php echo $pc->bemPatrimonial;?></td>
			<td><?php echo $pc->empresa;?></td>
			<td><?php echo $pc->notaFiscal;?></td>
			<td><?php echo $pc->valor;?></td>
			<td><?php echo date('d/m/Y',strtotime($pc->dataAquisicao));?></td>
			<td><?php echo $pc->tempoGarantia;?></td>
			<td><?php echo $pc->departamento;?></td>
			<td><?php echo $pc->marca;?></td>
			<td><?php echo $pc->sistemaOperacional;?></td>
			<td><?php echo $pc->placaMae;?></td>
			<td><?php echo $pc->processador;?></td>	
			<td><?php echo $pc->hd;?></td>
			<td><?php echo $pc->slot1;?></td>		
			<td><?php echo $pc->slot2;?></td>	
			<td><?php echo $pc->fonte;?></td>	
			<td><?php echo $pc->descricao;?></td>	
			<td><a href="editaMaquinaDesktop.php?idMaquinaDesktop=<?php echo $pc->idMaquinaDesktop; ?>">Editar</a></td> 
			<td><a href="../sql/deletaMaquinaDesktop_sql.php?idMaquinaDesktop=<?php echo $pc->idMaquinaDesktop; ?>">Excluir</a></td>
			</tr>	
			



			<?php	
			}	
			// Se não houver registros 
			} else 
			
			{ 
			
			echo "Nenhuma máquina foi encontrado com a palavra ".$conteudoBusca.""; } 
			} // fim do if do processador
			
			?> 
			</table>
			<?php