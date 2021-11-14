<div class="border-top-0 border border-bottom-0">
			<?php											
				if(isset($_GET['p'])){
					$busca= $_GET['p']."%";
					$title = "<div class='container text-center bg-lock text-white' >".$_GET['p']."</div>";
					$or = "";
				};
				if(isset($_POST['pesquisar'])){
					$_GET['p'] = "";
					$busca= "%".utf8_decode($_POST['pesquisar'])."%";
					$busca2= "%".utf8_encode($_POST['pesquisar'])."%";
					$or = "or complement LIKE '$busca2'";
					$title= "<div class='container p-1 pl-3 bg-lock text-white' >Resultado da pesquisa por: <b>".$_POST['pesquisar']."</b></div>";
				};

				if (isset($busca)){
					$result_ramais ="SELECT branch_line.*, section. `name` AS section_id FROM `branch_line`
						INNER JOIN `section` ON `branch_line`.`section_id` = section.`id`
						WHERE (section. `name` LIKE '$busca' or section. `name` = '$busca' $or) && status = 0 && private = 1 && type = 0
						ORDER BY section. `name`, `complement` ASC";
					$resultado_ramal = mysqli_query($connect, $result_ramais);


				    $resultado_ramal = mysqli_query($connect, $result_ramais);  ?>
				    <table class="rounded table table-striped table-hover table-sm m-0">
						<tbody class="text-left">
							<?php echo $title ?>
							<?php 
								if($resultado_ramal->num_rows > 0){
									while($row = mysqli_fetch_array($resultado_ramal)){ 
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
				<?php }else{
				
						foreach( range( 'A', 'Z' ) as $inicial ){

							$result = "SELECT branch_line.*, section. `name` AS section_id FROM `branch_line`
										INNER JOIN `section` ON `branch_line`.`section_id` = section.`id`
										WHERE section. `name` LIKE '$inicial%' && status = 0 && private = 1 && type = 0
										ORDER BY section. `name` ASC LIMIT 1";

							/*"SELECT * FROM branch_line WHERE  LIKE '$inicial%' && active = 1 order by fname asc limit 1";*/
					    	$resultado = mysqli_query($connect, $result); 
					    	while ($row = mysqli_fetch_array($resultado)){
					    		if(!empty($row['num'])){ ?>
					    			<div class="container text-center bg-lock text-white border-none" ><?php echo $inicial ?> </div>
					    		<?php };
					    	};
					    
							$result_ramais = "SELECT branch_line.*, section. `name` AS section_id FROM `branch_line`
											INNER JOIN `section` ON `branch_line`.`section_id` = section.`id`
											WHERE section. `name` LIKE '$inicial%' && status = 0 && private = 1 && type = 0
											ORDER BY section. `name`, `complement` ASC";


							/*"SELECT * FROM members WHERE fname LIKE '$inicial%' && active = 1 order by fname asc";*/
					    	$resultado_ramal = mysqli_query($connect, $result_ramais); ?>

							
							<table class="rounded table table-striped table-hover table-sm m-0">
								<tbody class="text-left">
									
									<?php while($row = mysqli_fetch_array($resultado_ramal)){ 
											if(!empty($row['complement'])){
													$s = " - ";
												}else{
													$s = "";
												} 
									?>
										<tr>
										<td class="pl-3" width="70%"><?php echo utf8_encode($row['section_id']); echo $s, utf8_decode($row['complement']) ?></td>
										<td class="text-center"><?php echo $row['num'] ?></td>
										</tr>
									<?php }; ?>
								</tbody>
							</table>	
					<?php }; 
				};
			?>		
</div>


