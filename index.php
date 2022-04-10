<?php
$index = 0;
include('header.php');
?>
	<div class="container p-0 bd mb-4">
		<?php include('abc.php') ?>
		<div class="container mt-2">
			<div class="border rounded  bg-white">
				<div id="title" class="text-center border-bottom p-3">
					<b><h5 class="p-0 m-0">Lista de ramais informatizada</h5></b>
				</div>
				<div id="main">
					<?php 
						if(isset($_GET['l']) and ($_GET['l'] == "bips")){
							include("bips.php");
						}elseif(isset($_GET['l']) and ($_GET['l'] == "linhasdiretas")){
							include("linhasdiretas.php");
						}else{
							include("main.php");# code...
						}
						 
					?>
				</div>
				<div id="footer" class="text-center border-top p-3">
					Copyright © <?php echo date("Y"); ?> - <a href="https://henriquelockmann.com.br">Desenvolvido por Henrique Lockmann</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>


