<?php
	if(isset($_POST['confirmar'])){

		$id = $_SESSION['userId'];
		$senhaatual = md5($_POST['senhaatual']);
		$novasenha = md5($_POST['novasenha']);
		$novasenha2 = md5($_POST['novasenha2']);

		$sql = "SELECT * FROM user WHERE id = $id";
		$sql = mysqli_query($connect, $sql);
		$sql = mysqli_fetch_array($sql);
		$sqlR = $sql['password'];

		if($senhaatual == $sqlR){
			if ($novasenha == $novasenha2) {
				
				$sql = "UPDATE user SET password = '$novasenha' WHERE id = $id";
		    
			    if($connect->query($sql) === TRUE) {
			        $_SESSION['insert'] = "<div class='alert alert-success m-0 text-center mt-2'role='alert'>
			  									Senha alterada.
											</div>";
					$connect->close();
			    } else {
			        $_SESSION['insert'] = "<div class='alert alert-warning m-0 text-center mt-2'role='alert'>
			  								Dados inválidos, por favor verifique as informações preenchidas e tente novamente.			
										</div>";
					echo "Erro ao atualizar registro : ". $connect->error;
			    }

			}else{
				$_SESSION['insert'] = "<div class='alert alert-danger m-0 text-center mt-2'role='alert'>
			  								Repita a nova senha corretamente.			
										</div>";
			}
		}else{
			 $_SESSION['insert'] = "<div class='alert alert-danger m-0 text-center mt-2'role='alert'>
			  								Senha atual incorreta.			
										</div>";
		}
	}
?>
<div class="container-fluid p-4 m-0">
	<div class="d-flex name-page align-items-center">
		<h3 class="d-inline m-0 mr-2">Alterar Senha</h3>
	</div>
	<small class="text-muted">Campos marcados com * são de preenchimento obrigatório.</small>
	<?php 
		if(isset($_SESSION['insert'])){
			echo $_SESSION['insert'];
			unset($_SESSION['insert']);
		}
	?>
	<div>
		<form method="POST">
			<label>Senha atual*</label>
			<input class="form-control" type="password" name="senhaatual" minlength="4" required="required">
			<label>Nova senha*</label>
			<small class="text-muted">Sua nova senha deve ter no mínimo 4 caracteres</small>
			<input class="form-control" type="password" name="novasenha"   minlength="4" required="required">		
			<label>Repita a nova senha*</label>
			<input class="form-control" type="password" name="novasenha2"   minlength="4" required="required">
			<button class="btn btn-success mt-3" name="confirmar">Confirmar</button>			
		</form>
	</div>
</div>