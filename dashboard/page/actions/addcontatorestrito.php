<?php

	if($_POST) {
    $id = $_SESSION['userId'];
    $dt = date("Y-m-d H:i");
    $nome = $_POST['nome'];
    
    $busca = "SELECT * FROM restricted WHERE name = '$nome' && status = 0";
    $busca = mysqli_query($connect, $busca);
    $busca = mysqli_fetch_array($busca);
    $busca_nome =  $busca['name'];

	    if ($busca_nome == $nome) {
	    	$_SESSION['insert'] = "<div class='alert alert-danger m-0 text-center mt-2'role='alert'>
		  								Contato <b>".$nome."</b> já cadastrado.		  								
									</div>";
	    }else{
	    	$sql = "INSERT INTO restricted (name, status, insert_by, dt) VALUES ('$nome', '0', '$id', '$dt')";
		    
		    if($connect->query($sql) === TRUE) {
		        $_SESSION['insert'] = "<div class='alert alert-success m-0 text-center mt-2'role='alert'>
		  									Contato adicionado
										</div>";
				$connect->close();					
		    } else {
		        $_SESSION['insert'] = "<div class='alert alert-warning m-0 text-center mt-2'role='alert'>
		  								Dados inválidos, por favor verifique as informações preenchidas e tente novamente.			
									</div>";
		    }
	    }
	}
?>
<div class="container-fluid p-4 m-0">
	<div class="d-flex justify-content-between name-page">
		<h4 class="d-inline m-0">Adicionar Contato Restrito</h4>
		<a href="?p=adicionar-numero-restrito">
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
	 	<input class="form-control mb-3" type="text" name="nome" maxlength="100" required="required">
 		<button class="btn btn-success">Confirmar</button>	
	 </form>
	
</div>