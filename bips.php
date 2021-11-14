<?php
$sql ="SELECT branch_line.*, section. `name` AS section_id FROM `branch_line`
						INNER JOIN `section` ON `branch_line`.`section_id` = section.`id`
						WHERE status = 0 && private = 1 && type = 1
						ORDER BY section. `name`, `complement` ASC";
					$resultado_bip = mysqli_query($connect, $sql);
?>
 <table class="rounded table table-striped table-hover table-sm m-0">
	<tbody class="text-left">
		<div class="container p-1 pl-3 bg-lock text-white text-center"><b>Bips</b></div>
		<div class='alert alert-warning m-0'role='alert'>
				<b>Utilizando o Bip:</b><br>
				Discar 51 + Número do Bip + Número do ramal solicitante.			
		</div>
		<?php 
			if($resultado_bip->num_rows > 0){
				while($row = mysqli_fetch_array($resultado_bip)){ 
					if(!empty($row['complement'])){
						$s = " - ";
					}else{
						$s = "";
					} ?>
					<tr>
					<td class="pl-3" width="70%"><?php echo utf8_encode($row['section_id']); echo $s, utf8_decode($row['complement']) ?></td>
					<td class="text-center"><?php echo $row['num'] ?></td>
					</tr>
				<?php }; 
			}else{ 
				?>
				<div class=" border-0 text-center p-3">
					Sem resultado, realize uma nova pesquisa ou <a href="./">clique aqui </a>para voltar ao início.
				</div>
		<?php	};?>
			
		
	</tbody>
</table>