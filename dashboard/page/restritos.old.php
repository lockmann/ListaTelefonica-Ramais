<?php
	
	if(isset($_POST['filtrar'])){
		$busca = $_POST['busca'];
		$sql = "SELECT * FROM restricted WHERE name LIKE '%$busca%' ORDER BY name ASC";
		$sql = mysqli_query($connect, $sql);
	}else{
		$sql = "SELECT * FROM restricted ORDER BY name ASC";
		$sql = mysqli_query($connect, $sql);
	}
?>

<div class="container-fluid p-4 m-0">
	<div class="d-flex name-page align-items-center">
		<h3 class="d-inline m-0 mr-2">Contatos Restritos</h3>
			<div>
				<a href="?p=adicionar-numero-restrito">
					<svg width="1.4em" height="1.4em" viewBox="0 0 16 16" class="bi bi-telephone-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					  <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.471 17.471 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969zM12.5 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H12V.5a.5.5 0 0 1 .5-.5z"/>
					  <path fill-rule="evenodd" d="M12 3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H13v2.5a.5.5 0 0 1-1 0v-3z"/>
					</svg>
				</a>
			</div>
	</div>
	<div class="mt-4">
		<form method="POST">
			<label for="filtro"><b>Buscar</b></label>
			<div class="form-row">
				<div class="form-group col-md-4">
					<input type="text" name="busca" class="form-control">
				</div>
				<div class="form-group col-md-4">
					<button class="btn btn-primary" name="filtrar">
						Buscar
						<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
						  <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
						  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
						</svg>
					</button>
				</div>
				
			</div>
		</form>
		<?php 
			while ($result = $sql->fetch_array()){ 
			$id = $result['id'];
		?>
			<div class="accordion mb-2" id="accordion<?php echo $result['id'] ?>">
				<div class="card rounded border border-gray">
				    <div class="card-header name-page d-flex align-items-center justify-content-between p-0" id="heading<?php echo $result['id'] ?>">
				      <h2 class="mb-0">
				        <button class="btn btn-link btn-block text-left " type="button" data-toggle="collapse" aria-expanded="false" data-target="#collapse<?php echo $result['id'] ?>" aria-controls="collapse<?php echo $result['id'] ?>" style="color: #000">
				        <?php echo $result['name'] ?>
				        </button>
				      </h2>
				      <a href="?p=r&id=<?php echo $id ?>">
				      	<svg width="1.6em" height="1.6em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
							  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
						</svg>
				      </a>
				    </div>
				    <div id="collapse<?php echo $result['id'] ?>" class="collapse p-0 m-0" aria-labelledby="heading<?php echo $result['id'] ?>" data-parent="#accordion<?php echo $result['id'] ?>">
				      <div class="card-body p-0">
						<div class="container-fluid p-0">
							<textarea class="form-control m-0 bg-white border-none" readonly style="resize: none;"><?php echo $result['num'] ?></textarea>
						</div>
				      </div>
				    </div>
				</div>
			</div>
		<?php } ?>	
	</div>
</div>


			