<?php
	$voltar = "?p=r&";
	$id_contact = "id=".$_GET['id'];
	if(empty($_GET['id_item'])){
		$id_item = "";
		$id_restrito = $_GET['id'];
		$sql = "SELECT * FROM restricted WHERE id = '$id_restrito'";
		$sql = mysqli_query($connect,$sql);
		$result = mysqli_fetch_array($sql);

	}else{
		$id_item = $_GET['id_item'];
		$sql = "SELECT * FROM restricted_num WHERE id= $id_item";
		$sql = mysqli_query($connect, $sql);
		$sql = mysqli_fetch_assoc($sql);
	}
	

	if(isset($_POST['deletar'])){
		$id_item = $sql['id'];
		$sql = "UPDATE restricted_num SET status = 1, delete_by = '$id_user', dt_delete = '$dt_' WHERE id = $id_item";
			
			if($connect->query($sql) === TRUE) {
				echo "<div class='m-2'>Atualizando...</div>"; ?>
				<script>window.location.href = "<?php echo $voltar,$id_contact ?>";</script>
			<?php }
	}

	if(isset($_POST['deletar_contato'])){
		$sql = "UPDATE restricted SET status = 1, delete_by = '$id_user', dt_delete = '$dt_' WHERE id = $id_restrito ";
		$sql = mysqli_query($connect, $sql);
		$sql2 = "UPDATE restricted_num SET status = 1, delete_by = '$id_user', dt_delete = '$dt_' WHERE id_restricted = $id_restrito";


		if($connect->query($sql2) === TRUE) {
				echo "<div class='m-2'>Atualizando...</div>"; ?>
				<script>window.location.href = "?p=restritos";</script>
			<?php }

	}
?>
<div class="container-fluid p-4 m-0">
	<div class="d-flex justify-content-between name-page">
		<h4 class="d-inline m-0">Deletar Registro</h4>
		<a href="<?php echo $voltar,$id_contact ?>">
			<svg width="1.6em" height="1.6em" viewBox="0 0 16 16" class="bi bi-arrow-left-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
			  <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.354 10.646a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L6.207 7.5H11a.5.5 0 0 1 0 1H6.207l2.147 2.146z"/>
			</svg>
		</a>	
	</div>

	<?php 
		if(empty($id_item)){ ?>
		<div class="alert mt-4 text-center">
			<h5>Tem certeza que deseja deletar esse registro?</h5>
			<h6><?php echo $result['name'] ?></h6>
			<small class="text-muted">Ao excluir este contato, será excluído também todos os números cadastrados.</small>
			<h6 class="mb-3"></h6>
			
			<form method="POST" action="">
				<a href="<?php echo $voltar,$id_contact ?>" class="btn btn-danger">Cancelar</a>
				<button name="deletar_contato" class="btn btn-success" >Confirmar</button>
			</form>
		</div>

	<?php }else{?>


	<div class="alert mt-4 text-center">
		<h5>Tem certeza que deseja deletar esse registro?</h5>
		<h6><?php echo $sql['num'] ?></h6>
		<h6 class="mb-3"></h6>
		
		<form method="POST" action="">
			<a href="<?php echo $voltar,$id_contact ?>" class="btn btn-danger">Cancelar</a>
			<button name="deletar" class="btn btn-success" >Confirmar</button>
		</form>
		
	</div>
<?php } ?>
</div>