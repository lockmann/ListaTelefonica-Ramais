<?php
	if(isset($_POST['confirmar'])){

		$id = $_SESSION['userId'];
		$nome = $_POST['nome'];
		$role = $_POST['funcao'];
		if($role == "Administrador"){
			$nivelacesso = 1;
		}elseif($role == "Gestor"){
			$nivelacesso = 2;
		}
		$login = $_POST['login'];
		$senha = md5($login);
		$dt = date("Y-m-d H:i");


		$sql = "SELECT * FROM user WHERE login = '$login'";
		$sql = mysqli_query($connect, $sql);
		$sqlR = mysqli_fetch_array($sql);

		if(empty($sqlR)){

			$sql = "INSERT INTO user (name, role, accesslevel, status, login, password, insert_by, dt) VALUES ('$nome', '$role', '$nivelacesso', '1', '$login', '$senha', '$id', '$dt')";
		    
		    if($connect->query($sql) === TRUE) {
		        $_SESSION['insert'] = "<div class='alert alert-success m-0 text-center mt-2'role='alert'>
		  									Usuário criado.
										</div>";
				$connect->close();
					
		    } else {
		        $_SESSION['insert'] = "<div class='alert alert-warning m-0 text-center mt-2'role='alert'>
		  								Dados inválidos, por favor verifique as informações preenchidas e tente novamente.			
									</div>";
		    }
		}else{

		   $_SESSION['insert'] = "<div class='alert alert-danger m-0 text-center mt-2'role='alert'>
		  								Login informado já cadastrado.			
									</div>";
		}
	}
?>
<div class="container-fluid p-4 m-0">
	<div class="d-flex justify-content-between name-page">
		<h4 class="d-inline m-0">Criar Usuário</h4>
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
	?>
	 <form action="" method="POST">
	 	<label for="nome">Nome*</label>
	 	<input class="form-control" type="text" name="nome" required="required" maxlength="100">
	 	<label for="funcao">Função*</label>
	 	<select class="form-control" name="funcao" required="required">
	 		<option value="" disabled="disabled" selected="selected"></option>
	 		<option value="Administrador">Administrador</option>
	 	</select>
	 	<label for="login">Login*</label>
	 	<input class="form-control" type="text" name="login" required="required" maxlength="100">
	 	<button class="btn btn-success mt-3" name="confirmar">Confirmar</button>		
	 </form>
	
</div>