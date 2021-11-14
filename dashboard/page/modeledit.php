<?php
	$id_item = $_GET['id'];
	$sql = "SELECT * FROM branch_line WHERE id = '$id_item'";
	$sql = mysqli_query($connect, $sql);
	$sql = mysqli_fetch_array($sql);
	$setor = $sql['section_id'];
	$descricao = utf8_decode($sql['description']);
	$complemento = utf8_decode($sql['complement']);
	$numero = $sql['num'];
	$status = $sql['status'];
	$private = $sql['private'];
	$tipo = $sql['type'];
	$inserido_por = $sql['insert_by'];
	$dt = date_format(new DateTime($sql['dt']), "d/m/Y H:i");

	$busca_setores = "SELECT * FROM section ORDER BY name ASC";
	$busca_setores = mysqli_query($connect, $busca_setores);

	$busca_private = "SELECT * FROM private";
	$busca_private = mysqli_query($connect, $busca_private);

	$voltar = "";
		if($_GET['t'] == 0){
			$voltar = "?p=ramais";
		}elseif ($_GET['t'] == 1) {
			$voltar = "?p=bips";
		}else{
			$voltar = "?p=linhas-diretas";
		}

	if(isset($_POST['update'])){
		$u_id = $id_item;
		if($setor == 1){
			$u_setor = 1;
		}else{
			$u_setor = $_POST['setor'];
		};		
		$u_descricao = utf8_encode($_POST['descricao']);
		$u_complemento = utf8_encode($_POST['complemento']);
		$u_numero = $_POST['numero'];
		$u_private = $_POST['status'];
		$u_insert_by = $_SESSION['userId']; 
		$u_dt = date("Y-m-d H:i");
		
		if($numero != $u_numero){
			
			$busca = "SELECT branch_line.*, section. `name` AS section_id FROM `branch_line` INNER JOIN `section` ON `branch_line`.`section_id` = section.`id` WHERE num = '$u_numero' && status = 0 ";

		    $busca = mysqli_query($connect, $busca);
		    $busca = mysqli_fetch_assoc($busca);
		    $busca_num =  $busca['num'];
		    $busca_status = $busca['status'];
		    $busca_setor = utf8_encode($busca['section_id']);

			    if ($busca_num == $u_numero) {
			    	$_SESSION['insert'] = "<div class='alert alert-danger m-0 text-center mt-2'role='alert'>
				  								Número <b>".$busca_num."</b> já cadastrado com o setor <b>".$busca_setor."</b>		  								
											</div>";
			    }else{
			    	$sql = "UPDATE branch_line SET section_id = '$u_setor', description = '$u_descricao', complement = '$u_complemento', num = '$u_numero', private = '$u_private', insert_by = '$u_insert_by', dt = '$u_dt' WHERE id = '$u_id'";
			
					if($connect->query($sql) === TRUE) {
				        echo "<div class='m-2'>Atualizando...</div>";
				        printf('<script>window.location.href = "";</script>');
				    }
			    }
		}else{
			
		  $sql = "UPDATE branch_line SET section_id = '$u_setor', description = '$u_descricao', complement = '$u_complemento', num = '$u_numero', private = '$u_private', insert_by = '$u_insert_by', dt = '$u_dt' WHERE id = '$u_id'";
			
			if($connect->query($sql) === TRUE) {
				echo "<div class='m-2'>Atualizando...</div>";
				printf('<script>window.location.href = "";</script>');
		    }
		}

	}elseif(isset($_POST['deletar'])){
		 
		 $sql = "UPDATE branch_line SET status = 1, delete_by = '$id_user', dt_delete = '$dt_' WHERE id = '$id_item'";
			if($connect->query($sql) === TRUE) {
				echo "<div class='m-2'>Atualizando...</div>"; ?>
				<script>window.location.href = "<?php echo $voltar ?>";</script>
			<?php }
	}
?>
<div class="container-fluid p-4 m-0">
	<div class="d-flex justify-content-between name-page">
		<h4 class="d-inline m-0">Editar Informações</h4>
		<a href="<?php echo $voltar ?>">
			<svg width="1.6em" height="1.6em" viewBox="0 0 16 16" class="bi bi-arrow-left-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.354 10.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L6.207 7.5H11a.5.5 0 0 1 0 1H6.207l2.147 2.146z"/>
			</svg>
		</a>	
	</div>
	<?php 
		if(isset($_SESSION['insert'])){
			echo $_SESSION['insert'];
			unset($_SESSION['insert']);
		}
	?>
	 <form action="" method="POST">
	 	
	 	<?php
	 		if($setor == 1){ ?>
	 			<label for="setor">Setor / Unidade / Empresa</label>
	 			<input value="<?php echo $descricao ?>" class="form-control" type="text" name="descricao" maxlength="100" required="required">
	 			<input hidden="hidden" type="" name="setor">
	 		<?php }else{ ?>
	 			<label for="setor">Setor</label>
	 			<input hidden="hidden" type="" name="descricao">
	 			<select class="form-control" name="setor" required="required">
			 		<?php while($setor = $busca_setores->fetch_array()){ 
			 			if($setor['id'] == $sql['section_id']){
			 				$selec = "selected='selected'";
			 			}else{
			 				$selec = "";
			 			}
			 		?>
	 			<option <?php echo $selec ?> value="<?php echo $setor['id']?>"><?php echo utf8_encode($setor['name']) ?></option>
	 		<?php }?>
	 	</select>
	 <?php } ?>
	 	
	 	<label for="complemento">Complemento</label>
	 	<input value="<?php echo $complemento ?>" class="form-control" type="text" name="complemento" maxlength="100">
	 	<div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="número">Número</label>
		      <?php if($setor == 1){ ?>
		      	<input value="<?php echo $numero ?>" type="text" class="form-control" name="numero" minlength="14" maxlength="14" onkeypress="$(this).mask('(00) 0000-0000')" required="required">
		      <?php }else{ ?>
		      	<input value="<?php echo $numero ?>" type="text" class="form-control" name="numero" minlength="4" maxlength="4" onkeypress="$(this).mask('0000')" required="required">
		     <?php } ?>
		    </div>
		    <div class="form-group col-md-6">
		      <label for="status">Status</label>
		      <select class="form-control" name="status" required="required">
		      	<?php while($res_private = $busca_private->fetch_array()){ 
		      		
		      		if($res_private['id'] == $sql['private']){
	 					$selec = "selected='selected'";
		 			}else{
		 				$selec = "";
		 			}
		      	?>
	 			<option <?php echo $selec ?> value="<?php echo $res_private['id']?>"><?php echo utf8_encode($res_private['name']) ?></option>
	 		<?php }?>
		      </select>
		    </div>
		  </div>
 		<button class="btn btn-success" name="update">Salvar</button>
 		<a href="id=<?php echo $id_item ?>" class="btn btn-danger text-white" data-toggle="modal" data-target="#deletemodal">Deletar registro</a>
	 </form>
</div>


<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletemodalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h5>Tem certeza que deseja deletar esse registro?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <form action="" method="POST">
        	<button type="submit" class="btn btn-success" name="deletar">Confirmar</button>
      	</form>
      </div>
    </div>
  </div>
</div>