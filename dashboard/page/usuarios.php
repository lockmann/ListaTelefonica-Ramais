<?php

	$by = "name ASC";
	$where = "1=1";
	if(isset($_POST{'nome'})){
		$by = "name ASC";
	}elseif (isset($_POST['login'])) {
		$by = "login ASC";
	}elseif(isset($_POST['NA'])){
		$by = "accesslevel ASC";
	}elseif(isset($_POST['status'])){
		$by = "status_user. `id`";
	}

	if(isset($_POST['filtrar'])){
		$busca =  $_POST['busca'];
		$opcao = $_POST['opcao'];

		if($opcao == 1){
			$where = "user. `name` LIKE '%$busca%'";
		}elseif ($opcao == 2) {
			$where = "user. `login` LIKE '%$busca%'";
		}elseif ($opcao == 3) {
			$where = "user. `accesslevel` = 1";
		}elseif ($opcao == 4) {
			$where = "user. `accesslevel` = 2";
		}elseif ($opcao == 5){
			$where = "user. `status` = 1";
		}elseif ($opcao == 6){
			$where = "user. `status` = 2";
		}
		
	}

	$sql = "SELECT user.*, status_user.`name` AS status FROM `user` 
	INNER JOIN `status_user` ON `user`.status = status_user.`id`
	WHERE $where
	ORDER BY $by";
	$sql = mysqli_query($connect, $sql);
	

?>

<div class="container-fluid p-4 m-0">
	<div class="d-flex name-page align-items-center">
		<h3 class="d-inline m-0 mr-2">Usuários</h3>
			<div>
				<a href="?p=adicionar-usuario">
					<svg width="1.6em" height="1.6em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
				  		<path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
				  		<path fill-rule="evenodd" d="M13 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/>
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
						<option value="1">Nome</option>
						<option value="2">Login</option>
						<option value="3">Administrador</option>
						<option value="4">Gestor</option>
						<option value="5">Ativo</option>
						<option value="6">Inativo</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<input type="text" name="busca" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<button class="btn btn-primary" name="filtrar">
						Filtrar
						<svg width="1.4em" height="1.4em" viewBox="0 0 16 16" class="bi bi-telephone-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-funnel-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  	<path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
						</svg>
					</button>
				</div>
			</div>
		</form>
		<table class="rounded table table-striped table-hover table-sm m-0">
			<tbody class="">
				<tr>
					<form method="POST">
						<td width="50%"><button class="btn p-0 dropdown-toggle" name="nome"><b>Nome</b></button></td>
						<td><button class="btn p-0 dropdown-toggle" name="login"><b>Login</b></button></td>
						<td><button class="btn p-0 dropdown-toggle" name="NA"><b>Nível de acesso</b></button></td>
						<td><button class="btn p-0 dropdown-toggle" name="status"><b>Status</b></button></td>
					</form>
				</tr>
				<?php while ($result = $sql->fetch_array()) { ?>
					<tr>
						<td><a href="?p=ue&id=<?php echo $result['id'] ?>" class="text-black"><?php echo $result['name']?></a></td>
						<td><?php echo $result['login']?></td>
						<td><?php echo $result['role']?></td>
						<td><?php echo $result['status']?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>