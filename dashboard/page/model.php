<?php
	if($title == "Linhas Diretas"){
		$by = "`description`, `complement` ASC";
	}else{
		$by = "section. `name`, `complement` ASC";
	}
	
	if(isset($_POST['setor'])){
		if($title == "Linhas Diretas"){
			$by = "`description`, `complement` ASC";
		}else{
			$by ="section. `name`, `complement` ASC";
		}
	}
	if(isset($_POST['numero'])){
		$by ="num";
	}if(isset($_POST['status'])){
		$by ="private. `name` ASC";
	}if(isset($_POST['usuario'])){
		$by ="user. `name` ASC";
	}
	if(isset($_POST['data'])){
		$by ="dt DESC";
	}

	if(isset($_POST['filtrar'])){

		$opcao = $_POST['opcao'];
		$busca = "%".utf8_decode($_POST['busca'])."%";
		
		if($opcao == 0){
			$where = "";
		}elseif($opcao == 1){
			if($title == "Linhas Diretas"){
				$where = "&& description LIKE '$busca'";
				$by = " `description`, `complement` ASC";
			}else{
				$where = "&& section. `name` LIKE '$busca'";
				$by = " section. `name`, `complement` ASC";
			}
		}elseif($opcao == 2) {
			$where = "&& num LIKE '$busca'";
			$by = " section. `name`, `complement` ASC";
		}elseif ($opcao == 3) {
			$where = " && user. `name` LIKE '$busca'";
			$by = " section. `name`, `complement` ASC";
		}elseif ($opcao == 4) {
			$where = " && private=2";
			$by = " section. `name`, `complement` ASC";
		}elseif ($opcao == 5) {
			$where = " && private=1";
			$by = " section. `name`, `complement` ASC";
		}
	}

	$sql = "SELECT branch_line.*, section. `name` AS section_id, private. `name` AS private , user. `name` AS insert_by FROM `branch_line` 
		INNER JOIN `section` ON `branch_line`.`section_id` = section.`id`
		INNER JOIN `private` ON `branch_line`.`private` = private.`id`
		INNER JOIN `user` ON `branch_line`.`insert_by` = user.`id`
		WHERE branch_line. `status` = 0 && $type $where
		ORDER BY $by";


	$sql = mysqli_query($connect, $sql);
	$total = mysqli_num_rows($sql);
	
	if($title == "Linhas Diretas"){
		$item = "Descrição";
	}else{ 
		$item = "Setor";
	}
?>

<div class="container-fluid p-4 m-0">
	<div class="d-flex name-page align-items-center">
		<h3 class="d-inline m-0 mr-2"><?php echo $title ?></h3>
			<div class="">
				<a href="<?php echo $add ?>">
					<svg width="1.4em" height="1.4em" viewBox="0 0 16 16" class="bi bi-telephone-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					  <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.471 17.471 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969zM12.5 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H12V.5a.5.5 0 0 1 .5-.5z"/>
					  <path fill-rule="evenodd" d="M12 3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H13v2.5a.5.5 0 0 1-1 0v-3z"/>
					</svg>
				</a>			
			</div>
	</div>
	<div class="mt-4">
		<form method="POST">
			<label for="filtro"><b>Filtrar</b></label>
			<div class="form-row">
				
				<div class="form-group col-md-4">
					<select class="form-control" name="opcao" required="">
						<option selected="" value="0">Todos</option>
						<option value="1"><?php echo $item ?></option>
						<option value="2">Número</option>
						<option value="3">Usuário</option>
						<option value="4">Privado</option>
						<option value="5">Público</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<input type="text" name="busca" class="form-control">
				</div>
				<div class="form-group col-md-4 d-flex justify-content-between">
					<button class="btn btn-primary" name="filtrar">
						Filtrar
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-funnel-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
						</svg>
					</button>
					<div class="alert alert-primary mb-0 ml-2 d-flex align-items-center p-0 pr-2 pl-2">Total de registros: <?php echo $total ?></div>
				</div>
			</div>
		</form>
		<table class="rounded table table-striped table-hover table-sm m-0">
			<tbody class="">
				<tr>
					<form method="POST">
						<td width="50%"><button class="btn p-0 dropdown-toggle" name="setor"><b><?php echo $item ?></b></button></td>
						<td><button class="btn p-0 dropdown-toggle" name="numero"><b>Número</b></button></td>
						<td><button class="btn p-0 dropdown-toggle" name="status"><b>Status</b></button></td>
						<td><button class="btn p-0 dropdown-toggle" name="usuario"><b>Usuário</b></button></td>
						<td><button class="btn p-0 dropdown-toggle" name="data"><b>Data</b></button></td>
					</form>
				</tr>
				<?php while($result = $sql->fetch_array()){ ?>
				<tr>
					<?php

						if(!empty($result['complement'])){
							$s = " - ";
						}else{
							$s = "";
						}

						if($title == "Linhas Diretas"){ ?>
							<td><a href="?p=e&id=<?php echo $result['id'] ?>&t=<?php echo $result['type'] ?>" class="text-black"><?php echo utf8_decode($result['description']); echo $s, utf8_decode($result['complement']);?></a></td>
					<?php }else{ ?>
					<td><a href="?p=e&id=<?php echo $result['id'] ?>&t=<?php echo $result['type'] ?>" class="text-black"><?php echo utf8_encode($result['section_id']); echo $s, utf8_decode($result['complement']) ?></a></td>
					<?php } ?>
					<td><?php echo $result['num'] ?></td>
					<td><?php echo utf8_encode($result['private']) ?></td>
					<td><?php echo $result['insert_by'] ?></td>
					<td><?php echo date_format(new DateTime($result['dt']), "d/m/Y"); ?></td>

				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>