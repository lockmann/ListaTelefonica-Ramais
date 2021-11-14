<?php

	$id = $_GET['id'];

	$sql = "SELECT * FROM restricted WHERE id = $id";
	$sql = mysqli_query($connect, $sql);
	$result = mysqli_fetch_assoc($sql);

	$sql2 = "SELECT * FROM restricted_num WHERE id_restricted = $id && status=0 && type=0 ORDER BY id";
	$sql3 = "SELECT * FROM restricted_num WHERE id_restricted = $id && status=0 && type=1 ORDER BY id";
	$sql2 = mysqli_query($connect, $sql2);
	$sql3 = mysqli_query($connect, $sql3);


	if(isset($_POST['salvarnome'])){
		$nome = $_POST['nome'];
		$busca = "SELECT * FROM restricted WHERE name = '$nome'";
	    $busca = mysqli_query($connect, $busca);
	    $busca = mysqli_fetch_array($busca);
	    $busca_nome =  $busca['name'];
		

		if ($busca_nome == $nome) {
	    	$_SESSION['insert'] = "<div class='alert alert-danger m-0 text-center mt-2'role='alert'>
		  								Contato <b>".$nome."</b> já cadastrado.		  								
									</div>";
	    }else{
	    	$sql = "UPDATE restricted SET name = '$nome' WHERE id = '$id'";
			
			if($connect->query($sql) === TRUE) {
				echo "<div class='m-2'>Atualizando...</div>";
				printf('<script>window.location.href = "";</script>');
		    }
	    }
	}
?>
<div class="container-fluid p-4 m-0">
	<div class="d-flex justify-content-between name-page">
		<div class="h-100 d-flex align-items-center">
			<h4 class="d-inline m-0 mr-2">Editar Informações</h4>
		</div>
		<a href="?p=restritos" class="justify-content-end">
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
	?>
	<form action="" method="POST" name="nome">
	 	<label for="nome">Nome*</label>
	 	<input class="form-control" type="text" name="nome" maxlength="100" required="required" value="<?php echo $result['name'] ?>">	

	 	<label for="nome">Números cadastrados*</label>
	 	<?php 
	 	if(($sql2->num_rows == 0) and ($sql3->num_rows == 0)){
	 		echo "<div class='mb-3'><a href='?p=adicionar-numero-restrito'>+ Adicione um número para este contato</a></div>";
	 	}else{
	 		while ($result = $sql2->fetch_array()) { ?>
		 	<div class="form-row">
				<div class="form-group col-md-11">
		 			<input type="text" class="form-control" name="numerofixo" minlength="14" maxlength="14" onkeypress="$(this).mask('(00) 0000-0000')" value="<?php echo $result['num']; ?>" disabled="">
				</div>
				<div class="form-group col-md-1">
					<a href="?p=dr&id=<?php echo $id."&id_item=".$result['id'] ?>" class="btn btn-danger w-100" data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Deletar</a>
				</div>
			</div>
			<?php } ?>
		 	<?php while ($result = $sql3->fetch_array()) { ?>
		 	<div class="form-row">
				<div class="form-group col-md-11">
		 			<input type="text" class="form-control" name="numerofixo" minlength="14" maxlength="14" onkeypress="$(this).mask('(00) 0000-0000')" value="<?php echo $result['num']; ?>" disabled="">
				</div>
				<div class="form-group col-md-1">
					<a href="?p=dr&id=<?php echo $id."&id_item=".$result['id'] ?>" class="btn btn-danger w-100" data-confirm='Tem certeza de que deseja excluir o item selecionado?'>Deletar</a>
				</div>
			</div>
		<?php } 
		} ?>
		<button type="submit" class="btn btn-success" name="salvarnome">Salvar</button>
		<a href="?p=dr&id=<?php echo $id ?>" class="btn btn-danger">Deletar contato</a>
	</form>
</div>