<?php
	
	$busca_restrito = "SELECT * FROM restricted WHERE status = 0 ORDER BY name ASC";
	$busca_restrito = mysqli_query($connect, $busca_restrito);


	if(isset($_POST['confirmar'])){
		$id = $_SESSION['userId'];
		$nome = $_POST['nome'];
		$fixo = $_POST['numerofixo'];
		$celular = $_POST['numerocelular'];
		$dt = date("Y/m/d H:i");
		
		$sqlF = "SELECT `num` FROM restricted_num WHERE num = '$fixo' && status = 0";
		$sqlC = "SELECT `num` FROM restricted_num WHERE num = '$celular' && status = 0";
		$sqlFR = mysqli_query($connect, $sqlF);
		$sqlCR = mysqli_query($connect, $sqlC);
		$sqlFR = mysqli_fetch_array($sqlFR);
		$sqlCR = mysqli_fetch_array($sqlCR);

		if(empty($sqlFR) and (empty($sqlCR))){

			if((empty($fixo)) and (empty($celular))){
				$_SESSION['insert'] = "<div class='alert alert-warning m-0 text-center mt-2'role='alert'>
		  								Você deve informar ao menos um número fixo ou celular.			
									</div>";
			}elseif((!empty($fixo)) and (!empty($celular))){
			
			$sqlF = "INSERT INTO restricted_num (id_restricted, status, num, type, insert_by, dt) VALUES ('$nome', '0', '$fixo', '0', '$id', '$dt')";
		    $sqlC = "INSERT INTO restricted_num (id_restricted, status, num, type, insert_by, dt) VALUES ('$nome', '0', '$celular', '1', '$id', '$dt')";
		    if(($connect->query($sqlF) === TRUE) and ($connect->query($sqlC) === TRUE)) {
		        $_SESSION['insert'] = "<div class='alert alert-success m-0 text-center mt-2'role='alert'>
		  									Números adicionados.
										</div>";
				$connect->close();					
		    }else {
		        $_SESSION['insert'] = "<div class='alert alert-warning m-0 text-center mt-2'role='alert'>
		  								Dados inválidos, por favor verifique as informações preenchidas e tente novamente.			
									</div>";
		    }

			}elseif ((empty($fixo)) or (empty($celular))) {

				if(!empty($fixo)){

					$sqlF = "INSERT INTO restricted_num (id_restricted, status, num, type, insert_by, dt) VALUES ('$nome', '0', '$fixo', '0', '$id', '$dt')";
					if($connect->query($sqlF) === TRUE) {
				        $_SESSION['insert'] = "<div class='alert alert-success m-0 text-center mt-2'role='alert'>
				  									Número fixo adicionado.
												</div>";
						$connect->close();

						
						
			    	} else {
			        	$_SESSION['insert'] = "<div class='alert alert-warning m-0 text-center mt-2'role='alert'>
			  								Dados inválidos, por favor verifique as informações preenchidas e tente novamente.			
										</div>";
			    	}

				}else{
					$sqlC = "INSERT INTO restricted_num (id_restricted, status, num, type, insert_by, dt) VALUES ('$nome', '0', '$celular', '1', '$id', '$dt')";
					if($connect->query($sqlC) === TRUE) {
			        	$_SESSION['insert'] = "<div class='alert alert-success m-0 text-center mt-2'role='alert'>
			  									Número celular adicionado.
											</div>";
						$connect->close();

						
					
		    		}else {
		        		$_SESSION['insert'] = "<div class='alert alert-warning m-0 text-center mt-2'role='alert'>
		  								Dados inválidos, por favor verifique as informações preenchidas e tente novamente.			
									</div>";
		    		}
				}
			}
		}else{
			$_SESSION['insert'] = "<div class='alert alert-danger m-0 text-center mt-2'role='alert'>
		  								Número <b>".$fixo." ".$celular."</b> já cadastrado.			
									</div>";
		}

	};

?>
<div class="container-fluid p-4 m-0">
	<div class="d-flex justify-content-between name-page">
		<div class="h-100 d-flex align-items-center">
			<h4 class="d-inline m-0 mr-2">Adicionar Número Restrito</h4>
			<a href="?p=adicionar-contato-restrito">
				<svg width="1.6em" height="1.6em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				  <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
				  <path fill-rule="evenodd" d="M13 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/>
				</svg>
			</a>
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
	 <form action="" method="POST">
	 	<label for="nome">Nome*</label>
	 	<select class="form-control" name="nome" required="required">
	 		<option disabled="disabled" selected="selected"></option>
	 		<?php while($restrito = $busca_restrito->fetch_array()){ ?>
	 			<option value="<?php echo $restrito['id']?>"><?php echo $restrito['name'] ?></option>
	 		<?php }?>
	 	</select>
	 	<div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="número">Telefone fixo</label>
		      <input type="text" class="form-control" name="numerofixo" minlength="14" maxlength="14" onkeypress="$(this).mask('(00) 0000-0000')">
		    </div>
		    <div class="form-group col-md-6">
		      <label for="status">Celular</label>
		      <input type="text" class="form-control" name="numerocelular" minlength="15" maxlength="15" onkeypress="$(this).mask('(00) 00000-0000')">
		    </div>
		  </div>
 		<button class="btn btn-success" name="confirmar">Confirmar</button>	
	 </form>
	
</div>