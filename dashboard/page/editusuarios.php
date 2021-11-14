<?php
	if(empty($_GET['id'])){
		$_GET['id'] ="";
	}
	$id_user_edit = $_GET['id'];

	$sql = "SELECT * FROM user WHERE id = '$id_user_edit'";
	$sql = mysqli_query($connect, $sql);
	$res = mysqli_fetch_assoc($sql);

	if(isset($_POST['confirmar'])){

		$nome = $_POST['nome'];
		$role = $_POST['funcao'];
		if($role == "Administrador"){
			$nivelacesso = 1;
		}elseif($role == "Gestor"){
			$nivelacesso = 2;
		}
		$status = $_POST['status'];

			$sql = "UPDATE user SET name='$nome',role='$role',accesslevel='$nivelacesso',status='$status',edit_by='$id_user',dt_edit='$dt_'  WHERE id = $id_user_edit";
		    
		    if($connect->query($sql) === TRUE) {
		        echo "<div class='m-2'>Atualizando...</div>";
				        printf('<script>window.location.href = "?p=usuarios";</script>');
				$connect->close();
					
		    } else {
		        $_SESSION['insert'] = "<div class='alert alert-warning m-0 text-center mt-2'role='alert'>
		  								Dados inválidos, por favor verifique as informações preenchidas e tente novamente.			
									</div>";
		    }
	}

?>
<div class="container-fluid p-4 m-0">
	<div class="d-flex justify-content-between name-page">
		<h4 class="d-inline m-0">Editar Informações</h4>
		<a href="?p=usuarios">
			<svg width="1.6em" height="1.6em" viewBox="0 0 16 16" class="bi bi-arrow-left-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.354 10.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L6.207 7.5H11a.5.5 0 0 1 0 1H6.207l2.147 2.146z"/>
			</svg>
		</a>	
	</div>
	<small class="text-muted">Campos marcados com * são de preenchimento obrigatório.</small>
	<?php 
		if(isset($_SESSION['insert'])){
			echo $_SESSION['insert'];
			unset($_SESSION['insert']);
		}
		
		if(empty($res) or ($id_user_edit == 1 )){

		}else{ ?>
		 <form action="" method="POST">
		 	<label for="nome">Nome*</label>
		 	<input class="form-control" type="text" name="nome" required="required" maxlength="100" value="<?php echo $res['name'] ?>">
		 	<label for="login">Login*</label>
		 	<input class="form-control" type="text" name="login" required="required" maxlength="100" value="<?php echo $res['login'] ?>" disabled="">
		 	<div class="form-row">
		 		<?php 
		 			if($res['accesslevel'] == 1 ){
		 				$select1 = "selected=''";
		 				$select2 = "";
		 			}elseif ($res['accesslevel'] == 2){
		 				$select1 = "";
		 				$select2 = "selected=''";
		 			}

		 			if($res['status'] == 1 ){
		 				$select_status1 = "selected=''";
		 				$select_status2 = "";
		 			}elseif ($res['status'] == 2){
		 				$select_status1 = "";
		 				$select_status2 = "selected=''";
		 			}

		 		?>
		 		<div class="col-md-6">
		 			<label for="funcao">Função*</label>
		 			<select class="form-control" name="funcao" required="required">
				 		<option value="Administrador" <?php echo $select1 ?>>Administrador</option>
			 		</select>
		 		</div>
		 		<div class="col-md-6">
		 			<label for="status">Status*</label>
		 			<select class="form-control" name="status" required="required">
				 		<option value="1" <?php echo $select_status1 ?>>Ativo</option>
				 		<option value="2" <?php echo $select_status2 ?>>Inativo</option>
			 		</select>
		 		</div>
		 	</div>
		 	<button class="btn btn-success mt-3" name="confirmar">Salvar</button>		
		 </form>
		<?php } ?>
	
</div>