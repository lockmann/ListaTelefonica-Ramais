<?php 
$page = 0;
include('header.php');

if($_POST) {
    $fname = $_POST['fname'];
    $framal = $_POST['framal'];
     
    $sql = "INSERT INTO members (fname, framal, active) VALUES ('$fname', '$framal', 1)";
    if($connect->query($sql) === TRUE) {
        $_SESSION['insert'] = "<div class='alert alert-success m-0 text-center mt-2'role='alert'>
  										Ramal adicionado
									</div>";
    } else {
        echo "Error " . $sql . ' ' . $connect->connect_error;
    }
 
    $connect->close();
}
 
?>
<div class="container p-0 bd">
		<div class="container mb-3">
			<div class="shadow rounded-bottom">
				<div class="Mtitle bg-white border rounded-top border-bottom-1 mt-2 pt-2 text-center "><b><h4>Adicionar Ramal</h4></b></div>
				<div class="bg-white Mbodybox border-top-0 border border-bottom-0 mb-2">
					<div class="container add">
							<?php 
								if(isset($_SESSION['insert'])){
									echo $_SESSION['insert'];
									unset($_SESSION['insert']);
								}
							?>
						<form action="" method="post" class="text-center">
					        <input type="text" class="form-control" name="fname" placeholder="Setor" required="required" maxlength="255">
					        <input type="text" class="form-control mt-2 mb-2" name="framal" placeholder="Ramal" required="required" maxlength="4">
					        <?php include ("ramal_action/button.php") ?>
					    </form>
					</div>
				</div>
				<div class="Mtitle bg-white border rounded-bottom border-bottom-1 mt-0 p-2 text-center ">Copyright © 2020 - Hospital Santa Marcelina</div>
			</div>
		</div>
	</div>
</body>
</html>