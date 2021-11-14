<?php
	$busca_setores = "SELECT * FROM section ORDER BY name ASC";
	$busca_setores = mysqli_query($connect, $busca_setores);

	if($_POST) {
    $id = $_SESSION['userId'];
    $dt = date("Y-m-d H:i");
    $setor = $_POST['setor'];
    $complemento = utf8_encode($_POST['complemento']);
    $numero = $_POST['numero'];
    $private = $_POST['status'];
    
    $busca = "SELECT branch_line.*, section. `name` AS section_id FROM `branch_line` INNER JOIN `section` ON `branch_line`.`section_id` = section.`id` WHERE num = '$numero' && status = 0 && type = 1";

    $busca = mysqli_query($connect, $busca);
    $busca = mysqli_fetch_assoc($busca);
    $busca_num =  $busca['num'];
    $busca_status = $busca['status'];
    $busca_setor = utf8_encode($busca['section_id']);
    $busca_complemento = $busca['complement'];
	    if ($busca_num == $numero) {
	    	$_SESSION['insert'] = "<div class='alert alert-danger m-0 text-center mt-2'role='alert'>
		  								Número <b>".$busca_num."</b> já cadastrado com o setor <b>".$busca_setor."</b>		  								
									</div>";
	    }else{
	    	$sql = "INSERT INTO branch_line (section_id, complement, num, status, private, type, insert_by, dt) VALUES ('$setor', '$complemento', '$numero', '0', '$private', '1', '$id', '$dt')";
		    
		    if($connect->query($sql) === TRUE) {
				 $_SESSION['insert'] = "<div class='alert alert-success m-0 text-center mt-2'role='alert'>
		  									Número adicionado
										</div>";
				 
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
		<h4 class="d-inline m-0">Adicionar Bip</h4>
		<a href="?p=bips">
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
	 	<label for="setor">Setor*</label>
	 	<select class="form-control" name="setor" required="required">
	 		<option disabled="disabled" selected="selected"></option>
	 		<?php while($setor = $busca_setores->fetch_array()){ ?>
	 			<option value="<?php echo $setor['id']?>"><?php echo utf8_encode($setor['name']) ?></option>
	 		<?php }?>
	 	</select>
	 	<label for="complemento">Complemento</label>
	 	<input class="form-control" type="text" name="complemento" maxlength="100">
	 	<div class="form-row">
		    <div class="form-group col-md-6">
		      <label for="número">Número*</label>
		      <input type="text" class="form-control" name="numero" minlength="4" maxlength="4" onkeypress="$(this).mask('0000')" required="required">
		    </div>
		    <div class="form-group col-md-6">
		      <label for="status">Status*</label>
		      <select class="form-control" name="status" required="required">
		      	<option selected="selected" disabled="disabled"></option>
		      	<option value="1">Público</option>
		      	<option value="2">Privado</option>
		      </select>
		    </div>
		  </div>
 		<button class="btn btn-success">Confirmar</button>	
	 </form>
</div>